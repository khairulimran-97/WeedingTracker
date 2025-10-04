<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Time Since Beginning Taaruf</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Crimson+Pro:wght@400;700&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;700&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&family=Amiri:wght@400;700&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Satisfy&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Courgette&display=swap');

        :root {
            --primary-color: #d87093;
            --secondary-color: #ffc0cb;
            --background-color: #fff0f5;
            --text-color: #333;
            --glow-color: rgba(255, 182, 193, 0.8);
            --accent-color: #c02942;
            --success-color: #28a745;
            --gold-color: #ffd700;
        }
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        body {
            font-family: 'Crimson Pro', serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: var(--background-color);
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='80' height='80' viewBox='0 0 80 80'%3E%3Cg fill='%23ffc0cb' fill-opacity='0.2'%3E%3Cpath d='M0 0h40v40H0V0zm40 40h40v40H40V40zm0-40h2l-2 2V0zm0 4l4-4h2l-6 6V4zm0 4l8-8h2L40 10V8zm0 4L52 0h2L40 14v-2zm0 4L56 0h2L40 18v-2zm0 4L60 0h2L40 22v-2zm0 4L64 0h2L40 26v-2zm0 4L68 0h2L40 30v-2zm0 4L72 0h2L40 34v-2zm0 4L76 0h2L40 38v-2zm0 4L80 0v2L42 40h-2zm4 0L80 4v2L46 40h-2zm4 0L80 8v2L50 40h-2zm4 0l28-28v2L54 40h-2zm4 0l24-24v2L58 40h-2zm4 0l20-20v2L62 40h-2zm4 0l16-16v2L66 40h-2zm4 0l12-12v2L70 40h-2zm4 0l8-8v2l-6 6h-2zm4 0l4-4v2l-2 2h-2z'/%3E%3C/g%3E%3C/svg%3E");
            overflow-x: hidden;
            color: var(--text-color);
            padding: 2rem 0;
        }
        .container {
            text-align: center;
            background: rgba(255, 255, 255, 0.95);
            padding: 2rem;
            border-radius: 20px;
            box-shadow: 0 0 20px var(--glow-color), 0 0 40px var(--glow-color);
            z-index: 10;
            width: 90%;
            max-width: 500px;
            border: 2px solid var(--secondary-color);
            animation: glow 5s infinite alternate;
            margin: 2rem auto;
            position: relative;
            overflow: hidden;
        }
        h1 {
            font-family: 'Cormorant Garamond', serif;
            font-size: clamp(2.5rem, 6vw, 3.5rem);
            color: var(--primary-color);
            margin-bottom: 1.5rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
        }
        #current-datetime {
            font-size: clamp(1rem, 3vw, 1.5rem);
            margin-top: 1rem;
            font-style: italic;
        }
        .time-display {
            font-size: clamp(1.2rem, 4vw, 2rem);
            color: var(--primary-color);
            margin-bottom: 1.5rem;
            position: relative;
            padding: 0.5rem 0;
        }
        .time-unit {
            font-weight: bold;
            display: inline-block;
        }
        .subtitle {
            font-size: clamp(1.2rem, 3vw, 1.8rem);
            color: var(--primary-color);
            margin-bottom: 1.5rem;
            font-family: 'Courgette', cursive;
            line-height: 1.5;
        }
        .info-section {
            margin-top: 1.5rem;
            font-size: clamp(1rem, 3vw, 1.2rem);
            color: var(--text-color);
            line-height: 1.6;
            background: rgba(255, 255, 255, 0.8);
            padding: 1rem;
            border-radius: 10px;
            position: relative;
        }
        .info-section p {
            margin-bottom: 0.8rem;
            text-align: left;
            font-size: 1.15em;
            position: relative;
            padding-left: 1.8rem;
        }
        .info-section p::before {
            content: "♥";
            color: var(--accent-color);
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            font-size: 1.3em;
        }
        .info-section p.completed::before {
            content: "✓";
            color: var(--success-color);
            font-weight: bold;
        }
        .info-section p.completed {
            color: var(--success-color);
            font-weight: 500;
        }
        .info-section strong {
            font-weight: bold;
            color: var(--primary-color);
        }
        .countdown-section {
            margin-top: 2rem;
            padding: 1rem;
            border-radius: 15px;
            margin-bottom: 1.5rem;
        }
        .countdown-section.engagement {
            background: linear-gradient(135deg, rgba(255,192,203,0.3), rgba(216,112,147,0.2));
        }
        .countdown-section.ijab-qabul {
            background: linear-gradient(135deg, rgba(255,215,0,0.3), rgba(255,165,0,0.2));
        }
        .countdown-section.reception1 {
            background: linear-gradient(135deg, rgba(138,43,226,0.3), rgba(147,112,219,0.2));
        }
        .countdown-section.reception2 {
            background: linear-gradient(135deg, rgba(34,139,34,0.3), rgba(144,238,144,0.2));
        }
        .countdown-section.completed {
            background: linear-gradient(135deg, rgba(40,167,69,0.3), rgba(144,238,144,0.2));
        }
        .countdown-title {
            font-family: 'Courgette', cursive;
            color: var(--primary-color);
            margin-bottom: 0.5rem;
            font-size: 1.5rem;
        }
        .countdown-title.ijab-qabul {
            color: var(--gold-color);
            text-shadow: 1px 1px 2px rgba(0,0,0,0.3);
        }
        .countdown-title.reception {
            color: #8a2be2;
        }
        .countdown-title.completed {
            color: var(--success-color);
        }
        .countdown-display {
            display: flex;
            justify-content: center;
            gap: 0.8rem;
            flex-wrap: wrap;
            max-width: 100%;
        }
        .countdown-row {
            display: flex;
            justify-content: center;
            gap: 0.8rem;
            width: 100%;
            margin-bottom: 0.8rem;
        }
        .countdown-row:last-child {
            margin-bottom: 0;
        }
        .countdown-item {
            background: white;
            padding: 0.6rem 0.8rem;
            border-radius: 10px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
            min-width: 65px;
            flex: 1;
            max-width: 90px;
        }
        .countdown-number {
            font-size: 1.5rem;
            font-weight: bold;
            color: var(--accent-color);
        }
        .countdown-label {
            font-size: 0.8rem;
            color: var(--text-color);
        }
        .completed-message {
            font-size: 1.2rem;
            color: var(--success-color);
            font-weight: bold;
            padding: 1rem;
            background: rgba(40,167,69,0.1);
            border-radius: 10px;
            border: 2px solid var(--success-color);
        }
        .flower {
            position: fixed;
            width: 40px;
            height: 40px;
            animation: float 20s infinite ease-in-out;
            z-index: 1;
            opacity: 0.8;
        }
        .petal {
            position: absolute;
            width: 50%;
            height: 50%;
            background-color: var(--secondary-color);
            border-radius: 50% 0;
            top: 25%;
            left: 25%;
            transform-origin: bottom right;
            filter: drop-shadow(0 0 2px rgba(0,0,0,0.1));
        }
        .petal:nth-child(2) { transform: rotate(72deg); }
        .petal:nth-child(3) { transform: rotate(144deg); }
        .petal:nth-child(4) { transform: rotate(216deg); }
        .petal:nth-child(5) { transform: rotate(288deg); }
        .heart {
            position: fixed;
            font-size: 1.5rem;
            color: var(--accent-color);
            z-index: 1000;
            pointer-events: none;
        }
        @keyframes float {
            0%, 100% { transform: translate(0, 0) rotate(0deg); }
            25% { transform: translate(50px, -50px) rotate(45deg); }
            50% { transform: translate(100px, 0) rotate(90deg); }
            75% { transform: translate(50px, 50px) rotate(45deg); }
        }
        @keyframes heartFloat {
            0% {
                transform: translateY(0) scale(0.5);
                opacity: 1;
            }
            100% {
                transform: translateY(-100px) scale(1.5);
                opacity: 0;
            }
        }
        @keyframes glow {
            from {
                box-shadow: 0 0 20px var(--glow-color), 0 0 40px var(--glow-color);
            }
            to {
                box-shadow: 0 0 30px var(--glow-color), 0 0 60px var(--glow-color);
            }
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @media (max-width: 768px) {
            .container {
                padding: 1.5rem;
                margin: 1rem auto;
            }
            .countdown-item {
                min-width: 55px;
                padding: 0.5rem 0.6rem;
                max-width: 80px;
            }
            .countdown-number {
                font-size: 1.3rem;
            }
            .countdown-label {
                font-size: 0.75rem;
            }
            .info-section p {
                font-size: 1.1em;
            }
        }
        @media (max-width: 480px) {
            .container {
                padding: 1rem;
                margin: 0.5rem auto;
            }
            .countdown-row {
                gap: 0.5rem;
                margin-bottom: 0.6rem;
            }
            .countdown-item {
                min-width: 50px;
                padding: 0.4rem 0.5rem;
                max-width: 70px;
            }
            .countdown-number {
                font-size: 1.2rem;
            }
            .countdown-label {
                font-size: 0.7rem;
            }
            .info-section p {
                font-size: 1em;
                padding-left: 1.5rem;
            }
            .countdown-title {
                font-size: 1.3rem;
            }
        }
        @media (max-width: 360px) {
            .container {
                padding: 0.8rem;
                width: 95%;
            }
            .countdown-item {
                min-width: 45px;
                padding: 0.3rem 0.4rem;
                max-width: 60px;
            }
            .countdown-number {
                font-size: 1.1rem;
            }
            .countdown-label {
                font-size: 0.65rem;
            }
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Time Since Beginning Taaruf</h1>

    <div class="time-display">
        <span id="months" class="time-unit">0</span> months and
        <span id="days" class="time-unit">0</span> days
    </div>

    <p class="subtitle">of growth, understanding, and discovering a soulmate</p>

    <div class="info-section">
        <p id="taaruf-date"><strong>Taaruf:</strong> March 13, 2024</p>
        <p id="lunch-date"><strong>1st Lunch:</strong> February 11, 2025</p>
        <p id="beraya-date"><strong>Beraya di Melor:</strong> April 2, 2025</p>
        <p id="merisik-date"><strong>Merisik:</strong> May 2, 2025</p>
        <p id="engagement-date"><strong>Engagement:</strong> June 3, 2025</p>
        <p id="reception1-date"><strong>Ijab & Qabul:</strong> December 27, 2025</p>
        <p id="reception2-date"><strong>2nd Reception:</strong> December 29, 2025</p>
    </div>

    <!-- Ijab & Qabul + 1st Reception Countdown -->
    <div class="countdown-section ijab-qabul" id="ijab-countdown">
        <h2 class="countdown-title ijab-qabul">Countdown to Our Wedding 💍🎉</h2>
        <p style="font-size: 1rem; margin-top: 0.5rem; margin-bottom: 1rem; color: var(--text-color); opacity: 0.8;">
            Ijab & Qabul + 1st Reception (Dec 27)
        </p>
        <div class="countdown-display">
            <div class="countdown-row">
                <div class="countdown-item">
                    <div class="countdown-number" id="ijab-months-count">0</div>
                    <div class="countdown-label">Months</div>
                </div>
                <div class="countdown-item">
                    <div class="countdown-number" id="ijab-days-count">0</div>
                    <div class="countdown-label">Days</div>
                </div>
                <div class="countdown-item">
                    <div class="countdown-number" id="ijab-hours-count">0</div>
                    <div class="countdown-label">Hours</div>
                </div>
            </div>
            <div class="countdown-row">
                <div class="countdown-item">
                    <div class="countdown-number" id="ijab-minutes-count">0</div>
                    <div class="countdown-label">Minutes</div>
                </div>
                <div class="countdown-item">
                    <div class="countdown-number" id="ijab-seconds-count">0</div>
                    <div class="countdown-label">Seconds</div>
                </div>
            </div>
        </div>
    </div>

    <!-- 2nd Reception Countdown -->
    <div class="countdown-section reception2" id="reception2-countdown">
        <h2 class="countdown-title reception">Countdown to 2nd Reception 🌟</h2>
        <div class="countdown-display">
            <div class="countdown-row">
                <div class="countdown-item">
                    <div class="countdown-number" id="rec2-months-count">0</div>
                    <div class="countdown-label">Months</div>
                </div>
                <div class="countdown-item">
                    <div class="countdown-number" id="rec2-days-count">0</div>
                    <div class="countdown-label">Days</div>
                </div>
                <div class="countdown-item">
                    <div class="countdown-number" id="rec2-hours-count">0</div>
                    <div class="countdown-label">Hours</div>
                </div>
            </div>
            <div class="countdown-row">
                <div class="countdown-item">
                    <div class="countdown-number" id="rec2-minutes-count">0</div>
                    <div class="countdown-label">Minutes</div>
                </div>
                <div class="countdown-item">
                    <div class="countdown-number" id="rec2-seconds-count">0</div>
                    <div class="countdown-label">Seconds</div>
                </div>
            </div>
        </div>
    </div>

    <p id="current-datetime"></p>
</div>

<script>
    // Event dates
    const events = {
        taaruf: new Date('2024-03-13'),
        lunch: new Date('2025-02-11'),
        beraya: new Date('2025-04-02'),
        merisik: new Date('2025-05-02'),
        engagement: new Date('2025-06-03T00:00:00+08:00'),
        reception1: new Date('2025-12-27T00:00:00+08:00'),
        reception2: new Date('2025-12-29T00:00:00+08:00')
    };

    function updateTime() {
        const startDate = events.taaruf;
        const currentDate = new Date();
        const timeDifference = currentDate - startDate;
        const daysPassed = Math.floor(timeDifference / (1000 * 60 * 60 * 24));
        const months = Math.floor(daysPassed / 30);
        const remainingDays = daysPassed % 30;
        document.getElementById('months').textContent = months;
        document.getElementById('days').textContent = remainingDays;

        document.querySelector('.time-display').style.animation = 'fadeIn 1s ease';
    }

    function updateCurrentDatetime() {
        const now = new Date();
        const options = {
            weekday: 'long',
            year: 'numeric',
            month: 'long',
            day: 'numeric',
            hour: '2-digit',
            minute: '2-digit',
            second: '2-digit',
            hour12: true,
            timeZone: 'Asia/Kuala_Lumpur'
        };
        const formattedDatetime = now.toLocaleString('en-US', options);
        document.getElementById('current-datetime').textContent = formattedDatetime;
    }

    function markCompletedEvents() {
        const now = new Date();

        // Check each event and mark as completed if date has passed
        Object.keys(events).forEach(eventKey => {
            if (now > events[eventKey]) {
                const elementId = eventKey.replace(/([A-Z])/g, '-$1').toLowerCase() + '-date';
                const element = document.getElementById(elementId);
                if (element) {
                    element.classList.add('completed');
                }
            }
        });
    }

    function updateCountdown(eventDate, prefix, sectionId, title) {
        const now = new Date();
        const timeDiff = eventDate - now;

        if (timeDiff <= 0) {
            // Event has passed
            const section = document.getElementById(sectionId);
            section.innerHTML = `<div class="completed-message">${title} Day is Here! 🎉✨</div>`;
            section.classList.add('completed');
            return false; // Event completed
        }

        // Calculate time units
        const totalSeconds = Math.floor(timeDiff / 1000);
        const seconds = totalSeconds % 60;
        const totalMinutes = Math.floor(totalSeconds / 60);
        const minutes = totalMinutes % 60;
        const totalHours = Math.floor(totalMinutes / 60);
        const hours = totalHours % 24;
        const totalDays = Math.floor(totalHours / 24);

        // Calculate months and remaining days
        const months = Math.floor(totalDays / 30);
        const days = totalDays % 30;

        document.getElementById(`${prefix}-months-count`).textContent = months;
        document.getElementById(`${prefix}-days-count`).textContent = days;
        document.getElementById(`${prefix}-hours-count`).textContent = hours;
        document.getElementById(`${prefix}-minutes-count`).textContent = minutes;
        document.getElementById(`${prefix}-seconds-count`).textContent = seconds;

        return true; // Event still upcoming
    }

    function updateAllCountdowns() {
        updateCountdown(events.reception1, 'ijab', 'ijab-countdown', 'Our Wedding');
        updateCountdown(events.reception2, 'rec2', 'reception2-countdown', '2nd Reception');
    }

    function createFlower() {
        const flower = document.createElement('div');
        flower.className = 'flower';
        const size = Math.random() * 30 + 30;
        flower.style.width = `${size}px`;
        flower.style.height = `${size}px`;
        flower.style.left = `${Math.random() * window.innerWidth}px`;
        flower.style.top = `${Math.random() * window.innerHeight}px`;

        for (let i = 0; i < 5; i++) {
            const petal = document.createElement('div');
            petal.className = 'petal';
            flower.appendChild(petal);
        }

        flower.style.animationDuration = `${Math.random() * 10 + 15}s`;
        document.body.appendChild(flower);

        setTimeout(() => {
            flower.remove();
        }, 20000);
    }

    // Initialize
    updateTime();
    setInterval(updateTime, 86400000); // Update daily

    updateCurrentDatetime();
    setInterval(updateCurrentDatetime, 1000); // Update every second

    markCompletedEvents();
    updateAllCountdowns();
    setInterval(updateAllCountdowns, 1000); // Update all countdowns every second

    // Flowers animation
    setInterval(createFlower, 800);
    setInterval(createFlower, 1000);

    // Initial flowers
    for (let i = 0; i < 30; i++) {
        createFlower();
    }

    // Handle window resize
    window.addEventListener('resize', () => {
        const flowers = document.querySelectorAll('.flower');
        flowers.forEach(flower => flower.remove());

        for (let i = 0; i < 30; i++) {
            createFlower();
        }
    });

    // Click hearts effect
    document.addEventListener('click', (event) => {
        const heart = document.createElement('div');
        heart.className = 'heart';
        heart.innerHTML = '❤';
        heart.style.left = `${event.clientX}px`;
        heart.style.top = `${event.clientY}px`;
        heart.style.fontSize = '24px';
        heart.style.position = 'fixed';
        heart.style.animation = 'heartFloat 2s forwards';

        document.body.appendChild(heart);

        setTimeout(() => {
            heart.remove();
        }, 2000);
    });
</script>
</body>
</html>
