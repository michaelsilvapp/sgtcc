<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Professor extends CI_Controller 
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_Professor','minha_model');
		$this->load->library('M_tlm');
	}

	public function verifica_session()
	{
		if($this->session->userdata('logado') == FALSE)
		{
			redirect('/');	
		}
	}

	public function cadastrar_professor_ajax()
	{
		$this->validacao('insert');
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

	public function alterar_professor_ajax()
	{
		$this->verifica_session();
		$this->validacao('update');
		$data = array(
				'nome' => $this->input->post('nome'),
				'dt_nascimento' => $this->m_tlm->data_eua($this->input->post('dt_nascimento')),
				'sexo' => $this->input->post('sexo'),
				'telefone' => $this->input->post('telefone'), 
				'area_id' => $this->input->post('area_id'),
				'copetencia' => $this->input->post('copetencia')
			);
		$this->minha_model->atualizar('tb_professores', $data, array('id_professor' => $this->input->post('id'))); 
		echo json_encode(array("status" => TRUE));
	}

	public function lista_dados()
	{
		$this->verifica_session();
		$this->load->library('M_tlm');
 		$list['dados'] = $this->minha_model->consulta_inner_professor('prof.nome, prof.dt_nascimento, prof.telefone, prof.sexo, prof.cpf, prof.email, prof.copetencia ,tb_areas.area', 'tb_professores AS prof', 'tb_areas', 
		'prof.area_id = tb_areas.id_area AND prof.id_professor = '. $this->session->userdata('id') );


		$list['dados']->dt_nascimento = $this->m_tlm->data_br($list['dados']->dt_nascimento);
		$list['dados']->sexo = ucfirst($list['dados']->sexo);
  		echo json_encode($list);
	}

	private function validacao($opcao)
	{
		$data = array();
		$data['msg_erro'] = array();
		$data['campo'] = array();
		$data['status'] = TRUE;

		switch ($opcao)
		{
			case 'insert':
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
		

			break;
			
			case 'update':
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
		
			break;
		}
		
		###########################################################################
		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}

	public function dados()
	{
		$this->verifica_session();
		$data = array('myname' => $this->session->userdata('nome'));
		$this->load->view('inc/head');
		$this->parser->parse('inc/menu', $data);
		$this->parser->parse('usuarios/professor/dados', $data);
	}

	public function editar_professor_ajax($id)
	{
		$this->verifica_session();
		$data = $this->minha_model->retorna_id_professor('prof.nome, prof.id_professor, prof.dt_nascimento, prof.sexo, prof.copetencia, prof.telefone, prof.area_id', 'tb_professores AS prof', $id);
		$data->date = $this->m_tlm->data_br($data->dt_nascimento);
		echo json_encode($data);
	}
}
