<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller 
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_Login','minha_model');
	}

	public function index()
	{
		$data['csrf'] = array('name' => $this->security->get_csrf_token_name(),'hash' => $this->security->get_csrf_hash());
		$this->load->view('inc/head');
		$this->load->view('login/index', $data);//view responsvel com form login e form cadastros
		$this->load->view('login/acoes_ajax');
	}

}
