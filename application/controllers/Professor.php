<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Professor extends CI_Controller 
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_Login','minha_model');
	}

	public function index()
	{
		redirect();
	}

	public function cadastrar_professor_ajax()
	{
		$this->load->library('M_tlm');
		$this->validacao();
		$data = array(
				'nome' => $this->input->post('nome'),
				'cpf' => $this->input->post('cpf'),
				'dt_nascimento' => $this->m_tlm->data_eua($this->input->post('dt_nascimento')),
				'dt_registro' => date('Y-m-d'),
				'sexo' => $this->input->post('sexo'),
				'situacao' => '1',
				'telefone' => $this->input->post('telefone'), 
				'email' => $this->input->post('email'),
				'senha' => $this->m_tlm->criptografar($this->input->post('senha')),
				'copetencia' => $this->input->post('copetencia'),
				'area_id' => $this->input->post('area_id')
			);

		$insert = $this->minha_model->cadastrar('tb_professores', $data);
		echo json_encode(array("status" => TRUE));
	}


	private function validacao()
	{
		$data = array();
		$data['msg_erro'] = array();
		$data['campo'] = array();
		$data['status'] = TRUE;

		###########################################################################
		if($this->form_validation->set_rules('nome', 'Nome', 'required|min_length[4]|addslashes|trim')->run() == TRUE)
		{
			$data['status'] = TRUE;
		}
		else 
		{
			$data['campo'][] = 'nome';
			$data['msg_erro'][] = form_error('nome', ' ', ' ');
			$data['status'] = FALSE;
		}
		###########################################################################
		if($this->form_validation->set_rules('email', 'Email', 'required|min_length[6]|addslashes|trim|valid_email|is_unique[tb_professores.email]|is_unique[tb_alunos.email]')->run() == TRUE)
		{
			$data['status'] = TRUE;
		}
		else 
		{
			$data['campo'][] = 'email';
			$data['msg_erro'][] = form_error('email', ' ', ' ');
			$data['status'] = FALSE;
		}
		###########################################################################
		if($this->form_validation->set_rules('senha', 'Senha', 'required|min_length[6]|max_length[13]|addslashes|trim')->run() == TRUE)
		{
			$data['status'] = TRUE;
		}
		else 
		{
			$data['campo'][] = 'senha';
			$data['msg_erro'][] = form_error('senha', ' ', ' ');
			$data['status'] = FALSE;
		}
		###########################################################################
		if($this->form_validation->set_rules('confirmar', 'Confirmar senha', 'required|min_length[6]|max_length[13]|addslashes|matches[senha]|trim', array('matches' => 'As senhas não são iguais' , ))->run() == TRUE)
		{
			$data['status'] = TRUE;
		}
		else 
		{
			$data['campo'][] = 'confirmar';
			$data['msg_erro'][] = form_error('confirmar', ' ', ' ');
			$data['status'] = FALSE;
		}
		###########################################################################
		if($this->form_validation->set_rules('cpf', 'CPF', 'required|is_unique[tb_professores.cpf]|is_unique[tb_alunos.email]')->run() == TRUE)
		{
			$data['status'] = TRUE;
		}
		else 
		{
			$data['campo'][] = 'cpf';
			$data['msg_erro'][] = form_error('cpf', ' ', ' ');
			$data['status'] = FALSE;
		}
		###########################################################################
		if($this->form_validation->set_rules('dt_nascimento', 'Data de Nascimento', 'required|min_length[9]|addslashes|trim')->run() == TRUE)
		{
			$data['status'] = TRUE;
		}
		else 
		{
			$data['campo'][] = 'dt_nascimento';
			$data['msg_erro'][] = form_error('dt_nascimento', ' ', ' ');
			$data['status'] = FALSE;
		}
		###########################################################################
		if($this->form_validation->set_rules('copetencia', 'Copetencias', 'required|min_length[20]|addslashes')->run() == TRUE)
		{
			$data['status'] = TRUE;
		}
		else 
		{
			$data['campo'][] = 'copetencia';
			$data['msg_erro'][] = form_error('copetencia', ' ', ' ');
			$data['status'] = FALSE;
		}
		###########################################################################
		if($this->form_validation->set_rules('telefone', 'Telefone', 'required|addslashes')->run() == TRUE)
		{
			$data['status'] = TRUE;
		}
		else 
		{
			$data['campo'][] = 'telefone';
			$data['msg_erro'][] = form_error('telefone', ' ', ' ');
			$data['status'] = FALSE;
		}
		###########################################################################
		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}
}
