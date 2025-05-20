<?php
namespace App\Models;

use Core\Model;
class CustomerModel extends Model
{
    protected $table = 'bookings';

    public function getCustomers($keyword = "", $sort = 'CustomerName', $order = 'ASC', $page = 1, $item_per_page = 10)
    {
        $offset = ($page - 1) * $item_per_page;

        $sql = "SELECT b.CustomerName, b.CustomerPhoneNumber, b.CustomerEmail, GROUP_CONCAT(DISTINCT b.CarID SEPARATOR ', ') AS AllCarID, GROUP_CONCAT(DISTINCT c.LicensePlate SEPARATOR ', ') AS AllLicensePlates, COUNT(b.BookingID) AS NumberOfBookings FROM bookings b LEFT JOIN cars c ON c.CarID = b.CarID WHERE 1";

        $params = [];

        if (!empty($keyword) && $keyword !== '/') {
            $sql .= " AND (b.CustomerName LIKE ? OR b.CustomerPhoneNumber LIKE ? OR b.CustomerEmail LIKE ? OR c.LicensePlate LIKE ?)";
            $params[] = "%$keyword%";
            $params[] = "%$keyword%";
            $params[] = "%$keyword%";
            $params[] = "%$keyword%";
        }

        $sql .= " GROUP BY b.CustomerName, b.CustomerPhoneNumber, b.CustomerEmail";


        $sql .= " ORDER BY $sort $order";

        // $sql .= " LIMIT " . (int) $item_per_page;

        // $sql .= " OFFSET " . (int) $offset;

        return $this->pdo_query_all($sql, $params);
    }


    public function getTotalCustomers($keyword = "")
    {
        $sql = "SELECT COUNT(DISTINCT b.CustomerName) as total FROM bookings b LEFT JOIN cars c ON c.CarID = b.CarID WHERE 1";
        $params = [];

        if (!empty($keyword) && $keyword !== '/') {
            $sql .= " AND (b.CustomerName LIKE ? OR b.CustomerPhoneNumber LIKE ? OR b.CustomerEmail LIKE ? OR c.LicensePlate LIKE ?)";
            $params[] = "%$keyword%";
            $params[] = "%$keyword%";
            $params[] = "%$keyword%";
            $params[] = "%$keyword%";
        }

        $result = $this->pdo_query_one($sql, $params);
        return $result['total'];
    }
}
?>