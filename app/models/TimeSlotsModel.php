<?php
namespace App\Models;

use Core\Model;

class TimeSlotsModel extends Model
{


    protected $table;
    protected $status;
    protected $contents;

    public function __construct()
    {
        parent::__construct();
        $this->table = 'timeslots';
        $this->contents = "SlotID";
    }

    public function getTimeslots($date)
    {
        $sql = "SELECT * FROM {$this->table} WHERE SlotDate = ? ORDER BY {$this->contents} ASC";
        return $this->pdo_query_all($sql, [$date]);
    }

    public function updateTimeslot($slotID)
    {
        $sql = "UPDATE {$this->table} SET BookedCount = BookedCount + 1, IsAvailable = IsAvailable - 1 WHERE {$this->contents} = ?";
        return $this->pdo_execute($sql, [$slotID]);
    }

}
?>