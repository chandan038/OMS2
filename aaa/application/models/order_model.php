<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Order_model extends CI_Model{
   
    public function get_all(){
       return $this->db->get('orders')->result();
    }
	
	public function insert_data($table_name, $data){
       $this->db->insert($table_name,$data);
	   return $this->db->insert_id();
    }
	
	 public function get_by($id){
       return $this->db->get('orders',array('id'=>$id))->row();
    }
	public function update_data($table_name,$id,$cid, $data){ // cid => compare Id for update
       $this->db->update($table_name,$data,array($cid =>$id));
	}
	
}