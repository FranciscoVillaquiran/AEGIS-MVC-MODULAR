<?php

class Producto extends Model
{
    public function findById(int $id): ?array
    {
        return $this->fetch(
            'SELECT p.*, c.nombre AS categoria_nombre, u.nombre AS vendedor_nombre, u.id AS vendedor_id
             FROM productos p
             JOIN categorias c ON p.categoria_id = c.id
             JOIN usuarios u ON p.usuario_id = u.id
             WHERE p.id = ?',
            [$id]
        ) ?: null;
    }

    public function findByCategoria(string $categoria): array
    {
        return $this->fetchAll(
            "SELECT p.*, c.nombre AS categoria_nombre
             FROM productos p
             JOIN categorias c ON p.categoria_id = c.id
             WHERE c.nombre LIKE ? AND p.estado_publicacion = 'activo'
             ORDER BY p.fecha_publicacion DESC",
            ['%' . $categoria . '%']
        );
    }

    public function getRecientes(int $limit = 12): array
    {
        return $this->fetchAll(
            "SELECT p.*, c.nombre AS categoria_nombre
             FROM productos p
             JOIN categorias c ON p.categoria_id = c.id
             WHERE p.estado_publicacion = 'activo'
             ORDER BY p.fecha_publicacion DESC
             LIMIT {$limit}"
        );
    }

    public function create(array $data): int
    {
        $sql = 'INSERT INTO productos
                (usuario_id, categoria_id, titulo, descripcion, precio, estado_producto, ciudad, estado_publicacion)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)';

        $this->query($sql, [
            $data['usuario_id'],
            $data['categoria_id'],
            $data['titulo'],
            $data['descripcion'],
            $data['precio'],
            $data['estado_producto'],
            $data['ciudad'],
            $data['estado_publicacion'] ?? 'activo',
        ]);

        return (int) $this->db->lastInsertId();
    }

    public function update(int $id, array $data): bool
    {
        $sql = 'UPDATE productos
                SET titulo = ?, descripcion = ?, precio = ?, estado_producto = ?, ciudad = ?, estado_publicacion = ?
                WHERE id = ?';

        return (bool) $this->query($sql, [
            $data['titulo'],
            $data['descripcion'],
            $data['precio'],
            $data['estado_producto'],
            $data['ciudad'],
            $data['estado_publicacion'] ?? 'activo',
            $id,
        ]);
    }

    public function delete(int $id): bool
    {
        return (bool) $this->query('DELETE FROM productos WHERE id = ?', [$id]);
    }

    public function findByUsuario(int $usuarioId): array
    {
        return $this->fetchAll(
            "SELECT p.*, c.nombre AS categoria_nombre
             FROM productos p
             JOIN categorias c ON p.categoria_id = c.id
             WHERE p.usuario_id = ?
             ORDER BY p.fecha_publicacion DESC",
            [$usuarioId]
        );
    }

    public function countActivos(): int
    {
        $row = $this->fetch(
            "SELECT COUNT(*) AS total FROM productos WHERE estado_publicacion = 'activo'"
        );

        return (int) ($row['total'] ?? 0);
    }
}
