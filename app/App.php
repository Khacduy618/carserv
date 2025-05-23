<?php
namespace App;


class App
{
    private $__controller, $__action, $__params, $__routes;

    public function __construct()
    {
        global $routes, $config;

        $this->__routes = new \Core\Route();

        // Fetch service categories and store them in a global variable
        $serviceModel = new \App\Models\ServiceCategoryModel();
        global $serviceCategories;
        $serviceCategories = $serviceModel->getServiceCategories();

        if (!empty($routes['default_controller'])) {
            $this->__controller = $routes['default_controller'];
        }

        $this->__action = 'index';
        $this->__params = [];
        $this->handleurl();

        // echo '<pre>';
        // print_r($config);
        // echo '</pre>';
    }

    public function getUrl()
    {
        if (!empty($_SERVER['PATH_INFO'])) {
            $url = $_SERVER['PATH_INFO'];
        } else {
            $url = '/';
        }
        return $url;
    }

    public function handleurl()
    {
        $url = $this->getUrl();
        $url = $this->__routes->handleRoute($url);

        $urlArr = array_filter(explode('/', $url));
        $urlArr = array_values($urlArr);

        $urlCheck = '';
        if (!empty($urlArr)) {
            foreach ($urlArr as $key => $item) {
                $urlCheck .= $item . '/';
                $fileCheck = rtrim($urlCheck, '/');
                $fileArr = explode('/', $fileCheck);
                $fileArr[count($fileArr) - 1] = ucfirst($fileArr[count($fileArr) - 1]);
                $fileCheck = implode('/', $fileArr);

                if (!empty($urlArr[$key - 1])) {
                    unset($urlArr[$key - 1]);
                }

                if (file_exists('app/controllers/' . ($fileCheck) . '.php')) {
                    $urlCheck = $fileCheck;
                    break;
                }
            }
            $urlArr = array_values($urlArr);
        }


        //xu ly controller
        if (!empty($urlArr[0])) {
            $this->__controller = ucfirst($urlArr[0]);
        } else {
            $this->__controller = ucfirst($this->__controller);
        }

        //xu ly khi urlcheck rong
        if (empty($urlCheck)) {
            $urlCheck = $this->__controller;
        }

        if (file_exists('app/controllers/' . ($urlCheck) . '.php')) {
            $controllerName = "App\\Controllers\\" . $this->__controller;

            if (class_exists($controllerName)) {
                $this->__controller = new $controllerName();
                unset($urlArr[0]);
            } else {
                $this->loadError();
            }
        } else {
            $this->loadError();
        }

        //xuly action
        if (!empty($urlArr[1])) {
            $this->__action = $urlArr[1];
            unset($urlArr[1]);
        }

        //xuly param
        $this->__params = array_values($urlArr);

        //kiemtra method ton tai
        if (method_exists($this->__controller, $this->__action)) {
            call_user_func_array([$this->__controller, $this->__action], $this->__params);
        } else {
            $this->loadError();
        }

        // echo '<pre>';
        // print_r($this->__params);
        // echo '</pre>';
    }

    public function loadError($name = '404')
    {
        require_once 'errors/' . $name . '.php';
    }
}
