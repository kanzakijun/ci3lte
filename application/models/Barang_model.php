<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
                        
class Barang_model extends CI_Model 
{
    public function get_barang()
    {
        $query = "SELECT `master_barang`.*, `master_barang_foto`.`barang_foto_file` FROM `master_barang` JOIN `master_barang_foto` ON `master_barang`.`barang_id` = `master_barang_foto`.`barang_id`";

        return $this->db->query($query)->result_array();
    }                        
                        
}


/* End of file Barang_model.php and path /application/models/Barang_model.php */
