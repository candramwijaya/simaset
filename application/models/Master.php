<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master extends CI_Model {

    public function getAllData($table){
		$data = $this->db->get($table);
		return $data->result_array();
	}

    public function getAllDataDesc($table, $id){
		$this->db->select('*');
        $this->db->from($table);
        $this->db->order_by($id, 'desc');
        $data = $this->db->get();

		return $data->result_array();
	}

    public function getDetailData($table, $id){
		$this->db->select('*');
        $this->db->from($table);
        $this->db->where('id', $id);
        $data = $this->db->get();
        
		return $data->row_array();
	}

    public function addData($table, $data)
    {
        return $this->db->insert($table, $data);
    }

	public function updateData($id,$table,$data){
        $this->db->where('id', $id);
        $res = $this->db->update($table,$data);
        return $res;
    }

    public function updateDataID($id_update, $id,$table,$data){
        $this->db->where($id_update, $id);
        $res = $this->db->update($table,$data);
        return $res;
    }

    public function deleteData($id, $table)
    {
        $this->db->where('id', $id);
		$res = $this->db->delete($table);
		return $res;
    }

    public function deleteDataID($id_update, $id, $table)
    {
        $this->db->where($id_update, $id);
		$res = $this->db->delete($table);
		return $res;
    }

}

/* End of file ModelName.php */
