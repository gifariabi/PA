 <?php 
    class Tiket extends CI_Controller{
        public function __construct(){
            parent::__construct();
            $this->load->helper('url','form','file');
            $this->load->model('Tiket_model');
            $this->load->model('Kegiatan_model');
            $this->load->library('form_validation','session');
        }

        public function index(){
            $this->load->view('home');
        }

        public function tiket($id_kegiatan){
                $where = array('id_kegiatan'=> $id_kegiatan);
                // $where2 = array('nim');
                $data['data'] = $this->Kegiatan_model->edit_data($where,'kegiatan')->result();
                // print_r($data);
                $this->load->view('input_tiket',$data);
            
        }
        public function simpan($id_kegiatan){
            $this->form_validation->set_rules('nama','Nama','required',array('required' => 'Kolom Nama masih kosong'));
            $this->form_validation->set_rules('nim','Nim','trim|required|max_length[10]', array('required' => 'Kolom nim masih kosong','max_length' => 'NIM harus 10 digit'));
            $this->form_validation->set_rules('jurusan','Jurusan','required',array('required' => 'Kolom jurusan masih kosong'));
            $this->form_validation->set_rules('email','Email','trim|required|valid_email',array('required' => 'Kolom email masih kosong'));
            // $this->form_validation->set_rules('jumlah','Jumlah','required');
            $this->form_validation->set_rules('metode','Metode','required');
            // $this->form_validation->set_rules('kondisi','Kondisi','required');

            if ($this->form_validation->run() === false) {
                $where = array('id_kegiatan' => $id_kegiatan);
                $data['data'] = $this->Kegiatan_model->edit_data($where,'kegiatan')->result();
                // print_r($data);
                $this->load->view('input_tiket',$data);
            }
            else {
                $id_kegiatan = $this->input->post('id_kegiatan');
                $harga = $this->input->post('harga');
                $nama = $this->input->post('nama');
                $nim = $this->input->post('nim');
                $jurusan = $this->input->post('jurusan');
                $email = $this->input->post('email');

                // $jumlah = $this->input->post('jumlah');
                $metode = $this->input->post('metode');
                $status = 'Menunggu';
                $total = 0;
                if($harga == 'Free'){
                    echo 'Free';
                }else{
                    $total = $harga;
                }

                $data = array(
                    'nama' => $nama, 
                    'nimAkun' => $this->session->nim,
                    'nim' => $nim,
                    'jurusan' => $jurusan,
                    'email' => $email,
                    // 'jumlah' => $jumlah,
                    'total' => $total,
                    'metode_pembayaran' => $metode,
                    'status' => $status,
                    'id_kegiatan' => $id_kegiatan
                );
                $this->Tiket_model->data($data,'tiket');
                // redirect('tiket/tiket/'.$id_kegiatan);
                
                redirect('tiket/displaydata/'.$this->session->nim);
            }
        }
        public function displaydata($where){
            // $newdata = $this->session->userdata('jabatan');
            if ($this->session->userdata('jabatan') == 'Sekretaris') {
                $data['data'] = $this->Tiket_model->tampil_req();
                $this->load->view('display_tiket',$data);
            }else{
                $data['data']=$this->Tiket_model->tampil_tiket($where)->result();
                // print_r($data);
                $this->load->view('display_tiket',$data);
            }
        }
        public function hapus($id){
            $where = array('no_tiket'=>$id);
            $this->Tiket_model->hapus_data($where,'tiket');
            redirect('tiket/displaydata');
        }
        public function edit($id){
            $where = array('no_tiket'=>$id);
            $data['data'] = $this->Tiket_model->edit_data($where,'tiket')->result();
            $this->load->view('edit_tiket',$data);
        }
        public function update(){
            $id = $this->input->post('no_tiket');
            $nama = $this->input->post('nama');
            $nim = $this->input->post('nim');
            $jurusan = $this->input->post('jurusan');
            $email = $this->input->post('email');
            $jumlah = $this->input->post('jumlah');
            $metode = $this->input->post('metode');

            $data = array(
                'nama' => $nama, 
                'nim' => $nim,
                'jurusan' => $jurusan,
                'email' => $email,
                'jumlah' => $jumlah,
                'metode_pembayaran' => $metode
            );

            $where = array(
                'no_tiket' => $id
            );
            $this->Tiket_model->update_data($where,$data,'tiket');
            redirect('tiket/displaydata');
        }
        
        public function cetak_tiket($where){
            // $where = array('no_tiket' => $no_tiket);
            $data['data'] = $this->Tiket_model->tampil_pdf($where)->result();
            //$this->load->view('editsuratmasuk',$data);
            $this->load->library('pdf');
            $this->load->view('tiket',$data);
        }
    
        public function update_status_admin($no_tiket){
            $this->Tiket_model->update_status($no_tiket);
            redirect('tiket/status_tiket_admin/'.$this->session->nim);  
        }

        public function update_status(){
            $nama = $this->input->post('nama');
            $nim = $this->input->post('nim');
            $jurusan = $this->input->post('jurusan');
            $email = $this->input->post('email');
            $jumlah = $this->input->post('jumlah');
            $metode = $this->input->post('metode');
            $status = $this->input->post('status');
            $no_tiket = $this->input->post('no_tiket');
            // $data = array(
            //     // 'nama' => $nama,
            //     // 'nim' => $nim,
            //     // 'jurusan' => $jurusan,
            //     // 'email' => $email,
            //     // 'jumlah' => $jumlah,
            //     // 'metode_pembayaran' => $metode,
            //     'status' => $status
            // );
            // $where = array(
            //     'no_tiket' => $no_tiket
            // );
            $this->Tiket_model->update_status($nama,$nim,$jurusan,$email,$jumlah,$metode,$status);
            redirect('tiket/status_tiket_admin');
        }
        public function status_tiket_admin($where){
                $data['data']=$this->Tiket_model->tampil_tiket($where)->result();
                $this->load->view('display_tiket',$data);
        }

    }

?>