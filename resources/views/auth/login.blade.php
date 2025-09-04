<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aerocity Login | Futuristic Design</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="icon" href="{{ asset('/storage/images/logo_bp.png') }}" type="image/png">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(135deg, #1a1a40, #2d2d6e, #4a4a8c);
            overflow: hidden;
            position: relative;
        }

        /* Futuristic Grid Background */
        .grid-background {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -2;
            background: 
                linear-gradient(rgba(255, 255, 255, 0.1) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255, 255, 255, 0.1) 1px, transparent 1px);
            background-size: 40px 40px;
            perspective: 1000px;
            transform-style: preserve-3d;
            transform: rotateX(60deg) translateZ(-100px);
            animation: gridMove 20s linear infinite;
        }

        @keyframes gridMove {
            0% { background-position: 0 0; }
            100% { background-position: 0 1000px; }
        }

        /* Animated orbs - brighter version */
        .orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(60px);
            opacity: 0.6;
            z-index: -1;
        }

        .orb-1 {
            width: 300px;
            height: 300px;
            background: rgba(0, 200, 255, 0.8);
            top: 20%;
            left: 10%;
            animation: float 15s ease-in-out infinite;
        }

        .orb-2 {
            width: 450px;
            height: 450px;
            background: rgba(138, 43, 226, 0.7);
            bottom: 10%;
            right: 15%;
            animation: float 18s ease-in-out infinite reverse;
        }

        .orb-3 {
            width: 200px;
            height: 200px;
            background: rgba(0, 255, 170, 0.6);
            top: 60%;
            left: 30%;
            animation: float 12s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translate(0, 0) scale(1); }
            25% { transform: translate(40px, -40px) scale(1.05); }
            50% { transform: translate(0, -80px) scale(1.1); }
            75% { transform: translate(-40px, -40px) scale(1.05); }
        }

        /* Enhanced light effect that follows mouse */
        .light-effect {
            position: fixed;
            width: 300px;
            height: 300px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(0, 200, 255, 0.3) 0%, rgba(0, 200, 255, 0) 70%);
            transform: translate(-50%, -50%);
            pointer-events: none;
            z-index: 0;
            transition: width 0.2s, height 0.2s;
            mix-blend-mode: screen;
        }

        /* Interactive connection lines */
        .connections {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: -1;
        }

        .connection-line {
            position: absolute;
            background: linear-gradient(to right, rgba(0, 200, 255, 0.5), rgba(138, 43, 226, 0.5));
            transform-origin: 0 0;
            height: 1px;
            box-shadow: 0 0 10px rgba(0, 200, 255, 0.5);
        }

        /* Interactive particles that react to mouse */
        .particles {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: -1;
        }

        .particle {
            position: absolute;
            width: 6px;
            height: 6px;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 50%;
            animation: floatParticle 15s linear infinite;
            opacity: 0;
            box-shadow: 0 0 15px 2px rgba(0, 200, 255, 0.7);
            transition: transform 0.3s;
        }

        @keyframes floatParticle {
            0% {
                transform: translateY(100vh) rotate(0deg);
                opacity: 1;
            }
            100% {
                transform: translateY(-100px) rotate(720deg);
                opacity: 0;
            }
        }

        /* Halo effect around mouse */
        .halo {
            position: fixed;
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.2) 0%, transparent 70%);
            box-shadow: 0 0 100px 30px rgba(0, 200, 255, 0.3);
            transform: translate(-50%, -50%);
            pointer-events: none;
            z-index: 0;
            opacity: 0;
            transition: opacity 0.3s, transform 0.3s;
        }

        /* Login container - brighter version */
        .login-container {
            position: relative;
            width: 400px;
            z-index: 1;
            backdrop-filter: blur(15px);
            border-radius: 20px;
            padding: 40px;
            background: rgba(255, 255, 255, 0.15);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.2);
            overflow: hidden;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .login-container:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 45px rgba(0, 200, 255, 0.3);
        }

        .login-container::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(
                45deg,
                transparent, 
                rgba(255, 255, 255, 0.1), 
                rgba(200, 200, 255, 0.1),
                transparent
            );
            transform: rotate(0deg);
            animation: rotate 20s linear infinite;
            z-index: -1;
        }

        @keyframes rotate {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .login-form {
            width: 100%;
        }

        .form-content {
            display: flex;
            flex-direction: column;
            gap: 25px;
        }

        h2 {
            text-align: center;
            color: #fff;
            font-weight: 600;
            letter-spacing: 1px;
            margin-bottom: 10px;
            text-shadow: 0 0 15px rgba(0, 200, 255, 0.8);
        }

        .auto-typer {
            height: 40px;
            text-align: center;
            color: rgba(255, 255, 255, 0.9);
            font-size: 16px;
            margin-bottom: 10px;
        }

        .cursor {
            display: inline-block;
            width: 8px;
            height: 18px;
            background: #00c8ff;
            margin-left: 4px;
            animation: blink 1s infinite;
            box-shadow: 0 0 8px rgba(0, 200, 255, 0.8);
        }

        @keyframes blink {
            0%, 100% { opacity: 1; }
            50% { opacity: 0; }
        }

        .input-group {
            position: relative;
        }

        .input-group i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: rgba(255, 255, 255, 0.8);
            font-size: 18px;
            transition: color 0.3s;
        }

        .input-group input {
            width: 100%;
            padding: 15px 15px 15px 50px;
            background: rgba(255, 255, 255, 0.15);
            border: none;
            outline: none;
            border-radius: 10px;
            color: #fff;
            font-size: 16px;
            transition: all 0.3s;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .input-group input::placeholder {
            color: rgba(255, 255, 255, 0.6);
        }

        .input-group input:focus {
            background: rgba(255, 255, 255, 0.2);
            border-color: rgba(0, 200, 255, 0.7);
            box-shadow: 0 0 20px rgba(0, 200, 255, 0.4);
        }

        .input-group input:focus + i {
            color: #00c8ff;
            text-shadow: 0 0 10px rgba(0, 200, 255, 0.9);
        }

        .message {
            padding: 10px;
            border-radius: 8px;
            text-align: center;
            font-weight: 500;
        }

        .message.success {
            background: rgba(72, 187, 120, 0.3);
            color: #48bb78;
            border: 1px solid rgba(72, 187, 120, 0.4);
        }

        .message.error {
            background: rgba(245, 101, 101, 0.3);
            color: #f56565;
            border: 1px solid rgba(245, 101, 101, 0.4);
        }

        .login-btn {
            padding: 15px;
            border: none;
            border-radius: 10px;
            background: linear-gradient(45deg, #00c8ff, #667eea);
            color: white;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            box-shadow: 0 5px 20px rgba(0, 200, 255, 0.5);
            letter-spacing: 1px;
            position: relative;
            overflow: hidden;
        }

        .login-btn::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(
                45deg,
                transparent, 
                rgba(255, 255, 255, 0.3), 
                rgba(255, 255, 255, 0.3),
                transparent
            );
            transform: rotate(45deg);
            animation: shine 3s infinite;
        }

        @keyframes shine {
            0% { transform: translateX(-100%) rotate(45deg); }
            100% { transform: translateX(100%) rotate(45deg); }
        }

        .login-btn:hover {
            background: linear-gradient(45deg, #00a0cc, #5a67d8);
            box-shadow: 0 8px 25px rgba(0, 200, 255, 0.7);
            transform: translateY(-2px);
        }

        .login-btn:active {
            transform: translateY(0);
        }

        /* Neon line effect */
        .neon-line {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 3px;
            background: linear-gradient(90deg, transparent, #00c8ff, transparent);
            box-shadow: 0 0 15px rgba(0, 200, 255, 0.9);
            animation: neonLine 3s infinite;
        }

        @keyframes neonLine {
            0%, 100% { opacity: 0.5; }
            50% { opacity: 1; }
        }

        /* Responsive design */
        @media (max-width: 480px) {
            .login-container {
                width: 90%;
                padding: 30px 20px;
            }
            
            .orb {
                display: none;
            }
        }
    </style>
</head>
<body>
    <!-- Futuristic Grid Background -->
    <div class="grid-background"></div>
    
    <!-- Animated Orbs -->
    <div class="orb orb-1"></div>
    <div class="orb orb-2"></div>
    <div class="orb orb-3"></div>

    <!-- Light effect that follows mouse -->
    <div class="light-effect" id="light-effect"></div>
    
    <!-- Halo effect around mouse -->
    <div class="halo" id="halo-effect"></div>

    <!-- Connection lines -->
    <div class="connections" id="connections"></div>

    <!-- Particles background -->
    <div class="particles" id="particles"></div>

    <div class="login-container">
        <div class="neon-line"></div>
        <form action="{{ route('proses-login') }}" method="POST" class="login-form">
            @csrf
            <div class="form-content">
                <h2>Inspection Management System</h2>
                
                <div class="auto-typer" id="auto-typer">
                    <span id="typing-text"></span><span class="cursor"></span>
                </div>

                @if(session('success'))
                    <div class="message success">{{ session('success') }}</div>
                @endif

                @error('error')
                    <div class="message error">{{ $message }}</div>
                @enderror

                <div class="input-group">
                    <i class="fas fa-user"></i>
                    <input type="text" name="nip_atau_nup" placeholder="NIP/NUP" required>
                </div>

                <div class="input-group">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" placeholder="Password" required>
                </div>

                <button type="submit" class="login-btn">Sign In</button>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize auto typer
            initAutoTyper();
            
            // Initialize mouse light effect
            initMouseLightEffect();
            
            // Initialize particles
            initParticles();
            
            // Initialize connection lines
            initConnections();
        });

        // Auto typer functionality
        function initAutoTyper() {
            const texts = [
                "Inspection System Management",
                "Information System",
                "Advanced Management Platform",
                "Systematic Data Maintain"
            ];
            const typingTextElement = document.getElementById('typing-text');
            let textIndex = 0;
            let charIndex = 0;
            let isDeleting = false;
            let typingSpeed = 100;

            function type() {
                const currentText = texts[textIndex];
                
                if (isDeleting) {
                    // Delete text
                    typingTextElement.textContent = currentText.substring(0, charIndex - 1);
                    charIndex--;
                    typingSpeed = 50;
                } else {
                    // Type text
                    typingTextElement.textContent = currentText.substring(0, charIndex + 1);
                    charIndex++;
                    typingSpeed = 100;
                }
                
                // Check if text is complete
                if (!isDeleting && charIndex === currentText.length) {
                    isDeleting = true;
                    typingSpeed = 1000; // Pause at end of typing
                } else if (isDeleting && charIndex === 0) {
                    isDeleting = false;
                    textIndex = (textIndex + 1) % texts.length;
                    typingSpeed = 500; // Pause before starting next text
                }
                
                setTimeout(type, typingSpeed);
            }
            
            // Start typing effect
            setTimeout(type, 1000);
        }

        // Mouse light effect
        function initMouseLightEffect() {
            const lightEffect = document.getElementById('light-effect');
            const haloEffect = document.getElementById('halo-effect');
            let mouseX = 0;
            let mouseY = 0;
            let lightX = 0;
            let lightY = 0;
            let haloSize = 0;
            
            // Smooth follow with easing
            function animate() {
                // Ease towards mouse position
                lightX += (mouseX - lightX) * 0.1;
                lightY += (mouseY - lightY) * 0.1;
                
                // Move light effect to mouse position
                lightEffect.style.left = `${lightX}px`;
                lightEffect.style.top = `${lightY}px`;
                
                // Move halo effect with different easing
                const haloX = mouseX;
                const haloY = mouseY;
                haloEffect.style.left = `${haloX}px`;
                haloEffect.style.top = `${haloY}px`;
                
                // Adjust halo size based on mouse speed
                haloEffect.style.transform = `translate(-50%, -50%) scale(${1 + haloSize/50})`;
                
                requestAnimationFrame(animate);
            }
            animate();
            
            let lastX = 0;
            let lastY = 0;
            
            document.addEventListener('mousemove', (e) => {
                mouseX = e.clientX;
                mouseY = e.clientY;
                
                // Calculate mouse speed for halo effect
                const deltaX = mouseX - lastX;
                const deltaY = mouseY - lastY;
                const speed = Math.sqrt(deltaX * deltaX + deltaY * deltaY);
                
                haloSize = Math.min(speed, 50);
                haloEffect.style.opacity = Math.min(speed/10, 1);
                
                lastX = mouseX;
                lastY = mouseY;
                
                // Change light size based on mouse speed
                const width = 250 + speed * 2;
                const height = 250 + speed * 2;
                lightEffect.style.width = `${width}px`;
                lightEffect.style.height = `${height}px`;
                
                // Change color based on position
                const hue = (mouseX / window.innerWidth) * 360;
                lightEffect.style.background = `radial-gradient(circle, hsla(${hue}, 100%, 70%, 0.3) 0%, transparent 70%)`;
                
                // Update particles based on mouse position
                updateParticles(mouseX, mouseY, speed);
            });
            
            document.addEventListener('mouseleave', () => {
                haloEffect.style.opacity = 0;
            });
            
            document.addEventListener('mouseenter', () => {
                haloEffect.style.opacity = 0.5;
            });
        }

        // Particles background
        function initParticles() {
            const particlesContainer = document.getElementById('particles');
            const particleCount = 80;
            
            for (let i = 0; i < particleCount; i++) {
                createParticle();
            }
            
            function createParticle() {
                const particle = document.createElement('div');
                particle.classList.add('particle');
                
                // Random position
                const posX = Math.random() * 100;
                const posY = Math.random() * 100 + 100; // Start below screen
                
                // Random size
                const size = Math.random() * 4 + 2;
                
                // Random animation duration
                const duration = Math.random() * 10 + 10;
                
                // Apply styles
                particle.style.left = `${posX}vw`;
                particle.style.top = `${posY}vh`;
                particle.style.width = `${size}px`;
                particle.style.height = `${size}px`;
                particle.style.animationDuration = `${duration}s`;
                particle.style.animationDelay = `${Math.random() * 5}s`;
                
                // Random color with brighter tones
                const hue = Math.random() * 360;
                const saturation = 80 + Math.random() * 20;
                particle.style.background = `hsla(${hue}, ${saturation}%, 70%, 0.9)`;
                particle.style.boxShadow = `0 0 15px 2px hsla(${hue}, ${saturation}%, 70%, 0.7)`;
                
                // Store initial position for interaction
                particle.dataset.x = posX;
                particle.dataset.y = posY;
                
                particlesContainer.appendChild(particle);
                
                // Remove particle after animation and create new one
                setTimeout(() => {
                    particle.remove();
                    createParticle();
                }, duration * 1000);
            }
        }
        
        // Update particles based on mouse movement
        function updateParticles(mouseX, mouseY, speed) {
            const particles = document.querySelectorAll('.particle');
            const mouseXPercent = (mouseX / window.innerWidth) * 100;
            const mouseYPercent = (mouseY / window.innerHeight) * 100;
            
            particles.forEach(particle => {
                const particleX = parseFloat(particle.dataset.x);
                const particleY = parseFloat(particle.dataset.y);
                
                // Calculate distance from mouse to particle
                const deltaX = mouseXPercent - particleX;
                const deltaY = mouseYPercent - particleY;
                const distance = Math.sqrt(deltaX * deltaX + deltaY * deltaY);
                
                // If mouse is close to particle, push it away
                if (distance < 20) {
                    const pushForce = (20 - distance) / 2;
                    const angle = Math.atan2(deltaY, deltaX);
                    
                    const translateX = Math.cos(angle) * pushForce * (speed / 10);
                    const translateY = Math.sin(angle) * pushForce * (speed / 10);
                    
                    particle.style.transform = `translate(${translateX}px, ${translateY}px)`;
                } else {
                    particle.style.transform = 'translate(0, 0)';
                }
            });
        }
        
        // Connection lines between orbs
        function initConnections() {
            const connectionsContainer = document.getElementById('connections');
            const orbs = document.querySelectorAll('.orb');
            const connectionCount = 5;
            
            for (let i = 0; i < connectionCount; i++) {
                createConnection();
            }
            
            function createConnection() {
                const line = document.createElement('div');
                line.classList.add('connection-line');
                
                // Random start and end points
                const startX = Math.random() * 100;
                const startY = Math.random() * 100;
                const endX = Math.random() * 100;
                const endY = Math.random() * 100;
                
                // Calculate distance and angle
                const deltaX = endX - startX;
                const deltaY = endY - startY;
                const distance = Math.sqrt(deltaX * deltaX + deltaY * deltaY);
                const angle = Math.atan2(deltaY, deltaX) * 180 / Math.PI;
                
                // Apply styles
                line.style.left = `${startX}%`;
                line.style.top = `${startY}%`;
                line.style.width = `${distance}%`;
                line.style.transform = `rotate(${angle}deg)`;
                line.style.opacity = 0.3 + Math.random() * 0.4;
                
                connectionsContainer.appendChild(line);
                
                // Animate the line
                let growing = true;
                function animateLine() {
                    const currentWidth = parseFloat(line.style.width);
                    
                    if (growing) {
                        line.style.width = `${currentWidth + 0.1}%`;
                        if (currentWidth > distance * 1.2) growing = false;
                    } else {
                        line.style.width = `${currentWidth - 0.1}%`;
                        if (currentWidth < distance * 0.8) growing = true;
                    }
                    
                    setTimeout(animateLine, 30);
                }
                
                animateLine();
            }
        }
    </script>
</body>
</html>