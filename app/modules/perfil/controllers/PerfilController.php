<?php

class PerfilController extends Controller
{
    private $perfilModel;
    private $productoModel;

    public function __construct()
    {
        $this->perfilModel = $this->loadModel('perfil', 'Perfil');
        $this->productoModel = $this->loadModel('productos', 'Producto');
    }

    public function index(): void
    {
        $this->requireAuth();

        $usuario = $this->perfilModel->findByUsuarioId(Auth::id());
        $publicaciones = $this->perfilModel->getPublicaciones(Auth::id());
        $productos = $this->productoModel->findByUsuario(Auth::id());

        $this->render(ROOT_PATH . '/app/modules/perfil/views/perfil.php', [
            'usuario'       => $usuario,
            'publicaciones' => $publicaciones,
            'productos'     => $productos,
            'esPropio'      => true,
        ]);
    }

    public function ver(): void
    {
        $id = (int) ($_GET['id'] ?? 0);

        if ($id <= 0) {
            $this->redirect('/home');
        }

        $usuario = $this->perfilModel->findByUsuarioId($id);

        if (!$usuario) {
            $this->notFound();
        }

        $publicaciones = $this->perfilModel->getPublicaciones($id);
        $productos = $this->productoModel->findByUsuario($id);

        $this->render(ROOT_PATH . '/app/modules/perfil/views/perfil.php', [
            'usuario'       => $usuario,
            'publicaciones' => $publicaciones,
            'productos'     => $productos,
            'esPropio'      => Auth::check() && Auth::id() === $id,
        ]);
    }

    public function editar(): void
    {
        $this->requireAuth();

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $usuario = $this->perfilModel->findByUsuarioId(Auth::id());

            $this->render(ROOT_PATH . '/app/modules/perfil/views/editar.php', [
                'usuario' => $usuario,
            ]);
            return;
        }

        $this->perfilModel->update(Auth::id(), [
            'descripcion' => trim($_POST['descripcion'] ?? ''),
            'ciudad'      => trim($_POST['ciudad'] ?? ''),
            'telefono'    => trim($_POST['telefono'] ?? ''),
        ]);

        $updated = $this->perfilModel->findByUsuarioId(Auth::id());
        Auth::login($updated);

        $_SESSION['success'] = 'Perfil actualizado';
        $this->redirect('/perfil');
    }
}
