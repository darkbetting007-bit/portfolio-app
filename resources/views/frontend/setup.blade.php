<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="refresh" content="15">
    <title>Setting Up — {{ config('app.name', 'Portfolio') }}</title>
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: #0a0a0a;
            color: #e5e5e5;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .card {
            text-align: center;
            max-width: 480px;
            padding: 3rem 2rem;
        }
        .spinner {
            width: 48px;
            height: 48px;
            border: 3px solid #333;
            border-top-color: #6366f1;
            border-radius: 50%;
            animation: spin 0.9s linear infinite;
            margin: 0 auto 2rem;
        }
        @keyframes spin { to { transform: rotate(360deg); } }
        h1 {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 0.75rem;
            color: #fff;
        }
        p {
            color: #9ca3af;
            line-height: 1.6;
            margin-bottom: 0.5rem;
        }
        .hint {
            margin-top: 1.5rem;
            font-size: 0.8rem;
            color: #4b5563;
        }
    </style>
</head>
<body>
    <div class="card">
        <div class="spinner"></div>
        <h1>Setting up your portfolio…</h1>
        <p>Database migrations are running in the background.</p>
        <p>This page will refresh automatically once everything is ready.</p>
        <p class="hint">This usually takes less than a minute on first deploy.</p>
    </div>
</body>
</html>
