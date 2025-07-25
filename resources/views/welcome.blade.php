<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Landing Page Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background-color: #151D4B;
            color: white;
        }

        .container {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            padding: 100px;
            padding-top: 170px;
            padding-left: 120px;
            max-width: 700px;
            position: relative;
            z-index: 1;
        }

        .landing-title {
            font-size: 46px;
            font-weight: 700;
            margin-bottom: 30px;
            line-height: 1.3;
        }

        .description {
            font-size: 16px;
            margin-bottom: 30px;
            max-width: 600px;
        }

        .btn-pink {
            background-color: #ff59b8;
            color: white;
            border: none;
            padding: 12px 30px;
            font-weight: bold;
            border-radius: 10px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }

        .btn-pink:hover {
            background-color: #ff7dc5;
        }

        .user-link {
            position: absolute;
            top: 35px;
            right: 30px;
            z-index: 10;
        }

        .user-link a {
            background-color: #ff59b8;
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: bold;
            text-decoration: none;
        }

        .logo {
            position: absolute;
            top: 0px;
            left: 0px;
            z-index: 20;
        }

        .logo img {
            height: 150px;
            width: auto;
        }

        .wave-img {
            position: absolute;
            top: -60px;
            right: 10px;
            width: 850px;
            height: 800px;
            z-index: 0;
            pointer-events: none;
        }

        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            text-align: center;
            padding: 10px;
            background-color: #415dd0;
            font-weight: bold;
            z-index: 1;
        }

         #backToTop {
            position: fixed;
            bottom: 70px;
            right: 20px;
            display: none;
            z-index: 99;
            font-size: 18px;
            border: none;
            outline: none;
            background-color: #007bff;
            color: white;
            cursor: pointer;
            padding: 10px 15px;
            border-radius: 50%;
            box-shadow: 0 4px 6px rgba(0,0,0,0.3);
        }

        #backToTop:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

    <!-- Logo pojok kiri atas -->
    <div class="logo">
        <img src="{{ asset('logo.png') }}" alt="Logo">
    </div>

    <!-- Gambar Wave -->
    <img src="{{ asset('wave.png') }}" alt="Wave Background" class="wave-img">

    <!-- Konten Landing Page -->
    <div class="container">
        <div class="landing-title">Hai, Selamat Datang<br>di KerjaKu</div>
        <div class="description">
            Presensi mudah dengan QR code dan pantau produktivitas tim secara realtime dalam satu platform.
        </div>
        <a href="{{ route('login') }}" class="btn-pink">Login</a>
    </div>

    <!-- Footer -->
    <div class="footer">@AALYAAS</div>

    <button onclick="scrollToTop()" id="backToTop" title="Kembali ke atas"><i class="fas fa-arrow-up"></i></button>



</body><script>
    // Tampilkan tombol ketika scroll turun 100px
    window.onscroll = function () {
        const btn = document.getElementById("backToTop");
        if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
            btn.style.display = "block";
        } else {
            btn.style.display = "none";
        }
    };

    // Fungsi scroll ke atas
    function scrollToTop() {
        $('html, body').animate({ scrollTop: 0 }, 'slow');
    }
</script>

</html>
