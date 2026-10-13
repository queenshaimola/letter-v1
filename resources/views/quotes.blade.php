<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>For You</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Caveat:wght@500;700&family=Poppins:wght@300;400&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Caveat', cursive;
            padding: 20px;
            position: relative;
            overflow: hidden;
            background-color: #0c0c0c;
            color: #ffffff;
            text-align: center;
        }

        /* Background Video Fullscreen */
        .bg-video {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            object-fit: cover;
            z-index: -2;
            opacity: 0.5;
        }

        /* Overlay Gelap */
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(4px);
            z-index: -1;
        }

        /* Container Teks Kalimat */
        .quote-container {
            max-width: 800px;
            width: 90%;
            padding: 20px;
            z-index: 10;
        }

        /* Styling Teks Tulis Tangan Estetik */
        .quote-text {
            font-size: 2.8rem;
            line-height: 3.5rem;
            letter-spacing: 1px;
            color: #fffdf9;
            text-shadow: 0 4px 12px rgba(0, 0, 0, 0.5);
            opacity: 0; /* Awalnya tersembunyi */
            transition: opacity 1.5s ease-in-out, transform 1.5s ease-in-out;
            transform: translateY(10px);
        }

        /* Class untuk animasi Fade In */
        .quote-text.fade-in {
            opacity: 1;
            transform: translateY(0);
        }

        /* Class untuk animasi Fade Out */
        .quote-text.fade-out {
            opacity: 0;
            transform: translateY(-10px);
        }

        /* Tombol Selesai / Pesan Akhir */
        .final-btn {
            display: none;
            margin-top: 30px;
            background: rgba(255, 255, 255, 0.2);
            color: #fff;
            padding: 10px 28px;
            font-size: 1.1rem;
            font-family: 'Poppins', sans-serif;
            font-weight: 400;
            border-radius: 30px;
            border: 1px solid rgba(255, 255, 255, 0.4);
            backdrop-filter: blur(5px);
            cursor: pointer;
            text-decoration: none;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
            animation: fadeIn 1.5s ease forwards;
        }

        .final-btn:hover {
            background: rgba(255, 255, 255, 0.35);
            transform: translateY(-2px);
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
    </style>
</head>
<body>

    <!-- Background Video -->
    <video class="bg-video" autoplay loop muted playsinline>
        <source src="{{ asset('videos/bg.mp4') }}" type="video/mp4">
        Browser Anda tidak mendukung video tag.
    </video>

    <!-- Overlay Gelap -->
    <div class="overlay"></div>

    <!-- Wadah Teks yang Berganti-ganti -->
    <div class="quote-container">
        <h1 class="quote-text" id="quoteDisplay"></h1>
        <button class="final-btn" id="finalBtn" onclick="window.location.href='/'">❤️</button>
    </div>

    <!-- Musik Latar (Opsional jika ingin dilanjutkan) -->
    <audio id="bg-music" autoplay loop>
        <source src="{{ asset('audio/music.mp3') }}" type="audio/mp3">
    </audio>

    <script>
        // Daftar kalimat yang muncul satu per satu
        const quotes = [
            "I hope you remember you matter...",
            "You are precious...",
            "I hope the world would treat you better. . ."
        ];

        const quoteDisplay = document.getElementById('quoteDisplay');
        const finalBtn = document.getElementById('finalBtn');
        let currentQuoteIndex = 0;

        // Waktu tampil per kalimat (dalam milidetik)
        const displayTime = 3000; // Berapa lama teks terlihat (3 detik)
        const fadeTime = 1500;    // Durasi efek fade in / fade out (1.5 detik)

        function showNextQuote() {
            if (currentQuoteIndex < quotes.length) {
                // 1. Masukkan teks kalimat baru
                quoteDisplay.innerText = quotes[currentQuoteIndex];

                // 2. Jalankan Fade In
                quoteDisplay.classList.remove('fade-out');
                quoteDisplay.classList.add('fade-in');

                // 3. Setelah diam beberapa saat (displayTime), jalankan Fade Out
                setTimeout(() => {
                    quoteDisplay.classList.remove('fade-in');
                    quoteDisplay.classList.add('fade-out');

                    // 4. Setelah selesai Fade Out, pindah ke kalimat berikutnya
                    setTimeout(() => {
                        currentQuoteIndex++;
                        showNextQuote();
                    }, fadeTime);

                }, displayTime);

            } else {
                // Semua kalimat sudah tampil, tunjukkan emosional icon / tombol akhir
                setTimeout(() => {
                    quoteDisplay.style.display = 'none';
                    finalBtn.style.display = 'inline-block';
                }, 500);
            }
        }

        // Mulai animasi saat halaman terbuka
        window.addEventListener('DOMContentLoaded', () => {
            setTimeout(showNextQuote, 800);
        });
    </script>
</body>
</html>