<?php 

class Dashboard extends Controller {
    public function index()
    {
        
        $data['judul'] = 'Home';
        $data['users'] = $this->model('Dashboard_model')->getCountUsers();
        $data['event'] = $this->model('Dashboard_model')->getCountProduct();
        $data['participant'] = $this->model('Dashboard_model')->getCountCategory();
        $this->view('template-admin/header', $data);
        $this->view('template-admin/sidebar', $data);
        $this->view('dashboard/index', $data);
        $this->view('template-admin/footer');
    }
}