<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
  body { font-family: Arial, sans-serif; background:#0f172a; margin:0; padding:0; }
  .wrapper { max-width:540px; margin:40px auto; }
  .header { background:#111827; border-radius:4px 4px 0 0; padding:32px 36px 28px; }
  .header img { height:32px; margin-bottom:20px; display:block; }
  .header h1 { font-size:20px; color:#f9fafb; margin:0 0 6px; font-weight:700; }
  .header p  { font-size:12px; color:rgba(255,255,255,0.4); margin:0; }
  .body { background:#1f2937; padding:32px 36px; border-radius:0 0 4px 4px; }
  .body p { font-size:14px; color:#d1d5db; line-height:1.7; margin:0 0 16px; }
  .btn-wrap { text-align:center; margin:28px 0; }
  .btn { display:inline-block; background:#eab308; color:#111827;
         font-size:14px; font-weight:700; padding:14px 36px;
         border-radius:3px; text-decoration:none; letter-spacing:0.3px; }
  .notice { background:rgba(234,179,8,0.08); border:1px solid rgba(234,179,8,0.2);
            border-radius:3px; padding:12px 16px; font-size:12px; color:#9ca3af;
            line-height:1.6; margin-top:20px; }
  .notice a { color:#eab308; word-break:break-all; }
  .footer { text-align:center; margin-top:20px; font-size:11px; color:#4b5563; }
</style>
</head>
<body>
<div class="wrapper">
  <div class="header">
    <p style="font-size:10px;letter-spacing:2px;text-transform:uppercase;color:#eab308;margin:0 0 14px;font-weight:700;">◆ Printbuka Staff Portal</p>
    <h1>Verify Your Email Address</h1>
    <p>Account verification required before access is granted.</p>
  </div>
  <div class="body">
    <p>Hi {{ $admin->first_name }},</p>
    <p>
      Your Printbuka staff account has been created. Before you can log in, you need to verify your email address by clicking the button below.
    </p>
    <p>
      After verification, a <strong style="color:#eab308;">SuperAdmin</strong> will need to activate your account. You'll be able to log in once both steps are complete.
    </p>
    <div class="btn-wrap">
      <a href="{{ $verificationUrl }}" class="btn">Verify My Email →</a>
    </div>
    <div class="notice">
      <p style="margin:0 0 6px;font-weight:700;color:#d1d5db;">Link not working?</p>
      Copy and paste this URL into your browser:<br>
      <a href="{{ $verificationUrl }}">{{ $verificationUrl }}</a>
      <p style="margin:10px 0 0;color:#6b7280;">This link expires in 24 hours. If you did not create this account, you can safely ignore this email.</p>
    </div>
  </div>
  <div class="footer">
    This email was sent to {{ $admin->email }} — Printbuka Staff Portal<br>
    Strictly confidential. Do not forward this link.
  </div>
</div>
</body>
</html>
