<?php
namespace App\Models;

use Core\Model;
class AccountModel extends Model
{
    protected $table = 'staff';

    public function get_user_by_username($Username)
    {
        $sql = "SELECT * FROM $this->table WHERE Username = ? AND IsActive = 1 LIMIT 1";
        return $this->pdo_query_one($sql, [$Username]);
    }

    function check_account($Username)
    {
        $sql = "SELECT Username FROM $this->table WHERE Username = ? LIMIT 1";
        $result = $this->pdo_query_one($sql, [$Username]);
        return $result ? true : false;
    }

    function check_email($Email)
    {
        $sql = "SELECT Username FROM $this->table WHERE Email = ? LIMIT 1";
        $result = $this->pdo_query_one($sql, [$Email]);
        return $result ? true : false;
    }
    public function updatePassword($access_token, $new_password)
    {
        $new_password = password_hash($new_password, PASSWORD_DEFAULT);
        $sql = "UPDATE $this->table SET Password = ? WHERE access_token = ?";
        return $this->pdo_query($sql, [$new_password, $access_token]);
    }

    public function accessToken($access_token = '', $Email)
    {
        $sql = "UPDATE $this->table SET access_token = ? WHERE Email = ?";
        return $this->pdo_execute($sql, [$access_token, $Email]);
    }

    public function getAccessToken($access_token)
    {
        $sql = "SELECT Username FROM $this->table WHERE access_token = ?";
        $result = $this->pdo_query_one($sql, [$access_token]);
        return $result ? $result['Username'] : false;
    }


}

?>