<?php 

class Dashboard_model {
    private $table = 'users';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getCountUsers()
    {
        $query = $this->db->query('SELECT COUNT(*) as total FROM ' . $this->table);
        $query = $this->db->single();
        $result = $query;

        if (isset($result['total'])) {
            return $result['total'];
        }
    
        return 0;
    }
    public function getCountProduct()
    {
        $query = $this->db->query('SELECT COUNT(*) as total_product FROM products');
        $query = $this->db->single();
        $result = $query;

        if (isset($result['total_product'])) {
            return $result['total_product'];
        }
    
        return 0;
    }
    public function getCountCategory()
    {
        $query = $this->db->query('SELECT COUNT(*) as total_participant FROM payments');
        $query = $this->db->single();
        $result = $query;

        if (isset($result['total_participant'])) {
            return $result['total_participant'];
        }
    
        return 0;
    }
}