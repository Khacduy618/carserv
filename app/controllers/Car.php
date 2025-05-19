<?php
namespace App\Controllers;

use Core\Controller;

class Car extends Controller
{
    public $data = [];
    private $car_model;

    public function __construct()
    {
        $this->car_model = $this->model('CarModel');
    }

    public function index()
    {
        $search = isset($_GET['search']) ? $_GET['search'] : null;
        $sort = isset($_GET['sort']) ? $_GET['sort'] : 'CarID';
        $order = isset($_GET['order']) ? $_GET['order'] : 'ASC';
        $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
        $item_per_page = 10;

        $cars = $this->car_model->getCars($search, $sort, $order, $page, $item_per_page);
        $total_cars = $this->car_model->getTotalCars($search);
        $total_pages = ceil($total_cars / $item_per_page);

        $this->data['sub_content']['cars'] = $cars;
        $this->data['sub_content']['search'] = $search;
        $this->data['sub_content']['sort'] = $sort;
        $this->data['sub_content']['order'] = $order;
        $this->data['sub_content']['page'] = $page;
        $this->data['sub_content']['total_pages'] = $total_pages;
        $this->data['content'] = 'backend/car/list';
        $this->render('layouts/admin_layout', $this->data);
    }

    public function detail($id)
    {
        $car = $this->car_model->findbyId($id);

        $this->data['sub_content']['car'] = $car;
        $this->data['content'] = 'backend/car/detail';
        $this->render('layouts/admin_layout', $this->data);
    }
}
