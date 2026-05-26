<?php require_once ROOT_PATH . '/app/layouts/head.php'; ?>
<?php require_once ROOT_PATH . '/app/layouts/navbar.php'; ?>

<main style="max-width:1200px;margin:30px auto;padding:0 20px;">
    <section style="background:linear-gradient(135deg,#1E3A8A,#2563EB);color:#fff;padding:28px;border-radius:16px;margin-bottom:24px;">
        <h1 style="margin:0 0 6px;">Bienvenido a AEGIS</h1>
        <p style="margin:0;opacity:.9;">Compra y vende tecnología de forma segura con encuentros verificados.</p>
    </section>

    <?php if (!empty($_SESSION['success'])): ?>
        <div style="background:#DCFCE7;color:#166534;padding:10px 12px;border-radius:8px;margin-bottom:16px;">
            <?= htmlspecialchars($_SESSION['success']) ?>
        </div>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>

    <section>
        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:14px;">
            <h2 style="margin:0;">Productos recientes</h2>
            <a href="<?= url('/productos') ?>" style="color:#2563EB;font-weight:600;">Ver todos</a>
        </div>

        <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(240px,1fr));gap:16px;">
            <?php foreach (($productos ?? []) as $producto): ?>
                <article style="background:#fff;border-radius:12px;box-shadow:0 2px 10px rgba(0,0,0,.06);padding:14px;">
                    <h3 style="margin:0 0 6px;font-size:16px;"><?= htmlspecialchars($producto['titulo']) ?></h3>
                    <p style="margin:0 0 10px;color:#6B7280;font-size:14px;"><?= htmlspecialchars($producto['categoria_nombre'] ?? 'Sin categoría') ?></p>
                    <strong style="display:block;margin-bottom:10px;color:#111827;">$<?= number_format((float) $producto['precio'], 0, ',', '.') ?></strong>
                    <a href="<?= url('/productos/detalle?id=' . (int) $producto['id']) ?>" style="display:inline-block;background:#2563EB;color:#fff;padding:8px 12px;border-radius:8px;">Ver detalle</a>
                </article>
            <?php endforeach; ?>
        </div>
    </section>
</main>

<?php require_once ROOT_PATH . '/app/layouts/footer.php'; ?>