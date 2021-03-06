<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	// -- Class Name : Login
	// -- Purpose : 
	// -- Created On : 
	class Login extends CI_Controller
	{
		public

		// -- Function Name : __construct
		// -- Params : 
		// -- Purpose : 
		function __construct()
		{
			parent::__construct();
			$this->load->model('M_Login','minha_model');
		}

		public
		// -- Function Name : index
		// -- Params : 
		// -- Purpose : 
		function index()
		{
			$this->load->view('inc/head');
			$this->load->view('login/index');
		}

		public
		// -- Function Name : sair
		// -- Params : 
		// -- Purpose : 
		function sair()
		{
			$this->session->sess_destroy();
			redirect('/');
		}

		public
		// -- Function Name : verfica_login
		// -- Params : 
		// -- Purpose : 
		function verfica_login()
		{
			$this->load->library('M_tlm');
			$this->validacao();
			$email = $this->input->post('login_email');
			$senha = $this->m_tlm->criptografar($this->input->post('login_senha'));
			$tipo_user = $this->input->post('tipo_usuario');
			
			if($tipo_user == 'aluno'):
				$data['consulta'] = $this->minha_model->logar('*', 'tb_alunos', $email, $senha)->result();
				if(count($data['consulta']) == 1):
					$dados_aluno['nome'] = $data['consulta'][0]->nome;
					$dados_aluno['id_aluno'] = $data['consulta'][0]->id_aluno;
					$dados_aluno['user'] = 'aluno';
					$dados_aluno['logado'] = TRUE;
					$this->session->set_userdata($dados_aluno);
					echo json_encode(array("status" => TRUE));
				endif;

			elseif($tipo_user == 'professor'):
				$data['consulta'] = $this->minha_model->logar('*', 'tb_professores', $email, $senha)->result();
				if(count($data['consulta']) == 1):
					$dados_professor['nome'] = $data['consulta'][0]->nome;
					$dados_professor['id_professor'] = $data['consulta'][0]->id_professor;
					$dados_professor['user'] = 'professor';
					$dados_professor['logado'] = TRUE;
					$this->session->set_userdata($dados_professor);
					echo json_encode(array("status" => TRUE));
				endif;
			endif;
		}

		private

		// -- Function Name : validacao
		// -- Params : 
		// -- Purpose : 
		function validacao()
		{
			$data = array();
			$data['msg_erro'] = array();
			$data['campo'] = array();
			$data['status'] = TRUE;
			
			if($this->form_validation->set_rules('login_email', 'Email', 'required|min_length[6]|addslashes|trim|valid_email')->run() == TRUE):
				$data['status'] = TRUE;
			else:
				$data['campo'][] = 'login_email'; $data['msg_erro'][] = form_error('login_email', ' ', ' '); $data['status'] = FALSE;
			endif;

			if($this->form_validation->set_rules('login_senha', 'Senha', 'required|min_length[6]|max_length[13]|addslashes|trim')->run() == TRUE):
				$data['status'] = TRUE;
			else:
				$data['campo'][] = 'login_senha'; $data['msg_erro'][] = form_error('login_senha', ' ', ' ');$data['status'] = FALSE;
			endif;		
			
			if($this->form_validation->set_rules('tipo_usuario', 'Categoria do Usuario', 'required')->run() == TRUE):
				$data['status'] = TRUE;
			else:
				$data['campo'][] = 'tipo_usuario'; $data['msg_erro'][] = form_error('tipo_usuario', ' ', ' '); $data['status'] = FALSE;
			endif;		
			
			if($data['status'] === FALSE):
				echo json_encode($data);
				exit();
			endif;
		}

	}