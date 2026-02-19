<!doctype html>
<html lang="hu">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Jelszó változtatás</title>
</head>
<body>
    <div style="max-width:480px;margin:40px auto;font-family:Arial,sans-serif;">
        <h2>Jelszó változtatás</h2>

        @if (session('status'))
            <div style="background:#d1e7dd;color:#0f5132;padding:10px 12px;border-radius:4px;margin:12px 0;">
                {{ session('status') }}
            </div>
        @endif

        @if ($errors->any())
            <div style="background:#f8d7da;color:#842029;padding:10px 12px;border-radius:4px;margin:12px 0;">
                <ul style="margin:0;padding-left:18px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('password.reset.submit') }}">
            @csrf
            <input type="hidden" name="token" value="{{ old('token', $token ?? '') }}">
            <input type="hidden" name="email" value="{{ old('email', $email ?? '') }}">

            <div style="margin-top:12px;">
                <label for="password" style="display:block;margin-bottom:6px;">Új jelszó</label>
                <input type="password" id="password" name="password" required style="width:100%;padding:10px;border:1px solid #ccc;border-radius:4px;">
            </div>
            <div style="margin-top:12px;">
                <label for="password_confirmation" style="display:block;margin-bottom:6px;">Új jelszó megerősítése</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required style="width:100%;padding:10px;border:1px solid #ccc;border-radius:4px;">
            </div>
            <button type="submit" style="margin-top:16px;background:#0d6efd;color:#fff;padding:10px 16px;border:0;border-radius:4px;cursor:pointer;">
                Küldés
            </button>
        </form>
    </div>
</body>
</html>
