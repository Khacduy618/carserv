<?php
namespace App\Controllers;

use Core\Controller;

class Home extends Controller
{
    public $data = [];
    public $home_model;

    public function __construct()
    {
        $this->home_model = $this->model('HomeModel');
    }

    public function index()
    {
        $title = 'Trang chủ';
        $this->data['sub_content']['title'] = $title;
        $this->data['page_title'] = $title;
        $this->data['content'] = 'frontend/home/index';
        $this->render('layouts/client_layout', $this->data);
    }

    public function searchBooking()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' || $_SERVER['REQUEST_METHOD'] == 'GET') {
            $licensePlate = $_POST['license_plate'] ?? $_GET['license_plate'];
            $licensePlate = strtoupper(preg_replace("/[^a-zA-Z0-9]/", " ", $licensePlate));

            $customerName = $_POST['customerName'] ?? $_GET['customerName'];
            $bookings = $this->home_model->getBookingsByLicensePlate($licensePlate, $customerName);
            $_SESSION['customerName'] = $customerName;
            $_SESSION['license_plate'] = $licensePlate;

            $this->data['sub_content']['bookings'] = $bookings;
            $this->data['sub_content']['licensePlate'] = $licensePlate;
            $this->data['sub_content']['title'] = 'Kết quả tìm kiếm';
            $this->data['page_title'] = 'Kết quả tìm kiếm';
            $this->data['content'] = 'frontend/home/search_results';
            $this->render('layouts/client_layout', $this->data);
        } else {
            header('Location: ' . _WEB_ROOT . '/trang-chu');
        }
    }

    public function viewBookingForm()
    {
        $this->data['page_title'] = 'Tìm kiếm lịch hẹn';
        $this->data['sub_content']['title'] = 'Tìm kiếm lịch hẹn';
        $this->data['content'] = 'frontend/home/booking_form';
        $this->render('layouts/client_layout', $this->data);
    }

    
}
