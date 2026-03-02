<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Submitted — Printbuka Performance Evaluation</title>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
<script src="https://cdn.tailwindcss.com"></script>
<script>
tailwind.config = {
    theme: {
        extend: {
            fontFamily: {
                sans: ['DM Sans', 'sans-serif'],
                serif: ['Playfair Display', 'serif'],
            },
            colors: {
                ink: '#0f0f0f', paper: '#f7f4ef',
                accent: '#c8420a', muted: '#7a7065',
                border: '#ddd8d0', gold: '#d4a843',
            },
        },
    },
}
</script>
</head>
<body class="font-sans bg-paper text-ink min-h-screen flex items-center justify-center px-6">
    <div class="bg-white border border-border rounded p-16 max-w-md w-full text-center shadow-sm">
        <div class="text-5xl mb-6">✅</div>
        <h1 class="font-serif text-3xl font-bold mb-3">Thank You{{ $name ? ', ' . explode(' ', $name)[0] : '' }}!</h1>
        <p class="text-sm text-muted leading-relaxed mb-3">
            Your evaluation has been submitted successfully. Your feedback is valuable and will contribute to making Printbuka a better place to work.
        </p>
        <p class="text-sm text-muted leading-relaxed mb-6">
            A confirmation has been sent to your email address.
        </p>
        <p class="text-xs text-muted/60">You may now close this tab.</p>
    </div>
</body>
</html>
