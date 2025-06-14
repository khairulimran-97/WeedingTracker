<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Hari Pertama Bertunang</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Georgia', serif;
            background: linear-gradient(45deg, #ffb3d9, #ff80cc, #ff4da6, #ff1a8c);
            background-size: 400% 400%;
            animation: gradientShift 8s ease infinite;
            min-height: 100vh;
            overflow-x: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .hearts-bg {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            overflow: hidden;
            z-index: 1;
        }

        .heart {
            position: absolute;
            font-size: 20px;
            color: rgba(255, 255, 255, 0.3);
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(100vh) rotate(0deg); opacity: 0; }
            10% { opacity: 1; }
            90% { opacity: 1; }
            100% { transform: translateY(-100px) rotate(360deg); opacity: 0; }
        }

        .container {
            position: relative;
            z-index: 2;
            padding: 20px;
        }

        /* Envelope Styles */
        .envelope-container {
            position: relative;
            width: 400px;
            height: 280px;
            margin: 0 auto;
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .envelope-container:hover {
            transform: scale(1.05);
        }

        .envelope-container.clicked {
            pointer-events: none;
        }

        .envelope {
            position: relative;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #fff0f5, #ffe4e6);
            border-radius: 8px;
            box-shadow: 0 10px 30px rgba(255, 20, 140, 0.3);
            overflow: hidden;
            border: 2px solid #ffb3d9;
        }

        .envelope-flap {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 50%;
            background: linear-gradient(135deg, #ffb3d9, #ff80cc);
            transform-origin: top center;
            clip-path: polygon(0 0, 100% 0, 50% 100%);
            transition: transform 0.8s cubic-bezier(0.4, 0, 0.2, 1);
            z-index: 3;
            box-shadow: 0 5px 15px rgba(255, 105, 180, 0.4);
        }

        .envelope-container.opening .envelope-flap {
            transform: rotateX(180deg);
        }

        .wax-seal {
            position: absolute;
            top: 35%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 60px;
            height: 60px;
            background: radial-gradient(circle, #d63384, #c2185b);
            border-radius: 50%;
            z-index: 4;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            color: white;
            box-shadow: 0 4px 8px rgba(214, 51, 132, 0.6);
            transition: all 0.6s ease;
        }

        .envelope-container.opening .wax-seal {
            opacity: 0;
            transform: translate(-50%, -50%) scale(0);
        }

        .envelope-body {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 70%;
            background: linear-gradient(135deg, #fff0f5, #ffe4e6);
            border-radius: 0 0 8px 8px;
        }

        .letter-peek {
            position: absolute;
            bottom: 20px;
            left: 20px;
            right: 20px;
            height: 80%;
            background: white;
            border-radius: 4px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            transform: translateY(0);
            transition: transform 1s cubic-bezier(0.4, 0, 0.2, 1) 0.3s;
            opacity: 0.9;
        }

        .envelope-container.opening .letter-peek {
            transform: translateY(-150px) scale(1.2);
            opacity: 0;
        }

        .instruction {
            width: 100%;
            position: absolute;
            bottom: -80px;
            left: 50%;
            transform: translateX(-50%);
            color: white;
            font-size: 1.1em;
            text-align: center;
            animation: pulse 2s ease-in-out infinite;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }

        @keyframes pulse {
            0%, 100% { opacity: 0.7; transform: translateX(-50%) scale(1); }
            50% { opacity: 1; transform: translateX(-50%) scale(1.05); }
        }

        /* Letter Styles */
        .letter-container {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            padding: 40px;
            max-width: 600px;
            width: 100%;
            box-shadow: 0 20px 60px rgba(255, 20, 140, 0.3);
            transform: scale(0) rotateY(90deg);
            opacity: 0;
            transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
            backdrop-filter: blur(10px);
            border: 2px solid rgba(255, 105, 180, 0.3);
            margin: 0 auto;
        }

        .letter-container.show {
            transform: scale(1) rotateY(0deg);
            opacity: 1;
        }

        .letter-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .to-my-love {
            font-size: 2.5em;
            color: #d63384;
            text-shadow: 2px 2px 4px rgba(214, 51, 132, 0.3);
            animation: glow 2s ease-in-out infinite alternate;
            margin-bottom: 10px;
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.6s ease 0.2s;
        }

        .letter-container.show .to-my-love {
            opacity: 1;
            transform: translateY(0);
        }

        @keyframes glow {
            from { text-shadow: 2px 2px 4px rgba(214, 51, 132, 0.3), 0 0 10px rgba(255, 105, 180, 0.5); }
            to { text-shadow: 2px 2px 4px rgba(214, 51, 132, 0.5), 0 0 20px rgba(255, 105, 180, 0.8); }
        }

        .date {
            color: #ff69b4;
            font-style: italic;
            font-size: 1.1em;
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.6s ease 0.4s;
        }

        .letter-container.show .date {
            opacity: 1;
            transform: translateY(0);
        }

        .letter-content {
            line-height: 1.8;
            color: #333;
            font-size: 1.1em;
            text-align: justify;
        }

        .letter-content p {
            margin-bottom: 20px;
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.6s ease;
        }

        .letter-container.show .letter-content p:nth-child(1) { transition-delay: 0.6s; }
        .letter-container.show .letter-content p:nth-child(2) { transition-delay: 0.8s; }
        .letter-container.show .letter-content p:nth-child(3) { transition-delay: 1s; }
        .letter-container.show .letter-content p:nth-child(4) { transition-delay: 1.2s; }
        .letter-container.show .letter-content p:nth-child(5) { transition-delay: 1.4s; }
        .letter-container.show .letter-content p:nth-child(6) { transition-delay: 1.6s; }
        .letter-container.show .letter-content p:nth-child(7) { transition-delay: 1.8s; }
        .letter-container.show .letter-content p:nth-child(8) { transition-delay: 2s; }

        .letter-container.show .letter-content p {
            opacity: 1;
            transform: translateY(0);
        }

        .signature {
            text-align: right;
            margin-top: 40px;
            font-size: 1.3em;
            color: #d63384;
            font-style: italic;
            opacity: 0;
            transform: translateY(20px);
            transition: all 1s ease 6s;
        }

        .letter-container.show .signature {
            opacity: 1;
            transform: translateY(0);
        }

        .signature::before {
            content: "💕 ";
            animation: heartbeat 1.5s ease-in-out infinite;
        }

        @keyframes heartbeat {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.2); }
        }

        .love-quote {
            text-align: center;
            margin-top: 30px;
            padding: 20px;
            background: linear-gradient(45deg, rgba(255, 182, 193, 0.3), rgba(255, 105, 180, 0.3));
            border-radius: 15px;
            border-left: 4px solid #ff69b4;
            font-style: italic;
            color: #d63384;
            opacity: 0;
            transform: translateY(20px);
            transition: all 1s ease 5.5s;
        }

        .letter-container.show .love-quote {
            opacity: 1;
            transform: translateY(0);
        }

        .sparkle {
            position: absolute;
            width: 6px;
            height: 6px;
            background: #fff;
            border-radius: 50%;
            animation: sparkle 3s linear infinite;
        }

        @keyframes sparkle {
            0%, 100% { opacity: 0; transform: scale(0); }
            50% { opacity: 1; transform: scale(1); }
        }

        .hidden {
            display: none;
        }

        @media (max-width: 768px) {
            .envelope-container {
                width: 300px;
                height: 210px;
            }

            .letter-container {
                margin: 10px;
                padding: 30px 20px;
            }

            .to-my-love {
                font-size: 2em;
            }

            .letter-content {
                font-size: 1em;
            }
        }
    </style>
</head>
<body>
<div class="hearts-bg" id="heartsContainer"></div>

<div class="container">
    <!-- Envelope Section -->
    <div class="envelope-container" id="envelopeContainer">
        <div class="envelope">
            <div class="envelope-flap"></div>
            <div class="wax-seal">💖</div>
            <div class="envelope-body">
                <div class="letter-peek"></div>
            </div>
        </div>
        <div class="instruction">💕 Klik untuk baca surat hari pertama bertunang kita! 💕</div>
    </div>

    <!-- Letter Section -->
    <div class="letter-container hidden" id="letterContainer">
        <div class="letter-header">
            <h1 class="to-my-love">Untuk Tunangku - Hari Pertama Kita</h1>
            <div class="date">Hari Pertama Bertunang Yang Bersejarah</div>
        </div>

        <div class="letter-content">
            <p>Bismillahirrahmanirrahim...</p>

            <p>Tunangku yang dikasihi, Alhamdulillahi rabbil alamiin! Hari ini adalah hari yang paling bersejarah dalam hidup kita - HARI PERTAMA kita sebagai tunang! Subhanallah, betapa indahnya takdir Allah yang mempertemukan kita hingga hari yang diberkati ini.</p>

            <p><em><strong>Surat ini khas untuk hari pertama bertunang kita sahaja - sebuah milestone yang tidak akan pernah berulang. Insya Allah, selepas kita berkahwin nanti, akan ada surat cinta yang baru untuk meraikan kehidupan berumah tangga kita. ❤️</strong></em></p>

            <p>Pada hari istimewa ini, Abang ingin merakamkan betapa bahagianya hati Abang. Hari ini kita secara rasmi menjadi tunang! Setiap detik dari hari pertama ini terasa begitu bermakna - dari saat akad nikah tunang diucapkan, hinggalah saat ini Abang menulis surat cinta pertama untuk tunang Abang.</p>

            <p>Ya Allah, terima kasih atas keberkatan yang Engkau berikan pada hari yang mulia ini. Abang berdoa agar hari pertama bertunang ini menjadi permulaan yang baik untuk perjalanan panjang kita menuju pernikahan yang barakallahu.</p>

            <p>Hari ini menandakan permulaan baharu - kita bukan lagi sekadar kawan atau teman istimewa, tapi kini secara rasmi TUNANG! Alangkah indahnya perasaan ini, alangkah beruntungnya Abang dapat memanggil dirimu tunang mulai hari ini.</p>

            <p>Abang berjanji mulai dari hari pertama ini, Abang akan menjadi tunang yang soleh, yang akan sentiasa menjaga kehormatan perhubungan kita, dan mempersiapkan diri untuk menjadi suami yang terbaik untukmu kelak.</p>

            <p>Semoga Allah SWT memberkati hari bersejarah ini dan jadikan ia sebagai titik permulaan untuk kehidupan yang penuh sakinah, mawaddah, wa rahmah. Aamiin ya rabbal alamiin.</p>

            <p>Dengan hati yang penuh sukacita di hari pertama yang bersejarah ini, Abang dengan bangganya berkata: "Assalamualaikum, tunang Abang!" ❤️</p>
        </div>

        <div class="signature">
            Abang - Tunangmu ❤️<br>
            <small>Barakallahu laki wa laki wa jama'a baynakuma fi khair</small>
        </div>

        <div class="love-quote">
            "Dan di antara tanda-tanda (kebesaran)-Nya ialah Dia menciptakan pasangan-pasangan untukmu dari jenismu sendiri, agar kamu cenderung dan merasa tenteram kepadanya, dan Dia menjadikan di antaramu rasa kasih dan sayang." - Al-Quran, Ar-Rum: 21
        </div>
    </div>
</div>

<script>
    // Create floating hearts
    function createHeart() {
        const heart = document.createElement('div');
        heart.className = 'heart';
        heart.innerHTML = '💖';
        heart.style.left = Math.random() * 100 + '%';
        heart.style.animationDuration = (Math.random() * 3 + 3) + 's';
        heart.style.animationDelay = Math.random() * 2 + 's';
        document.getElementById('heartsContainer').appendChild(heart);

        setTimeout(() => {
            heart.remove();
        }, 8000);
    }

    // Create sparkles
    function createSparkle() {
        const sparkle = document.createElement('div');
        sparkle.className = 'sparkle';
        sparkle.style.left = Math.random() * 100 + '%';
        sparkle.style.top = Math.random() * 100 + '%';
        document.body.appendChild(sparkle);

        setTimeout(() => {
            sparkle.remove();
        }, 3000);
    }

    // Envelope opening functionality
    document.getElementById('envelopeContainer').addEventListener('click', function() {
        const envelope = this;
        const letterContainer = document.getElementById('letterContainer');

        // Add opening class to trigger animations
        envelope.classList.add('opening', 'clicked');

        // After envelope animation, show letter
        setTimeout(() => {
            envelope.style.display = 'none';
            letterContainer.classList.remove('hidden');

            // Small delay then show letter with animation
            setTimeout(() => {
                letterContainer.classList.add('show');
            }, 50);
        }, 1000);
    });

    // Initialize animations
    setInterval(createHeart, 800);
    setInterval(createSparkle, 1500);

    // Add click effect for extra romance (only after letter is shown)
    document.addEventListener('click', function(e) {
        if (!document.getElementById('letterContainer').classList.contains('hidden')) {
            for (let i = 0; i < 5; i++) {
                setTimeout(() => {
                    const heart = document.createElement('div');
                    heart.innerHTML = '💕';
                    heart.style.position = 'fixed';
                    heart.style.left = e.clientX + 'px';
                    heart.style.top = e.clientY + 'px';
                    heart.style.pointerEvents = 'none';
                    heart.style.color = '#ff69b4';
                    heart.style.fontSize = '20px';
                    heart.style.zIndex = '1000';
                    heart.style.animation = 'float 2s ease-out forwards';
                    document.body.appendChild(heart);

                    setTimeout(() => {
                        heart.remove();
                    }, 2000);
                }, i * 100);
            }
        }
    });
</script>
</body>
</html>
