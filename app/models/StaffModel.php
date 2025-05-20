<?php
namespace App\Models;

use Core\Model;
class StaffModel extends Model
{
    protected $table;
    protected $status;
    protected $contents;

    public function __construct()
    {
        parent::__construct();
        $this->table = "staff";
        $this->status = "IsActive";
        $this->contents = "StaffID";
    }

    public function getStaffs($keyword = "", $sort = 'FullName', $order = 'ASC', $page = 1, $item_per_page = 10)
    {
        $offset = ($page - 1) * $item_per_page;

        $sql = "SELECT * FROM {$this->table} WHERE 1";

        $params = [];

        // Handle search
        if (!empty($keyword) && $keyword !== '/' && $keyword !== '') {
            $sql .= " AND (FullName LIKE ? OR Email LIKE ? OR PhoneNumber LIKE ? OR Role LIKE ? )";
            $params[] = "%$keyword%";
            $params[] = "%$keyword%";
            $params[] = "%$keyword%";
            $params[] = "%$keyword%";
        }

        $sql .= " ORDER BY $sort $order";

        $sql .= " LIMIT " . (int) $item_per_page;

        $sql .= " OFFSET " . (int) $offset;

        return $this->pdo_query_all($sql, $params);
    }


    public function getTotalStaff($search = "")
    {
        $sql = "SELECT COUNT(*) as total FROM {$this->table} WHERE 1";
        $params = [];

        if (!empty($search) && $search !== '/') {
            $sql .= " AND (FullName LIKE ? OR Email LIKE ? OR PhoneNumber LIKE ? OR Role LIKE ?)";
            $params[] = "%$search%";
            $params[] = "%$search%";
            $params[] = "%$search%";
            $params[] = "%$search%";
        }

        $result = $this->pdo_query_one($sql, $params);
        return $result['total'];
    }


}
