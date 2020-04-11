<?php

require APPPATH . '/libraries/REST_Controller.php';

class Login extends REST_Controller {

    function __construct($config = 'rest'){
        parent::__construct($config);
        $this->load->model('login_model', 'login');
    }

    // ACCESS API LINK
    // http://localhost/pa/index.php/api/api_user
    function users_post(){
        $username = $this->post('username');
        $password = $this->post('password');

        if (isset($username) && isset($password)) {
            $user = $this->login->ambil_akun($username, $password);

            if ($user != NULL) {
                $this->response([
                    'error' => false,
                    'message' => "Login Berhasil",
                    'user' => $user
                ], REST_Controller::HTTP_OK);
            } else {
                $this->response([
                    'error' => true,
                    'message' => 'Akun tidak ditemukan'
                ], REST_Controller::HTTP_OK);
            }
            
        } else {
            $this->response([
				'error' => true,
				'message' => 'username & password required'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
        
        
    }
    
    // function index_get2(){
    //     $username = $this->get('username');
	// 	$password = $this->get('password');

	// 	if ($username == null || $password == null) {
	// 		$this->response([
	// 			'status' => false,
	// 			'message' => 'username & password required'
	// 		], REST_Controller::HTTP_NOT_FOUND);
	// 	} else {
	// 		$user_data = $this->login->ambil_akun($username, $password);

	// 		if ($user_data != NULL) {
	// 			$this->response([
	// 				'status' => true,
	// 				'data' => $user_data
	// 			], REST_Controller::HTTP_OK);
	// 		} else {
	// 			$this->response([
	// 				'status' => false,
	// 				'message' => 'Account not found'
	// 			], REST_Controller::HTTP_NOT_FOUND);
	// 		}	
	// 	}
    // }

    // function index_get() {
    //     $id = $this->get('id');

    //     if ($id == '') {
    //         $product = $this->db->get('m_item')->result();
    //     } else {
    //         $this->db->where('id_item', $id);
    //         $product = $this->db->get('m_item')->result();
    //     }
    //     $this->response($product, 200);
    // }
}

?>