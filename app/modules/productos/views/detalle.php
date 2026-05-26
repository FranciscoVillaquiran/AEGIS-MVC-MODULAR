<?php require_once ROOT_PATH . '/app/layouts/head.php'; ?>
<?php require_once ROOT_PATH . '/app/layouts/navbar.php'; ?>

<main style="max-width:1000px;margin:30px auto;padding:0 20px;">
    <a href="<?= url('/productos') ?>" style="display:inline-block;margin-bottom:14px;color:#2563EB;">← Volver</a>

    <div style="display:grid;grid-template-columns:2fr 1fr;gap:16px;">
        <section style="background:#fff;border-radius:12px;padding:16px;">
            <h1 style="margin-top:0;"><?= htmlspecialchars($producto['titulo']) ?></h1>
            <p><?= nl2br(htmlspecialchars($producto['descripcion'])) ?></p>
            <p><strong>Categoría:</strong> <?= htmlspecialchars($producto['categoria_nombre'] ?? 'Sin categoría') ?></p>
            <p><strong>Ciudad:</strong> <?= htmlspecialchars($producto['ciudad']) ?></p>
            <p><strong>Vendedor:</strong> <?= htmlspecialchars($producto['vendedor_nombre'] ?? 'Usuario') ?></p>
        </section>

        <aside style="background:#fff;border-radius:12px;padding:16px;">
            <div style="font-size:28px;font-weight:800;margin-bottom:12px;">$<?= number_format((float) $producto['precio'], 0, ',', '.') ?></div>

            <?php if (Auth::check() && Auth::id() !== (int) $producto['usuario_id']): ?>
                <h3 style="margin:0 0 10px;">Solicitar encuentro</h3>
                <form method="POST" action="<?= url('/productos/encuentro') ?>">
                    <input type="hidden" name="producto_id" value="<?= (int) $producto['id'] ?>">

                    <label>Punto físico</label>
                    <select name="punto_fisico_id" required style="width:100%;padding:8px;margin:6px 0 10px;border:1px solid #D1D5DB;border-radius:8px;">
                        <option value="">Selecciona</option>
                        <?php foreach (($puntos ?? []) as $punto): ?>
                            <option value="<?= (int) $punto['id'] ?>"><?= htmlspecialchars($punto['nombre']) ?> - <?= htmlspecialchars($punto['ciudad']) ?></option>
                        <?php endforeach; ?>
                    </select>

                    <label>Fecha</label>
                    <input type="date" name="fecha_encuentro" required style="width:100%;padding:8px;margin:6px 0 10px;border:1px solid #D1D5DB;border-radius:8px;">

                    <label>Hora</label>
                    <input type="time" name="hora_encuentro" required style="width:100%;padding:8px;margin:6px 0 12px;border:1px solid #D1D5DB;border-radius:8px;">

                    <button type="submit" style="width:100%;background:#2563EB;color:#fff;border:none;padding:10px;border-radius:8px;">Solicitar</button>
                </form>
            <?php endif; ?>
        </aside>
    </div>
</main>

<?php require_once ROOT_PATH . '/app/layouts/footer.php'; ?>
