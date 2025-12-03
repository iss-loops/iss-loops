// ============================================
// SIMULADOR DE PÉNDULO SIMPLE
// ISS-LOOPS - Interactive Physics Game
// ============================================

// Canvas setup
const canvas = document.getElementById('game-canvas');
const ctx = canvas.getContext('2d');

// Game state
let isRunning = false;
let animationId = null;

// Pendulum physics variables
let length = 200; // Length in pixels
let angle = Math.PI / 4; // Initial angle (45 degrees)
let angularVelocity = 0;
let angularAcceleration = 0;
let gravity = 9.8;
let damping = 0.995; // Damping factor
let mass = 10; // Mass in kg (for display)

// Time
let time = 0;
let deltaTime = 0.016; // 16ms ~ 60fps

// Origin point (pivot)
const originX = canvas.width / 2;
const originY = 100;

// History for trail effect
const trailHistory = [];
const maxTrailLength = 50;

// ============================================
// RENDER CONTROLS
// ============================================
function renderControls() {
    const controlsContainer = document.getElementById('game-controls');
    controlsContainer.innerHTML = `
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Length Control -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    ${translations.length || 'Length'}: <span id="length-value">${(length / 100).toFixed(1)}</span> m
                </label>
                <input type="range" id="length-slider" min="100" max="300" value="${length}" 
                       class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer accent-purple-600">
            </div>

            <!-- Mass Control -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    ${translations.mass || 'Mass'}: <span id="mass-value">${mass}</span> kg
                </label>
                <input type="range" id="mass-slider" min="5" max="20" value="${mass}" 
                       class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer accent-purple-600">
            </div>

            <!-- Initial Angle Control -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    ${translations.initialAngle || 'Initial Angle'}: <span id="angle-value">${(angle * 180 / Math.PI).toFixed(0)}</span>°
                </label>
                <input type="range" id="angle-slider" min="15" max="90" value="${angle * 180 / Math.PI}" 
                       class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer accent-purple-600">
            </div>

            <!-- Gravity Control -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    ${translations.gravity || 'Gravity'}: <span id="gravity-value">${gravity.toFixed(1)}</span> m/s²
                </label>
                <input type="range" id="gravity-slider" min="1" max="20" step="0.1" value="${gravity}" 
                       class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer accent-purple-600">
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex gap-3 mt-6">
            <button id="start-btn" class="flex-1 px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition font-medium">
                ${translations.start || 'Start'}
            </button>
            <button id="pause-btn" class="flex-1 px-6 py-3 bg-yellow-600 text-white rounded-lg hover:bg-yellow-700 transition font-medium" disabled>
                ${translations.pause || 'Pause'}
            </button>
            <button id="stop-btn" class="flex-1 px-6 py-3 bg-red-600 text-white rounded-lg hover:bg-red-700 transition font-medium" disabled>
                ${translations.stop || 'Stop'}
            </button>
        </div>

        <!-- Real-time Data Display -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-6 bg-gray-50 rounded-lg p-4">
            <div class="text-center">
                <div class="text-xs text-gray-600 mb-1">${translations.angle || 'Angle'}</div>
                <div id="current-angle" class="text-lg font-bold text-purple-600">0°</div>
            </div>
            <div class="text-center">
                <div class="text-xs text-gray-600 mb-1">${translations.velocity || 'Velocity'}</div>
                <div id="current-velocity" class="text-lg font-bold text-blue-600">0 rad/s</div>
            </div>
            <div class="text-center">
                <div class="text-xs text-gray-600 mb-1">${translations.period || 'Period'}</div>
                <div id="current-period" class="text-lg font-bold text-green-600">0 s</div>
            </div>
            <div class="text-center">
                <div class="text-xs text-gray-600 mb-1">${translations.time || 'Time'}</div>
                <div id="current-time" class="text-lg font-bold text-orange-600">0 s</div>
            </div>
        </div>
    `;

    // Add event listeners
    attachControlListeners();
}

// ============================================
// ATTACH EVENT LISTENERS
// ============================================
function attachControlListeners() {
    // Length slider
    document.getElementById('length-slider').addEventListener('input', (e) => {
        if (!isRunning) {
            length = parseFloat(e.target.value);
            document.getElementById('length-value').textContent = (length / 100).toFixed(1);
            draw();
        }
    });

    // Mass slider
    document.getElementById('mass-slider').addEventListener('input', (e) => {
        if (!isRunning) {
            mass = parseFloat(e.target.value);
            document.getElementById('mass-value').textContent = mass;
            draw();
        }
    });

    // Angle slider
    document.getElementById('angle-slider').addEventListener('input', (e) => {
        if (!isRunning) {
            angle = parseFloat(e.target.value) * Math.PI / 180;
            document.getElementById('angle-value').textContent = e.target.value;
            draw();
        }
    });

    // Gravity slider
    document.getElementById('gravity-slider').addEventListener('input', (e) => {
        gravity = parseFloat(e.target.value);
        document.getElementById('gravity-value').textContent = gravity.toFixed(1);
    });

    // Start button
    document.getElementById('start-btn').addEventListener('click', startSimulation);

    // Pause button
    document.getElementById('pause-btn').addEventListener('click', pauseSimulation);

    // Stop button
    document.getElementById('stop-btn').addEventListener('click', stopSimulation);
}

// ============================================
// PHYSICS CALCULATIONS
// ============================================
function updatePhysics() {
    // Calculate angular acceleration: α = -(g/L) * sin(θ)
    angularAcceleration = (-gravity / (length / 100)) * Math.sin(angle);
    
    // Update angular velocity: ω = ω + α * Δt
    angularVelocity += angularAcceleration * deltaTime;
    
    // Apply damping
    angularVelocity *= damping;
    
    // Update angle: θ = θ + ω * Δt
    angle += angularVelocity * deltaTime;
    
    // Update time
    time += deltaTime;
}

// ============================================
// DRAWING FUNCTIONS
// ============================================
function draw() {
    // Clear canvas
    ctx.fillStyle = '#ffffff';
    ctx.fillRect(0, 0, canvas.width, canvas.height);

    // Calculate bob position
    const bobX = originX + length * Math.sin(angle);
    const bobY = originY + length * Math.cos(angle);

    // Add to trail
    if (isRunning) {
        trailHistory.push({ x: bobX, y: bobY });
        if (trailHistory.length > maxTrailLength) {
            trailHistory.shift();
        }
    }

    // Draw trail
    if (trailHistory.length > 1) {
        ctx.strokeStyle = 'rgba(147, 51, 234, 0.3)';
        ctx.lineWidth = 2;
        ctx.beginPath();
        ctx.moveTo(trailHistory[0].x, trailHistory[0].y);
        for (let i = 1; i < trailHistory.length; i++) {
            ctx.lineTo(trailHistory[i].x, trailHistory[i].y);
        }
        ctx.stroke();
    }

    // Draw pivot point
    ctx.fillStyle = '#374151';
    ctx.beginPath();
    ctx.arc(originX, originY, 8, 0, Math.PI * 2);
    ctx.fill();

    // Draw string
    ctx.strokeStyle = '#6B7280';
    ctx.lineWidth = 3;
    ctx.beginPath();
    ctx.moveTo(originX, originY);
    ctx.lineTo(bobX, bobY);
    ctx.stroke();

    // Draw bob (pendulum ball)
    const bobRadius = Math.sqrt(mass) * 5;
    
    // Shadow
    ctx.fillStyle = 'rgba(0, 0, 0, 0.2)';
    ctx.beginPath();
    ctx.arc(bobX + 5, bobY + 5, bobRadius, 0, Math.PI * 2);
    ctx.fill();
    
    // Main bob
    const gradient = ctx.createRadialGradient(bobX - bobRadius/3, bobY - bobRadius/3, 0, bobX, bobY, bobRadius);
    gradient.addColorStop(0, '#fbbf24');
    gradient.addColorStop(1, '#f59e0b');
    ctx.fillStyle = gradient;
    ctx.beginPath();
    ctx.arc(bobX, bobY, bobRadius, 0, Math.PI * 2);
    ctx.fill();

    // Bob outline
    ctx.strokeStyle = '#d97706';
    ctx.lineWidth = 2;
    ctx.stroke();

    // Draw angle arc
    ctx.strokeStyle = 'rgba(59, 130, 246, 0.5)';
    ctx.lineWidth = 2;
    ctx.beginPath();
    ctx.arc(originX, originY, 50, Math.PI/2, Math.PI/2 + angle, angle > 0);
    ctx.stroke();

    // Draw angle label
    ctx.fillStyle = '#2563eb';
    ctx.font = 'bold 14px sans-serif';
    ctx.fillText(`${(angle * 180 / Math.PI).toFixed(1)}°`, originX + 60, originY + 30);

    // Update real-time display
    updateDisplay();
}

// ============================================
// UPDATE REAL-TIME DISPLAY
// ============================================
function updateDisplay() {
    document.getElementById('current-angle').textContent = `${(angle * 180 / Math.PI).toFixed(1)}°`;
    document.getElementById('current-velocity').textContent = `${angularVelocity.toFixed(2)} rad/s`;
    
    // Calculate period: T = 2π√(L/g)
    const period = 2 * Math.PI * Math.sqrt((length / 100) / gravity);
    document.getElementById('current-period').textContent = `${period.toFixed(2)} s`;
    document.getElementById('current-time').textContent = `${time.toFixed(1)} s`;
}

// ============================================
// ANIMATION LOOP
// ============================================
function animate() {
    if (isRunning) {
        updatePhysics();
        draw();
        animationId = requestAnimationFrame(animate);
    }
}

// ============================================
// CONTROL FUNCTIONS
// ============================================
function startSimulation() {
    isRunning = true;
    document.getElementById('start-btn').disabled = true;
    document.getElementById('pause-btn').disabled = false;
    document.getElementById('stop-btn').disabled = false;
    
    // Disable sliders during simulation
    document.getElementById('length-slider').disabled = true;
    document.getElementById('mass-slider').disabled = true;
    document.getElementById('angle-slider').disabled = true;
    
    animate();
}

function pauseSimulation() {
    isRunning = false;
    if (animationId) {
        cancelAnimationFrame(animationId);
    }
    document.getElementById('start-btn').disabled = false;
    document.getElementById('pause-btn').disabled = true;
}

function stopSimulation() {
    isRunning = false;
    if (animationId) {
        cancelAnimationFrame(animationId);
    }
    
    // Reset
    angularVelocity = 0;
    time = 0;
    trailHistory.length = 0;
    
    // Re-enable controls
    document.getElementById('start-btn').disabled = false;
    document.getElementById('pause-btn').disabled = true;
    document.getElementById('stop-btn').disabled = true;
    document.getElementById('length-slider').disabled = false;
    document.getElementById('mass-slider').disabled = false;
    document.getElementById('angle-slider').disabled = false;
    
    draw();
}

// ============================================
// GLOBAL RESET FUNCTION
// ============================================
function resetGame() {
    stopSimulation();
    
    // Reset to default values
    length = 200;
    angle = Math.PI / 4;
    mass = 10;
    gravity = 9.8;
    
    // Update sliders
    document.getElementById('length-slider').value = length;
    document.getElementById('length-value').textContent = (length / 100).toFixed(1);
    document.getElementById('mass-slider').value = mass;
    document.getElementById('mass-value').textContent = mass;
    document.getElementById('angle-slider').value = angle * 180 / Math.PI;
    document.getElementById('angle-value').textContent = (angle * 180 / Math.PI).toFixed(0);
    document.getElementById('gravity-slider').value = gravity;
    document.getElementById('gravity-value').textContent = gravity.toFixed(1);
    
    draw();
}

// ============================================
// TRANSLATIONS
// ============================================
const translations = {
    length: document.documentElement.lang === 'es' ? 'Longitud' : 'Length',
    mass: document.documentElement.lang === 'es' ? 'Masa' : 'Mass',
    initialAngle: document.documentElement.lang === 'es' ? 'Ángulo Inicial' : 'Initial Angle',
    gravity: document.documentElement.lang === 'es' ? 'Gravedad' : 'Gravity',
    start: document.documentElement.lang === 'es' ? 'Iniciar' : 'Start',
    pause: document.documentElement.lang === 'es' ? 'Pausar' : 'Pause',
    stop: document.documentElement.lang === 'es' ? 'Detener' : 'Stop',
    angle: document.documentElement.lang === 'es' ? 'Ángulo' : 'Angle',
    velocity: document.documentElement.lang === 'es' ? 'Velocidad' : 'Velocity',
    period: document.documentElement.lang === 'es' ? 'Periodo' : 'Period',
    time: document.documentElement.lang === 'es' ? 'Tiempo' : 'Time'
};

// ============================================
// INITIALIZE
// ============================================
renderControls();
draw();

console.log('🎮 Pendulum Simulator loaded successfully!');