<?php 

class DashboardArtikel extends Controller {

    public function index()
    {
        $data['judul'] = 'Daftar Artikel';
        $data['article'] = $this->model('Dashboard_artikel_model')->getAllArticle();
        $this->view('template-admin/header', $data);
        $this->view('template-admin/sidebar', $data);
        $this->view('dashboard/article/index', $data);
        $this->view('template-admin/footer');
    }
    public function AllPost()
    {
        $data['judul'] = 'Daftar Artikel';
        $data['article'] = $this->model('Dashboard_artikel_model')->getAllArticle();
        $this->view('templates/header', $data);
        $this->view('article/index', $data);
        $this->view('templates/footer');
    }

    public function detail($id)
    {
        $data['judul'] = 'Detail Event';
        $data['article'] = $this->model('Dashboard_artikel_model')->detail($id);
        $this->view('templates/header', $data);
        $this->view('article/detail', $data);
        $this->view('templates/footer');
    }
    public function opini()
    {
        $opini = 'Opini';
        $data['judul'] = 'Detail Event';
        $data['article'] = $this->model('Dashboard_artikel_model')->getOpini($opini);
        $this->view('templates/header', $data);
        $this->view('article/opini', $data);
        $this->view('templates/footer');
    }

    public function create() {
        $data['judul'] = 'Daftar Artikel';
        $data['category'] = $this->model('Dashboard_category_model')->getAllCategory();
        $this->view('template-admin/header', $data);
        $this->view('template-admin/sidebar', $data);
        $this->view('dashboard/article/create', $data);
        $this->view('template-admin/footer');
    }
    public function edit($id) {
        $data['judul'] = 'Daftar Artikel';
        $data['article'] = $this->model('Dashboard_artikel_model')->editArticle($id);
        $data['category'] = $this->model('Dashboard_category_model')->getAllCategory();
        $this->view('template-admin/header', $data);
        $this->view('template-admin/sidebar', $data);
        $this->view('dashboard/article/edit', $data);
        $this->view('template-admin/footer');
    }

    public function tambah()
    {
        
        if( $this->model('Dashboard_artikel_model')->tambahDataArticle($_POST) > 0 ) {
            Flasher::setFlash('berhasil', 'ditambahkan', 'success');
            header('Location: ' . BASEURL . '/DashboardArtikel');
            exit;
        } else {
            Flasher::setFlash('gagal', 'ditambahkan', 'danger');
            header('Location: ' . BASEURL . '/DashboardArtikel');
            exit;
        }
    }

    public function hapus($id)
    {
        if( $this->model('Dashboard_artikel_model')->hapusDataArticle($id) > 0 ) {
            Flasher::setFlash('berhasil', 'dihapus', 'success');
            header('Location: ' . BASEURL . '/DashboardArtikel');
            exit;
        } else {
            Flasher::setFlash('gagal', 'dihapus', 'danger');
            header('Location: ' . BASEURL . '/DashboardArtikel');
            exit;
        }
    }

    public function getubah()
    {
        echo json_encode($this->model('Dashboard_artikel_model')->getArticleById($_POST['id']));
    }

    public function ubah()
    {
        if( $this->model('Dashboard_artikel_model')->ubahDataArticle($_POST) > 0 ) {
            Flasher::setFlash('berhasil', 'diubah', 'success');
            header('Location: ' . BASEURL . '/DashboardArtikel');
            exit;
        } else {
            Flasher::setFlash('gagal', 'diubah', 'danger');
            header('Location: ' . BASEURL . '/DashboardArtikel');
            exit;
        } 
    }

    public function cari()
    {
        $data['judul'] = 'Daftar Artikel';
        $data['article'] = $this->model('Dashboard_artikel_model')->cariDataArticle();
        $this->view('template-admin/header', $data);
        $this->view('template-admin/sidebar', $data);
        $this->view('dashboard/article/index', $data);
        $this->view('template-admin/footer');
    }
    
}