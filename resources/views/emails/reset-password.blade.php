<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Atur Ulang Kata Sandi - Biblo</title>
</head>
<body style="margin:0;padding:0;background-color:#FDFBF8;font-family:'Helvetica Neue', Arial, sans-serif;">

<table width="100%" cellpadding="0" cellspacing="0" style="padding:40px 20px;">
    <tr>
        <td align="center">

            <table width="100%" max-width="520" cellpadding="0" cellspacing="0"
                   style="background:#ffffff;border-radius:24px;padding:40px 30px;box-shadow:0 10px 25px rgba(45, 45, 42, 0.05);border: 1px solid #D1D1C7;">

                <tr>
                    <td align="center" style="padding-bottom:30px;">
                        <h1 style="color:#4A5D23; font-size:28px; font-weight:800; margin:0; letter-spacing:-1px;">Biblo.</h1>
                    </td>
                </tr>

                <tr>
                    <td style="text-align:center;padding-bottom:20px;">
                        <h2 style="margin:0;font-size:20px;font-weight:800;color:#2D2D2A;">
                            Atur Ulang Kata Sandi Anda
                        </h2>
                    </td>
                </tr>

                <tr>
                    <td style="font-size:15px;color:#2D2D2A;line-height:1.6;padding-bottom:25px;">
                        Halo <strong>{{ $user->name }}</strong>,<br><br>
                        Kami menerima permintaan untuk mengatur ulang kata sandi akun Biblo Anda.
                        Silakan klik tombol di bawah ini untuk membuat kata sandi baru dan kembali membaca.
                    </td>
                </tr>

                <tr>
                    <td align="center" style="padding-bottom:30px;">
                        <a href="{{ $url }}"
                           style="display:inline-block;background-color:#2D2D2A;color:#ffffff;
                                  padding:16px 32px;border-radius:32px;font-weight:bold;
                                  text-decoration:none;font-size:12px;text-transform:uppercase;letter-spacing:2px;
                                  box-shadow:0 8px 20px rgba(45, 45, 42, 0.15);">
                            Atur Ulang Sandi
                        </a>
                    </td>
                </tr>

                <tr>
                    <td style="font-size:13px;color:#8E9E82;line-height:1.6;padding-bottom:15px;text-align:center;">
                        Link ini akan kedaluwarsa dalam 60 menit.
                    </td>
                </tr>

                </table>

            <table width="100%" cellpadding="0" cellspacing="0" style="margin-top:20px;">
                <tr>
                    <td align="center" style="font-size:12px;color:#D1D1C7; font-weight:bold;">
                        Jika Anda tidak meminta pengaturan ulang kata sandi, silakan abaikan email ini.
                        <br><br>
                        <span style="text-transform:uppercase; letter-spacing:1px;">© {{ date('Y') }} Biblo. Semua hak dilindungi.</span>
                    </td>
                </tr>
            </table>

        </td>
    </tr>
</table>

</body>
</html>