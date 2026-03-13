<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MediCare — Connexion</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --teal:       #4e73df;
            --teal-light: #6f8fe8;
            --teal-dark:  #2e59d9;
            --cream:      #f4f6fc;
            --white:      #ffffff;
            --slate:      #2d3748;
            --muted:      #718096;
            --border:     #d8dff5;
            --error:      #c53030;
        }

        html, body {
            height: 100%;
            font-family: 'DM Sans', sans-serif;
            background: var(--cream);
            color: var(--slate);
        }

        /* ── Layout ── */
        .page {
            display: grid;
            grid-template-columns: 1fr 1fr;
            min-height: 100vh;
        }

        /* ── Left panel ── */
        .panel-left {
            position: relative;
            background: #1a3a6e;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 3rem;
        }

        .panel-left::before {
            content: '';
            position: absolute;
            inset: 0;
            background:
                radial-gradient(ellipse 80% 60% at 20% 80%, rgba(46,89,217,0.55) 0%, transparent 70%),
                radial-gradient(ellipse 60% 80% at 80% 10%, rgba(78,115,223,0.3) 0%, transparent 60%);
        }

        /* Decorative circle grid */
        .circles {
            position: absolute;
            top: 0; right: -80px;
            width: 420px; height: 420px;
            opacity: 0.07;
        }
        .circles circle { fill: none; stroke: #fff; }

        /* Cross pattern */
        .cross-pattern {
            position: absolute;
            bottom: -30px; left: -30px;
            opacity: 0.06;
            width: 260px;
        }

        .panel-left-content {
            position: relative;
            z-index: 1;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 3rem;
        }

        .brand-icon {
            width: 44px; height: 44px;
            background: rgba(255,255,255,0.15);
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            backdrop-filter: blur(8px);
        }

        .brand-icon svg { width: 22px; height: 22px; fill: #fff; }

        .brand-name {
            font-family: 'Playfair Display', serif;
            font-size: 1.5rem;
            color: #fff;
            font-weight: 600;
            letter-spacing: -0.02em;
        }

        .brand-name span { color: rgba(255,255,255,0.55); font-weight: 400; font-size: 0.75rem; display: block; letter-spacing: 0.1em; text-transform: uppercase; font-family: 'DM Sans', sans-serif; }

        .headline {
            margin-bottom: 2rem;
        }

        .headline h1 {
            font-family: 'Playfair Display', serif;
            font-size: clamp(2rem, 3vw, 2.8rem);
            color: #fff;
            line-height: 1.2;
            margin-bottom: 1rem;
        }

        .headline h1 em {
            font-style: italic;
            color: rgba(255,255,255,0.7);
        }

        .headline p {
            color: rgba(255,255,255,0.6);
            font-size: 0.95rem;
            line-height: 1.7;
            max-width: 340px;
        }

        .stats {
            display: flex;
            gap: 2rem;
            margin-top: 2.5rem;
        }

        .stat-item { }
        .stat-num {
            font-family: 'Playfair Display', serif;
            font-size: 1.8rem;
            color: #fff;
            font-weight: 600;
        }
        .stat-label {
            font-size: 0.75rem;
            color: rgba(255,255,255,0.5);
            text-transform: uppercase;
            letter-spacing: 0.08em;
        }

        .divider-stat {
            width: 1px;
            background: rgba(255,255,255,0.15);
            align-self: stretch;
        }

        /* Testimonial */
        .testimonial {
            position: relative;
            z-index: 1;
            background: rgba(255,255,255,0.07);
            border: 1px solid rgba(255,255,255,0.12);
            border-radius: 16px;
            padding: 1.5rem;
            backdrop-filter: blur(10px);
        }

        .testimonial p {
            font-size: 0.9rem;
            color: rgba(255,255,255,0.8);
            line-height: 1.6;
            font-style: italic;
            margin-bottom: 1rem;
        }

        .testimonial-author {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .avatar {
            width: 36px; height: 36px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--teal-light), #fff);
            display: flex; align-items: center; justify-content: center;
            font-weight: 600;
            font-size: 0.8rem;
            color: #1a3a6e;
        }

        .author-info .name { color: #fff; font-size: 0.85rem; font-weight: 500; }
        .author-info .role { color: rgba(255,255,255,0.45); font-size: 0.75rem; }

        /* ── Right panel ── */
        .panel-right {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            background: var(--cream);
        }

        .login-box {
            width: 100%;
            max-width: 420px;
            animation: fadeUp 0.6s ease both;
        }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(24px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .login-header {
            margin-bottom: 2.5rem;
        }

        .login-header .tag {
            display: inline-block;
            background: rgba(78,115,223,0.1);
            color: var(--teal);
            font-size: 0.7rem;
            font-weight: 600;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            padding: 0.3rem 0.75rem;
            border-radius: 100px;
            margin-bottom: 1rem;
        }

        .login-header h2 {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            color: var(--slate);
            margin-bottom: 0.5rem;
        }

        .login-header p {
            color: var(--muted);
            font-size: 0.9rem;
        }

        /* Alerts */
        .alert {
            padding: 0.85rem 1rem;
            border-radius: 10px;
            font-size: 0.875rem;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .alert-danger { background: #fff5f5; border: 1px solid #fed7d7; color: var(--error); }
        .alert-success { background: #f0fff4; border: 1px solid #c6f6d5; color: #276749; }

        /* Form */
        .form-group {
            margin-bottom: 1.25rem;
        }

        label {
            display: block;
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--slate);
            letter-spacing: 0.03em;
            text-transform: uppercase;
            margin-bottom: 0.5rem;
        }

        .input-wrap {
            position: relative;
        }

        .input-wrap svg {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            width: 16px; height: 16px;
            color: var(--muted);
            pointer-events: none;
        }

        input[type="email"],
        input[type="password"],
        input[type="text"] {
            width: 100%;
            padding: 0.85rem 1rem 0.85rem 2.75rem;
            border: 1.5px solid var(--border);
            border-radius: 12px;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.925rem;
            color: var(--slate);
            background: var(--white);
            transition: border-color 0.2s, box-shadow 0.2s;
            outline: none;
        }

        input:focus {
            border-color: var(--teal);
            box-shadow: 0 0 0 3px rgba(78,115,223,0.15);
        }

        input.is-invalid {
            border-color: var(--error);
        }

        .invalid-feedback {
            color: var(--error);
            font-size: 0.8rem;
            margin-top: 0.35rem;
        }

        /* Remember + Forgot */
        .form-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.5rem;
        }

        .remember {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            cursor: pointer;
        }

        .remember input[type="checkbox"] {
            width: 16px; height: 16px;
            accent-color: var(--teal);
            padding: 0;
        }

        .remember span {
            font-size: 0.85rem;
            color: var(--muted);
        }

        .forgot {
            font-size: 0.85rem;
            color: var(--teal);
            text-decoration: none;
            font-weight: 500;
        }
        .forgot:hover { text-decoration: underline; }

        /* Submit button */
        .btn-login {
            width: 100%;
            padding: 1rem;
            background: var(--teal);
            color: #fff;
            border: none;
            border-radius: 12px;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.95rem;
            font-weight: 600;
            cursor: pointer;
            letter-spacing: 0.02em;
            transition: background 0.2s, transform 0.15s, box-shadow 0.2s;
            box-shadow: 0 4px 14px rgba(78,115,223,0.35);
            position: relative;
            overflow: hidden;
        }

        .btn-login::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(to bottom, rgba(255,255,255,0.08), transparent);
        }

        .btn-login:hover {
            background: var(--teal-light);
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(78,115,223,0.4);
        }

        .btn-login:active { transform: translateY(0); }

        /* Role badges */
        .roles {
            display: flex;
            gap: 0.5rem;
            margin-top: 2rem;
            padding-top: 1.5rem;
            border-top: 1px solid var(--border);
        }

        .role-badge {
            flex: 1;
            text-align: center;
            padding: 0.6rem;
            border-radius: 10px;
            border: 1.5px solid var(--border);
            cursor: pointer;
            transition: all 0.2s;
            background: var(--white);
        }

        .role-badge:hover {
            border-color: var(--teal);
            background: rgba(10,124,110,0.04);
        }

        .role-badge .icon { font-size: 1.2rem; margin-bottom: 0.2rem; }
        .role-badge .name { font-size: 0.7rem; font-weight: 600; color: var(--muted); text-transform: uppercase; letter-spacing: 0.05em; }

        /* Responsive */
        @media (max-width: 768px) {
            .page { grid-template-columns: 1fr; }
            .panel-left { display: none; }
            .panel-right { padding: 2rem 1.5rem; align-items: flex-start; padding-top: 4rem; }
        }
    </style>
</head>
<body>

<div class="page">

    <!-- ══ LEFT PANEL ══ -->
    <div class="panel-left">

        <!-- Decorative SVG circles -->
        <svg class="circles" viewBox="0 0 420 420" xmlns="http://www.w3.org/2000/svg">
            <circle cx="210" cy="210" r="200"/>
            <circle cx="210" cy="210" r="160"/>
            <circle cx="210" cy="210" r="120"/>
            <circle cx="210" cy="210" r="80"/>
            <circle cx="210" cy="210" r="40"/>
        </svg>

        <!-- Cross pattern bottom left -->
        <svg class="cross-pattern" viewBox="0 0 260 260" xmlns="http://www.w3.org/2000/svg">
            <defs>
                <pattern id="crosses" x="0" y="0" width="40" height="40" patternUnits="userSpaceOnUse">
                    <line x1="20" y1="10" x2="20" y2="30" stroke="white" stroke-width="2"/>
                    <line x1="10" y1="20" x2="30" y2="20" stroke="white" stroke-width="2"/>
                </pattern>
            </defs>
            <rect width="260" height="260" fill="url(#crosses)"/>
        </svg>

        <div class="panel-left-content">
            <!-- Brand -->
            <div class="brand">
                <div class="brand-icon">
                    <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M19 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2zm-7 14h-2v-4H6v-2h4V7h2v4h4v2h-4v4z"/>
                    </svg>
                </div>
                <div>
                    <div class="brand-name">MediCare</div>
                    <span>Centre Hospitalier</span>
                </div>
            </div>

            <!-- Headline -->
            <div class="headline">
                <h1>Votre santé,<br><em>notre priorité</em><br>absolue.</h1>
                <p>Une plateforme moderne pour gérer vos rendez-vous médicaux, suivre vos dossiers et communiquer avec vos médecins en toute sécurité.</p>

                <div class="stats">
                    <div class="stat-item">
                        <div class="stat-num">120+</div>
                        <div class="stat-label">Médecins</div>
                    </div>
                    <div class="divider-stat"></div>
                    <div class="stat-item">
                        <div class="stat-num">15k</div>
                        <div class="stat-label">Patients</div>
                    </div>
                    <div class="divider-stat"></div>
                    <div class="stat-item">
                        <div class="stat-num">98%</div>
                        <div class="stat-label">Satisfaction</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Testimonial -->
        <div class="testimonial">
            <p>"Grâce à MediCare, je gère mes rendez-vous en quelques clics. C'est simple, rapide et vraiment fiable."</p>
            <div class="testimonial-author">
                <div class="avatar">AK</div>
                <div class="author-info">
                    <div class="name">Aminata Kouyaté</div>
                    <div class="role">Patiente depuis 2023</div>
                </div>
            </div>
        </div>

    </div>

    <!-- ══ RIGHT PANEL ══ -->
    <div class="panel-right">
        <div class="login-box">

            <div class="login-header">
                <span class="tag">Espace sécurisé</span>
                <h2>Bon retour 👋</h2>
                <p>Connectez-vous pour accéder à votre espace personnel.</p>
            </div>

            {{-- Erreurs de validation --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    ⚠️ {{ $errors->first() }}
                </div>
            @endif

            {{-- Message de succès (ex: après logout) --}}
            @if (session('status'))
                <div class="alert alert-success">
                    ✓ {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email -->
                <div class="form-group">
                    <label for="email">Adresse email</label>
                    <div class="input-wrap">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                            <polyline points="22,6 12,13 2,6"/>
                        </svg>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="exemple@email.com"
                            autocomplete="email"
                            class="{{ $errors->has('email') ? 'is-invalid' : '' }}"
                            required
                        >
                    </div>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Mot de passe -->
                <div class="form-group">
                    <label for="password">Mot de passe</label>
                    <div class="input-wrap">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                            <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                        </svg>
                        <input
                            type="password"
                            id="password"
                            name="password"
                            placeholder="••••••••"
                            autocomplete="current-password"
                            class="{{ $errors->has('password') ? 'is-invalid' : '' }}"
                            required
                        >
                    </div>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Remember + Forgot -->
                <div class="form-footer">
                    <label class="remember">
                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                        <span>Se souvenir de moi</span>
                    </label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="forgot">Mot de passe oublié ?</a>
                    @endif
                </div>

                <!-- Bouton connexion -->
                <button type="submit" class="btn-login">
                    Se connecter →
                </button>

            </form>
            {{-- Séparateur --}}
<div style="display:flex; align-items:center; gap:1rem; margin: 1.25rem 0;">
    <div style="flex:1; height:1px; background:var(--border);"></div>
    <span style="color:var(--muted); font-size:0.8rem;">ou</span>
    <div style="flex:1; height:1px; background:var(--border);"></div>
</div>

{{-- Bouton Google --}}
<a href="{{ route('auth.google') }}" style="
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.75rem;
    width: 100%;
    padding: 0.85rem 1rem;
    border: 1.5px solid var(--border);
    border-radius: 12px;
    background: var(--white);
    color: var(--slate);
    font-family: 'DM Sans', sans-serif;
    font-size: 0.925rem;
    font-weight: 500;
    text-decoration: none;
    transition: border-color 0.2s, box-shadow 0.2s;
" onmouseover="this.style.borderColor='#4285f4'; this.style.boxShadow='0 0 0 3px rgba(66,133,244,0.15)'"
   onmouseout="this.style.borderColor='var(--border)'; this.style.boxShadow='none'">
    {{-- Logo Google SVG --}}
    <svg width="18" height="18" viewBox="0 0 48 48">
        <path fill="#EA4335" d="M24 9.5c3.54 0 6.71 1.22 9.21 3.6l6.85-6.85C35.9 2.38 30.47 0 24 0 14.62 0 6.51 5.38 2.56 13.22l7.98 6.19C12.43 13.72 17.74 9.5 24 9.5z"/>
        <path fill="#4285F4" d="M46.98 24.55c0-1.57-.15-3.09-.38-4.55H24v9.02h12.94c-.58 2.96-2.26 5.48-4.78 7.18l7.73 6c4.51-4.18 7.09-10.36 7.09-17.65z"/>
        <path fill="#FBBC05" d="M10.53 28.59c-.48-1.45-.76-2.99-.76-4.59s.27-3.14.76-4.59l-7.98-6.19C.92 16.46 0 20.12 0 24c0 3.88.92 7.54 2.56 10.78l7.97-6.19z"/>
        <path fill="#34A853" d="M24 48c6.48 0 11.93-2.13 15.89-5.81l-7.73-6c-2.18 1.48-4.97 2.31-8.16 2.31-6.26 0-11.57-4.22-13.47-9.91l-7.98 6.19C6.51 42.62 14.62 48 24 48z"/>
        <path fill="none" d="M0 0h48v48H0z"/>
    </svg>
    Continuer avec Google
</a>

            <!-- Rôles disponibles (informatif) -->
            <div class="roles">
                <div class="role-badge">
                    <div class="icon">👨‍⚕️</div>
                    <div class="name">Médecin</div>
                </div>
                <div class="role-badge">
                    <div class="icon">🧑‍💼</div>
                    <div class="name">Admin</div>
                </div>
                <div class="role-badge">
                    <div class="icon">🏥</div>
                    <div class="name">Patient</div>
                </div>
            </div>

        </div>
    </div>

</div>

</body>
</html>
