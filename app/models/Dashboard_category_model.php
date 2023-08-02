<?php 

class Dashboard_category_model {
    private $table = 'categories';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllCategory()
    {
        $this->db->query('SELECT * FROM ' . $this->table);
        return $this->db->resultSet();
    }

    public function getCategoryById($id)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE id=:id');
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    public function tambahDataCategory($data)
    {
        $query = "INSERT INTO categories (category_name)
                VALUES (:category_name)";
        
        $this->db->query($query);
        $this->db->bind('category_name', $data['category_name']);
        

        $this->db->execute();
        return $this->db->rowCount();
    }


    public function hapusDataCategory($id)
    {
        $query = "DELETE FROM categories WHERE id = :id";
        
        $this->db->query($query);
        $this->db->bind('id', $id);

        $this->db->execute();

        return $this->db->rowCount();
    }

}