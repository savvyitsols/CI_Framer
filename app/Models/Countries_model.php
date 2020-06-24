<?php
 
namespace App\Models;
 
use CodeIgniter\Model;
class Countries_model extends Model {
 
    var $table = 'counties';
     
    public function __construct() {
        parent::__construct();
        //$this->load->database();
        $db = \Config\Database::connect();
        $builder = $db->table('counties');
    }
 
    public function get_all_countries() {
       $query = $this->db->query('select * from counties');
        return $query->getResult();
    }
 
    public function get_by_id($id) {
      $sql = 'select * from counties where country_id ='.$id ;
      $query =  $this->db->query($sql);
       
      return $query->getRow();
    }
 
    public function country_add($data) {
         
        $query = $this->db->table($this->table)->insert($data);
        //$query = $this->db->insert($table,$data);
        return $this->db->insertID();
    }
 
    public function country_update($where, $data) {
        $this->db->table($this->table)->update($data, $where);
        return $this->db->affectedRows();
    }
 
    public function delete_by_id($id) {
        $this->db->table($this->table)->delete(array('country_id' => $id)); 
    }
 
}