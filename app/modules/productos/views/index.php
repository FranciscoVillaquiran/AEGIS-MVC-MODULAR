<?php require_once ROOT_PATH . '/app/layouts/head.php'; ?>
<?php require_once ROOT_PATH . '/app/layouts/navbar.php'; ?>

<main style="max-width:1200px;margin:30px auto;padding:0 20px;">
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:20px;">
        <h1 style="margin:0;">Productos <?= $categoria ? ' - ' . htmlspecialchars($categoria) : '' ?></h1>
        <?php if (Auth::check()): ?>
            <a href="<?= url('/productos/crear') ?>" style="background:#2563EB;color:#fff;padding:10px 14px;border-radius:8px;">Publicar producto</a>
        <?php endif; ?>
    </div>

    <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(240px,1fr));gap:16px;">
        <?php foreach (($productos ?? []) as $producto): ?>
            <article style="background:#fff;border-radius:12px;padding:14px;box-shadow:0 2px 8px rgba(0,0,0,.06);">
                <h3 style="margin:0 0 6px;font-size:16px;"><?= htmlspecialchars($producto['titulo']) ?></h3>
                <p style="margin:0 0 6px;color:#6B7280;font-size:14px;"><?= htmlspecialchars($producto['categoria_nombre'] ?? 'Categoría') ?></p>
                <strong style="display:block;margin-bottom:10px;">$<?= number_format((float) $producto['precio'], 0, ',', '.') ?></strong>
                <a href="<?= url('/productos/detalle?id=' . (int) $producto['id']) ?>" style="display:inline-block;background:#F3F4F6;padding:8px 12px;border-radius:8px;">Ver detalle</a>
            </article>
        <?php endforeach; ?>
    </div>
</main>

<?php require_once ROOT_PATH . '/app/layouts/footer.php'; ?>
