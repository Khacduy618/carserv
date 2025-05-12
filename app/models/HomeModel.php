<?php
namespace App\Models;

use Core\Model;

class HomeModel extends Model
{
    public function __construct()
    {
        parent::__construct();

    }
    public function getBookingsByLicensePlate($licensePlate, $customerName = '')
    {
        $sql = "SELECT b.BookingCode, COUNT(bs.ServiceID) AS TotalServices, b.TotalPrice, s.StatusName, b.StatusID
                FROM bookings b
                JOIN cars c ON b.CarID = c.CarID
                LEFT JOIN bookingservices bs ON b.BookingID = bs.BookingID
                LEFT JOIN bookingstatuses s ON b.StatusID = s.StatusID
                WHERE c.LicensePlate LIKE ? AND b.CustomerName LIKE ?
                GROUP BY b.BookingID";

        return $this->pdo_query_all($sql, ["%{$licensePlate}%", "%{$customerName}%"]);
    }

    public function updateBookingStatus($bookingCode, $data)
    {
        if (!empty($data)) {
            $fields = "";
            foreach ($data as $key => $value) {
                $fields .= "$key = '$value',";
            }
            $fields = trim($fields, ",");
            $sql = "UPDATE bookings SET $fields WHERE BookingCode = ?";
            return $this->pdo_execute($sql, $bookingCode);
        }
    }
}
