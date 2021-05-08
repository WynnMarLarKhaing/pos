<?php
class Receipt
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getReceipts()
    {
        $this->db->query('SELECT 
                            receipt_id,
                            customers.name as customer_name,
                            receipts.updated_at as order_date,
                            receipts.save_type
                        FROM receipts 
                        LEFT JOIN customers
                        ON receipts.customer_id = customers.id
                        GROUP BY receipts.receipt_id
                        ORDER BY receipts.receipt_id DESC');
        return $this->db->resultSet();
    }

    public function getReceiptsToday()
    {
        $this->db->query('SELECT 
                            receipt_id,
                            customers.name as customer_name,
                            receipts.updated_at as order_date,
                            receipts.save_type
                        FROM receipts 
                        LEFT JOIN customers
                        ON receipts.customer_id = customers.id
                        WHERE DATE(receipts.updated_at) = CURDATE()
                        GROUP BY receipts.receipt_id
                        ORDER BY receipts.receipt_id DESC');
        return $this->db->resultSet();
    }

    public function getReceipt($receipt_id)
    {
        $this->db->query('SELECT 
                            receipts.*,
                            customers.name as customer_name,
                            customers.name_zawgyi as customer_name_zawgyi,
                            stocks.name as stock_name,
                            stocks.name_zawgyi as stock_name_zawgyi,
                            stocks.customer_price
                        FROM receipts 
                        INNER JOIN stocks
                        ON receipts.stock_id = stocks.stocks_shortcut_id
                        LEFT JOIN customers
                        ON receipts.customer_id = customers.id
                        WHERE receipts.receipt_id = :receipt_id');
        //Bind Values
        $this->db->bind(':receipt_id', $receipt_id);

        return $this->db->resultSet();
    }

    public function addReceipt($data)
    {
        $this->db->query("INSERT INTO receipts (receipt_id, stock_id, customer_id, qty, order_type, save_type, created_at, updated_at) VALUES (:receipt_id, :stock_id, :customer_id, :qty, :order_type, :save_type, :created_at ,:updated_at)");
        //Bind Values
        $this->db->bind(':receipt_id', $data['receipt_id']);
        $this->db->bind(':stock_id', $data['stock_id']);
        $this->db->bind(':customer_id', $data['customer_id']);
        $this->db->bind(':qty', $data['qty']);
        $this->db->bind(':order_type', $data['order_type']);
        $this->db->bind(':save_type', $data['save_type']);
        $this->db->bind(':created_at', date('Y-m-d H:i:s'));
        $this->db->bind(':updated_at', date('Y-m-d H:i:s'));

        //execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function updatePost($data)
    {
        $this->db->query("UPDATE customers SET name = :name , phone = :phone, address = :address WHERE id = :id");
        //Bind Values
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':phone', $data['phone']);
        $this->db->bind(':address', $data['address']);

        //execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getPostById($id)
    {
        $this->db->query("SELECT * FROM customers WHERE id = :id");
        //Bind Values
        $this->db->bind(':id', $id);
        $row = $this->db->single();

        return $row;
    }

    public function deleteReceipt($receipt_id)
    {
        $this->db->query("DELETE FROM receipts WHERE receipt_id IN (:receipt_id)");
        //Bind Values
        $this->db->bind(':receipt_id', $receipt_id);

        //execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getLastInsertId()
    {
        $this->db->query("SELECT CASE WHEN MAX(receipt_id) IS NULL THEN 1 ELSE MAX(receipt_id) + 1 end as receipt_id FROM receipts");
                        
        return $this->db->single();
    }
}
