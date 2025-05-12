<?php
namespace App\Controllers;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use Core\Controller;

class Account extends Controller
{
    public $data = [];
    public $account_model;

    public function __construct()
    {
        $this->account_model = $this->model('AccountModel');
    }

    function login()
    {
        if (!isset($_SESSION['user'])) {
            $title = 'Login';
            $this->data['sub_content']['title'] = $title;
            $this->data['page_title'] = $title;
            $this->data['content'] = 'backend/login/login';
            $this->render('layouts/admin_layout', $this->data);
        } else {
            header('Location: ' . _WEB_ROOT . '/admin');
            exit();
        }
    }

    function login_action()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $Username = $_POST['Username'];
            $Password = $_POST['Password'];

            if (empty($Username)) {
                $_SESSION['flash_message'] = [
                    'title' => 'Cảnh báo!',
                    'img' => _WEB_ROOT . '/public/assets/img/medium_priority-48.png',
                    'type' => 'error',
                    'message' => 'Tên đăng nhập không được để trống!'
                ];
                // setcookie('msg1', 'Tên đăng nhập không được để trống', time() + 5, '/');
                header('Location: ' . _WEB_ROOT . '/dang-nhap');
                exit();
            }

            if (strlen($Password) < 8) {
                $_SESSION['flash_message'] = ['title' => 'Cảnh báo!', 'img' => _WEB_ROOT . '/public/assets/img/medium_priority-48.png', 'type' => 'error', 'message' => 'Mật khẩu tối thiểu 8 kí tự!'];
                // setcookie('msg1', 'Mật khẩu tối thiểu 8 kí tự', time() + 5, '/');
                header('Location: ' . _WEB_ROOT . '/dang-nhap');
                exit();
            }

            if (!$this->account_model->check_account($Username)) {
                $_SESSION['flash_message'] = ['title' => 'Cảnh báo!', 'img' => _WEB_ROOT . '/public/assets/img/medium_priority-48.png', 'type' => 'error', 'message' => 'Tên đăng nhập không chính xác!'];
                header('Location: ' . _WEB_ROOT . '/dang-nhap');
                exit();
            }

            $user = $this->account_model->get_user_by_username($Username);

            if ($user && password_verify($Password, $user['Password'])) {
                $_SESSION['user'] = $user;
                if ($_SESSION['user']['Role'] == 'Admin' || $_SESSION['user']['Role'] == 'Staff') {
                    $_SESSION['flash_message'] = ['title' => 'Kính chào!', 'img' => _WEB_ROOT . '/public/assets/img/ok-48.png', 'type' => 'success', 'message' => 'Chào mừng ' . $_SESSION['user']['FullName'] . '!'];

                    // setcookie('msg', 'Đăng nhập admin thành công', time() + 5, '/');
                    header('Location: ' . _WEB_ROOT . '/admin');
                }
            } else {
                $_SESSION['flash_message'] = ['title' => 'Cảnh báo!', 'img' => _WEB_ROOT . '/public/assets/img/medium_priority-48.png', 'type' => 'error', 'message' => 'Tên đăng nhập hoặc mật khẩu không chính xác!'];
                header('Location: ' . _WEB_ROOT . '/dang-nhap');
            }
            exit();
        }
    }

    function register_action()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $Email = filter_var($_POST['Email'], FILTER_SANITIZE_Email);
            $Username = trim($_POST['Username']);
            $Password = $_POST['Password'];
            $FullName = $_POST['FullName'];
            $Phone = $_POST['Phone'];
            $Role = $_POST['Role'];
            $check_Password = $_POST['check_Password'];


            if (!filter_var($Email, FILTER_VALIDATE_Email)) {
                $_SESSION['flash_message'] = ['title' => 'Cảnh báo!', 'img' => _WEB_ROOT . '/public/assets/img/medium_priority-48.png', 'type' => 'error', 'message' => 'Email không hợp lệ!'];
                // setcookie('msg1', 'Email không hợp lệ', time() + 5, '/');
                header('Location: ' . _WEB_ROOT . '/dang-nhap');
                exit();
            }

            if ($this->account_model->check_account($Username)) {
                $_SESSION['flash_message'] = ['title' => 'Cảnh báo!', 'img' => _WEB_ROOT . '/public/assets/img/medium_priority-48.png', 'type' => 'error', 'message' => 'Tên đăng nhập đã tài khoản sử dụng!'];
                // setcookie('msg1', 'Tên đăng nhập đã tài khoản sử dụng!', time() + 5, '/');
                header('Location: ' . _WEB_ROOT . '/dang-nhap');
                exit();
            }

            if (strlen($FullName) < 2 || strlen($FullName) > 50) {
                $_SESSION['flash_message'] = ['title' => 'Cảnh báo!', 'img' => _WEB_ROOT . '/public/assets/img/medium_priority-48.png', 'type' => 'error', 'message' => 'Tên phải từ 2 đến 50 ký tự!'];
                // setcookie('msg1', 'Tên phải từ 2 đến 50 ký tự', time() + 5, '/');
                header('Location: ' . _WEB_ROOT . '/dang-nhap');
                exit();
            }

            if (strlen($Password) < 8) {
                $_SESSION['flash_message'] = ['title' => 'Cảnh báo!', 'img' => _WEB_ROOT . '/public/assets/img/medium_priority-48.png', 'type' => 'error', 'message' => 'Mật khẩu phải có ít nhất 8 ký tự!'];
                // setcookie('msg1', 'Mật khẩu phải có ít nhất 8 ký tự', time() + 5, '/');
                header('Location: ' . _WEB_ROOT . '/dang-nhap');
                exit();
            }

            if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/', $Password)) {
                $_SESSION['flash_message'] = ['title' => 'Cảnh báo!', 'img' => _WEB_ROOT . '/public/assets/img/medium_priority-48.png', 'type' => 'error', 'message' => 'Mật khẩu phải chứa ít nhất 1 chữ hoa, 1 chữ thường và 1 số!'];
                // setcookie('msg1', 'Mật khẩu phải chứa ít nhất 1 chữ hoa, 1 chữ thường và 1 số', time() + 5, '/');
                header('Location: ' . _WEB_ROOT . '/dang-nhap');
                exit();
            }

            if ($Password !== $check_Password) {
                $_SESSION['flash_message'] = ['title' => 'Cảnh báo!', 'img' => _WEB_ROOT . '/public/assets/img/medium_priority-48.png', 'type' => 'error', 'message' => 'Mật khẩu xác nhận không khớp!'];
                // setcookie('msg1', 'Mật khẩu xác nhận không khớp', time() + 5, '/');
                header('Location: ' . _WEB_ROOT . '/dang-nhap');
                exit();
            }

            $data = array(
                'Username' => $Username,
                'FullName' => $FullName,
                'Password' => password_hash($Password, PASSWORD_DEFAULT),
                'Email' => $Email,
                'PhoneNumber' => $Phone,
                'Role' => $Role,
            );

            foreach ($data as $key => $value) {
                if (strpos($value, "'") != false) {
                    $value = str_replace("'", "\'", $value);
                    $data[$key] = $value;
                }
            }

            $status = $this->account_model->store($data);

            if ($status) {
                $_SESSION['flash_message'] = ['title' => 'Chúc mừng!', 'img' => _WEB_ROOT . '/public/assets/img/ok-48.png', 'type' => 'success', 'message' => 'Tạo người dùng mới thành công!'];
                // setcookie('msg', 'Tạo người dùng mới thành công', time() + 5, '/');
                header('Location: ' . _WEB_ROOT . '/dang-nhap');
            } else {
                $_SESSION['flash_message'] = ['title' => 'Cảnh báo!', 'img' => _WEB_ROOT . '/public/assets/img/medium_priority-48.png', 'type' => 'error', 'message' => 'Tạo người dùng mới thất bại!'];
                // setcookie('msg1', 'Tạo người dùng mới thất bại', time() + 5, '/');
                header('Location: ' . _WEB_ROOT . '/dang-nhap');
            }
            exit();
        }
    }

    function logout()
    {
        if (isset($_SESSION['user'])) {
            session_destroy();
        }
        header('Location: ' . _WEB_ROOT . '/dang-nhap');
        exit();
    }
    //doimatkhau
    public function check_Email_reset()
    {
        $title = 'Kiểm tra Email';
        $this->data['sub_content']['title'] = $title;
        $this->data['page_title'] = $title;
        $this->data['content'] = 'backend/account/reset_Password/check_Email_reset';
        $this->render('layouts/admin_layout', $this->data);
    }

    public function check_Email()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $Email = filter_var($_POST['Email'], FILTER_SANITIZE_Email);

            // Kiểm tra Email có tồn tại
            $user = $this->account_model->check_email($Email);

            if ($user) {
                // Lưu Email vào session để dùng ở bước tiếp theo
                $_SESSION['reset_Email'] = $Email;
                header('Location: ' . _WEB_ROOT . '/reset_form');
            } else {
                setcookie('msg1', 'Email không tồn tại trong hệ thống', time() + 5);
                header('Location: ' . _WEB_ROOT . '/check_Email_reset');
            }
            exit();
        }
    }

    //quenmatkhau
    public function check_Email_form()
    {
        $title = 'Kiểm tra Email';
        $this->data['sub_content']['title'] = $title;
        $this->data['page_title'] = $title;
        $this->data['content'] = 'backend/account/forgot_Password/check_Email_form';
        $this->render('layouts/admin_layout', $this->data);
    }

    public function send_Email()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            try {
                $Email = filter_var($_POST['Email'], FILTER_SANITIZE_Email);


                // Kiểm tra Email có tồn tại
                $user = $this->account_model->check_account($Email);
                if (!$user) {
                    setcookie('msg1', 'Email không tồn tại trong hệ thống', time() + 5, '/');
                    header('Location: ' . _WEB_ROOT . '/check_Email_form');
                    exit();
                }

                // Tạo access token
                $access_token = md5($Email . time());
                $this->account_model->accessToken($access_token, $Email);

                // Cấu hình PHPMailer
                $mail = new PHPMailer(true);

                try {
                    //Server settings
                    $mail->SMTPDebug = SMTP::DEBUG_SERVER;
                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com';
                    $mail->SMTPAuth = true;
                    $mail->Username = 'khacduy54.55@gmail.com';
                    $mail->Password = 'dmqk tidv milu uxol';
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                    $mail->Port = 465;
                    $mail->CharSet = 'UTF-8';

                    //Recipients
                    $mail->setFrom('khacduy54.55@gmail.com', 'Password Reset');
                    $mail->addAddress($Email);

                    //Content
                    $mail->isHTML(true);
                    $mail->Subject = 'Đặt lại mật khẩu';
                    $mail->Body = '
                        <h2>Xin chào,</h2>
                        <p>Chúng tôi nhận được yêu cầu đặt lại mật khẩu của bạn.</p>
                        <p>Vui lòng click vào link bên dưới để đặt lại mật khẩu:</p>
                        <p><a href="' . _WEB_ROOT . '/change_Password_form' . '/' . $access_token . '">Đặt lại mật khẩu</a></p>
                        <p>Nếu bạn không yêu cầu đặt lại mật khẩu, vui lòng bỏ qua Email này.</p>
                    ';

                    $mail->send();
                    setcookie('msg', 'Email đã được gửi thành công', time() + 5, '/');
                    header('Location: ' . _WEB_ROOT . '/dang-nhap');
                    exit();

                } catch (Exception $e) {
                    error_log("Mail Error: " . $mail->ErrorInfo);
                    setcookie('msg1', 'Không thể gửi Email: ' . $mail->ErrorInfo, time() + 5, '/');
                    header('Location: ' . _WEB_ROOT . '/check_Email_form');
                    exit();
                }

            } catch (Exception $e) {
                error_log("General Error: " . $e->getMessage());
                setcookie('msg1', 'Có lỗi xảy ra, vui lòng thử lại', time() + 5, '/');
                header('Location: ' . _WEB_ROOT . '/check_Email_form');
                exit();
            }
        }
    }

    public function change_Password_form($access_token = '')
    {
        $title = 'Đặt lại mật khẩu';
        $this->data['sub_content']['title'] = $title;
        $this->data['page_title'] = $title;
        $this->data['sub_content']['access_token'] = $access_token;
        $this->data['content'] = 'backend/account/forgot_Password/change_pass_form';
        $this->render('layouts/admin_layout', $this->data);
    }

    public function change_Password($access_token = '')
    {
        if (!$access_token || !$this->account_model->getAccessToken($access_token)) {
            setcookie('msg1', 'Link đặt lại mật khẩu không hợp lệ hoặc đã hết hạn', time() + 5, '/');
            header('Location: ' . _WEB_ROOT . '/check_Email_form');
            exit();
        }

        $new_Password = trim($_POST['new_Password']);
        $confirm_Password = trim($_POST['confirm_Password']);
        $Email = $this->account_model->getAccessToken($access_token);

        // Validate Password length
        if (strlen($new_Password) < 8) {
            setcookie('msg1', 'Mật khẩu phải có ít nhất 8 ký tự', time() + 5, '/');
            header('Location: ' . _WEB_ROOT . '/change_Password_form/' . $access_token);
            exit();
        }

        // Validate Password strength (optional)
        if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/', $new_Password)) {
            setcookie('msg1', 'Mật khẩu phải chứa ít nhất 1 chữ hoa, 1 chữ thường và 1 số', time() + 5, '/');
            header('Location: ' . _WEB_ROOT . '/change_Password_form/' . $access_token);
            exit();
        }

        // Validate Password confirmation
        if ($new_Password !== $confirm_Password) {
            setcookie('msg1', 'Mật khẩu xác nhận không khớp', time() + 5, '/');
            header('Location: ' . _WEB_ROOT . '/change_Password_form/' . $access_token);
            exit();
        }

        // Update Password
        if ($this->account_model->updatePassword($access_token, md5($new_Password))) {
            $access_token = NULL;
            $this->account_model->accessToken($access_token, $Email);

            setcookie('msg', 'Đổi mật khẩu thành công', time() + 5, '/');
            header('Location: ' . _WEB_ROOT . '/dang-nhap');
        } else {
            setcookie('msg1', 'Có lỗi xảy ra, vui lòng thử lại', time() + 5, '/');
            header('Location: ' . _WEB_ROOT . '/change_Password_form/' . $access_token);
        }
        exit();
    }
}
