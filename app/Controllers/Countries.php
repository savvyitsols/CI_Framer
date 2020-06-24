<?php
 
namespace App\Controllers;
 
use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Countries_model;
class Countries extends Controller {
 
 
    public function index() {
         
        helper(['form', 'url']);
        $this->Countries_model = new Countries_model();
        $data['countries'] = $this->Countries_model->get_all_countries();
        return view('Countries_view', $data);
    }
 
    public function country_add() {
 
        helper(['form', 'url']);
        $this->Countries_model = new Countries_model();
 
        $data = array(
            'country_code' => $this->request->getPost('country_code'),
            'country_name' => $this->request->getPost('country_name'),
             );
        
        $insert = $this->Countries_model->country_add($data);
        echo json_encode(array("status" => TRUE));
    }
 
    public function ajax_edit($id) {
 
        $this->Countries_model = new Countries_model();
 
        $data = $this->Countries_model->get_by_id($id);
 
        echo json_encode($data);
    }
 
    public function country_update() {
 
        helper(['form', 'url']);
        $this->Countries_model = new Countries_model();
 
        $data = array(
            'country_code' => $this->request->getPost('country_code'),
            'country_name' => $this->request->getPost('country_name'),
        );
        $this->Countries_model->country_update(array('country_id' => $this->request->getPost('country_id')), $data);
        echo json_encode(array("status" => TRUE));
    }
 
    public function country_delete($id) {
 
        helper(['form', 'url']);
        $this->Countries_model = new Countries_model();
        $this->Countries_model->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }
 
}