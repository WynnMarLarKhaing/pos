<?php
class Stock{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getStocks()
    {
        $this->db->query('SELECT * 
                        FROM stocks 
                        ORDER BY updated_at DESC');
        return $this->db->resultSet();
    }

    public function addStock($data)
    {
        $this->db->query("INSERT INTO stocks (name, name_zawgyi, stocks_shortcut_id, customer_price, non_customer_price) VALUES (:name, :name_zawgyi, :stocks_shortcut_id, :customer_price, :non_customer_price)");
        //Bind Values
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':name_zawgyi', $data['name_zawgyi']);
        $this->db->bind(':stocks_shortcut_id', $data['stocks_shortcut_id']);
        $this->db->bind(':customer_price', $data['customer_price']);
        $this->db->bind(':non_customer_price', $data['non_customer_price']);

        //execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function updateStock($data)
    {
        $this->db->query("UPDATE stocks SET name = :name , name_zawgyi = :name_zawgyi ,stocks_shortcut_id = :stocks_shortcut_id, customer_price = :customer_price, non_customer_price = :non_customer_price WHERE id = :id");
        //Bind Values
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':name_zawgyi', $data['name_zawgyi']);
        $this->db->bind(':stocks_shortcut_id', $data['stocks_shortcut_id']);
        $this->db->bind(':customer_price', $data['customer_price']);
        $this->db->bind(':non_customer_price', $data['non_customer_price']);

        //execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getStockById($id)
    {
        $this->db->query("SELECT * FROM stocks WHERE id = :id");
        //Bind Values
        $this->db->bind(':id', $id);
        $row = $this->db->single();

        return $row;
    }

    public function deleteStock($id)
    {
        $this->db->query("DELETE FROM stocks WHERE id = :id");
        //Bind Values
        $this->db->bind(':id', $id);

        //execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}