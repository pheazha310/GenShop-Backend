<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <style>
        body { font-family: Arial, sans-serif; background: linear-gradient(135deg, #0f172a, #1d4ed8); min-height: 100vh; display: grid; place-items: center; margin: 0; }
        .card { width: min(420px, calc(100vw - 32px)); background: white; border-radius: 16px; padding: 24px; box-shadow: 0 20px 60px rgba(0,0,0,.25); }
        label { display:block; margin-bottom: 12px; }
        input { width:100%; padding: 12px; border:1px solid #cbd5e1; border-radius: 10px; margin-top: 6px; }
        button { width: 100%; padding: 12px; border: 0; border-radius: 10px; background: #2563eb; color: white; font-weight: 700; }
    </style>
</head>
<body>
<div class="card">
    <h1>Admin Login</h1>
    <form method="POST" action="{{ route('admin.login.store') }}">
        @csrf
        <label>Email<input type="email" name="email" required></label>
        <label>Password<input type="password" name="password" required></label>
        <button type="submit">Sign in</button>
    </form>
</div>
</body>
</html>
