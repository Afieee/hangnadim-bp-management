document.addEventListener('DOMContentLoaded', function () {
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
        haloEffect.style.transform = `translate(-50%, -50%) scale(${1 + haloSize / 50})`;

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
        haloEffect.style.opacity = Math.min(speed / 10, 1);

        lastX = mouseX;
        lastY = mouseY;

        // Change light size based on mouse speed
        const width = 250 + speed * 2;
        const height = 250 + speed * 2;
        lightEffect.style.width = `${width}px`;
        lightEffect.style.height = `${height}px`;

        // Change color based on position
        const hue = (mouseX / window.innerWidth) * 360;
        lightEffect.style.background =
            `radial-gradient(circle, hsla(${hue}, 100%, 70%, 0.3) 0%, transparent 70%)`;

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
