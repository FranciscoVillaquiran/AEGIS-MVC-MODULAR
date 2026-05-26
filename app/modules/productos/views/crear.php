<?php require_once ROOT_PATH . '/app/layouts/head.php'; ?>
<?php require_once ROOT_PATH . '/app/layouts/navbar.php'; ?>

<main style="max-width:860px;margin:30px auto;padding:0 20px;">
    <h1 style="margin-bottom:16px;">Publicar producto</h1>

    <?php if (!empty($_SESSION['error'])): ?>
        <div style="background:#FEE2E2;color:#991B1B;padding:10px 12px;border-radius:8px;margin-bottom:12px;">
            <?= htmlspecialchars($_SESSION['error']) ?>
        </div>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <form method="POST" action="<?= url('/productos/guardar') ?>" style="background:#fff;border-radius:12px;padding:20px;box-shadow:0 2px 8px rgba(0,0,0,.06);">
        <label>Título</label>
        <input type="text" name="titulo" required style="width:100%;padding:10px;margin:6px 0 12px;border:1px solid #D1D5DB;border-radius:8px;">

        <label>Categoría</label>
        <select name="categoria_id" required style="width:100%;padding:10px;margin:6px 0 12px;border:1px solid #D1D5DB;border-radius:8px;">
            <?php foreach (($categorias ?? []) as $categoria): ?>
                <option value="<?= (int) $categoria['id'] ?>"><?= htmlspecialchars($categoria['nombre']) ?></option>
            <?php endforeach; ?>
        </select>

        <label>Precio</label>
        <input type="number" name="precio" min="1" step="0.01" required style="width:100%;padding:10px;margin:6px 0 12px;border:1px solid #D1D5DB;border-radius:8px;">

        <label>Estado</label>
        <select name="estado" style="width:100%;padding:10px;margin:6px 0 12px;border:1px solid #D1D5DB;border-radius:8px;">
            <option value="nuevo">Nuevo</option>
            <option value="usado">Usado</option>
            <option value="reacondicionado">Reacondicionado</option>
        </select>

        <label>Ciudad</label>
        <input type="text" name="ciudad" value="Medellín" style="width:100%;padding:10px;margin:6px 0 12px;border:1px solid #D1D5DB;border-radius:8px;">

        <label>Descripción</label>
        <textarea name="descripcion" rows="5" style="width:100%;padding:10px;margin:6px 0 12px;border:1px solid #D1D5DB;border-radius:8px;"></textarea>

        <button type="submit" style="background:#2563EB;color:#fff;border:none;padding:10px 14px;border-radius:8px;">Publicar</button>
    </form>
</main>

<?php require_once ROOT_PATH . '/app/layouts/footer.php'; ?>
