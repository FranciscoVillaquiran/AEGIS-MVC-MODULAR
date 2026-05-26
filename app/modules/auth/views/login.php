<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AEGIS - Iniciar Sesión</title>
    <link rel="stylesheet" href="/AEGIS/public/assets/css/pages/login.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="left-panel">
            <div class="security-wrapper">
                <h1>Acceso Seguro</h1>
                <p>Tu cuenta está protegida por múltiples capas de seguridad.</p>
            </div>
        </div>

        <div class="right-panel">
            <div class="form-container">
                <a href="<?= url('/home') ?>" class="back-home">← Volver al inicio</a>
                <h2>Bienvenido de nuevo</h2>

                <?php if (!empty($_SESSION['error'])): ?>
                    <div style="background:#FEE2E2;color:#991B1B;padding:10px 12px;border-radius:8px;margin-bottom:12px;">
                        <?= htmlspecialchars($_SESSION['error']) ?>
                    </div>
                    <?php unset($_SESSION['error']); ?>
                <?php endif; ?>

                <?php if (!empty($_SESSION['success'])): ?>
                    <div style="background:#DCFCE7;color:#166534;padding:10px 12px;border-radius:8px;margin-bottom:12px;">
                        <?= htmlspecialchars($_SESSION['success']) ?>
                    </div>
                    <?php unset($_SESSION['success']); ?>
                <?php endif; ?>

                <form method="POST" action="<?= url('/login') ?>">
                    <div class="input-group">
                        <label for="email">Correo electrónico</label>
                        <input type="email" id="email" name="email" required placeholder="correo@aegis.com">
                    </div>

                    <div class="input-group">
                        <label for="password">Contraseña</label>
                        <input type="password" id="password" name="password" required minlength="6" placeholder="******">
                    </div>

                    <button type="submit" class="login-btn">Iniciar sesión</button>
                </form>

                <p style="margin-top:16px;color:#6B7280;">
                    ¿No tienes cuenta?
                    <a href="<?= url('/register') ?>" style="color:#2563EB;font-weight:600;">Regístrate</a>
                </p>
            </div>
        </div>
    </div>
</body>
</html>