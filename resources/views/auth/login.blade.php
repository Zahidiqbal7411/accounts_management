<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login - Accounts Management</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #f5f7fa 0%, #e4ecf7 25%, #d9e4f5 50%, #e8eef5 75%, #f0f4f8 100%);
            position: relative;
            overflow: hidden;
        }

        /* Animated Background Elements */
        .bg-shapes {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 0;
        }

        .shape {
            position: absolute;
            border-radius: 50%;
            animation: float 20s infinite ease-in-out;
        }

        .shape:nth-child(1) {
            width: 500px;
            height: 500px;
            top: -150px;
            left: -150px;
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.15), rgba(168, 85, 247, 0.1));
            animation-delay: 0s;
        }

        .shape:nth-child(2) {
            width: 400px;
            height: 400px;
            bottom: -120px;
            right: -120px;
            background: linear-gradient(135deg, rgba(236, 72, 153, 0.12), rgba(139, 92, 246, 0.1));
            animation-delay: -5s;
        }

        .shape:nth-child(3) {
            width: 250px;
            height: 250px;
            top: 40%;
            right: 5%;
            background: linear-gradient(135deg, rgba(14, 165, 233, 0.1), rgba(99, 102, 241, 0.08));
            animation-delay: -10s;
        }

        .shape:nth-child(4) {
            width: 180px;
            height: 180px;
            bottom: 20%;
            left: 5%;
            background: linear-gradient(135deg, rgba(34, 197, 94, 0.1), rgba(14, 165, 233, 0.08));
            animation-delay: -15s;
        }

        .shape:nth-child(5) {
            width: 120px;
            height: 120px;
            top: 15%;
            right: 25%;
            background: linear-gradient(135deg, rgba(251, 146, 60, 0.12), rgba(236, 72, 153, 0.08));
            animation-delay: -8s;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0) rotate(0deg) scale(1); }
            25% { transform: translateY(-40px) rotate(5deg) scale(1.02); }
            50% { transform: translateY(-20px) rotate(-3deg) scale(0.98); }
            75% { transform: translateY(30px) rotate(8deg) scale(1.01); }
        }

        /* Decorative Elements */
        .decorative-dots {
            position: absolute;
            width: 100%;
            height: 100%;
            z-index: 0;
            opacity: 0.4;
        }

        .dot-group {
            position: absolute;
        }

        .dot-group::before,
        .dot-group::after {
            content: '';
            position: absolute;
            width: 6px;
            height: 6px;
            background: linear-gradient(135deg, #6366f1, #a855f7);
            border-radius: 50%;
        }

        .dot-group:nth-child(1) { top: 10%; left: 15%; }
        .dot-group:nth-child(1)::after { top: 15px; left: 12px; }
        .dot-group:nth-child(2) { top: 25%; right: 18%; }
        .dot-group:nth-child(2)::after { top: 10px; left: -8px; }
        .dot-group:nth-child(3) { bottom: 20%; left: 12%; }
        .dot-group:nth-child(3)::after { top: -12px; left: 15px; }
        .dot-group:nth-child(4) { bottom: 35%; right: 10%; }
        .dot-group:nth-child(4)::after { top: 18px; left: 5px; }

        /* Login Container */
        .login-container {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 460px;
            padding: 20px;
        }

        /* Login Card */
        .login-card {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-radius: 28px;
            border: 1px solid rgba(255, 255, 255, 0.9);
            padding: 50px 45px;
            box-shadow: 
                0 25px 50px -12px rgba(99, 102, 241, 0.15),
                0 10px 30px -15px rgba(0, 0, 0, 0.1),
                inset 0 1px 0 rgba(255, 255, 255, 0.8);
            animation: slideUp 0.6s ease-out;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Logo Section */
        .logo-section {
            text-align: center;
            margin-bottom: 40px;
        }

        .logo-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 50%, #a855f7 100%);
            border-radius: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 24px;
            box-shadow: 
                0 15px 35px rgba(99, 102, 241, 0.35),
                0 5px 15px rgba(139, 92, 246, 0.2);
            animation: pulse 3s infinite ease-in-out;
            position: relative;
        }

        .logo-icon::before {
            content: '';
            position: absolute;
            inset: -3px;
            border-radius: 27px;
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.3), rgba(168, 85, 247, 0.3));
            z-index: -1;
            animation: glow 3s infinite ease-in-out;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }

        @keyframes glow {
            0%, 100% { opacity: 0.5; }
            50% { opacity: 0.8; }
        }

        .logo-icon i {
            font-size: 36px;
            color: white;
            text-shadow: 0 2px 10px rgba(0,0,0,0.2);
        }

        .logo-section h1 {
            background: linear-gradient(135deg, #1e293b 0%, #334155 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            font-size: 30px;
            font-weight: 700;
            margin-bottom: 10px;
            letter-spacing: -0.5px;
        }

        .logo-section p {
            color: #64748b;
            font-size: 16px;
            font-weight: 400;
        }

        /* Form Styles */
        .form-group {
            margin-bottom: 26px;
        }

        .form-group label {
            display: block;
            color: #374151;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 10px;
            letter-spacing: 0.3px;
        }

        .input-wrapper {
            position: relative;
        }

        .input-wrapper > i:first-of-type {
            position: absolute;
            left: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            font-size: 17px;
            transition: all 0.3s ease;
        }

        .form-control {
            width: 100%;
            padding: 18px 20px 18px 52px;
            background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
            border: 2px solid #e2e8f0;
            border-radius: 16px;
            font-size: 15px;
            color: #1e293b;
            font-family: 'Inter', sans-serif;
            transition: all 0.3s ease;
            outline: none;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.03);
        }

        .form-control::placeholder {
            color: #94a3b8;
        }

        .form-control:focus {
            background: #ffffff;
            border-color: #6366f1;
            box-shadow: 
                0 0 0 4px rgba(99, 102, 241, 0.12),
                0 4px 15px rgba(99, 102, 241, 0.1);
        }

        .input-wrapper:focus-within > i:first-of-type {
            color: #6366f1;
            transform: translateY(-50%) scale(1.1);
        }

        /* Password Toggle */
        .password-toggle {
            position: absolute;
            right: 18px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #94a3b8;
            cursor: pointer;
            font-size: 17px;
            transition: all 0.3s ease;
            padding: 5px;
        }

        .password-toggle:hover {
            color: #6366f1;
            transform: translateY(-50%) scale(1.1);
        }

        /* Submit Button */
        .btn-login {
            width: 100%;
            padding: 18px;
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 50%, #a855f7 100%);
            border: none;
            border-radius: 16px;
            color: white;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            font-family: 'Inter', sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            box-shadow: 
                0 10px 30px rgba(99, 102, 241, 0.35),
                0 5px 15px rgba(139, 92, 246, 0.2);
            position: relative;
            overflow: hidden;
            margin-top: 8px;
        }

        .btn-login::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s ease;
        }

        .btn-login:hover {
            transform: translateY(-3px);
            box-shadow: 
                0 15px 40px rgba(99, 102, 241, 0.4),
                0 8px 20px rgba(139, 92, 246, 0.25);
        }

        .btn-login:hover::before {
            left: 100%;
        }

        .btn-login:active {
            transform: translateY(-1px);
        }

        .btn-login i {
            font-size: 15px;
            transition: transform 0.3s ease;
        }

        .btn-login:hover i {
            transform: translateX(5px);
        }

        /* Error Messages */
        .error-message {
            background: linear-gradient(135deg, rgba(239, 68, 68, 0.1), rgba(248, 113, 113, 0.08));
            border: 1px solid rgba(239, 68, 68, 0.25);
            border-radius: 14px;
            padding: 14px 18px;
            margin-bottom: 26px;
            color: #dc2626;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 12px;
            animation: shake 0.5s ease-in-out;
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }

        .error-message i {
            font-size: 18px;
        }

        /* Session Status */
        .session-status {
            background: linear-gradient(135deg, rgba(34, 197, 94, 0.1), rgba(74, 222, 128, 0.08));
            border: 1px solid rgba(34, 197, 94, 0.25);
            border-radius: 14px;
            padding: 14px 18px;
            margin-bottom: 26px;
            color: #16a34a;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        /* Footer Text */
        .footer-text {
            text-align: center;
            margin-top: 30px;
            padding-top: 24px;
            border-top: 1px solid rgba(226, 232, 240, 0.8);
        }

        .footer-text p {
            color: #94a3b8;
            font-size: 13px;
        }

        .footer-text i {
            color: #f472b6;
            margin: 0 3px;
        }

        /* Responsive */
        @media (max-width: 480px) {
            .login-card {
                padding: 40px 28px;
                border-radius: 24px;
            }

            .logo-section h1 {
                font-size: 26px;
            }

            .logo-icon {
                width: 70px;
                height: 70px;
            }

            .logo-icon i {
                font-size: 30px;
            }
        }
    </style>
</head>
<body>
    <!-- Animated Background -->
    <div class="bg-shapes">
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
    </div>

    <!-- Decorative Dots -->
    <div class="decorative-dots">
        <div class="dot-group"></div>
        <div class="dot-group"></div>
        <div class="dot-group"></div>
        <div class="dot-group"></div>
    </div>

    <div class="login-container">
        <div class="login-card">
            <!-- Logo Section -->
            <div class="logo-section">
                <div class="logo-icon">
                    <i class="fas fa-chart-line"></i>
                </div>
                <h1>Accounts Management</h1>
                <p>Sign in to access your dashboard</p>
            </div>

            <!-- Session Status -->
            @if (session('status'))
                <div class="session-status">
                    <i class="fas fa-check-circle"></i>
                    {{ session('status') }}
                </div>
            @endif

            <!-- Error Messages -->
            @if ($errors->any())
                <div class="error-message">
                    <i class="fas fa-exclamation-circle"></i>
                    <span>{{ $errors->first() }}</span>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Field -->
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <div class="input-wrapper">
                        <input 
                            type="email" 
                            id="email" 
                            name="email" 
                            class="form-control" 
                            placeholder="Enter your email"
                            value="{{ old('email') }}"
                            required 
                            autofocus
                            autocomplete="username"
                        >
                        <i class="fas fa-envelope"></i>
                    </div>
                </div>

                <!-- Password Field -->
                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-wrapper">
                        <input 
                            type="password" 
                            id="password" 
                            name="password" 
                            class="form-control" 
                            placeholder="Enter your password"
                            required
                            autocomplete="current-password"
                        >
                        <i class="fas fa-lock"></i>
                        <button type="button" class="password-toggle" onclick="togglePassword()">
                            <i class="fas fa-eye" id="toggleIcon"></i>
                        </button>
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn-login">
                    <span>Sign In</span>
                    <i class="fas fa-arrow-right"></i>
                </button>
            </form>

            <!-- Footer -->
            <!-- <div class="footer-text">
                <p>Made with <i class="fas fa-heart"></i> for secure accounting</p>
            </div> -->
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('toggleIcon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }

        // Add subtle animation to form inputs on focus
        document.querySelectorAll('.form-control').forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.style.transform = 'scale(1.01)';
                this.parentElement.style.transition = 'transform 0.25s ease';
            });
            
            input.addEventListener('blur', function() {
                this.parentElement.style.transform = 'scale(1)';
            });
        });

        // Add entrance animation delay
        document.addEventListener('DOMContentLoaded', function() {
            const formGroups = document.querySelectorAll('.form-group');
            formGroups.forEach((group, index) => {
                group.style.opacity = '0';
                group.style.transform = 'translateY(20px)';
                setTimeout(() => {
                    group.style.transition = 'all 0.5s ease';
                    group.style.opacity = '1';
                    group.style.transform = 'translateY(0)';
                }, 200 + (index * 100));
            });

            const button = document.querySelector('.btn-login');
            button.style.opacity = '0';
            button.style.transform = 'translateY(20px)';
            setTimeout(() => {
                button.style.transition = 'all 0.5s ease';
                button.style.opacity = '1';
                button.style.transform = 'translateY(0)';
            }, 500);
        });
    </script>
</body>
</html>
