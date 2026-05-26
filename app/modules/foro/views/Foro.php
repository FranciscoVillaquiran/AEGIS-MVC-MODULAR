<?php require_once ROOT_PATH . '/app/layouts/head.php'; ?>
<?php require_once ROOT_PATH . '/app/layouts/navbar.php'; ?>

<main style="max-width:1000px;margin:30px auto;padding:0 20px;">
    <h1>Foro AEGIS</h1>

    <?php if (Auth::check()): ?>
        <form method="POST" action="<?= url('/foro/publicar') ?>" style="background:#fff;padding:14px;border-radius:10px;margin-bottom:16px;">
            <input type="text" name="titulo" placeholder="Título de la publicación" required style="width:100%;padding:10px;margin-bottom:8px;border:1px solid #D1D5DB;border-radius:8px;">
            <textarea name="contenido" rows="4" placeholder="Comparte tu duda o experiencia..." required style="width:100%;padding:10px;border:1px solid #D1D5DB;border-radius:8px;margin-bottom:8px;"></textarea>
            <button type="submit" style="background:#2563EB;color:#fff;border:none;padding:9px 12px;border-radius:8px;">Publicar</button>
        </form>
    <?php endif; ?>

    <?php foreach (($publicaciones ?? []) as $post): ?>
        <article style="background:#fff;padding:14px;border-radius:10px;margin-bottom:14px;">
            <h3 style="margin:0 0 6px;"><?= htmlspecialchars($post['titulo']) ?></h3>
            <p style="margin:0 0 8px;color:#6B7280;font-size:14px;">
                Por <?= htmlspecialchars($post['nombre']) ?> · <?= htmlspecialchars($post['fecha_publicacion']) ?>
            </p>
            <p style="margin:0 0 12px;"><?= nl2br(htmlspecialchars($post['contenido'])) ?></p>

            <?php if (Auth::check()): ?>
                <form method="POST" action="<?= url('/foro/comentar') ?>" style="margin-bottom:8px;">
                    <input type="hidden" name="publicacion_id" value="<?= (int) $post['id'] ?>">
                    <input type="text" name="comentario" required placeholder="Escribe un comentario..." style="width:100%;padding:8px;border:1px solid #D1D5DB;border-radius:8px;">
                </form>
            <?php endif; ?>

            <?php foreach (($comentarios[$post['id']] ?? []) as $comentario): ?>
                <div style="border-top:1px solid #E5E7EB;padding-top:8px;margin-top:8px;">
                    <strong style="font-size:14px;"><?= htmlspecialchars($comentario['nombre']) ?>:</strong>
                    <span style="font-size:14px;"><?= htmlspecialchars($comentario['comentario']) ?></span>
                </div>
            <?php endforeach; ?>
        </article>
    <?php endforeach; ?>
</main>

<?php require_once ROOT_PATH . '/app/layouts/footer.php'; ?>