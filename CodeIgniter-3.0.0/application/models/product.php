<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Model{

    public function get_all(){
        return $this->db->query("SELECT * FROM products")->result_array();
    }

    public function search(){
        if($this->input->post('keyword')){
            $keyword  = '%' . $this->input->post('keyword') . '%';
        }else{
            $keyword = '%';
        }
        if($this->input->post('page')){
            $page = ($this->input->post('page') -1) * 5;
        }else{
            $page = 0;
        }
        $query = "SELECT * FROM products
                        WHERE name LIKE ?
                        LIMIT 5 OFFSET ?;";
        $values = array($keyword,$page);
        //var_dump($values);
        return $this->db->query($query,$values)->result_array();
    }
    public function count_search(){
        if($this->input->post('keyword')){
            $keyword  = '%' . $this->input->post('keyword') . '%';
        }else{
            $keyword = '%';
        }
        $query = "SELECT COUNT(*) as num_products FROM products
                        WHERE name LIKE ?;";
        $values = array($keyword);
        //var_dump($values);
        return $this->db->query($query,$values)->row_array();
    }

    public function add_product(){
        $this->load->library("form_validation");
        $this->form_validation->set_rules('name', "Product name", "required|max_length[255]");
        $this->form_validation->set_rules('quantity', "Product quantity", "required");
        $this->form_validation->set_rules('img_src', "Image", 'required');

        if($this->form_validation->run() == FALSE){
            $this->session->set_flashdata('err',validation_errors());
            return FALSE;
        }
        $query = "INSERT INTO products (name,quantity,img_src,sold,created_at,updated_at)
                                        VALUES (?,?,?,0,NOW(),NOW());";
        $values = array( $this->input->post('name'),
                                  $this->input->post('quantity'),
                                  $this->input->post('img_src'));

        if($this->db->query($query,$values)){
            return TRUE;
        }else{
            $this->session->set_flashdata('err',"Database error, product not added");
            return FALSE;
        }
    }
}