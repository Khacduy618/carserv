<?php
namespace App\Models;

use Core\Model;

class ServiceCategoryModel extends Model
{
    protected $table;
    protected $status;
    protected $contents;

    public function __construct()
    {
        parent::__construct();
        $this->table = 'servicecategories';
        $this->status = "DeletedAt";
        $this->contents = "CategoryID";
    }


    public function getServiceCategories($keyword = '', $sort = 'CategoryID', $order = 'ASC', $page = 1, $item_per_page = 10)
    {
        $offset = ($page - 1) * $item_per_page;

        $sql = "SELECT * FROM {$this->table} WHERE DeletedAt IS NULL";

        $params = [];

        // Handle search
        if (!empty($keyword) && $keyword !== '/' && $keyword !== '') {
            $sql .= " AND (CategoryName LIKE ? OR Description LIKE ?)";
            $params[] = "%$keyword%";
            $params[] = "%$keyword%";
        }

        $sql .= " ORDER BY $sort $order";

        $sql .= " LIMIT " . (int) $item_per_page;

        $sql .= " OFFSET " . (int) $offset;

        return $this->pdo_query_all($sql, $params);
    }

    public function getTotalServiceCategories($keyword = '')
    {
        $sql = "SELECT COUNT(*) AS total FROM {$this->table} WHERE DeletedAt IS NULL";

        $params = [];

        // Handle search
        if (!empty($keyword) && $keyword !== '/' && $keyword !== '') {
            $sql .= " AND (CategoryName LIKE ? OR Description LIKE ?)";
            $params[] = "%$keyword%";
            $params[] = "%$keyword%";
        }

        $result = $this->pdo_query_one($sql, params: $params);
        return $result['total'];
    }


    public function softDeleteServiceCategory($id)
    {
        $date = date('Y-m-d H:i:s');
        $sql = "UPDATE {$this->table} SET DeletedAt = '.$date.' WHERE {$this->contents} = ? ";
        return $this->pdo_execute($sql, $id);
    }

    public function getParentServiceCategories()
    {
        $sql = "SELECT * FROM {$this->table} WHERE parent_id IS NULL AND DeletedAt IS NULL";
        return $this->pdo_query_all($sql);
    }
}
