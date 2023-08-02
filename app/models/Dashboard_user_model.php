<?php 

class Dashboard_user_model {
    private $table = 'users';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getUser($email, $password)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE email=:email AND password = :password');
        $this->db->bind(':email', $email);
        $this->db->bind(':password', $password);
        return $this->db->single();
    }

    public function getAllUsers()
    {
        $this->db->query('SELECT * FROM ' . $this->table);
        return $this->db->resultSet();
    }

    public function getUserById($id)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE id=:id');
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    public function tambahDataUser($data)
    {
        $query = "INSERT INTO users (username, address, phone_number, email, password, role)
                VALUES (:username, :address, :phone_number, :email, :password, :role)";
        
        $this->db->query($query);
        $this->db->bind('username', $data['username']);
        $this->db->bind('address', $data['address']);
        $this->db->bind('phone_number', $data['phone_number']);
        $this->db->bind('email', $data['email']);
        $this->db->bind('password', $data['password']);
        $this->db->bind('role', $data['role']);

        $this->db->execute();
        return $this->db->rowCount();
    }
    public function editUser($id)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE id=:id');
        $this->db->bind('id', $id);
        return $this->db->single();
    }


    public function hapusDataUser($id)
    {
        $query = "DELETE FROM users WHERE id = :id";
        
        $this->db->query($query);
        $this->db->bind('id', $id);

        $this->db->execute();

        return $this->db->rowCount();
    }


    public function ubahDataUser($data)
    {
        $query = "UPDATE users SET
                    username = :username,
                    email = :email,
                    address = :address,
                    phone_number = :phone_number,
                    password = :password,
                    role = :role
                  WHERE id = :id";
        
        $this->db->query($query);
        $this->db->bind('username', $data['username']);
        $this->db->bind('email', $data['email']);
        $this->db->bind('address', $data['address']);
        $this->db->bind('phone_number', $data['phone_number']);
        $this->db->bind('password', $data['password']);
        $this->db->bind('role', $data['role']);
        $this->db->bind('id', $data['id']);

        $this->db->execute();

        return $this->db->rowCount();
    }


    public function cariDataUser()
    {
        $keyword = $_POST['keyword'];
        $query = "SELECT * FROM 'users' WHERE name LIKE :keyword";
        $this->db->query($query);
        $this->db->bind('keyword', "%$keyword%");
        return $this->db->resultSet();
    }

}