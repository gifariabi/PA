<?php

class Edit_Foto extends CI_Controller{

	function __construct(){
		parent::__construct();
		$this->load->helper(array('form', 'url','file'));
		$this->load->library('form_validation','session');
		$this->load->model('model_ormawa');
		$this->load->library('upload');
        $this->load->library('image_lib');

	}
	
	public function edit_foto(){
		
        //$this->form_validation->set_rules('foto', 'Foto', 'callback_file_selected');

        $config['upload_path'] = './asset/images/foto'; //path folder
        $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
        $config['encrypt_name'] = TRUE; //nama yang terupload nantinya

        $this->upload->initialize($config);
        //if($this->form_validation->run() != false) {
            if(!empty($_FILES['foto']['name']))
                {
                    if ($this->upload->do_upload('foto'))
                    {
                        $gbr = $this->upload->data();
                        //Compress Image
                        $config['image_library']='gd2';
                        $config['source_image']='./asset/images/foto/'.$gbr['file_name'];
                        $config['create_thumb']= FALSE;
                        $config['maintain_ratio']= FALSE;
                        $config['width']= 500;
                        $config['height']= 325;
                        $config['new_image']= './asset/images/foto/'.$gbr['file_name'];
                        $this->load->library('image_lib', $config);
                        $this->image_lib->resize();
        
                        $foto=$gbr['file_name'];
                        $this->model_ormawa->simpanfoto($foto);
                       
                        redirect('Organisasi/lihat_akun');
                        echo "Berhasil Mengganti Foto Profile";
                    }else{
                        redirect('Organisasi/lihat_akun');
                        }

                    }
            //}else{
                //echo "gagal";
                    //$this->load->view('admin/kegiatan/input_kegiatan');     
            //} 
    }

    public function v_edit_foto(){
    	
        $this->load->view('v_edit_foto');
    }

    public function editf($nim){
    $where = array('nim' => $nim);
    $data['data'] = $this->model_ormawa->edit_foto($where,'mahasiswa')->result();
    $this->load->view('v_edit_foto',$data);
    }

    public function updatef(){
    	$config['upload_path'] = './asset/images/foto'; //path folder
        $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
        $config['encrypt_name'] = TRUE; //nama yang terupload nantinya

        $this->upload->initialize($config);
        //if($this->form_validation->run() != false) {
            if(!empty($_FILES['foto']['name']))
                {
                    if ($this->upload->do_upload('foto'))
                    {
                        $gbr = $this->upload->data();
                        //Compress Image
                        $config['image_library']='gd2';
                        $config['source_image']='./asset/images/foto/'.$gbr['file_name'];
                        $config['create_thumb']= FALSE;
                        $config['maintain_ratio']= FALSE;
                        $config['width']= 300;
                        $config['height']= 125;
                        $config['new_image']= './asset/images/foto/'.$gbr['file_name'];
                        $this->load->library('image_lib', $config);
                        $this->image_lib->resize();
        
                        $foto=$gbr['file_name'];
                        $nim = $this->input->post('nim');
                        $data = array(
        					'foto' => $foto,
        				);
 
        				$where = array(
        				'nim' => $nim
        				);
 
       	 				$this->model_ormawa->update_foto($where,$data,'mahasiswa');
        				redirect('Organisasi/lihat_akun');
        				//$foto = $this->input->post('foto');
                        //$this->model_ormawa->simpanfoto($foto);
                       
                        //redirect('Organisasi/lihat_akun');
                        //echo "Berhasil Mengganti Foto Profile";
                    }else{
                        //redirect('Organisasi/lihat_akun');
                        echo "gagal";
                        }

                    }
                    else{
                		echo "gagal";
                    //$this->load->view('admin/kegiatan/input_kegiatan');     
            		} 
    	//
        //$nim = $this->input->post('nim');
        //$foto = $this->input->post('foto');
 
       
    }
}
