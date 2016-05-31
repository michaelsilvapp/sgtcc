<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class C_painel extends CI_Controller 
{

	########################################### Functions ################################################
	public function verifica_session()
	{
		if($this->session->userdata('logado') == FALSE)
		{
			redirect('c_painel/');	
		}
	}

    public function sair()
    {
        $this->session->sess_destroy();

        redirect('c_painel/');
    }


	########################################### Forms e Pags ################################################
	public function index()
	{
		$this->load->view('includes/headcss');
		$this->load->view('p_painel/login');
	}

	public function home()
	{
        $this->verifica_session();
		$this->load->view('includes/headcss');
		$this->load->view('includes/menu');
		$this->load->view('p_painel/home');
	}

    ########################################### Metodos de Consulta ################################################
	public function logar()
    {
        $this->load->library('metodos_diversos');
        $email = $this->input->post('email');
        $senha = $this->metodos_diversos->criptografar($this->input->post('senha'));
        $data['funcionario'] =  $this->db->select('*')->from('tbfuncionarios')->where('email', $email)->where('senha', $senha)->get()->result();

        if(count($data['funcionario']) == 1)
        {
            $dados_funcionario['nome'] = $data['funcionario'][0]->nome;
            $dados_funcionario['id'] = $data['funcionario'][0]->id;
            $dados_funcionario['logado'] = TRUE;

            $this->session->set_userdata($dados_funcionario);

            redirect('c_painel/home');
        }
        else
        {
            redirect('c_painel/');
        }
    }

}
