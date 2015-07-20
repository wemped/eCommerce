<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model('Product');
    }

    public function search(){
        $viewdata['products'] = $this->Product->search();
        $viewdata['num_pages'] = ceil($this->Product->count_search()['num_products']/5);
        //var_dump($this->input->post());die();
        if($this->input->post('page')){
            $viewdata['curr_page'] = $this->input->post('page');
        }else{
            $viewdata['curr_page'] = 1;
        }
        $this->load->view('partials/admin_table',$viewdata);
    }

    public function index()
    {
        $this->load->view('admin_index');
    }

    public function add(){
        if($this->input->post()){
            $this->Product->add_product();
            redirect('/products');
        }else{
            $this->load->view('add_product');
        }
    }
}
