<?php 

class Dashboard_product_model {
    private $table = 'products';
    private $imageTable = 'image';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllProduct()
    {
        $query = "SELECT products.*, image.image AS image_filename 
            FROM $this->table AS products
            LEFT JOIN $this->imageTable AS image ON products.id = image.product_id";

        $this->db->query($query);
        $results = $this->db->resultSet();

        $products = [];
        foreach ($results as $row) {
            $product_id = $row['id'];

            if (!isset($products[$product_id])) {

                $products[$product_id] = [
                    'id' => $product_id,
                    'product_name' => $row['product_name'],
                    'description' => $row['description'],
                    'category' => $row['category'],
                    'price' => $row['price'],
                    'stock' => $row['stock'],
                    'status' => $row['status'],
                    'seller_id' => $row['seller_id'],
                    'posting_date' => $row['posting_date'],
                    'images' => []
                ];
            }

            if (!empty($row['image_filename'])) {
                $products[$product_id]['images'][] = $row['image_filename'];
            }
        }

        return array_values($products);
    }


    public function getProductById($id)
    {
        $query = "SELECT products.*, image.image AS image_filename 
            FROM $this->table AS products
            LEFT JOIN $this->imageTable AS image ON products.id = image.product_id
            WHERE products.id = :id";

        $this->db->query($query);
        $this->db->bind('id', $id);
        $result = $this->db->single();

        if (!$result) {
            return null; 
        }

        
        $product_images = [];
        if (!empty($result['image_filename'])) {
            $product_images[] = $result['image_filename'];
        }

        $product_details = [
            'id' => $result['id'],
            'product_name' => $result['product_name'],
            'description' => $result['description'],
            'category' => $result['category'],
            'price' => $result['price'],
            'stock' => $result['stock'],
            'status' => $result['status'],
            'seller_id' => $result['seller_id'],
            'posting_date' => $result['posting_date'],
            'images' => $product_images
        ];

        return $product_details;
    }

    public function editProduct($id)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE id=:id');
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    public function tambahDataProduct($data)
    {
        
        $query = "INSERT INTO $this->table (product_name, price, category, status, description, seller_id, posting_date, stock)
                VALUES (:product_name, :price, :category, :status, :description, :seller_id, :posting_date, :stock)";

        $this->db->query($query);
        $this->db->bind('product_name', $data['product_name']);
        $this->db->bind('price', $data['price']);
        $this->db->bind('stock', $data['stock']);
        $this->db->bind('category', $data['category']);
        $this->db->bind('status', $data['status']);
        $this->db->bind('description', $data['description']);
        $this->db->bind('seller_id', $data['seller_id']);
        $this->db->bind('posting_date', $data['posting_date']);
        

        $this->db->execute();
        $product_id = $this->db->lastInsertId();

        // Handle image upload and insertion into the 'image' table
        if (isset($_FILES['images'])) {
            $images = $_FILES['images'];

            foreach ($images['tmp_name'] as $key => $tmp_name) {
                // Check if the uploaded file is valid
                if ($images['error'][$key] === UPLOAD_ERR_OK) {
                    // Retrieve the image details
                    $image_name = $images['name'][$key];
                    $image_type = $images['type'][$key];
                    $image_size = $images['size'][$key];
                    $image_tmp_name = $images['tmp_name'][$key];

                    // Specify the directory to store the uploaded images
                    $upload_dir = 'C:/xampp/htdocs/marketplace/public/images/'; // Change the directory path as per your requirement

                    // Generate a unique filename for the image
                    $image_filename = uniqid() . '_' . $image_name;

                    // Move the uploaded image to the desired directory
                    move_uploaded_file($image_tmp_name, $upload_dir . $image_filename);

                    // Insert image details into the 'image' table
                    $query = "INSERT INTO $this->imageTable (product_id, image)
                            VALUES (:product_id, :image)";

                    $this->db->query($query);
                    $this->db->bind('product_id', $product_id);
                    $this->db->bind('image', $image_filename);
                    $this->db->execute();
                }
            }
        }

        return $this->db->rowCount();
    }



    public function hapusDataProduct($id)
    {
        
        $query = "DELETE FROM $this->imageTable WHERE product_id = :product_id";
        
        $this->db->query($query);
        $this->db->bind('product_id', $id);

        $this->db->execute();

        $query = "DELETE FROM $this->table WHERE id = :id";
        
        $this->db->query($query);
        $this->db->bind('id', $id);

        $this->db->execute();

        return $this->db->rowCount();
    }


    public function ubahDataProduct($data)
    {
        $query = "UPDATE $this->table SET
                    product_name  = :product_name ,
                    price = :price,
                    stock = :stock,
                    category = :category,
                    posting_date = :posting_date,
                    status = :status,
                    seller_id = :seller_id,
                    description = :description
                WHERE id = :id";

        $this->db->query($query);
        $this->db->bind('product_name', $data['product_name']);
        $this->db->bind('description', $data['description']);
        $this->db->bind('category', $data['category']);
        $this->db->bind('price', $data['price']);
        $this->db->bind('stock', $data['stock']);
        $this->db->bind('status', $data['status']);
        $this->db->bind('seller_id', $data['seller_id']);
        $this->db->bind('posting_date', $data['posting_date']);
        $this->db->bind('id', $data['id']);

        $this->db->execute();

        
        if (isset($_FILES['images'])) {
            
            $deleteQuery = "DELETE FROM $this->imageTable WHERE product_id = :product_id";
            $this->db->query($deleteQuery);
            $this->db->bind('product_id', $data['id']);
            $this->db->execute();

            
            $images = $_FILES['images'];
            foreach ($images['tmp_name'] as $key => $tmp_name) {
                
                if ($images['error'][$key] === UPLOAD_ERR_OK) {
                    
                    $image_name = $images['name'][$key];
                    $image_type = $images['type'][$key];
                    $image_size = $images['size'][$key];
                    $image_tmp_name = $images['tmp_name'][$key];

                    
                    $upload_dir = 'C:/xampp/htdocs/marketplace/public/images/'; 

                    
                    $image_filename = uniqid() . '_' . $image_name;

                    
                    move_uploaded_file($image_tmp_name, $upload_dir . $image_filename);

                    
                    $query = "INSERT INTO $this->imageTable (product_id, image)
                            VALUES (:product_id, :image)";

                    $this->db->query($query);
                    $this->db->bind('product_id', $data['id']);
                    $this->db->bind('image', $image_filename);
                    $this->db->execute();
                }
            }
        }

        return $this->db->rowCount();
    }



    public function getLatestProduct($limit = 4)
    {
        $query = "SELECT products.*, image.image AS image_filename 
              FROM $this->table AS products
              LEFT JOIN $this->imageTable AS image ON products.id = image.product_id
              ORDER BY products.posting_date DESC
              LIMIT :limit";
    
        $this->db->query($query);
        $this->db->bind('limit', $limit);
        $results = $this->db->resultSet();

        $products = [];
        foreach ($results as $row) {
            $product_id = $row['id'];

            if (!isset($products[$product_id])) {

                $products[$product_id] = [
                    'id' => $product_id,
                    'product_name' => $row['product_name'],
                    'description' => $row['description'],
                    'category' => $row['category'],
                    'price' => $row['price'],
                    'stock' => $row['stock'],
                    'status' => $row['status'],
                    'seller_id' => $row['seller_id'],
                    'posting_date' => $row['posting_date'],
                    'images' => []
                ];
            }

            if (!empty($row['image_filename'])) {
                $products[$product_id]['images'][] = $row['image_filename'];
            }
        }

        return array_values($products);
        
    }


    public function detail($id)
    {
        $query = "SELECT products.*, image.image AS image_filename 
            FROM $this->table AS products
            LEFT JOIN $this->imageTable AS image ON products.id = image.product_id
            WHERE products.id = :id";

        $this->db->query($query);
        $this->db->bind('id', $id);
        $result = $this->db->single();

        if (!$result) {
            return null; 
        }

        
        $product_images = [];
        if (!empty($result['image_filename'])) {
            $product_images[] = $result['image_filename'];
        }

        $product_details = [
            'id' => $result['id'],
            'product_name ' => $result['product_name '],
            'description ' => $result['description '],
            'category' => $result['category'],
            'price' => $result['price'],
            'stock' => $result['stock'],
            'status' => $result['status'],
            'seller_id' => $result['seller_id'],
            'posting_date' => $result['posting_date'],
            'images' => $product_images
        ];

        return $product_details;
    }


    public function getImageFilenamesByProductId($productId)
    {
        $query = "SELECT image FROM $this->imageTable WHERE product_id = :product_id";
        $this->db->query($query);
        $this->db->bind('product_id', $productId);
        $results = $this->db->resultSet();

        $imageFilenames = [];
        foreach ($results as $row) {
            $imageFilenames[] = $row['image'];
        }

        return $imageFilenames;
    }

    public function getRelatedProducts($productId, $limit = 4)
    {
        $product = $this->getProductById($productId);

        if (!$product) {
            return [];
        }
        

        $categoryId = $product['category'];
        $query = "SELECT products.*, image.image AS image_filename 
                FROM $this->table AS products
                LEFT JOIN $this->imageTable AS image ON products.id = image.product_id
                WHERE products.id <> :productId AND products.category = :categoryId
                ORDER BY products.posting_date DESC
                LIMIT :limit";

        $this->db->query($query);
        $this->db->bind(':productId', $productId);
        $this->db->bind(':categoryId', $categoryId);
        $this->db->bind(':limit', $limit);
        $results = $this->db->resultSet();

        $relatedProducts = [];
        foreach ($results as $row) {
            $relatedProducts[] = [
                'id' => $row['id'],
                'product_name' => $row['product_name'],
                'description' => $row['description'],
                'category' => $row['category'],
                'price' => $row['price'],
                'stock' => $row['stock'],
                'status' => $row['status'],
                'seller_id' => $row['seller_id'],
                'posting_date' => $row['posting_date'],
                'images' => [$row['image_filename']]
            ];
        }

        return $relatedProducts;
    }

    public function getAllCategories()
    {
        $query = "SELECT * FROM categories";
        $this->db->query($query);
        return $this->db->resultSet();
    }

}