<?php

class Common_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    /* Simple SELECT queries
 *
 * Example input parameters:-
 * $where = array('name'=>'rohit','id'=>2);
 * $order_by = 'id desc, name asc';
 */
    public function get_data($table, $where = NULL, $order_by = NULL, $type = NULL, $column = NULL)
    {
        if ($column) {
            $this->db->select($column);
        }
        if (!empty($where)) {
            $this->db->where($where);
        }
        if (!empty($order_by)) {
            $this->db->order_by($order_by);
        }

        $res = $this->db->get($this->db->dbprefix($table));

        if (!empty($type) and $type == "array") {
            return $res->result_array();
        }

        return $res->result();
    }

    public function get_single_data($table, $where = NULL, $order_by = NULL, $column = NULL)
    {
        if ($column) {
            $this->db->select($column);
        }
        if (!empty($where)) {
            $this->db->where($where);
        }
        if (!empty($order_by)) {
            $this->db->order_by($order_by);
        }

        $res = $this->db->get($this->db->dbprefix($table));
        return $res->row();
    }

    function getSendMailData($id)
    {
        $id = $id['id'];
        $query = $this->db->select("vad.*, va.date_of_arrival as arrival_date ,va.service_type, vt.name as visa_type, c.name as nationality")
            ->from("visa_applicant_details vad")
            ->join("visa_applicants va", "va.visa_id = vad.visa_id", "LEFT")
            ->join("visa_types vt", "vt.id = va.visa_type_id", "LEFT")
            ->join("country c", "c.id = va.nationality_id", "LEFT")
            ->where("vad.`id`", $id)
            ->get();
//        echo $this->db->last_query();
        return $query->row();
    }


    /* Combo of INSERT & UPDATE
     *
     * Insert data if $where is not exists
     * else Update query will execute
     */
    public function set_data($table, $data, $where = NULL)
    {
        if (empty($where)) {
            $res = $this->db->insert($this->db->dbprefix($table), $data);
            return $this->db->insert_id();
        } else {
            $this->db->where($where);
            return $this->db->update($this->db->dbprefix($table), $data);
        }
    }

    /* DELETE the table data */
    public function unset_data($table, $where)
    {
        return $this->db->delete($this->db->dbprefix($table), $where);
    }


    /* For complex queries */
    public function query($query)
    {
        $res = $this->db->query($query);
        return $res->result();
    }

}

?>