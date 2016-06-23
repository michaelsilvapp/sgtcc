<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	// -- Class Name : Professor
	// -- Descrição : Classe com metodos de cadastro de informações de professores & validacoes e tratamentos 
	// -- Created On : 
	class Professor extends CI_Controller
	{
		public
		// -- Function Name : __construct
		// -- Params : 
		// -- Descrição : 
		function __construct()
		{
			parent::__construct();
			$this->load->model('M_Professor','minha_model');
			$this->load->library('M_tlm');
		}

		public
		// -- Function Name : verifica_session
		// -- Params : 
		// -- Descrição : 
		function verifica_session()
		{
			if($this->session->userdata('logado') == FALSE):
				redirect('/');
			endif;
		}

		public
		// -- Function Name : index
		// -- Params : 
		// -- Descrição : 
		function index()
		{
			$this->verifica_session();

			$dados['user'] = $this->minha_model->get_codicional('nome, img_perfil', 'tb_professores', array('id_professor' => $this->session->userdata('id') ))->result();
			$data = array('myname' => $dados['user'][0]->nome, 'myimg' => $dados['user'][0]->img_perfil);
			$this->load->view('inc/head');
			$this->parser->parse('inc/menu', $data);
			$this->parser->parse('usuarios/professor/dados', $data);
		}

		public
		// -- Function Name : cadastrar_professor
		// -- Params : 
		// -- Descrição : 
		function cadastrar_professor()
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
                'img_perfil' => 'use.png',
                'area_id' => $this->input->post('area_id'));
			$insert = $this->minha_model->cadastrar('tb_professores', $data);
			echo json_encode(array("status" => TRUE));
		}

		public
		// -- Function Name : editar_professor
		// -- Params : $id
		// -- Descrição : 
		function editar_professor($id)
		{
			$this->verifica_session();
			try 
			{
				$data = $this->minha_model->get_codicional('
                nome, email, cpf, id_professor, dt_nascimento, sexo, copetencia, telefone, area_id', 
                'tb_professores', array('id_professor' => $id))->row();
				$data->date = $this->m_tlm->data_br($data->dt_nascimento);
				echo json_encode($data);	
			} 
			catch (Exception $e) 
			{
			   $data = FALSE;
               echo json_encode($data);
			}
		}

		public
		// -- Function Name : alterar_professor
		// -- Params : 
		// -- Descrição : 
		function alterar_professor()
		{
			$this->verifica_session();
			$this->validacao('update');
			$data = array(    
                'nome' => $this->input->post('nome'),
                'dt_nascimento' => $this->m_tlm->data_eua($this->input->post('dt_nascimento')),
                'sexo' => $this->input->post('sexo'),       
                'telefone' => $this->input->post('telefone'), 
                'area_id' => $this->input->post('area_id'), 
                'copetencia' => $this->input->post('copetencia'));
			$this->minha_model->atualizar('tb_professores', $data, array('id_professor' => $this->session->userdata('id')));
			echo json_encode(array("status" => TRUE));
		}

		public
		// -- Function Name : alterar_senha
		// -- Params : 
		// -- Descrição : 
		function alterar_senha()
		{
			$this->verifica_session();
			$this->validacao('update_senha');
			$senha_atual = $this->m_tlm->criptografar($this->input->post('senha_atual'));
			$dados['senha'] = $this->minha_model->get_codicional('senha', 'tb_professores', $this->session->userdata('id'))->result();

			if($dados['senha'][0]->senha == $senha_atual):
				$data = array('senha' => $this->m_tlm->criptografar($this->input->post('nova_senha')));
				$this->minha_model->atualizar('tb_professores', $data, array('id_professor' => $this->session->userdata('id') ));
				echo json_encode(array("status" => TRUE));
			else:
				$data['campo'][] = 'senha_atual';
				$data['msg_erro'][] = 'A senha informada não confere com a anterior';
				$data['status'] = FALSE;	
				if($data['status'] === FALSE):
					echo json_encode($data);
					exit();
				endif;
			endif;
		}

		public
		// -- Function Name : cadastrar_formacao
		// -- Params : 
		// -- Descrição :
		function cadastrar_formacao()
		{
			$data = array('curso_id' => $this->input->post('curso'), 'professor_id' => $this->session->userdata('id') );
			$insert = $this->minha_model->cadastrar('tb_curso_professor', $data);
			echo json_encode(array("status" => TRUE));
		}

		public
		// -- Function Name : editar_formacao
		// -- Params : 
		// -- Descrição : 
		function editar_formacao($id)
		{
			$this->verifica_session();
			try 
			{
				$data = $this->minha_model->get_two_inner('
                	*', 
                	'tb_curso_professor AS cp', 
                	'tb_cursos AS c', 'tb_professores AS p', 
                	'cp.curso_id = c.id_curso', 
                	'p.id_professor = cp.professor_id AND cp.id_curso_professor = '. $id)->row();
				echo json_encode($data);	
			} 
			catch (Exception $e) 
			{
			   $data = FALSE;
               echo json_encode($data);
			}
		}

		public
		// -- Function Name : alterar_formacao
		// -- Params : 
		// -- Descrição : 
		function alterar_formacao()
		{
			$this->verifica_session();
			$data = array('curso_id' => $this->input->post('curso'));
			$this->minha_model->atualizar('tb_curso_professor', $data, array('id_curso_professor' =>  $this->input->post('id_curso_professor') ));
			echo json_encode(array("status" => TRUE));
		}

		public
		// -- Function Name : lista_dados_p
		// -- Params : 
		// -- Descrição : 
		function lista_dados_p()
		{
            $this->verifica_session();
            try
            {
    			$list['dados'] = $this->minha_model->get_one_inner('
                     p.nome, p.dt_nascimento, p.telefone, p.sexo, p.cpf, p.email, p.copetencia ,a.area', 
                    'tb_professores AS p', 
                    'tb_areas AS a', 
                    'p.area_id = a.id_area AND p.id_professor = '. $this->session->userdata('id') )->row();

    			$list['dados']->dt_nascimento = $this->m_tlm->data_br($list['dados']->dt_nascimento);
    			$list['dados']->sexo = ucfirst($list['dados']->sexo);
    			
                echo json_encode($list);
            } 
            catch (Exception $erro)
            {
               $list = FALSE;
               echo json_encode($list);
            }
		}

        public
        // -- Function Name : lista_dados_f
        // -- Params : 
        // -- Descrição : 
        function lista_dados_f()
        {
            $this->verifica_session();
            try
            {
                $list = $this->minha_model->get_two_inner('
                	c.curso, cp.id_curso_professor', 
                	'tb_curso_professor AS cp', 
                	'tb_cursos AS c', 'tb_professores AS p', 
                	'cp.curso_id = c.id_curso', 
                	'p.id_professor = cp.professor_id AND p.id_professor = '. $this->session->userdata('id'))->result_array();

                echo json_encode($list);
            }
            catch (Exception $erro)
            {
               $list = FALSE;
               echo json_encode($list);
            }
        }

		public
		// -- Function Name : busca_por_curso
		// -- Params : 
		// -- Descrição : 		
		function busca_por_curso()
		{
			$this->verifica_session();
			$data = $this->minha_model->get_codicional('*', 'tb_cursos', array('tipo_curso' => $this->input->post('tipo_cursos')))->result();
			//'TecnÃ³logo' = 1 ,'TÃ©cnico' = 2,'GraduaÃ§Ã£o' = 3,'PÃ³s-graduaÃ§Ã£o' = 4,'Mestrado' = 5,'Doutorado' = 6,'Especialista' = 7
			$option = "<option value=''>Selecione seu curso </option>";
			foreach($data as $linha):
				$option .= "<option value='$linha->id_curso'>$linha->curso</option>";
			endforeach; 

			echo $option;
		}

		public
		// -- Function Name : edita_imagem
		// -- Params : 
		// -- Descrição : 		
		function edita_imagem()
		{			
			$configUpload['upload_path']   = './imagens/';
			$configUpload['allowed_types'] = 'jpg|png';
			$configUpload['encrypt_name']  = TRUE;
			$this->upload->initialize($configUpload);

			if(!$this->upload->do_upload('imagem')):
				$data= array('error' => $this->upload->display_errors());
				$this->load->view('home',$data);
			else:
		
				$dadosImagem = $this->upload->data();
				$tamanhos = $this->CalculaPercetual($this->input->post());
				$configCrop['image_library'] = 'gd2';
				$configCrop['source_image']  = $dadosImagem['full_path'];
				$configCrop['new_image']     = './imagens/img_upload/';
				$configCrop['maintain_ratio']= FALSE;
				$configCrop['quality']			 = 100;
				$configCrop['width']         = $tamanhos['wcrop'];
				$configCrop['height']        = $tamanhos['hcrop'];
				$configCrop['x_axis']        = $tamanhos['x'];
				$configCrop['y_axis']        = $tamanhos['y'];
				$this->image_lib->initialize($configCrop);
				if ( ! $this->image_lib->crop()):
					$data = array('error' => $this->image_lib->display_errors());
					$this->load->view('home',$data);
				else:
					$urlImagem = base_url('imagens/img_upload/'.$dadosImagem['file_name']);
					
					unlink('C:\xampp\htdocs\project\imagens/'. $dadosImagem['file_name']);

					$data_consulta['img'] = $this->minha_model->get_codicional('img_perfil', 'tb_professores', array('id_professor' => $this->session->userdata('id')))->result();

					if($data_consulta['img'][0]->img_perfil == 'use.png'):
						$data_img = array('img_perfil' => $dadosImagem['file_name']);
						$this->minha_model->atualizar('tb_professores', $data_img, array('id_professor' => $this->session->userdata('id')));	
					else: 
						$data_img = array('img_perfil' => $dadosImagem['file_name']);
						$this->minha_model->atualizar('tb_professores', $data_img, array('id_professor' => $this->session->userdata('id')));
						unlink('C:\xampp\htdocs\project\imagens\img_upload/'. $data_consulta['img'][0]->img_perfil);
					endif;
					

					redirect('professor');
				endif;
			endif;
		}

		private
		// -- Function Name : CalculaPercetual
		// -- Params : 
		// -- Descrição :
	    function CalculaPercetual($dimensoes)
		{
			if($dimensoes['woriginal'] > $dimensoes['wvisualizacao']):
				$percentual = $dimensoes['woriginal'] / $dimensoes['wvisualizacao'];
				$dimensoes['x'] = round($dimensoes['x'] * $percentual);
				$dimensoes['y'] = round($dimensoes['y'] * $percentual);
				$dimensoes['wcrop'] = round($dimensoes['wcrop'] * $percentual);
				$dimensoes['hcrop'] = round($dimensoes['hcrop'] * $percentual);
			endif;

			return $dimensoes;
		}


		private  
        // -- Function Name : validacao
		// -- Params : $opcao
		// -- Descrição : 		
		function validacao($opcao)
		{
			$data = array();
			$data['msg_erro'] = array(); $data['campo'] = array(); $data['status'] = TRUE;

			switch ($opcao)
			{
				case 'insert':
					
					if($this->form_validation->set_rules('nome', 'Nome', 'required|min_length[4]|addslashes|trim')->run() == TRUE):
						$data['status'] = TRUE;
			    	else:
						$data['campo'][] = 'nome'; $data['msg_erro'][] = form_error('nome', ' ', ' '); $data['status'] = FALSE;
					endif;
					
					if($this->form_validation->set_rules('senha', 'Senha', 'required|min_length[6]|max_length[13]|addslashes|trim')->run() == TRUE):
					  $data['status'] = TRUE;
					else:
				  	  $data['campo'][] = 'senha'; $data['msg_erro'][] = form_error('senha', ' ', ' '); $data['status'] = FALSE;
					endif;
					
					if($this->form_validation->set_rules('confirmar', 'Confirmar senha', 'required|min_length[6]|max_length[13]|addslashes|matches[senha]|trim', array('matches' => 'As senhas não são iguais' , ))->run() == TRUE):
						$data['status'] = TRUE;
					else:
						$data['campo'][] = 'confirmar'; $data['msg_erro'][] = form_error('confirmar', ' ', ' '); $data['status'] = FALSE;
					endif;
					
					if($this->form_validation->set_rules('cpf', 'CPF', 'required|is_unique[tb_professores.cpf]|is_unique[tb_alunos.cpf]')->run() == TRUE):
						$data['status'] = TRUE;
					else:
						$data['campo'][] = 'cpf'; $data['msg_erro'][] = form_error('cpf', ' ', ' '); $data['status'] = FALSE;
					endif;
					
					if($this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[tb_professores.email]|is_unique[tb_alunos.email]')->run() == TRUE):
						$data['status'] = TRUE;
					else:
						$data['campo'][] = 'email'; $data['msg_erro'][] = form_error('email', ' ', ' '); $data['status'] = FALSE;
					endif;

					if($this->form_validation->set_rules('dt_nascimento', 'Data de Nascimento', 'required|min_length[9]|addslashes|trim')->run() == TRUE):
						$data['status'] = TRUE;
					else:
						$data['campo'][] = 'dt_nascimento';	$data['msg_erro'][] = form_error('dt_nascimento', ' ', ' '); $data['status'] = FALSE;
					endif;
					
					if($this->form_validation->set_rules('copetencia', 'Copetencias', 'required|min_length[20]|addslashes')->run() == TRUE):
						$data['status'] = TRUE;
					else:
						$data['campo'][] = 'copetencia'; $data['msg_erro'][] = form_error('copetencia', ' ', ' '); $data['status'] = FALSE;
					endif;
					
					if($this->form_validation->set_rules('telefone', 'Telefone', 'required|addslashes')->run() == TRUE):
						$data['status'] = TRUE;
					else:
						$data['campo'][] = 'telefone'; $data['msg_erro'][] = form_error('telefone', ' ', ' '); $data['status'] = FALSE;
					endif;
					
				break;

				case 'update':
					
					if($this->form_validation->set_rules('nome', 'Nome', 'required|min_length[4]|addslashes|trim')->run() == TRUE):
						$data['status'] = TRUE;
					else:
						$data['campo'][] = 'nome'; $data['msg_erro'][] = form_error('nome', ' ', ' '); $data['status'] = FALSE;
					endif;
					
					if($this->form_validation->set_rules('dt_nascimento', 'Data de Nascimento', 'required|min_length[9]|addslashes|trim')->run() == TRUE):
						$data['status'] = TRUE;
					else:
						$data['campo'][] = 'dt_nascimento'; $data['msg_erro'][] = form_error('dt_nascimento', ' ', ' '); $data['status'] = FALSE;
					endif;
					
					if($this->form_validation->set_rules('copetencia', 'Copetencias', 'required|min_length[20]|addslashes')->run() == TRUE):
						$data['status'] = TRUE;
					else:
						$data['campo'][] = 'copetencia'; $data['msg_erro'][] = form_error('copetencia', ' ', ' '); $data['status'] = FALSE;
					endif;
					
					if($this->form_validation->set_rules('telefone', 'Telefone', 'required|addslashes')->run() == TRUE):
						$data['status'] = TRUE;
					else:
						$data['campo'][] = 'telefone'; $data['msg_erro'][] = form_error('telefone', ' ', ' '); $data['status'] = FALSE;
					endif;
				break;
	

				case 'update_senha':
					
					if($this->form_validation->set_rules('senha_atual', 'Senha Atual', 'required|min_length[6]|max_length[13]|addslashes|trim')->run() == TRUE):
						$data['status'] = TRUE;
					else:
						$data['campo'][] = 'senha_atual'; $data['msg_erro'][] = form_error('senha_atual', ' ', ' '); $data['status'] = FALSE;
					endif;
					
					if($this->form_validation->set_rules('nova_senha', 'Nova Senha', 'required|min_length[6]|max_length[13]|addslashes|trim')->run() == TRUE):
						$data['status'] = TRUE;
					else:
						$data['campo'][] = 'nova_senha'; $data['msg_erro'][] = form_error('nova_senha', ' ', ' '); $data['status'] = FALSE;
					endif;
					
					if($this->form_validation->set_rules('confirmar_senha', 'Confirmar senha', 'required|min_length[6]|max_length[13]|addslashes|matches[nova_senha]|trim', array('matches' => 'As senhas nÃ£o sÃ£o iguais' , ))->run() == TRUE):
						$data['status'] = TRUE;
					else:
						$data['campo'][] = 'confirmar_senha'; $data['msg_erro'][] = form_error('confirmar_senha', ' ', ' '); $data['status'] = FALSE;
					endif;
				break;
			}
		
		if($data['status'] === FALSE):
			echo json_encode($data);
			exit();
		endif;
	}
}