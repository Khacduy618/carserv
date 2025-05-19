<?php
namespace App\Models;

use Core\Model;
class CarModel extends Model
{
    protected $table;
    protected $status;
    protected $contents;

    public function __construct()
    {
        parent::__construct();
        $this->table = "cars";
        $this->contents = "CarID";
    }


    public function getCars($keyword = "", $sort = 'CarID', $order = 'ASC', $page = 1, $item_per_page = 10)
    {
        $offset = ($page - 1) * $item_per_page;

        $sql = "SELECT * FROM {$this->table} WHERE 1";

        $params = [];

        // Handle search
        if (!empty($keyword) && $keyword !== '/' && $keyword !== '') {
            $sql .= " AND (LicensePlate LIKE ? OR Brand LIKE ? OR Model LIKE ? OR CarYear LIKE ? OR VIN LIKE ?)";
            $params[] = "%$keyword%";
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

    public function getTotalCars($keyword = "")
    {
        $sql = "SELECT COUNT(*) AS total FROM {$this->table} WHERE 1";

        $params = [];

        // Handle search
        if (!empty($keyword) && $keyword !== '/' && $keyword !== '') {
            $sql .= " AND (LicensePlate LIKE ? OR Brand LIKE ? OR Model LIKE ?)";
            $params[] = "%$keyword%";
            $params[] = "%$keyword%";
            $params[] = "%$keyword%";
        }

        $result = $this->pdo_query_one($sql, params: $params);
        return $result['total'];
    }
}
