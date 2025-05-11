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
        $this->contents = "Username";
    }

    public function getAllStaff($keyword = "", $status = "", $page = 1, $item_per_page = 12)
    {
        $offset = ($page - 1) * $item_per_page;

        $sql = "SELECT StaffID, FullName, Email, PhoneNumber, Role, {$this->status}, CreatedAt
                FROM {$this->table}
                WHERE 1";

        $params = [];

        // Handle search
        if (!empty($keyword) && $keyword !== '/' && $keyword !== '') {
            $sql .= " AND (FullName LIKE ? OR Email LIKE ? OR PhoneNumber LIKE ? OR Role LIKE ?)";
            $params[] = "%$keyword%";
            $params[] = "%$keyword%";
            $params[] = "%$keyword%";
            $params[] = "%$keyword%";
        }

        // Handle status filter
        if ($status !== '') {
            $sql .= " AND {$this->status} = ?";
            $params[] = $status;
        }

        $sql .= " ORDER BY Role ASC";
        if ($item_per_page > 0) {
            $sql .= " LIMIT " . (int) $item_per_page;
        }

        if ($offset > 0) {
            $sql .= " OFFSET " . (int) $offset;
        }

        return $this->pdo_query_all($sql, $params);
    }

    public function getTotalStaff($keyword = "", $status = "")
    {
        $sql = "SELECT COUNT(*) as total FROM {$this->table} WHERE 1";
        $params = [];

        if (!empty($keyword) && $keyword !== '/') {
            $sql .= " AND (FullName LIKE ? OR Email LIKE ? OR PhoneNumber LIKE ? OR Role LIKE ?)";
            $params[] = "%$keyword%";
            $params[] = "%$keyword%";
            $params[] = "%$keyword%";
            $params[] = "%$keyword%";
        }
        $sql .= " ORDER BY CreatedAt ASC";
        if ($status !== '') {
            $sql .= " AND {$this->status} = ?";
            $params[] = $status;
        }

        $result = $this->pdo_query_one($sql, $params);
        return $result['total'];
    }
}
