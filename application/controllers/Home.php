<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_Login','minha_model');
		$this->verifica_session();
	}

	public function verifica_session()
	{
		if($this->session->userdata('logado') == FALSE)
		{
			redirect('/');	
		}
	}

	public function index()
	{
		$data = array('myname' => $this->session->userdata('nome'));
		$this->load->view('inc/head');
		$this->parser->parse('inc/menu', $data);
		$this->load->view('home/index');
		//$this->load->view('usuarios/usuarios_ajax');
		//$this->load->view('inc/footer');
	}
}
