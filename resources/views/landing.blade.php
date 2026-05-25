<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OneID Pension | Official Portal</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #003399;
            --secondary: #FF9933;
            --white: #ffffff;
            --bg-overlay: rgba(0, 0, 0, 0.6);
        }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { 
            font-family: 'Inter', sans-serif; 
            background: linear-gradient(var(--bg-overlay), var(--bg-overlay)), url('{{ asset('images/gateway_background.jpg') }}');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            min-height: 100vh;
            color: var(--white);
            display: flex;
            flex-direction: column;
        }

        .top-nav {
            display: flex;
            justify-content: flex-end;
            padding: 20px 60px;
            gap: 24px;
            font-size: 0.875rem;
            align-items: center;
            background: rgba(0,0,0,0.3);
        }
        .top-nav a { color: white; text-decoration: none; opacity: 0.8; transition: 0.2s; }
        .top-nav a:hover { opacity: 1; }

        .hero {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 80px 20px;
        }

        .emblem { height: 100px; margin-bottom: 30px; filter: drop-shadow(0 5px 15px rgba(0,0,0,0.5)); }
        
        .logo-area {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-bottom: 15px;
        }
        .main-logo { height: 90px; }
        .logo-text { font-size: 3.5rem; font-weight: 800; letter-spacing: -1.5px; }
        .logo-text span { color: var(--secondary); }

        .tagline { font-size: 1.5rem; font-weight: 500; opacity: 0.9; margin-bottom: 40px; }

        .login-cta {
            background: linear-gradient(135deg, var(--secondary) 0%, #e67e22 100%);
            color: white;
            padding: 20px 50px;
            font-size: 1.4rem;
            font-weight: 800;
            border-radius: 50px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 15px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.4);
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
            border: 2px solid rgba(255,255,255,0.2);
        }
        .login-cta:hover {
            transform: translateY(-5px) scale(1.02);
            box-shadow: 0 20px 45px rgba(0,0,0,0.5);
        }

        .features-section {
            padding: 80px 60px;
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(15px);
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }
        .section-title {
            text-align: center;
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 50px;
            text-transform: uppercase;
            letter-spacing: 2px;
        }
        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 40px;
            max-width: 1200px;
            margin: 0 auto;
        }
        .feature-card {
            background: rgba(255, 255, 255, 0.1);
            padding: 40px;
            border-radius: 24px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: 0.3s;
            text-align: center;
        }
        .feature-card:hover {
            background: rgba(255, 255, 255, 0.15);
            transform: translateY(-10px);
            border-color: var(--secondary);
        }
        .feature-icon {
            font-size: 3rem;
            color: var(--secondary);
            margin-bottom: 25px;
        }
        .feature-card h3 { font-size: 1.5rem; margin-bottom: 15px; }
        .feature-card p { font-size: 1rem; opacity: 0.8; line-height: 1.6; }

        footer {
            padding: 40px;
            text-align: center;
            font-size: 0.9rem;
            opacity: 0.6;
            background: rgba(0,0,0,0.4);
        }
    </style>
</head>
<body>
    <div class="top-nav">
        <a href="#">Language: English</a>
        <a href="#">Accessibility Options</a>
        <img src="https://upload.wikimedia.org/wikipedia/en/4/41/Flag_of_India.svg" style="width: 24px;" alt="India Flag">
    </div>

    <div class="hero">
        <img src="{{ asset('images/emblem.png') }}" alt="Emblem of India" class="emblem">
        <div class="logo-area">
            <img src="{{ asset('images/pension_logo.png') }}" class="main-logo" alt="OneID Pension Logo">
            <h1 class="logo-text">oneid.pension<span>.gov</span></h1>
        </div>
        <p class="tagline">The Unified Digital Backbone for India's Pensioners</p>
        
        <a href="{{ url('/login') }}" class="login-cta">
            <i class="fas fa-shield-halved"></i> Main Portal Login
        </a>
    </div>

    <section class="features-section">
        <h2 class="section-title">What We Can Do</h2>
        <div class="features-grid">
            <div class="feature-card">
                <i class="fas fa-id-card feature-icon"></i>
                <h3>Unified Identity</h3>
                <p>One digital identity (OneID) for all your pension schemes. No more managing multiple registration numbers or portals.</p>
            </div>
            <div class="feature-card">
                <i class="fas fa-money-bill-transfer feature-icon"></i>
                <h3>Real-time Tracking</h3>
                <p>Monitor your pension disbursements, credit status, and transaction history in real-time with direct bank integration.</p>
            </div>
            <div class="feature-card">
                <i class="fas fa-file-signature feature-icon"></i>
                <h3>Digital Life Certs</h3>
                <p>Submit your Life Certificate (Jeevan Pramaan) digitally using Aadhaar biometrics from the comfort of your home.</p>
            </div>
            <div class="feature-card">
                <i class="fas fa-headset feature-icon"></i>
                <h3>Instant Support</h3>
                <p>Integrated grievance redressal system to resolve payment delays, profile corrections, and technical issues efficiently.</p>
            </div>
        </div>
    </section>

    <footer>
        <p>© 2024 National Pension System Trust | Ministry of Social Justice & Empowerment, Government of India</p>
    </footer>
</body>
</html>
