<?php 

class DashboardUser extends Controller {

    public function index()
    {
        $data['judul'] = 'Daftar User';
        $data['user'] = $this->model('Dashboard_user_model')->getAllUsers();
        $this->view('template-admin/header', $data);
        $this->view('template-admin/sidebar', $data);
        $this->view('dashboard/users/index', $data);
        $this->view('template-admin/footer');
    }

    public function detail($id)
    {
        $data['judul'] = 'Detail User';
        $data['user'] = $this->model('Dashboard_user_model')->getUserById($id);
        $this->view('template-admin/header', $data);
        $this->view('template-admin/sidebar', $data);
        $this->view('dashboard/users/detail', $data);
        $this->view('template-admin/footer');
    }

    public function create() {
        $data['judul'] = 'Daftar User';
        $data['user'] = $this->model('Dashboard_user_model')->getAllUsers();
        $this->view('template-admin/header', $data);
        $this->view('template-admin/sidebar', $data);
        $this->view('dashboard/users/create', $data);
        $this->view('template-admin/footer');
    }

    public function tambah()
    {
        if( $this->model('Dashboard_user_model')->tambahDataUser($_POST) > 0 ) {
            Flasher::setFlash('berhasil', 'ditambahkan', 'success');
            header('Location: ' . BASEURL . '/DashboardUser');
            exit;
        } else {
            Flasher::setFlash('gagal', 'ditambahkan', 'danger');
            header('Location: ' . BASEURL . '/DashboardUser');
            exit;
        }
    }

    public function hapus($id)
    {
        if( $this->model('Dashboard_user_model')->hapusDataUser($id) > 0 ) {
            Flasher::setFlash('berhasil', 'dihapus', 'success');
            header('Location: ' . BASEURL . '/DashboardUser');
            exit;
        } else {
            Flasher::setFlash('gagal', 'dihapus', 'danger');
            header('Location: ' . BASEURL . '/DashboardUser');
            exit;
        }
    }

    public function edit($id) {
        $data['judul'] = 'Edit User';
        $data['user'] = $this->model('Dashboard_User_model')->editUser($id);
        $this->view('template-admin/header', $data);
        $this->view('template-admin/sidebar', $data);
        $this->view('dashboard/users/edit', $data);
        $this->view('template-admin/footer');
    }
    public function getubah()
    {
        echo json_encode($this->model('Dashboard_user_model')->getUserById($_POST['id']));
    }

    public function ubah()
    {
        if( $this->model('Dashboard_user_model')->ubahDataUser($_POST) > 0 ) {
            Flasher::setFlash('berhasil', 'diubah', 'success');
            header('Location: ' . BASEURL . '/DashboardUser');
            exit;
        } else {
            Flasher::setFlash('gagal', 'diubah', 'danger');
            header('Location: ' . BASEURL . '/DashboardUser');
            exit;
        } 
    }

    public function cari()
    {
        $data['judul'] = 'Daftar Event';
        $data['event'] = $this->model('Dashboard_user_model')->cariDataUser();
        $this->view('template-admin/header', $data);
        $this->view('template-admin/sidebar', $data);
        $this->view('dashboard/users/index', $data);
        $this->view('template-admin/footer');
    }
}