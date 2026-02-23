<div style="max-width: 480px; margin: 40px auto; background: #f8fafc; border-radius: 12px; box-shadow: 0 2px 12px #0001; padding: 32px; font-family: 'Segoe UI', Arial, sans-serif; text-align: center;">
	<h1 style="color: #2563eb; margin-bottom: 16px;">Üdvözlünk, {{$user->name}}!</h1>
	<p style="font-size: 1.1em; color: #222; margin-bottom: 32px;">Köszönjük, hogy regisztráltál az oldalunkon.<br>Az alábbi gombbal erősítsd meg az email címed:</p>
	<a href="{{$verificationURL}}" style="display: inline-block; background: #2563eb; color: #fff; padding: 14px 32px; border-radius: 6px; font-size: 1.1em; font-weight: 600; text-decoration: none; box-shadow: 0 2px 8px #2563eb33; transition: background 0.2s;">Email megerősítése</a>
	<p style="margin-top: 36px; color: #555; font-size: 0.95em;">Ha nem te regisztráltál, kérjük, hagyd figyelmen kívül ezt az üzenetet.</p>
</div>