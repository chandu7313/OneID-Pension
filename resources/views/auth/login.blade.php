@extends('layouts.app')

@section('no-layout', true)
@section('title', 'Secure Sign-In')

@section('styles')
<style>
    .auth-container {
        display: flex;
        min-height: 100vh;
        background: var(--white);
    }
    .auth-visual {
        flex: 1;
        background: #f8fafc;
        display: flex;
        flex-direction: column;
        justify-content: center;
        padding: 64px;
        position: relative;
        overflow: hidden;
    }
    .auth-form-side {
        width: 500px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        padding: 64px;
        background: white;
        box-shadow: -10px 0 30px rgba(0,0,0,0.02);
    }
    .portal-badge {
        display: inline-block;
        padding: 6px 16px;
        background: var(--primary-light);
        color: var(--primary);
        border-radius: 20px;
        font-weight: 700;
        font-size: 0.75rem;
        margin-bottom: 24px;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }
    .auth-title {
        font-size: 2.5rem;
        font-weight: 800;
        color: var(--secondary);
        line-height: 1.1;
        margin-bottom: 24px;
    }
    .auth-subtitle {
        color: var(--text-light);
        font-size: 1.1rem;
        margin-bottom: 40px;
        max-width: 480px;
    }
    .visual-image {
        width: 100%;
        max-width: 400px;
        margin-top: 40px;
        border-radius: 24px;
        box-shadow: 0 20px 40px rgba(0,51,153,0.1);
    }
    
    .form-group { margin-bottom: 24px; }
    .form-group label { display: block; margin-bottom: 8px; font-weight: 600; font-size: 0.875rem; color: var(--text-light); }
    .input-wrapper { position: relative; }
    .input-wrapper i { position: absolute; left: 16px; top: 50%; transform: translateY(-50%); color: var(--text-light); }
    .input-wrapper input {
        width: 100%;
        padding: 12px 16px 12px 48px;
        border: 1px solid var(--border);
        border-radius: 10px;
        outline: none;
        transition: border-color 0.2s;
    }
    .input-wrapper input:focus { border-color: var(--primary); }

    .tabs { display: flex; background: #f1f5f9; border-radius: 12px; padding: 4px; margin-bottom: 32px; }
    .tab { flex: 1; text-align: center; padding: 10px; cursor: pointer; border-radius: 8px; font-weight: 600; font-size: 0.875rem; color: var(--text-light); }
    .tab.active { background: white; color: var(--primary); box-shadow: 0 2px 4px rgba(0,0,0,0.05); }

    .captcha-row { display: flex; gap: 12px; align-items: center; margin-top: 24px; }
    .captcha-code { background: #f1f5f9; padding: 12px 24px; border-radius: 8px; font-family: monospace; font-weight: 800; font-size: 1.25rem; letter-spacing: 4px; color: var(--primary); font-style: italic; }
    
    .social-btns { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-top: 32px; }
    .social-btn { display: flex; align-items: center; justify-content: center; gap: 8px; padding: 12px; border: 1px solid var(--border); border-radius: 10px; background: white; cursor: pointer; font-weight: 500; font-size: 0.875rem; }
</style>
@endsection

@section('content')
<div class="auth-container">
    <div class="auth-visual">
        <div class="logo-container" style="position: absolute; top: 48px; left: 64px; display: flex; align-items: center; gap: 15px;">
            <img src="{{ asset('images/pension_logo.png') }}" style="height: 50px;" alt="Pension Logo">
            <div style="border-left: 2px solid var(--border); padding-left: 15px;">
                <div style="font-size: 1.2rem; font-weight: 800; color: var(--primary);">OneID Pension</div>
                <div style="font-size: 0.75rem; color: var(--text-light); text-transform: uppercase; letter-spacing: 1px;">Ministry of Social Justice</div>
            </div>
        </div>
        
        <div style="margin-top: 80px;">
            <span class="portal-badge" style="background: #fff7ed; color: #c2410c; border: 1px solid #ffedd5;">Government of India</span>
            <h1 class="auth-title">Unified Digital <br><span style="color: var(--primary)">Pension Identity</span></h1>
            <p class="auth-subtitle">Ensuring financial dignity for every senior citizen through transparent, paperless, and secure digital governance.</p>
            
            <img src="{{ asset('images/govt_banner.png') }}" class="visual-image" style="max-width: 550px; border: 8px solid white; box-shadow: 0 20px 40px rgba(0,0,0,0.1);" alt="OneID Banner">
        </div>
        
        <div style="position: absolute; bottom: 48px; left: 64px; display: flex; gap: 24px; color: var(--text-light); font-size: 0.75rem;">
            <span>© 2024 National Pension System Trust.</span>
            <a href="#" style="color: var(--text-light); text-decoration: none;">Privacy Policy</a>
            <a href="#" style="color: var(--text-light); text-decoration: none;">Helpdesk</a>
        </div>
    </div>
    
    <div class="auth-form-side">
        <div style="text-align: right; margin-bottom: 40px; font-size: 0.875rem; color: var(--text-light); display: flex; align-items: center; justify-content: flex-end; gap: 8px;">
            <i class="fas fa-shield-check" style="color: var(--success)"></i> Secure Portal
        </div>
        
        <h2 style="font-size: 1.75rem; font-weight: 800; margin-bottom: 8px;">Secure Sign-In</h2>
        <p style="color: var(--text-light); margin-bottom: 32px;">Access your digital pension records</p>
        
        <div class="tabs">
            <div class="tab active" onclick="setRole('citizen')">Aadhaar / ID</div>
            <div class="tab" onclick="setRole('admin')">Employee ID</div>
        </div>
        
        <form id="loginForm" action="{{ url('/citizen/dashboard') }}">
            <div class="form-group">
                <label>Identity Number</label>
                <div class="input-wrapper">
                    <i class="fas fa-id-card"></i>
                    <input type="text" placeholder="Enter 12 digit Aadhaar or ID" required>
                </div>
            </div>
            
            <div class="form-group">
                <label>Password / PIN</label>
                <div class="input-wrapper">
                    <i class="fas fa-lock"></i>
                    <input type="password" placeholder="••••••••" required>
                    <i class="fas fa-eye" style="left: auto; right: 16px; cursor: pointer;"></i>
                </div>
            </div>
            
            <div class="captcha-row">
                <div class="captcha-code">X 7 R 2 K</div>
                <button type="button" style="background: none; border: none; color: var(--primary); cursor: pointer;"><i class="fas fa-sync"></i></button>
                <input type="text" placeholder="Captcha" style="flex: 1; padding: 12px; border: 1px solid var(--border); border-radius: 10px; outline: none;">
            </div>
            
            <div style="display: flex; justify-content: space-between; align-items: center; margin: 24px 0;">
                <label style="display: flex; align-items: center; gap: 8px; font-size: 0.875rem; color: var(--text-light); cursor: pointer;">
                    <input type="checkbox"> Remember me
                </label>
                <a href="#" style="font-size: 0.875rem; color: var(--primary); text-decoration: none; font-weight: 600;">Forgot PIN?</a>
            </div>
            
            <button type="submit" class="btn btn-primary" style="width: 100%; justify-content: center; padding: 14px; font-size: 1rem;">
                Sign In to Dashboard <i class="fas fa-arrow-right"></i>
            </button>
        </form>
        
        <div style="margin-top: 32px; text-align: center; position: relative;">
            <div style="position: absolute; top: 50%; left: 0; right: 0; border-top: 1px solid var(--border); z-index: 1;"></div>
            <span style="position: relative; z-index: 2; background: white; padding: 0 16px; color: var(--text-light); font-size: 0.75rem;">or continue with</span>
        </div>
        
        <div class="social-btns">
            <button class="social-btn">
                <img src="https://www.google.com/favicon.ico" style="width: 16px;"> Google
            </button>
            <button class="social-btn">
                <i class="fas fa-car" style="color: #003399"></i> mParivahan
            </button>
        </div>
        
        <p style="margin-top: 32px; text-align: center; font-size: 0.875rem; color: var(--text-light);">
            Don't have an OneID? <a href="#" style="color: var(--primary); font-weight: 700; text-decoration: none;">Register Now</a>
        </p>
    </div>
</div>

<script>
    function setRole(role) {
        // Toggle tabs
        document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
        event.target.classList.add('active');

        // Set form action
        const form = document.getElementById('loginForm');
        if (role === 'admin') {
            form.action = "{{ url('/admin') }}";
        } else {
            form.action = "{{ url('/citizen/dashboard') }}";
        }
    }
</script>
@endsection
