<?php 

class DashboardCategory extends Controller {

    public function index()
    {
        $data['judul'] = 'Daftar User';
        $data['category'] = $this->model('Dashboard_category_model')->getAllCategory();
        $this->view('template-admin/header', $data);
        $this->view('template-admin/sidebar', $data);
        $this->view('dashboard/category/index', $data);
        $this->view('template-admin/footer');
    }

    public function create() {
        $data['judul'] = 'Daftar User';
        $data['category'] = $this->model('Dashboard_category_model')->getAllCategory();
        $this->view('template-admin/header', $data);
        $this->view('template-admin/sidebar', $data);
        $this->view('dashboard/category/create', $data);
        $this->view('template-admin/footer');
    }

    public function tambah()
    {
        if( $this->model('Dashboard_category_model')->tambahDataCategory($_POST) > 0 ) {
            Flasher::setFlash('berhasil', 'ditambahkan', 'success');
            header('Location: ' . BASEURL . '/DashboardCategory');
            exit;
        } else {
            Flasher::setFlash('gagal', 'ditambahkan', 'danger');
            header('Location: ' . BASEURL . '/DashboardCategory');
            exit;
        }
    }

    public function hapus($id)
    {
        if( $this->model('Dashboard_category_model')->hapusDataCategory($id) > 0 ) {
            Flasher::setFlash('berhasil', 'dihapus', 'success');
            header('Location: ' . BASEURL . '/DashboardCategory');
            exit;
        } else {
            Flasher::setFlash('gagal', 'dihapus', 'danger');
            header('Location: ' . BASEURL . '/DashboardCategory');
            exit;
        }
    }

}