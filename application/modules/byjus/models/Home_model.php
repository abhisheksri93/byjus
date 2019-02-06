<?php

class Home_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getUser()
    {
        $this->db->select('');
        $this->db->from('users');

        if ($this->input->post_get("search_by")) {
            $search_by = $this->input->post_get("search_by");
            $this->db->where("( userName LIKE '$search_by%' ) ");
        }

        $this->db->limit(10);
        $page = ($this->input->post_get('page')) ? (($this->input->post_get('page') - 1) * 10) : 0;
        $this->db->offset($page);

        $query = $this->db->get();

        return $query->result_array();
    }

    public function getUserCount()
    {
        $this->db->select('');
        $this->db->from('users');

        if ($this->input->post_get("search_by")) {
            $search_by = $this->input->post_get("search_by");
            $this->db->where("( userName LIKE '$search_by%' ) ");
        }

        $query = $this->db->get();

        return $query->num_rows();
    }
}

?>