<?php
class Customer
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getCustomers()
    {
        $this->db->query('SELECT * ,
                        id as postId,
                        name,
                        phone,
                        address,
                        created_at as postCreated
                        FROM customers 
                        ORDER BY customers.updated_at DESC');
        return $this->db->resultSet();
    }

    public function addPost($data)
    {
        $this->db->query("INSERT INTO customers (name,name_zawgyi,phone,address) VALUES (:name, :name_zawgyi, :phone, :address)");
        //Bind Values
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':name_zawgyi', $data['name_zawgyi']);
        $this->db->bind(':phone', $data['phone']);
        $this->db->bind(':address', $data['address']);

        //execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function updatePost($data)
    {
        $this->db->query("UPDATE customers SET name = :name , name_zawgyi = :name_zawgyi ,phone = :phone, address = :address WHERE id = :id");
        //Bind Values
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':name_zawgyi', $data['name_zawgyi']);
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

    public function deletePost($id)
    {
        $this->db->query("DELETE FROM customers WHERE id = :id");
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
