<?php 

class Dashboard_artikel_model {
    private $table = 'articles';
    private $imageTable = 'image';
    private $ProductTable = 'products';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllArticle()
    {
        $query = "SELECT articles.*, image.image AS image_filename 
              FROM $this->table AS articles
              LEFT JOIN $this->imageTable AS image ON articles.id = image.article_id";
    
        $this->db->query($query);
        $results = $this->db->resultSet();

        // Group events by ID and collect associated images
        $events = [];
        foreach ($results as $row) {
            $event_id = $row['id'];

            if (!isset($events[$event_id])) {
                // Create a new event entry
                $events[$event_id] = [
                    'id' => $event_id,
                    'title' => $row['title'],
                    'content' => $row['content'],
                    'publish_date' => $row['publish_date'],
                    'author_id' => $row['author_id'],
                    'category_id' => $row['category_id'],
                    'images' => []
                ];
            }

            if (!empty($row['image_filename'])) {
                // Add image filename to the event's images array
                $events[$event_id]['images'][] = $row['image_filename'];
            }
        }

        return array_values($events);
    }

    public function getArticleById($id)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE id=:id');
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    public function editArticle($id)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE id=:id');
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    public function tambahDataProduct($data)
    {
        $query = "INSERT INTO $this->ProductTable (product_name, price, category, status, description, seller_id, posting_date, stock)
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
        $article_id = $this->db->lastInsertId();

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
                    $query = "INSERT INTO $this->imageTable (article_id, image)
                            VALUES (:article_id, :image)";

                    $this->db->query($query);
                    $this->db->bind('article_id', $article_id);
                    $this->db->bind('image', $image_filename);
                    $this->db->execute();
                }
            }
        }

        return $this->db->rowCount();
    }



    public function hapusDataArticle($id)
    {
        // Delete associated images from the 'image' table
        $query = "DELETE FROM $this->imageTable WHERE article_id = :article_id";
        
        $this->db->query($query);
        $this->db->bind('article_id', $id);

        $this->db->execute();

        // Delete event from the 'event' table
        $query = "DELETE FROM $this->table WHERE id = :id";
        
        $this->db->query($query);
        $this->db->bind('id', $id);

        $this->db->execute();

        

        return $this->db->rowCount();
    }


    public function ubahDataArticle($data)
    {
        $query = "UPDATE articles SET
                    title = :title,
                    content = :content,
                    publish_date = :publish_date,
                    author_id = :author_id,
                    category_id = :category_id
                  WHERE id = :id";
        
        $this->db->query($query);
        $this->db->bind('title', $data['title']);
        $this->db->bind('content', $data['content']);
        $this->db->bind('publish_date', $data['publish_date']);
        $this->db->bind('author_id', $data['author_id']);
        $this->db->bind('category_id', $data['category_id']);
        $this->db->bind('id', $data['id']);

        $this->db->execute();

        return $this->db->rowCount();
    }


    public function cariDataArticle()
    {
        $keyword = $_POST['keyword'];
        $query = "SELECT * FROM 'articles' WHERE title LIKE :keyword";
        $this->db->query($query);
        $this->db->bind('keyword', "%$keyword%");
        return $this->db->resultSet();
    }

    public function getLatestArticle($limit = 6)
    {
        $query = "SELECT articles.*, image.image AS image_filename 
              FROM $this->table AS articles
              LEFT JOIN $this->imageTable AS image ON articles.id = image.article_id
              ORDER BY articles.publish_date DESC
              LIMIT :limit";
    
        $this->db->query($query);
        $this->db->bind('limit', $limit);
        $results = $this->db->resultSet();

        // Group events by ID and collect associated images
        $article = [];
        foreach ($results as $row) {
            $article_id = $row['id'];

            if (!isset($article[$article_id])) {
                // Create a new event entry
                $article[$article_id] = [
                    'id' => $article_id,
                    'title' => $row['title'],
                    'content' => $row['content'],
                    'publish_date' => $row['publish_date'],
                    'author_id' => $row['author_id'],
                    'category_id' => $row['category_id'],
                    'images' => []
                ];
            }

            if (!empty($row['image_filename'])) {
                // Add image filename to the event's images array
                $article[$article_id]['images'][] = $row['image_filename'];
            }
        }

        return array_values($article);
        
    }

    public function detail($id)
    {
        $query = "SELECT articles.*, image.image AS image_filename 
            FROM $this->table AS articles
            LEFT JOIN $this->imageTable AS image ON articles.id = image.article_id
            WHERE articles.id = :id";

        $this->db->query($query);
        $this->db->bind('id', $id);
        $result = $this->db->single();

        if (!$result) {
            return null; // Portfolio with the given ID not found
        }

        // Group portfolio images
        $article_images = [];
        if (!empty($result['image_filename'])) {
            $article_images[] = $result['image_filename'];
        }

        $article_details = [
            'id' => $result['id'],
            'title' => $result['title'],
            'author_id' => $result['author_id'],
            'category_id' => $result['category_id'],
            'publish_date' => $result['publish_date'],
            'content' => $result['content'],
            'images' => $article_images
        ];

        return $article_details;
    }
    public function getOpini($categoryID)
    {
        $query = "SELECT articles.*, image.image AS image_filename 
                FROM $this->table AS articles
                LEFT JOIN $this->imageTable AS image ON articles.id = image.article_id
                WHERE articles.category_id = :category_id";
        
        $this->db->query($query);
        $this->db->bind('category_id', $categoryID);
        $results = $this->db->resultSet();

        // Group articles by ID and collect associated images
        $articles = [];
        foreach ($results as $row) {
            $articleID = $row['id'];

            if (!isset($articles[$articleID])) {
                // Create a new article entry
                $articles[$articleID] = [
                    'id' => $articleID,
                    'title' => $row['title'],
                    'content' => $row['content'],
                    'publish_date' => $row['publish_date'],
                    'author_id' => $row['author_id'],
                    'category_id' => $row['category_id'],
                    'images' => []
                ];
            }

            if (!empty($row['image_filename'])) {
                // Add image filename to the article's images array
                $articles[$articleID]['images'][] = $row['image_filename'];
            }
        }

        return array_values($articles);
    }

}


