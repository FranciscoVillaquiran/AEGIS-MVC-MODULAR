<?php

class Publicacion extends Model
{
    public function findById(int $id): ?array
    {
        return $this->fetch(
            'SELECT p.*, u.nombre, u.foto_perfil, u.username
             FROM publicaciones_foro p
             JOIN usuarios u ON p.usuario_id = u.id
             WHERE p.id = ?',
            [$id]
        ) ?: null;
    }

    public function create(array $data): int
    {
        $sql = 'INSERT INTO publicaciones_foro (usuario_id, titulo, contenido)
                VALUES (?, ?, ?)';

        $this->query($sql, [
            $data['usuario_id'],
            $data['titulo'],
            $data['contenido'],
        ]);

        return (int) $this->db->lastInsertId();
    }

    public function getAllWithAuthor(): array
    {
        return $this->fetchAll(
            'SELECT p.*, u.nombre, u.username, u.foto_perfil
             FROM publicaciones_foro p
             JOIN usuarios u ON p.usuario_id = u.id
             ORDER BY p.fecha_publicacion DESC'
        );
    }
}
