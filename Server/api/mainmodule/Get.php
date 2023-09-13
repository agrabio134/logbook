<?php

class Get
{

    protected $pdo;
    protected $gm;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
        $this->gm = new GlobalMethods($pdo);
    }

    public function get_common($table, $condition = null)
    {
        $sql = "SELECT * FROM $table";
        if ($condition != null) {
            $sql .= " WHERE {$condition}";
        }

        $res = $this->gm->executeQuery($sql);
        if ($res['code'] == 200) {
            return $this->gm->returnPayload($res['data'], "success", "Succesfully retieved users records", $res['code']);
        }

        return $this->gm->returnPayload(null, "failed", "failed to retrieved data", $res['code']);
    }
    public function get_common_two_table($table1, $table2, $condition = null)
    {
        $sql = "SELECT * FROM $table1 Join $table2 ON $table1.user_id = $table2.id";
        if ($condition != null) {
            $sql .= " WHERE {$condition}";
        }

        $res = $this->gm->executeQuery($sql);
        if ($res['code'] == 200) {
            return $this->gm->returnPayload($res['data'], "success", "Succesfully retieved users records", $res['code']);
        }

        return $this->gm->returnPayload(null, "failed", "failed to retrieved data", $res['code']);
    }
    public function get_cart($condition)
    {
        $sql = "SELECT products.id, products.name, products.price, cart.quantity, users.id as user_id FROM products JOIN cart ON products.id = cart.product_id JOIN users ON users.id = cart.user_id 
        
        WHERE {$condition}
        ;
        ";


        $res = $this->gm->executeQuery($sql);
        if ($res['code'] == 200) {
            return $this->gm->returnPayload($res['data'], "success", "Succesfully retieved users records", $res['code']);
        }
    }

    public function get_last($table, $condition = null)
    {
        $sql = "SELECT studnum_fld FROM $table ORDER BY recno_fld DESC LIMIT 1";

        $res = $this->gm->executeQuery($sql);
        if ($res['code'] == 200) {
            return $this->gm->returnPayload($res['data'], "success", "Succesfully retieved users records", $res['code']);
        }

        return $this->gm->returnPayload(null, "failed", "failed to retrieved data", $res['code']);
    }
}
