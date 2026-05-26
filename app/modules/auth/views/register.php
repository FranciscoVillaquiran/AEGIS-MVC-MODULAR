<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AEGIS - Registro</title>
    <link rel="stylesheet" href="/AEGIS/public/assets/css/pages/register.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="left-panel">
            <div class="left-content">
                <h1>Únete al mercado de tecnología segura</h1>
                <p>Publica, compra y concreta encuentros verificados en puntos físicos confiables.</p>
            </div>
        </div>

        <div class="right-panel">
            <div class="form-container">
                <h2>Crea tu cuenta</h2>

                <?php if (!empty($_SESSION['error'])): ?>
                    <div style="background:#FEE2E2;color:#991B1B;padding:10px 12px;border-radius:8px;margin-bottom:12px;">
                        <?= htmlspecialchars($_SESSION['error']) ?>
                    </div>
                    <?php unset($_SESSION['error']); ?>
                <?php endif; ?>

                <form method="POST" action="<?= url('/register') ?>">
                    <div class="input-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" id="nombre" name="nombre" required placeholder="Pepito">
                    </div>

                    <div class="input-group">
                        <label for="apellido">Apellido</label>
                        <input type="text" id="apellido" name="apellido" placeholder="Pérez">
                    </div>

                    <div class="input-group">
                        <label for="email">Correo electrónico</label>
                        <input type="email" id="email" name="email" required placeholder="correo@aegis.com">
                    </div>

                    <div class="input-group">
                        <label for="password">Contraseña</label>
                        <input type="password" id="password" name="password" required minlength="6">
                    </div>

                    <div class="input-group">
                        <label for="password_confirm">Confirmar contraseña</label>
                        <input type="password" id="password_confirm" name="password_confirm" required minlength="6">
                    </div>

                    <button type="submit" class="login-btn">
                        Crear cuenta
                    </button>
                </form>

                <p style="margin-top:16px;color:#6B7280;">
                    ¿Ya tienes cuenta?
                    <a href="<?= url('/login') ?>" style="color:#2563EB;font-weight:600;">Iniciar sesión</a>
                </p>
            </div>
        </div>
    </div>
</body>
</html>