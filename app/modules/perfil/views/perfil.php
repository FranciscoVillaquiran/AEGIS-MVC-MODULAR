<?php require_once ROOT_PATH . '/app/layouts/head.php'; ?>
<?php require_once ROOT_PATH . '/app/layouts/navbar.php'; ?>

<main style="max-width:1100px;margin:30px auto;padding:0 20px;">
    <section style="background:#fff;border-radius:12px;padding:16px;margin-bottom:14px;">
        <h1 style="margin:0;"><?= htmlspecialchars(($usuario['nombre'] ?? '') . ' ' . ($usuario['apellido'] ?? '')) ?></h1>
        <p style="margin:6px 0;color:#6B7280;"><?= htmlspecialchars($usuario['email'] ?? '') ?></p>
        <p style="margin:6px 0;"><?= htmlspecialchars($usuario['descripcion'] ?? 'Sin descripción') ?></p>
        <p style="margin:6px 0;"><strong>Ciudad:</strong> <?= htmlspecialchars($usuario['ciudad'] ?? 'No definida') ?></p>
        <?php if (!empty($esPropio)): ?>
            <a href="<?= url('/perfil/editar') ?>" style="display:inline-block;background:#2563EB;color:#fff;padding:8px 12px;border-radius:8px;">Editar perfil</a>
        <?php endif; ?>
    </section>

    <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
        <section style="background:#fff;border-radius:12px;padding:16px;">
            <h2 style="margin-top:0;">Publicaciones</h2>
            <?php foreach (($publicaciones ?? []) as $pub): ?>
                <article style="border-top:1px solid #E5E7EB;padding-top:8px;margin-top:8px;">
                    <h4 style="margin:0 0 4px;"><?= htmlspecialchars($pub['titulo']) ?></h4>
                    <p style="margin:0;color:#6B7280;font-size:14px;"><?= htmlspecialchars($pub['fecha_publicacion']) ?></p>
                </article>
            <?php endforeach; ?>
        </section>

        <section style="background:#fff;border-radius:12px;padding:16px;">
            <h2 style="margin-top:0;">Productos</h2>
            <?php foreach (($productos ?? []) as $producto): ?>
                <article style="border-top:1px solid #E5E7EB;padding-top:8px;margin-top:8px;">
                    <h4 style="margin:0 0 4px;"><?= htmlspecialchars($producto['titulo']) ?></h4>
                    <p style="margin:0;">$<?= number_format((float) $producto['precio'], 0, ',', '.') ?></p>
                </article>
            <?php endforeach; ?>
        </section>
    </div>
</main>

<?php require_once ROOT_PATH . '/app/layouts/footer.php'; ?>