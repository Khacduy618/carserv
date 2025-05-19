<?php
namespace App\Models;

use Core\Model;
class CustomerModel extends Model
{
    protected $table = 'bookings';

    public function getCustomers($search = null, $sort = null, $order = '')
    {
        $sql = "SELECT b.CustomerName, b.CustomerPhoneNumber, b.CustomerEmail, GROUP_CONCAT(DISTINCT b.CarID SEPARATOR ', ') AS AllCarID, GROUP_CONCAT(DISTINCT c.LicensePlate SEPARATOR ', ') AS AllLicensePlates, COUNT(b.BookingID) AS NumberOfBookings FROM bookings b LEFT JOIN cars c ON c.CarID = b.CarID";

        if ($search) {
            $search = $this->db->quote($search);
            $sql .= " WHERE (b.CustomerName LIKE '%" . $search . "%' OR b.CustomerPhoneNumber LIKE '%" . $search . "%' OR b.CustomerEmail LIKE '%" . $search . "%' OR c.LicensePlate LIKE '%" . $search . "%')";
        }

        $sql .= " GROUP BY b.CustomerName, b.CustomerPhoneNumber, b.CustomerEmail";

        if ($sort) {
            $order = strtoupper($order) == 'DESC' ? 'DESC' : 'ASC';
            $sql .= " ORDER BY " . $sort . " " . $order;
        }

        return $this->pdo_query_all($sql);
    }
}

?>