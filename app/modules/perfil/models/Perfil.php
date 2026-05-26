<?php

class Perfil extends Model
{
    public function findByUsuarioId(int $usuarioId): ?array
    {
        return $this->fetch(
            'SELECT * FROM usuarios WHERE id = ?',
            [$usuarioId]
        ) ?: null;
    }

    public function update(int $usuarioId, array $data): bool
    {
        $sql = 'UPDATE usuarios SET descripcion = ?, ciudad = ?, telefono = ? WHERE id = ?';

        return (bool) $this->query($sql, [
            $data['descripcion'] ?? '',
            $data['ciudad'] ?? '',
            $data['telefono'] ?? '',
            $usuarioId,
        ]);
    }

    public function getPublicaciones(int $usuarioId, int $limit = 10): array
    {
        return $this->fetchAll(
            'SELECT * FROM publicaciones_foro
             WHERE usuario_id = ?
             ORDER BY fecha_publicacion DESC
             LIMIT ' . (int) $limit,
            [$usuarioId]
        );
    }
}
