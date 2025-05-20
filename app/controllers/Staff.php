<?php
namespace App\Controllers;
use Core\Controller;

use App\Middleware\AuthMiddleWare;

class Staff extends Controller
{
    public $data = [];
    private $staff_model;
    private $account_model;
    private $authMiddleware;

    public function __construct()
    {
        $this->authMiddleware = new AuthMiddleWare();
        $this->authMiddleware->handleAdminAuth();
        $this->staff_model = $this->model('StaffModel');
        $this->account_model = $this->model('AccountModel');
    }

    public function list_staff()
    {
        $search = isset($_GET['search']) ? $_GET['search'] : null;
        $sort = isset($_GET['sort']) ? $_GET['sort'] : 'FullName';
        $order = isset($_GET['order']) ? $_GET['order'] : 'ASC';
        $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
        $item_per_page = 10;

        $staffs = $this->staff_model->getStaffs($search, $sort, $order, $page, $item_per_page);
        $total_staffs = $this->staff_model->getTotalStaff($search);
        $total_pages = ceil($total_staffs / $item_per_page);

        $this->data['sub_content']['users'] = $staffs;
        $this->data['sub_content']['search'] = $search;
        $this->data['sub_content']['sort'] = $sort;
        $this->data['sub_content']['order'] = $order;
        $this->data['sub_content']['page'] = $page;
        $this->data['sub_content']['title'] = 'Quản lý nhân viên';
        $this->data['sub_content']['total_pages'] = $total_pages;
        $this->data['content'] = 'backend/user/list';
        $this->render('layouts/admin_layout', $this->data);
    }

    public function add()
    {
        $title = 'Thêm mới nhân viên';
        $this->data['sub_content']['title'] = $title;
        $this->data['page_title'] = $title;
        $this->data['content'] = 'backend/user/add';
        $this->render('layouts/admin_layout', $this->data);
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Validate required fields
            if (
                empty($_POST['username']) || empty($_POST['email']) ||
                empty($_POST['phone']) || empty($_POST['fullname'])
            ) {
                $_SESSION['flash_message'] = [
                    'title' => 'Cảnh báo!',
                    'img' => _WEB_ROOT . '/public/assets/img/medium_priority-48.png',
                    'type' => 'error',
                    'message' => 'Vui lòng điền đầy đủ thông tin!'
                ];
                header('Location: ' . _WEB_ROOT . '/add-staff');
                exit();
            }
            // Validate email format
            if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $_SESSION['flash_message'] = [
                    'title' => 'Cảnh báo!',
                    'img' => _WEB_ROOT . '/public/assets/img/medium_priority-48.png',
                    'type' => 'error',
                    'message' => 'Email không hợp lệ!'
                ];
                header('Location: ' . _WEB_ROOT . '/add-staff');
                exit();
            }

            // Check if email exists
            if ($this->account_model->check_account($_POST['email'])) {
                $_SESSION['flash_message'] = [
                    'title' => 'Cảnh báo!',
                    'img' => _WEB_ROOT . '/public/assets/img/medium_priority-48.png',
                    'type' => 'error',
                    'message' => 'Email đã tồn tại trong hệ thống!'
                ];
                header('Location: ' . _WEB_ROOT . '/add-staff');
                exit();
            }

            // Validate phone number
            $phone = $_POST['phone'];
            if (!preg_match('/^[0-9]{10,12}$/', $phone)) {
                $_SESSION['flash_message'] = [
                    'title' => 'Cảnh báo!',
                    'img' => _WEB_ROOT . '/public/assets/img/medium_priority-48.png',
                    'type' => 'error',
                    'message' => 'Số điện thoại phải từ 10-12 số!'
                ];
                header('Location: ' . _WEB_ROOT . '/add-staff');
                exit();
            }

            // Prepare data
            $data = array(
                'Username' => $_POST['username'],
                'FullName' => $_POST['fullname'],
                'Email' => $_POST['email'],
                'PhoneNumber' => $phone,
                'Role' => $_POST['role'],
                'Password' => password_hash('123456', PASSWORD_DEFAULT), // Default password
                'IsActive' => 1
            );

            // Store user
            if ($this->staff_model->store($data)) {
                $_SESSION['flash_message'] = [
                    'title' => 'Thêm mới!',
                    'img' => _WEB_ROOT . '/public/assets/img/ok-48.png',
                    'type' => 'success',
                    'message' => 'Thêm nhân viên mới thành công!'
                ];
                header('Location: ' . _WEB_ROOT . '/staff');
            } else {
                $_SESSION['flash_message'] = [
                    'title' => 'Thêm mới!',
                    'img' => _WEB_ROOT . '/public/assets/img/medium_priority-48.png',
                    'type' => 'error',
                    'message' => 'Thêm nhân viên mới thất bại!'
                ];
                header('Location: ' . _WEB_ROOT . '/add-staff');
            }
            exit();
        }
    }

    public function edit($id = 0)
    {
        $title = 'Cập nhật thông tin nhân viên';
        $this->data['sub_content']['title'] = $title;
        $this->data['page_title'] = $title;
        $this->data['sub_content']['user'] = $this->staff_model->findbyId($id);
        $this->data['content'] = 'backend/user/edit';
        $this->render('layouts/admin_layout', $this->data);
    }

    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Validate required fields
            if (
                empty($_POST['username']) || empty($_POST['email']) ||
                empty($_POST['phone']) ||
                empty($_POST['fullname'])
            ) {
                $_SESSION['flash_message'] = [
                    'title' => 'Cảnh báo!',
                    'img' => _WEB_ROOT . '/public/assets/img/medium_priority-48.png',
                    'type' => 'error',
                    'message' => 'Vui lòng điền đầy đủ thông tin!'
                ];
                header('Location: ' . _WEB_ROOT . '/edit-staff' . '/' . $_POST['id']);
                exit();
            }

            // Validate email format
            if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $_SESSION['flash_message'] = [
                    'title' => 'Cảnh báo!',
                    'img' => _WEB_ROOT . '/public/assets/img/medium_priority-48.png',
                    'type' => 'error',
                    'message' => 'Email không hợp lệ!'
                ];
                header('Location: ' . _WEB_ROOT . '/edit-staff' . '/' . $_POST['id']);
                exit();
            }

            // Validate phone number
            $phone = $_POST['phone'];
            if (!preg_match('/^[0-9]{10,12}$/', $phone)) {
                $_SESSION['flash_message'] = [
                    'title' => 'Cảnh báo!',
                    'img' => _WEB_ROOT . '/public/assets/img/medium_priority-48.png',
                    'type' => 'error',
                    'message' => 'Số điện thoại phải từ 10-12 số!'
                ];
                header('Location: ' . _WEB_ROOT . '/edit-staff' . '/' . $_POST['id']);
                exit();
            }

            // Prepare data
            $data = array(
                'Username' => $_POST['username'],
                'FullName' => $_POST['fullname'],
                'Email' => $_POST['email'],
                'PhoneNumber' => $phone,
                'Role' => $_POST['role']
            );

            // Update user
            if ($this->staff_model->update($data, $_POST['id'])) {
                $_SESSION['flash_message'] = [
                    'title' => 'Cập nhật!',
                    'img' => _WEB_ROOT . '/public/assets/img/ok-48.png',
                    'type' => 'success',
                    'message' => 'Cập nhật thông tin nhân viên thành công!'
                ];
                header('Location: ' . _WEB_ROOT . '/staff');
            } else {
                $_SESSION['flash_message'] = [
                    'title' => 'Cập nhật!',
                    'img' => _WEB_ROOT . '/public/assets/img/medium_priority-48.png',
                    'type' => 'error',
                    'message' => 'Cập nhật thông tin nhân viên thất bại!'
                ];
                header('Location: ' . _WEB_ROOT . '/staff/edit/' . $_POST['id']);
            }
            exit();
        }
    }

    public function delete($id = 0)
    {
        $data = array(
            'IsActive' => 0
        );
        if ($this->staff_model->update($data, $id)) {
            $_SESSION['flash_message'] = [
                'title' => 'Thêm vào thùng rác!',
                'img' => _WEB_ROOT . '/public/assets/img/ok-48.png',
                'type' => 'success',
                'message' => 'Thêm nhân viên vào thùng rác thành công!'
            ];
            header('Location: ' . _WEB_ROOT . '/staff');
        } else {
            $_SESSION['flash_message'] = [
                'title' => 'Thêm vào thùng rác!',
                'img' => _WEB_ROOT . '/public/assets/img/medium_priority-48.png',
                'type' => 'error',
                'message' => 'Thêm nhân viên vào thùng rác thất bại!'
            ];
            header('Location: ' . _WEB_ROOT . '/staff');
        }
        exit();
    }
}
