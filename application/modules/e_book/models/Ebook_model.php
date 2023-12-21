<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Ebook_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_data($limit=1000, $offset=0) {
        $this->db->select('e.id, e.book_title, e.image_file, e.pdf_file, e.status, c.category_name_en');
        $this->db->from('ebook e');        
        $this->db->join('ebook_category c', 'c.id=e.category_id', 'LEFT');
        $this->db->limit($limit);
        $this->db->offset($offset);
        $this->db->order_by('e.id', 'DESC');
        // Search Filter
        if($this->input->get('category') != NULL){
            $this->db->where('e.category_id', $this->input->get('category')); 
        }
        $result['rows'] = $this->db->get()->result();
        // echo $this->db->last_query(); exit;

        // count query
        $q = $this->db->select('COUNT(*) as count');
        $this->db->from('ebook');        
        // Search Filter
        if($this->input->get('category') != NULL){
            $this->db->where('category_id', $this->input->get('category')); 
        }
        $tmp = $this->db->get()->result();
        $result['num_rows'] = $tmp[0]->count;

        return $result;
    }    

    public function get_info($id) {
        $this->db->select('e.id, e.book_title, e.description, e.image_file, e.pdf_file, e.total_page, e.status, e.category_id, c.category_name_en');
        $this->db->from('ebook e');        
        $this->db->join('ebook_category c', 'c.id=e.category_id', 'LEFT');
        $this->db->where('e.id', $id);
        $query = $this->db->get();

        $num = $query->num_rows();
        if($num){
            $query = $query->row();
            return $query;
        }else{
            return false;
        }
        //return $query;
    }

    public function get_book_indexs($id) {
        $this->db->select('id, ebook_id, index_title, page_no');
        $this->db->from('ebook_index');
        $this->db->where('ebook_id', $id);
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get()->result();

        return $query;
    }    


    function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('ebook');
        
        return TRUE;
    }

}
