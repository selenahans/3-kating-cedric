<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Verifikasi Email - Biblo</title>
</head>
<body style="background-color:#FDFBF8; font-family: 'Helvetica Neue', Arial, sans-serif; padding:40px; color:#2D2D2A;">
    
    <div style="max-width:500px; margin:auto; background:#ffffff; padding:40px; border-radius:24px; border: 1px solid #D1D1C7; box-shadow: 0 10px 25px rgba(45, 45, 42, 0.05);">
        
        <div style="text-align:center; margin-bottom:30px;">
            <h1 style="color:#4A5D23; font-size:28px; font-weight:800; margin:0; letter-spacing:-1px;">Biblo.</h1>
        </div>

        <h2 style="color:#2D2D2A; text-align:center; font-size:20px; font-weight:800; margin-top:0;">
            Verifikasi Email Anda
        </h2>

        <p style="font-size:15px; line-height:1.6;">Halo <strong>{{ $user->name }}</strong>,</p>

        <p style="font-size:15px; line-height:1.6;">
            Selamat datang di dunia pengetahuan! Terima kasih telah mendaftar di Biblo.  
            Silakan klik tombol di bawah ini untuk memverifikasi email Anda dan mulai membaca:
        </p>

        <div style="text-align:center; margin:40px 0;">
            <a href="{{ $url }}"
               style="background-color:#2D2D2A; color:#ffffff; padding:16px 32px; text-decoration:none; border-radius:32px; display:inline-block; font-weight:bold; font-size:12px; text-transform:uppercase; letter-spacing:2px;">
                Verifikasi Sekarang
            </a>
        </div>

        <p style="font-size:13px; color:#8E9E82; line-height:1.5;">
            Jika Anda tidak merasa membuat akun di Biblo, silakan abaikan email ini.
        </p>

        <hr style="margin:30px 0; border:none; border-top:1px solid rgba(209, 209, 199, 0.4);">

        <p style="font-size:11px; color:#D1D1C7; text-align:center; font-weight:bold; text-transform:uppercase; letter-spacing:1px;">
            © {{ date('Y') }} Biblo. All rights reserved.
        </p>

    </div>

</body>
</html>