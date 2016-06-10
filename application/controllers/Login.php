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
		$this->load->view('inc/head');
		$this->load->view('login/index');//view responsvel com form login e form cadastros
		$this->load->view('login/acoes_ajax');
	}

}
