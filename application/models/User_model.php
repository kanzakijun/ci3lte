<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{
    public function select()
    {
        $query = $this->db->get('user');
        return $query->result();
    }

    public function insert($data)
    {
        $this->db->insert('user', $data);

        return $this->db->insert_id();
    }
}


/* End of file User_model.php and path /application/models/User_model.php */
