<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	/*
	|--------------------------Métodos do Controle------------------------------
	|
	| -- Class Name : aluno
	| -- Descrição : Classe com metodos de cadastro de informações de alunoes & validacoes e tratamentos 
	| -- Criado Em : 
	| 1. __construct
	| 2. verifica_session
	| 3. index
	| 4. cadastrar_aluno
	| 5. cadastrar_formacao
	| 6. editar_aluno
	| 7. editar_formacao
	| 8. alterar_aluno
	| 9. alterar_senha
	| 10. alterar_img
	| 11. alterar_formacao
	| 12. lista_dados_p
	| 13. lista_dados_f
	| 14. busca_por_curso
	| 15. calcula_percentual
	| 16. validacao
	|--------------------------------------------------------------------------
	*/
	class Aluno extends CI_Controller
	{
		public
		// -- Function Name : __construct
		// -- Params : 
		// -- Descrição : 
		function __construct()
		{
			parent::__construct();
			$this->load->model('M_aluno','minha_model');
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

			$dados['user'] = $this->minha_model->get_codicional('nome, img_perfil', 'tb_alunos', array('id_aluno' => $this->session->userdata('id_aluno') ))->result();
			$data = array('myname' => $dados['user'][0]->nome, 'myimg' => $dados['user'][0]->img_perfil);
			$this->load->view('inc/head');
			$this->parser->parse('inc/menu', $data);
			$this->parser->parse('usuarios/aluno/dados', $data);
		}

		/*
		|--------------------------------------------------------------------------
		| 								Cadastros
		|--------------------------------------------------------------------------
		*/

		public
		// -- Function Name : cadastrar_aluno
		// -- Params : 
		// -- Descrição : 
		function cadastrar_aluno()
		{
			try
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
				$insert = $this->minha_model->cadastrar('tb_alunos', $data);
				echo json_encode(array("status" => TRUE));
			}
			catch(Exception $erro)
			{
	            echo json_encode(FALSE);
			}
		}

		public
		// -- Function Name : cadastrar_formacao
		// -- Params : 
		// -- Descrição :
		function cadastrar_formacao()
		{
			try
			{
				$this->validacao('formacao');
				$data = array('curso_id' => $this->input->post('curso'), 'aluno_id' => $this->session->userdata('id_aluno') );
				$insert = $this->minha_model->cadastrar('tb_curso_aluno', $data);
				echo json_encode(array("status" => TRUE));
			}
			catch(Exception $e)
			{
				 $data = array(); $data['msg_erro'] = array(); $data['campo'] = array(); $data['status'] = TRUE;
	             $data['campo'][] = 'curso'; $data['msg_erro'][] = 'ERRO' ; $data['status'] = FALSE;
			}
		}

		/*
		|--------------------------------------------------------------------------
		| 								Monta edição
		|--------------------------------------------------------------------------
		*/

		public
		// -- Function Name : editar_aluno
		// -- Params : $id
		// -- Descrição : 
		function editar_aluno($id)
		{
			$this->verifica_session();
			try 
			{
				$data = $this->minha_model->get_codicional('
                nome, email, cpf, id_aluno, dt_nascimento, sexo, copetencia, telefone, area_id', 
                'tb_alunos', array('id_aluno' => $id))->row();
				$data->date = $this->m_tlm->data_br($data->dt_nascimento);
				echo json_encode($data);	
			} 
			catch (Exception $e) 
			{
               echo json_encode(FALSE);
			}
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
                	'tb_curso_aluno AS cp', 
                	'tb_cursos AS c', 'tb_alunos AS p', 
                	'cp.curso_id = c.id_curso', 
                	'p.id_aluno = cp.aluno_id AND cp.id_curso_aluno = '. $id)->row();
				echo json_encode($data);	
			} 
			catch (Exception $e) 
			{
               echo json_encode(FALSE);
			}
		}
		/*
		|--------------------------------------------------------------------------
		| 								Alteração
		|--------------------------------------------------------------------------
		*/

		public
		// -- Function Name : alterar_aluno
		// -- Params : 
		// -- Descrição : 
		function alterar_aluno()
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
			$this->minha_model->atualizar('tb_alunos', $data, array('id_aluno' => $this->session->userdata('id_aluno')));
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
			$dados['senha'] = $this->minha_model->get_codicional('senha', 'tb_alunos', array('id_aluno' => $this->session->userdata('id_aluno')))->result();

			if($dados['senha'][0]->senha == $senha_atual):
				$data = array('senha' => $this->m_tlm->criptografar($this->input->post('nova_senha')));
				$this->minha_model->atualizar('tb_alunos', $data, array('id_aluno' => $this->session->userdata('id_aluno') ));
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
		// -- Function Name : alterar_img
		// -- Params : 
		// -- Descrição : 		
		function alterar_img()
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
				$tamanhos = $this->calcula_percentual($this->input->post());
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

					$data_consulta['img'] = $this->minha_model->get_codicional('img_perfil', 'tb_alunos', array('id_aluno' => $this->session->userdata('id_aluno')))->result();

					if($data_consulta['img'][0]->img_perfil == 'use.png'):
						$data_img = array('img_perfil' => $dadosImagem['file_name']);
						$this->minha_model->atualizar('tb_alunos', $data_img, array('id_aluno' => $this->session->userdata('id_aluno')));	
					else: 
						$data_img = array('img_perfil' => $dadosImagem['file_name']);
						$this->minha_model->atualizar('tb_alunos', $data_img, array('id_aluno' => $this->session->userdata('id_aluno')));
						unlink('C:\xampp\htdocs\project\imagens\img_upload/'. $data_consulta['img'][0]->img_perfil);
					endif;
					redirect('aluno');
				endif;
			endif;
		}

		public
		// -- Function Name : alterar_formacao
		// -- Params : 
		// -- Descrição : 
		function alterar_formacao()
		{
			$this->verifica_session();
			$data = array('curso_id' => $this->input->post('curso'));
			$this->minha_model->atualizar('tb_curso_aluno', $data, array('id_curso_aluno' =>  $this->input->post('id_curso_aluno') ));
			echo json_encode(array("status" => TRUE));
		}

		/*
		|--------------------------------------------------------------------------
		| 								Pesquisas
		|--------------------------------------------------------------------------
		*/
	
		public
		// -- Function Name : lista_dados_a
		// -- Params : 
		// -- Descrição : 
		function lista_dados_a()
		{
            $this->verifica_session();
            try
            {
    			$list['dados'] = $this->minha_model->get_one_inner('
                     p.nome, p.dt_nascimento, p.telefone, p.sexo, p.cpf, p.email, p.copetencia ,a.area', 
                    'tb_alunos AS p', 
                    'tb_areas AS a', 
                    'p.area_id = a.id_area AND p.id_aluno = '. $this->session->userdata('id_aluno') )->row();

    			$list['dados']->dt_nascimento = $this->m_tlm->data_br($list['dados']->dt_nascimento);
    			$list['dados']->sexo = ucfirst($list['dados']->sexo);
    			
                echo json_encode($list);
            } 
            catch (Exception $erro)
            {
               echo json_encode(FALSE);
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
                	c.curso, cp.id_curso_aluno', 
                	'tb_curso_aluno AS cp', 
                	'tb_cursos AS c', 'tb_alunos AS p', 
                	'cp.curso_id = c.id_curso', 
                	'p.id_aluno = cp.aluno_id AND p.id_aluno = '. $this->session->userdata('id_aluno'))->result_array();

                echo json_encode($list);
            }
            catch (Exception $erro)
            {
               echo json_encode(FALSE);
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

		/*
		|--------------------------------------------------------------------------
		| 								Privates
		|--------------------------------------------------------------------------
		*/

		private
		// -- Function Name : calcula_percentual
		// -- Params : 
		// -- Descrição :
	    function calcula_percentual($dimensoes)
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

		/*
		|--------------------------------------------------------------------------
		| 								Validações
		|--------------------------------------------------------------------------
		*/
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
					
					if($this->form_validation->set_rules('cpf', 'CPF', 'required|is_unique[tb_alunos.cpf]|is_unique[tb_alunos.cpf]')->run() == TRUE):
						$data['status'] = TRUE;
					else:
						$data['campo'][] = 'cpf'; $data['msg_erro'][] = form_error('cpf', ' ', ' '); $data['status'] = FALSE;
					endif;
					
					if($this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[tb_alunos.email]|is_unique[tb_alunos.email]')->run() == TRUE):
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
					
					if($this->form_validation->set_rules('confirmar_senha', 'Confirmar senha', 'required|min_length[6]|max_length[13]|addslashes|matches[nova_senha]|trim', array('matches' => 'As senhas não são iguais' , ))->run() == TRUE):
						$data['status'] = TRUE;
					else:
						$data['campo'][] = 'confirmar_senha'; $data['msg_erro'][] = form_error('confirmar_senha', ' ', ' '); $data['status'] = FALSE;
					endif;
				break;

				case 'formacao':
					if($this->form_validation->set_rules('tipo_curso', 'Curso', 'required')->run() == TRUE):
						$data['status'] = TRUE;
					else:
						$data['campo'][] = 'curso'; $data['msg_erro'][] = form_error('curso', ' ', ' '); $data['status'] = FALSE;
					endif;
					
					if($this->form_validation->set_rules('tipo_curso', 'Tipo Curso', 'required')->run() == TRUE):
						$data['status'] = TRUE;
					else:
						$data['campo'][] = 'tipo_curso'; $data['msg_erro'][] = form_error('tipo_curso', ' ', ' '); $data['status'] = FALSE;
					endif;
				break; 
			}
		
		if($data['status'] === FALSE):
			echo json_encode($data);
			exit();
		endif;
	}
}