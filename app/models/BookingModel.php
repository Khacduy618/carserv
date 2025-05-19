<?php
namespace App\Models;

use Core\Model;
class BookingModel extends Model
{
    protected $table;
    protected $status;
    protected $contents;

    public function __construct()
    {
        parent::__construct();
        $this->table = "bookings";
        $this->status = "StatusID";
        $this->contents = "BookingID";
    }


    public function getAllBooking($keyword = "", $status = "", $page = 1, $item_per_page = 12)
    {
        $offset = ($page - 1) * $item_per_page;

        $sql = "SELECT BookingID, BookingCode, CustomerName, CustomerPhoneNumber, CarID, BookingDateTime, StatusID, StaffID
                FROM {$this->table}
                WHERE 1";

        $params = [];

        // Handle search
        if (!empty($keyword) && $keyword !== '/' && $keyword !== '') {
            $sql .= " AND (CustomerName LIKE ? OR BookingCode LIKE ? OR CustomerPhoneNumber LIKE ? )";
            $params[] = "%$keyword%";
            $params[] = "%$keyword%";
            $params[] = "%$keyword%";
        }

        // Handle status filter
        if ($status !== '') {
            $sql .= " AND {$this->status} = ?";
            $params[] = $status;
        }

        $sql .= " ORDER BY CreatedAt ASC";
        if ($item_per_page > 0) {
            $sql .= " LIMIT " . (int) $item_per_page;
        }

        if ($offset > 0) {
            $sql .= " OFFSET " . (int) $offset;
        }

        return $this->pdo_query_all($sql, $params);
    }

    public function getTotalBookings($keyword = "", $status = "")
    {
        $sql = "SELECT COUNT(*) as total FROM {$this->table} WHERE 1";
        $params = [];

        if (!empty($keyword) && $keyword !== '/' && $keyword !== '') {
            $sql .= " AND (CustomerName LIKE ? OR BookingCode LIKE ? OR CustomerPhoneNumber LIKE ? )";
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


    public function store_id($data)
    {
        $f = "";
        $v = "";
        foreach ($data as $key => $value) {
            $f .= $key . ",";
            $v .= "'" . $value . "',";
        }
        $f = trim($f, ",");
        $v = trim($v, ",");
        $sql = "INSERT INTO $this->table($f) VALUES ($v);";
        return $this->pdo_execute_id($sql);
    }

    public function createCar($data)
    {
        $f = "";
        $v = "";
        foreach ($data as $key => $value) {
            $f .= $key . ",";
            $v .= "'" . $value . "',";
        }
        $f = trim($f, ",");
        $v = trim($v, ",");
        $sql = "INSERT INTO cars($f) VALUES ($v);";
        return $this->pdo_execute_id($sql);
    }

    public function create_bookingSer($data)
    {
        $f = "";
        $v = "";
        foreach ($data as $key => $value) {
            $f .= $key . ",";
            $v .= "'" . $value . "',";
        }
        $f = trim($f, ",");
        $v = trim($v, ",");
        $sql = "INSERT INTO bookingservices($f) VALUES ($v);";
        return $this->pdo_execute_id($sql);
    }

    public function getCarByLicensePlate($licensePlate)
    {
        $sql = "SELECT CarID FROM cars WHERE LicensePlate = ?";
        return $this->pdo_query_one($sql, [$licensePlate]);
    }

    public function getAvailableTimeSlots($date)
    {
        $sql = "SELECT * FROM timeslots WHERE SlotDate = ?";
        return $this->pdo_query_all($sql, [$date]);
    }

    public function getBookingDetails($bookingCode)
    {
        $sql = "SELECT
           
            b.BookingCode,
            b.CustomerName,
            b.CustomerPhoneNumber,
            b.CustomerEmail,
            b.BookingDate,
            b.Time,
            b.Notes,
            b.EstimatedCompletionTime,
            b.ActualCompletionTime,
            b.TotalPrice,
            b.CancellationReason,
            bs.StatusName,
            c.LicensePlate,
            c.Brand,
            c.Model,
            c.CarYear
        FROM bookings b
        JOIN bookingstatuses bs ON b.StatusID = bs.StatusID
        JOIN cars c ON b.CarID = c.CarID
        WHERE b.BookingCode = ?";

        return $this->pdo_query_one($sql, [$bookingCode]);
    }

    public function getBookingServices($bookingCode)
    {
        $sql = "SELECT
            s.ServiceName,

            bs.PriceAtBooking
        FROM bookingservices bs
        JOIN bookings b ON bs.BookingID = b.BookingID
        JOIN services s ON bs.ServiceID = s.ServiceID
        WHERE b.BookingCode = ?";

        return $this->pdo_query_all($sql, [$bookingCode]);
    }
}
