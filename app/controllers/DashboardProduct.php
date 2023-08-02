<?php 

class DashboardProduct extends Controller {

    public function index()
    {
        $data['judul'] = 'Daftar Product';
        $data['product'] = $this->model('Dashboard_product_model')->getAllProduct();
        $this->view('template-admin/header', $data);
        $this->view('template-admin/sidebar', $data);
        $this->view('dashboard/product/index', $data);
        $this->view('template-admin/footer');
    }

    public function detail($id)
    {
        $data['judul'] = 'Detail Product';
        $data['product'] = $this->model('Event_model')->getProductById($id);
        $this->view('template-admin/header', $data);
        $this->view('template-admin/sidebar', $data);
        $this->view('dashboard/product/index', $data);
        $this->view('template-admin/footer');
    }

    public function create() {
        $data['judul'] = 'Daftar Product';
        $data['product'] = $this->model('Dashboard_product_model')->getAllProduct();
        $data['category'] = $this->model('Dashboard_category_model')->getAllCategory();
        $this->view('template-admin/header', $data);
        $this->view('template-admin/sidebar', $data);
        $this->view('dashboard/product/create', $data);
        $this->view('template-admin/footer');
    }
    public function edit($id) {
        $data['judul'] = 'Daftar Product';
        $data['product'] = $this->model('Dashboard_product_model')->editProduct($id);
        $data['category'] = $this->model('Dashboard_category_model')->getAllCategory();
        $this->view('template-admin/header', $data);
        $this->view('template-admin/sidebar', $data);
        $this->view('dashboard/product/edit', $data);
        $this->view('template-admin/footer');
    }

    public function tambah()
    {
        
        if( $this->model('Dashboard_product_model')->tambahDataProduct($_POST) > 0 ) {
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
            header('Location: ' . BASEURL . '/DashboardProduct');
            exit;
        } else {
            Flasher::setFlash('gagal', 'dihapus', 'danger');
            header('Location: ' . BASEURL . '/DashboardProduct');
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
            header('Location: ' . BASEURL . '/DashboardProduct');
            exit;
        } else {
            Flasher::setFlash('gagal', 'diubah', 'danger');
            header('Location: ' . BASEURL . '/DashboardProduct');
            exit;
        } 
    }

}