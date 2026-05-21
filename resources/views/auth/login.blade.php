<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lu Vendas | Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <link
        href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=Lora:ital,wght@0,400;0,600;1,400&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>

<body>

    <div class="bg-dots"></div>

    <div class="bg-orbs">
        <div class="orb orb-1"></div>
        <div class="orb orb-2"></div>
        <div class="orb orb-3"></div>
    </div>

    <div class="card-login" id="login-card">

        <div class="card-glow"></div>

        <div class="login-top">

            <div class="login-icon-wrap">
                <i class="bi bi-flower2"></i>
            </div>

            <h1>Lu Vendas</h1>

            <p>Entre para acessar o sistema</p>

        </div>

        @if($errors->any())
            <div class="login-error">
                <i class="bi bi-exclamation-circle-fill"></i>
                E-mail ou senha incorretos. Tente novamente.
            </div>
        @endif

        <form action="/login" method="POST" id="login-form">

            @csrf

            {{-- LOGIN (EMAIL OU CELULAR) --}}
            <div class="field floating">

                <div class="field-wrap">

                    <i class="bi bi-person f-icon"></i>

                    <input type="text" id="login" name="login" placeholder=" " value="{{ old('login') }}" required
                        autofocus>

                    <label for="login">E-mail ou Celular</label>

                </div>

            </div>

            {{-- SENHA --}}
            <div class="field floating">

                <div class="field-wrap has-toggle">

                    <i class="bi bi-lock f-icon"></i>

                    <input type="password" id="password" name="password" placeholder=" " required>

                    <label for="password">Senha</label>

                    <button type="button" class="toggle-pw" id="toggle-pw" tabindex="-1" aria-label="Mostrar senha">
                        <i class="bi bi-eye" id="toggle-icon"></i>
                    </button>

                </div>

            </div>

            {{-- BOTÃO --}}
            <button type="submit" class="btn-entrar" id="btn-entrar">

                <i class="bi bi-box-arrow-in-right btn-icon"></i>

                <span class="btn-text">Entrar</span>

                <div class="spinner"></div>

            </button>

        </form>

        <div class="login-footer">
            <i class="bi bi-shield-check"></i>
            Acesso protegido e seguro
        </div>

    </div>

    <script>

        // ── TOGGLE SENHA ─────────────────────────────

        const toggleBtn = document.getElementById('toggle-pw');
        const toggleIcon = document.getElementById('toggle-icon');
        const pwInput = document.getElementById('password');

        toggleBtn.addEventListener('click', () => {

            const visivel = pwInput.type === 'text';

            pwInput.type = visivel ? 'password' : 'text';

            toggleIcon.className =
                visivel ? 'bi bi-eye' : 'bi bi-eye-slash';
        });

        // ── LOADING BUTTON ───────────────────────────

        document
            .getElementById('login-form')
            .addEventListener('submit', () => {

                document
                    .getElementById('btn-entrar')
                    .classList.add('loading');

            });

        // ── CARD INTERATIVO ──────────────────────────

        const card = document.getElementById('login-card');

        card.addEventListener('mousemove', (e) => {

            const rect = card.getBoundingClientRect();

            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;

            card.style.setProperty('--x', `${x}px`);
            card.style.setProperty('--y', `${y}px`);

            const rotateY = ((x / rect.width) - 0.5) * 6;
            const rotateX = ((y / rect.height) - 0.5) * -6;

            card.style.transform =
                `
                perspective(1000px)
                rotateX(${rotateX}deg)
                rotateY(${rotateY}deg)
                translateY(-2px)
                `;

        });

        card.addEventListener('mouseleave', () => {

            card.style.transform =
                'perspective(1000px) rotateX(0) rotateY(0)';

        });

    </script>

</body>

</html>