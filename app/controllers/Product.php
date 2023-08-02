<?php 

class Product extends Controller {
    
    public function index()
    {
        $data['judul'] = 'Daftar Product';
        $productModel = $this->model('Dashboard_product_model');
        $data['products'] = $productModel->getAllProduct();

        // Number of items per page
        $itemsPerPage = 6;

        // Get the total number of products
        $totalProducts = count($data['products']);

        // Get the current page from the URL (e.g., ?page=2)
        $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;

        // Calculate the offset for pagination
        $offset = ($currentPage - 1) * $itemsPerPage;

        // Get a subset of products based on the current page
        $data['products'] = array_slice($data['products'], $offset, $itemsPerPage);

        // Calculate the total number of pages
        $totalPages = ceil($totalProducts / $itemsPerPage);

        // Pass the total number of products and current page to the view
        $data['totalProducts'] = $totalProducts;
        $data['currentPage'] = $currentPage;
        $data['totalPages'] = $totalPages;

        $this->view('templates/header', $data);
        $this->view('product/index', $data);
        $this->view('templates/footer');
    }
    
    public function detail($id)
    {
        $data['judul'] = 'Detail Product';
        $productModel = $this->model('Dashboard_product_model');
        $data['product'] = $productModel->getProductById($id);

        if (!$data['product']) {
            // Handle case when product with the given ID is not found
            Flasher::setFlash('Error', 'Product not found', 'danger');
            header('Location: ' . BASEURL . '/Product');
            exit;
        }

        // Get related products (in this example, products from the same category)
        $relatedProducts = $productModel->getRelatedProducts($id);
        $data['relatedProducts'] = $relatedProducts;

        $this->view('templates/header', $data);
        $this->view('product/detail', $data);
        $this->view('templates/footer');
    }
    public function checkout($id)
    {
        $data['judul'] = 'Detail Product';
        $productModel = $this->model('Dashboard_product_model');
        $data['product'] = $productModel->getProductById($id);

        if (!$data['product']) {
            // Handle case when product with the given ID is not found
            Flasher::setFlash('Error', 'Product not found', 'danger');
            header('Location: ' . BASEURL . '/Product');
            exit;
        }

        $this->view('templates/header', $data);
        $this->view('product/checkout', $data);
        $this->view('templates/footer');
    }
    public function AddCheckout()
    {
       
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['place_order'])) {
            
            $buyerId = $_POST['buyer_id'];
            $sellerId = $_POST['seller_id'];
            $productId = $_POST['product_id'];
            $productQuantity = $_POST['product_quantity'];
            $totalPrice = $data['product']['price'] * $productQuantity; 
            $transactionDate = date('Y-m-d H:i:s'); 

            $this->model('Transaction_model')->insertTransaction($buyerId, $sellerId, $productId, $productQuantity, $totalPrice, $transactionDate);

        }

    }
    public function createTransactionWithPayment() {
        if( $this->model('Transaction_model')->createTransactionWithPayment($_POST) > 0 ) {
            Flasher::setFlash('pesanan', 'berhasil di order', 'success');
            header('Location: ' . BASEURL . '/Product');
            exit;
        } else {
            Flasher::setFlash('gagal', 'ditambahkan', 'danger');
            header('Location: ' . BASEURL . '/Product');
            exit;
        }
    }

    public function create() {
        $data['judul'] = 'Daftar Product';
        $productModel = $this->model('Dashboard_product_model');
        $data['categories'] = $productModel->getAllCategories(); // Fetch categories
        $this->view('templates/header', $data);
        $this->view('product/create', $data);
        $this->view('templates/footer');
    }
    public function edit($id) {
        $data['judul'] = 'Daftar Product';
        $data['product'] = $this->model('Dashboard_product_model')->editProduct($id);
        $this->view('templates/header', $data);
        $this->view('product/index', $data);
        $this->view('templates/footer');
    }

    public function tambah()
    {
        
        if( $this->model('Dashboard_artikel_model')->tambahDataProduct($_POST) > 0 ) {
            Flasher::setFlash('berhasil', 'ditambahkan', 'success');
            header('Location: ' . BASEURL . '/Product');
            exit;
        } else {
            Flasher::setFlash('gagal', 'ditambahkan', 'danger');
            header('Location: ' . BASEURL . '/Product');
            exit;
        }
    }

    public function hapus($id)
    {
        if( $this->model('Dashboard_product_model')->hapusDataProduct($id) > 0 ) {
            Flasher::setFlash('berhasil', 'dihapus', 'success');
            header('Location: ' . BASEURL . '/Product');
            exit;
        } else {
            Flasher::setFlash('gagal', 'dihapus', 'danger');
            header('Location: ' . BASEURL . '/Product');
            exit;
        }
    }

    public function getubah()
    {
        echo json_encode($this->model('Dashboard_product_model')->getProductById($_POST['id']));
    }

    public function ubah()
    {
        if( $this->model('Dashboard_product_model')->ubahDataProduct($_POST) > 0 ) {
            Flasher::setFlash('berhasil', 'diubah', 'success');
            header('Location: ' . BASEURL . '/Product');
            exit;
        } else {
            Flasher::setFlash('gagal', 'diubah', 'danger');
            header('Location: ' . BASEURL . '/Product');
            exit;
        } 
    }
    public function cart(){
        $this->view('templates/header');
        $this->view('product/cart');
        $this->view('templates/footer');
    }

    public function addToCart()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $productId = $_POST['product_id'];
            $quantity = $_POST['quantity'];

            // Get the product details from the database
            $productModel = $this->model('Dashboard_product_model');
            $product = $productModel->getProductById($productId);

            if (!$product) {
                // Handle the case when the product is not found, e.g., show an error message
                Flasher::setFlash('Error', 'Product not found', 'danger');
            } else {
                // Create an associative array representing the cart item
                $cartItem = [
                    'product_id' => $product['id'],
                    'product_name' => $product['product_name'],
                    'product_image' => $product['images'][0],
                    'price' => $product['price'],
                    'quantity' => $quantity
                ];

                // Initialize the cart session if it does not exist
                if (!isset($_SESSION['cart'])) {
                    $_SESSION['cart'] = [];
                }

                // Check if the product is already in the cart, update the quantity if found
                $found = false;
                foreach ($_SESSION['cart'] as &$item) {
                    if ($item['product_id'] === $productId) {
                        $item['quantity'] += $quantity;
                        $found = true;
                        break;
                    }
                }

                // If not found, add the product to the cart
                if (!$found) {
                    $_SESSION['cart'][] = $cartItem;
                }

                // Show a success message indicating the product has been added to the cart
                Flasher::setFlash('Success', 'Product added to cart', 'success');
            }
        }

        // Redirect to the product detail page after adding the product to the cart
        header('Location: ' . BASEURL . '/Product/detail/' . $productId);
        exit;
    }

    public function RemoveFromCart($id)
    {
        // Periksa apakah sesi keranjang ada
        if (isset($_SESSION['cart'])) {
            // Cari indeks produk yang ingin dihapus di sesi keranjang
            $index = -1;
            foreach ($_SESSION['cart'] as $key => $cartItem) {
                if ($cartItem['product_id'] === $id) {
                    $index = $key;
                    break;
                }
            }

            // Debug: Tampilkan informasi produk yang akan dihapus dan indeksnya
            echo "Product ID to be removed: $id<br>";
            echo "Index of the product to be removed: $index<br>";
            
            // Jika produk ditemukan, hapus produk dari sesi keranjang
            if ($index !== -1) {
                unset($_SESSION['cart'][$index]);

                // Tampilkan pesan sukses bahwa produk telah dihapus dari keranjang
                Flasher::setFlash('Sukses', 'Produk dihapus dari keranjang', 'success');
            } else {
                // Tampilkan pesan kesalahan bahwa produk tidak ditemukan di dalam keranjang
                Flasher::setFlash('Kesalahan', 'Produk tidak ditemukan di dalam keranjang', 'danger');
            }
        } else {
            // Tampilkan pesan kesalahan bahwa keranjang belanja kosong
            Flasher::setFlash('Kesalahan', 'Keranjang belanja kosong', 'danger');
        }

        // Alihkan kembali ke halaman keranjang belanja
        header('Location: ' . BASEURL . '/product/cart');
        exit;
    }

}