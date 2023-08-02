<?php 

class Home extends Controller {
    public function index()
    {
        $data['judul'] = 'Home';
        $data['product'] = $this->model('Dashboard_product_model')->getLatestProduct();
        $this->view('templates/header', $data);
        $this->view('home/index', $data);
        $this->view('templates/footer');
    }

    public function about() {
        $this->view('templates/header');
        $this->view('about/index');
        $this->view('templates/footer');
    }
}