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
}