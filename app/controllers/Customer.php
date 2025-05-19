<?php
namespace App\Controllers;

use Core\Controller;

class Customer extends Controller
{
    public $data = [];
    private $customer_model;

    public function __construct()
    {
        $this->customer_model = $this->model('CustomerModel');
    }

    public function index()
    {
        $search = isset($_GET['search']) ? $_GET['search'] : null;
        $sort = isset($_GET['sort']) ? $_GET['sort'] : null;
        $order = isset($_GET['order']) ? $_GET['order'] : null;

        $customers = $this->customer_model->getCustomers($search, $sort, $order);
        $this->data['sub_content']['customers'] = $customers;
        $this->data['sub_content']['search'] = $search;
        $this->data['sub_content']['sort'] = $sort;
        $this->data['content'] = 'backend/customer/list';
        $this->render('layouts/admin_layout', $this->data);
    }
}
