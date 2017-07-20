<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengguna extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		//Do your magic here
	}

	public function index()
	{
      	$this->SecurityModel->level_admin();

		$data=array('title'=>'Pengguna',
					'isi'  =>'adminpages/pengguna/index'
						);
		$data['pengguna'] = $this->m_global->get_data_all('user', null);

		$this->load->view('adminlayout/wrapper',$data);	
	}

	public function add()
	{
      	$this->SecurityModel->level_admin();

		$data=array('title'=>'Tambah Pengguna',
					'isi'  =>'adminpages/pengguna/add'
						);
		$this->load->view('adminlayout/wrapper',$data);	

	}

	public function edit($id)
	{
      	$this->SecurityModel->level_admin();

		$data=array('title'=>'Edit Pengguna',
					'isi'  =>'adminpages/pengguna/edit'
						);
		$data['profil'] = $this->m_global->get_data_all('user',null,['id' => $id]);

		$this->load->view('adminlayout/wrapper',$data);	

	}

	public function act_add()
	{
		$result = [];
		$post 	= $this->input->post();

		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		$this->form_validation->set_rules('jabatan', 'Jabatan', 'trim|required');
		$this->form_validation->set_rules('level', 'Level', 'trim|required');
		
		if ($this->form_validation->run() == true){
			$menu_data 	= [
						'username' 			=> $post['username'],
						'password'			=> md5($post['password']),
						'jabatan'			=> $post['jabatan'],
						'level'				=> $post['level']
						// 'created_by'		=> user_data()->id
					  ];
			$x = $this->m_global->get_data_all('user',null,['jabatan' => $menu_data['jabatan']]);
			if($x) {			
					$result['msg'] = 'Jabatan sudah terisi !';
					$result['sts'] = '0';
				}
				else{
					$role = $this->m_global->insert('user', $menu_data);

					if($role) {
						$result['msg'] = 'Data pengguna berhasil ditambahakan !';
						$result['sts'] = '1';
						redirect('pengguna');
					} else {
						$result['msg'] = 'Data pengguna gagal ditambahakan !';
						$result['sts'] = '0';
					}
				}
		} else {
			$result['msg'] = validation_errors();
			$result['sts'] = '0';
		}

		echo json_encode($result);

	}
	public function act_edit()
	{
		$result = [];
		$post 	= $this->input->post();

		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		$this->form_validation->set_rules('jabatan', 'Jabatan', 'trim|required');
		$this->form_validation->set_rules('level', 'Level', 'trim|required');
		
		if ($this->form_validation->run() == true){
			$menu_data 	= [
						'username' 			=> $post['username'],
						'password'			=> md5($post['password']),
						'jabatan'			=> $post['jabatan'],
						'level'				=> $post['level']
						// 'created_by'		=> user_data()->id
					  ];
			$x = $this->m_global->get_data_all('user',null,['jabatan' => $menu_data['jabatan']]);
			if($x) {			
					$result['msg'] = 'Jabatan sudah terisi !';
					$result['sts'] = '0';
				}
				else{
					$role = $this->m_global->insert('user', $menu_data);

					if($role) {
						$result['msg'] = 'Data pengguna berhasil ditambahakan !';
						$result['sts'] = '1';
						redirect('pengguna');
					} else {
						$result['msg'] = 'Data pengguna gagal ditambahakan !';
						$result['sts'] = '0';
					}
				}
		} else {
			$result['msg'] = validation_errors();
			$result['sts'] = '0';
		}

		echo json_encode($result);

	}

	public function del($id)
	{
		$this->m_global->delete('user', ['id' => $id]);
		redirect('pengguna');

	}

}

/* End of file Pengguna.php */
/* Location: ./application/controllers/Pengguna.php */