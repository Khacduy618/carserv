<?php
namespace App\Models;

use Core\Model;

class ServiceModel extends Model
{


    protected $table;
    protected $status;
    protected $contents;

    public function __construct()
    {
        parent::__construct();
        $this->table = 'services';
        $this->status = "IsActive";
        $this->contents = "ServiceID";
    }

    public function getServicesByCategory($categoryID)
    {
        $sql = "SELECT * FROM {$this->table} WHERE CategoryID = ?";
        return $this->pdo_query_all($sql, [$categoryID]);
    }
}
?>