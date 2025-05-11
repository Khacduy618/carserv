<?php
namespace App\Middleware;

use Core\Controller;

class AuthMiddleWare extends Controller
{
    public function handleAdminAuth()
    {
        if (!isset($_SESSION['user'])) {
            $_SESSION['redirect_url'] = $_SERVER['REQUEST_URI']; // Lưu URL hiện tại để redirect sau khi đăng nhập
            $_SESSION['flash_message'] = ['title' => 'Thông báo', 'type' => 'error', 'message' => 'Vui lòng đăng nhập để tiếp tục!'];
            // setcookie('msg1', 'Vui lòng đăng nhập để tiếp tục!', time() + 5, '/');
            header('Location: ' . _WEB_ROOT . '/dang-nhap');
            exit();
        }

    }

}
