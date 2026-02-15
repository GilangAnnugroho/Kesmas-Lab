<!DOCTYPE html>
<html lang="id" data-theme="light">
<head>
    <meta charset="UTF-8">
    <title>Login Admin Kesmas</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root{
            --bg:#e0f2fe;
            --card:#ffffffcc;
            --primary:#2563eb;
            --accent:#06b6d4;
            --text:#0f172a;
            --radius:20px;
            --shadow:0 25px 60px rgba(15,23,42,.28);
        }

        body{
            margin:0;
            font-family:'Inter', sans-serif;
            min-height:100vh;
            display:flex;
            align-items:center;
            justify-content:center;
            background:radial-gradient(circle at top,#bfdbfe,#eff6ff);
        }

        .login-card{
            width:100%;
            max-width:380px;
            background:var(--card);
            padding:32px 28px;
            border-radius:var(--radius);
            backdrop-filter:blur(16px);
            box-shadow:var(--shadow);
        }

        h2{
            text-align:center;
            font-size:22px;
            font-weight:700;
            margin-bottom:22px;
            color:var(--text);
        }

        label{
            font-size:13px;
            color:#334155;
            font-weight:500;
        }

        input{
            width:100%;
            padding:10px 12px;
            border-radius:12px;
            border:1px solid #cbd5e1;
            margin-top:5px;
            margin-bottom:14px;
            font-size:14px;
        }

        button{
            width:100%;
            padding:12px 0;
            border:none;
            border-radius:999px;
            background:linear-gradient(90deg,var(--primary),var(--accent));
            color:white;
            font-weight:600;
            font-size:15px;
            cursor:pointer;
            box-shadow:0 12px 22px rgba(37,99,235,.35);
        }

        .error{
            color:#b91c1c;
            margin-bottom:10px;
            font-size:13px;
        }

    </style>
</head>
<body>

<div class="login-card">

    <h2>Login Admin Kesmas</h2>

    @if($errors->any())
        <div class="error">{{ $errors->first() }}</div>
    @endif

    <form action="{{ route('login.submit') }}" method="POST">
        @csrf

        <label>Email</label>
        <input type="email" name="email" required>

        <label>Password</label>
        <input type="password" name="password" required>

        <button type="submit">Masuk</button>
    </form>

</div>

</body>
</html>
