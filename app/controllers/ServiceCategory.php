<?php
namespace App\Controllers;

use Core\Controller;

class ServiceCategory extends Controller
{
    public $data = [];
    private $servicecategory_model;

    public function __construct()
    {
        $this->servicecategory_model = $this->model('ServiceCategoryModel');
    }

    public function index()
    {
        $search = isset($_GET['search']) ? $_GET['search'] : null;
        $sort = isset($_GET['sort']) ? $_GET['sort'] : 'CategoryID';
        $order = isset($_GET['order']) ? $_GET['order'] : 'ASC';
        $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
        $item_per_page = 10;

        $servicecategories = $this->servicecategory_model->getServiceCategories($search, $sort, $order, $page, $item_per_page);
        $total_servicecategories = $this->servicecategory_model->getTotalServiceCategories($search);
        $total_pages = ceil($total_servicecategories / $item_per_page);

        $this->data['sub_content']['servicecategories'] = $servicecategories;
        $this->data['sub_content']['search'] = $search;
        $this->data['sub_content']['sort'] = $sort;
        $this->data['sub_content']['order'] = $order;
        $this->data['sub_content']['page'] = $page;
        $this->data['sub_content']['total_pages'] = $total_pages;
        $this->data['content'] = 'backend/servicecategory/list';
        $this->render('layouts/admin_layout', $this->data);
    }

    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $_POST;
            $this->servicecategory_model->store($data);
            $_SESSION['flash_message'] = [
                'title' => 'Thêm mới!',
                'img' => _WEB_ROOT . '/public/assets/img/ok-48.png',
                'type' => 'success',
                'message' => 'Thêm mới danh mục dịch vụ thành công!'
            ];
            header('Location: ' . _WEB_ROOT . '/servicecategory');
            exit();
        }

        $parentcategories = $this->servicecategory_model->getParentServiceCategories();
        $this->data['sub_content']['parentcategories'] = $parentcategories;
        $this->data['content'] = 'backend/servicecategory/add';
        $this->render('layouts/admin_layout', $this->data);
    }

    public function edit($id)
    {
        $servicecategory = $this->servicecategory_model->findbyId($id);

        if (!$servicecategory) {
            $_SESSION['flash_message'] = [
                'title' => 'Cảnh báo!',
                'img' => _WEB_ROOT . '/public/assets/img/medium_priority-48.png',
                'type' => 'error',
                'message' => 'Danh mục không tồn tại!'
            ];
            header('Location: ' . _WEB_ROOT . '/servicecategory');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $_POST;
            $this->servicecategory_model->update($data, $id);
            $_SESSION['flash_message'] = [
                'title' => 'Cập nhật!',
                'img' => _WEB_ROOT . '/public/assets/img/ok-48.png',
                'type' => 'success',
                'message' => 'Cập nhật danh mục dịch vụ thành công!'
            ];
            header('Location: ' . _WEB_ROOT . '/servicecategory');
            exit();
        }

        $parentcategories = $this->servicecategory_model->getParentServiceCategories();
        $this->data['sub_content']['servicecategory'] = $servicecategory;
        $this->data['sub_content']['parentcategories'] = $parentcategories;
        $this->data['content'] = 'backend/servicecategory/edit';
        $this->render('layouts/admin_layout', $this->data);
    }

    public function delete($id)
    {
        $this->servicecategory_model->softDeleteServiceCategory($id);
        $_SESSION['flash_message'] = [
            'title' => 'Thêm vào thùng rác!',
            'img' => _WEB_ROOT . '/public/assets/img/ok-48.png',
            'type' => 'success',
            'message' => 'Thêm danh mục dịch vụ vào thùng rác thành công!'
        ];
        header('Location: ' . _WEB_ROOT . '/servicecategory');
        exit();
    }
}
