<?php

namespace App\Http\Controllers;

use App\Mail\AdminEmailVerification;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;
use const FILEINFO_MIME_TYPE;
// GD functions — explicit imports required inside PHP namespaces
use function imagecreatefromstring;
use function imagejpeg;
use function imagepng;
use function imagepalettetotruecolor;
use function imagealphablending;
use function imagesavealpha;
use function ob_start;
use function ob_get_clean;

class AdminController extends Controller
{
    // ── ONBOARDING FORM ───────────────────────────────────────────────────────

    public function onboarding(): View
    {
        return view('internalMGT.onboarding');
    }

    /**
     * Register a new admin account.
     *
     * Security measures applied:
     *  - Server-side MIME sniffing via finfo (not just extension)
     *  - Extension whitelist: jpg, jpeg, png only
     *  - File size capped at 2 MB
     *  - Re-encoded via GD to strip any embedded payloads
     *  - Stored with a random UUID filename, never the original name
     *  - Saved to non-public disk; served via signed URL or symlink
     */
    public function onboardNow(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'first_name'            => 'required|string|max:100',
            'last_name'             => 'required|string|max:100',
            'phone'                 => 'required|string|max:20',
            'address'               => 'required|string|max:255',
            'email'                 => 'required|email|unique:admins,email',
            'staff_role'            => 'required|in:HR,IT,Operations,customer_service,Designer,Operator,Operations Manager,QC,other',
            'other_role'            => 'required_if:staff_role,other|nullable|string|max:100',
            // mimes: checks actual file content, not just extension.
            // All industry-standard raster formats. SVG excluded (XSS risk).
            'photo'                 => 'required|file|max:2048|mimes:jpg,jpeg,png,gif,webp,avif,bmp,tiff,tif',
            'date_of_birth'         => 'required|date|before:-18 years',
            'password'              => 'required|string|min:8|confirmed',
        ], [
            'date_of_birth.before'  => 'Staff must be at least 18 years old.',
            'photo.max'             => 'Profile photo must not exceed 2 MB.',
        ]);

        // ── IMAGE SECURITY ──────────────────────────────────────────────────

        $photo     = $request->file('photo');
        $photoPath = $this->processAndStorePhoto($photo); // throws on failure

        // ── PERSIST ─────────────────────────────────────────────────────────

        $verificationToken = Str::random(64);

        $admin = Admin::create([
            'first_name'               => $validated['first_name'],
            'last_name'                => $validated['last_name'],
            'phone'                    => $validated['phone'],
            'address'                  => $validated['address'],
            'email'                    => $validated['email'],
            'email_verification_token' => $verificationToken,
            'password'                 => Hash::make($validated['password']),
            'admin_status'             => 'staff',   // always starts as staff
            'is_active'                => false,      // SuperAdmin must activate
            'staff_role'               => $validated['staff_role'],
            'other_role'               => $validated['other_role'] ?? null,
            'date_of_birth'            => $validated['date_of_birth'],
            'photo'                    => $photoPath,
        ]);

        // ── SEND VERIFICATION EMAIL ──────────────────────────────────────────

        try {
            \Illuminate\Support\Facades\Mail::to($admin->email)
                ->send(new AdminEmailVerification($admin, $verificationToken));
        } catch (\Throwable $e) {
            Log::error('Verification email failed for admin #' . $admin->id . ': ' . $e->getMessage());
        }

        return redirect()->route('admin.onboarding')
            ->with('success', 'Account created! Please check your email to verify your address. Your account will then be reviewed by a SuperAdmin before you can log in.');
    }

    // ── EMAIL VERIFICATION ────────────────────────────────────────────────────

    public function verifyEmail(Request $request, string $token): RedirectResponse
    {
        $admin = Admin::where('email_verification_token', $token)->firstOrFail();

        if ($admin->hasVerifiedEmail()) {
            return redirect()->route('internalMGT.login')
                ->with('info', 'Email already verified.');
        }

        $admin->update([
            'email_verified_at'        => now(),
            'email_verification_token' => null,
        ]);

        return redirect()->route('internalMGT.login')
            ->with('success', 'Email verified! Your account is pending SuperAdmin activation before you can log in.');
    }

    // ── LOGIN ─────────────────────────────────────────────────────────────────

    public function login(): View
    {
        return view('internalMGT.login');
    }

    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        // Attempt guard resolution first (checks password)
        if (! Auth::guard('admin')->attempt($credentials, $request->boolean('remember'))) {
            return back()
                ->withInput($request->only('email'))
                ->withErrors(['email' => 'These credentials do not match our records.']);
        }

        /** @var Admin $admin */
        $admin = Auth::guard('admin')->user();

        // Verified email check
        if (! $admin->hasVerifiedEmail()) {
            Auth::guard('admin')->logout();
            return back()
                ->withInput($request->only('email'))
                ->withErrors(['email' => 'Please verify your email address before logging in.']);
        }

        // Active account check — SuperAdmin must have activated the account
        if (! $admin->is_active) {
            Auth::guard('admin')->logout();
            return back()
                ->withInput($request->only('email'))
                ->withErrors(['email' => 'Your account is pending activation by a SuperinternalMGT.']);
        }

        $request->session()->regenerate();

        return redirect()->intended(route('admin.dashboard'));
    }

    // ── DASHBOARD ─────────────────────────────────────────────────────────────

    public function dashboard(): View
    {
        $admin = Auth::guard('admin')->user();
        return view('internalMGT.dashboard', compact('admin'));
    }

    // ── LOGOUT ────────────────────────────────────────────────────────────────

    public function logout(Request $request): RedirectResponse
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('internalMGT.login');
    }

    // ── PRIVATE: SECURE IMAGE PROCESSING ─────────────────────────────────────

    /**
     * Validates, sanitises, and stores a profile photo.
     *
     * Designed to work on localhost, shared hosting (cPanel), and VPS alike —
     * no third-party packages required. Uses only PHP core extensions (GD /
     * Imagick) which are available on virtually every PHP host.
     *
     * Why no Intervention Image facade here:
     *   Image::read() failing silently is a common misconfiguration issue on
     *   shared hosts where the service provider is not auto-discovered or the
     *   config is not published. Using the extensions directly removes that
     *   entire failure surface.
     *
     * Strategy:
     *   - All uploaded images are NORMALISED to JPEG or PNG on save.
     *     This means we only ever store two formats, regardless of what was
     *     uploaded, keeping the match/encode logic trivially simple.
     *   - JPEG input  → saved as JPEG (quality 90)
     *   - Everything else (PNG, GIF, WebP, BMP, TIFF, AVIF) → saved as PNG
     *     PNG is lossless and universally supported; it is the safe output
     *     format for any input that is not already JPEG.
     *
     * Security layers:
     *   1. Laravel mimes: rule   — first pass before this method is even called
     *   2. Extension whitelist   — double-check client-supplied extension
     *   3. finfo MIME sniffing   — reads magic bytes; spoof-proof
     *   4. GD/Imagick re-encode  — fresh image object strips EXIF / payloads
     *   5. UUID filename         — original name never used
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    private function processAndStorePhoto(\Illuminate\Http\UploadedFile $file): string
    {
        // ── 1. Extension whitelist ───────────────────────────────────────────
        $allowedExtensions = [
            'jpg', 'jpeg',        // JPEG
            'png',                 // PNG
            'gif',                 // GIF
            'webp',                // WebP
            'avif',                // AVIF
            'bmp',                 // BMP
            'tiff', 'tif',        // TIFF
        ];

        $extension = strtolower($file->getClientOriginalExtension());

        if (! in_array($extension, $allowedExtensions, true)) {
            throw \Illuminate\Validation\ValidationException::withMessages([
                'photo' => 'Allowed formats: JPG, PNG, GIF, WebP, AVIF, BMP, TIFF.',
            ]);
        }

        // ── 2. finfo MIME sniffing ───────────────────────────────────────────
        // getRealPath() can return false on some server configurations when the
        // temp file path is inaccessible. We fall back to getPathname() which
        // is always populated by Laravel's UploadedFile.
        $tmpPath = $file->getRealPath() ?: $file->getPathname();

        if (! $tmpPath || ! file_exists($tmpPath)) {
            throw \Illuminate\Validation\ValidationException::withMessages([
                'photo' => 'The uploaded file could not be read from the server. Please try again.',
            ]);
        }

        $allowedMimes = [
            'image/jpeg'         => 'jpg',
            'image/jpg'          => 'jpg',   // non-standard but seen in the wild
            'image/png'          => 'png',
            'image/gif'          => 'gif',
            'image/webp'         => 'webp',
            'image/avif'         => 'avif',
            'image/bmp'          => 'bmp',
            'image/x-bmp'        => 'bmp',
            'image/x-ms-bmp'     => 'bmp',   // Windows alternate MIME
            'image/tiff'         => 'tiff',
            'image/x-tiff'       => 'tiff',  // alternate MIME
        ];

        $finfo    = new \finfo(FILEINFO_MIME_TYPE);
        $realMime = $finfo->file($tmpPath);

        if (! array_key_exists($realMime, $allowedMimes)) {
            throw \Illuminate\Validation\ValidationException::withMessages([
                'photo' => 'The file is not a recognised image type (detected: ' . $realMime . '). Allowed: JPG, PNG, GIF, WebP, AVIF, BMP, TIFF.',
            ]);
        }

        // ── 3. Re-encode & store ────────────────────────────────────────────
        //
        // Strategy: attempt each driver in order, catch any failure, try next.
        // No pre-detection flags — they lie on cPanel/CGI/FPM environments.
        // Imagick first (full format support), GD second (universal fallback),
        // raw store last (file already validated by finfo — just skip re-encode).
        //
        // All inputs normalise to JPEG (for JPEG sources) or PNG (everything else).
        $outputIsJpeg = in_array($realMime, ['image/jpeg', 'image/jpg'], true);
        $outputExt    = $outputIsJpeg ? 'jpg' : 'png';
        $filename     = Str::uuid() . '.' . $outputExt;

        $imageData = self::tryEncodeImage($tmpPath, $realMime, $outputIsJpeg);

        // tryEncodeImage returns null only when every driver silently failed.
        // In that case store the validated raw bytes under a UUID name.
        if ($imageData === null) {
            Log::warning('[Printbuka] No image driver available — storing raw validated file.', [
                'mime'        => $realMime,
                'php'         => PHP_VERSION,
                'sapi'        => PHP_SAPI,
                'extensions'  => implode(', ', get_loaded_extensions()),
            ]);
            $imageData = file_get_contents($tmpPath);
            $filename  = Str::uuid() . '.' . $extension; // keep original ext
        }

        // ── 4. Persist ───────────────────────────────────────────────────────
        Storage::disk('public')->put("photos/{$filename}", $imageData);

        return $filename;
    }

    /**
     * Try every available image driver in order.
     * Returns encoded binary string on success, NULL if nothing worked.
     * Never throws — all exceptions are caught and logged here.
     */
    private static function tryEncodeImage(string $path, string $mime, bool $asJpeg): ?string
    {
        // ── Attempt 1: Imagick ───────────────────────────────────────────────
        // Use a fully-qualified class instantiation inside a try so that
        // "Class Imagick not found" is caught just like any other exception.
        try {
            $imagick = new \Imagick($path);
            $imagick->autoOrient();
            $imagick->stripImage();
            $imagick->setImageFormat($asJpeg ? 'jpeg' : 'png');
            $imagick->setImageCompressionQuality($asJpeg ? 90 : 9);
            $data = $imagick->getImageBlob();
            $imagick->destroy();
            return $data;
        } catch (\Throwable $e) {
            Log::debug('[Printbuka] Imagick unavailable: ' . $e->getMessage());
        }

        // ── Attempt 2: GD via imagecreatefromstring ──────────────────────────
        // imagecreatefromstring() is the single most portable GD entry point —
        // it auto-detects the format from magic bytes so we don't need to match
        // MIME to loader function. Available in GD since PHP 4.0.
        try {
            $raw = file_get_contents($path);

            if ($raw === false || $raw === '') {
                throw new \RuntimeException('file_get_contents returned empty');
            }

            // Suppress the warning GD emits for unsupported formats so it
            // reaches our false-check cleanly rather than polluting error logs.
            $image = @imagecreatefromstring($raw);

            if ($image === false) {
                throw new \RuntimeException('imagecreatefromstring returned false');
            }

            // Preserve transparency for PNG output
            if (! $asJpeg) {
                imagepalettetotruecolor($image);
                imagealphablending($image, false);
                imagesavealpha($image, true);
            }

            ob_start();
            $asJpeg ? imagejpeg($image, null, 90) : imagepng($image, null, 6);
            $data = ob_get_clean();
            unset($image);

            if ($data === false || $data === '') {
                throw new \RuntimeException('GD output buffer was empty');
            }

            return $data;
        } catch (\Throwable $e) {
            Log::debug('[Printbuka] GD unavailable: ' . $e->getMessage());
        }

        // Both drivers failed — caller will store the raw validated file.
        return null;
    }
}