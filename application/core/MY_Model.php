<?php

class MY_Model extends CI_Model
{

	function __construct()
	{
		parent::__construct();		
	}

	########################################### Insert ################################################
	public function cadastrar($tabela, $dados = null)
	{
		$insere_funcionario = $this->db->insert($tabela, $dados);	
		return $this->db->insert_id();
	}

	public function excluir($tabela, $referencia, $id)
	{
		$this->db->where($referencia, $id);

		return $this->db->delete($tabela);
	}

	public function atualizar($tabela, $dados, $referencia, $id)
	{
		$this->db->where($referencia, $id);

		return $this->db->update($tabela, $dados);
	}
	
	function GetAll($tabela, $sort = 'id', $order = 'asc')
	{
    	$this->db->order_by($sort, $order);
    	$query = $this->db->get($tabela);

    	if ($query->num_rows() > 0) 
    	{
      		return $query->result_array();
    	} 
    	else 
    	{
      		return null;
    	}
  	}

	public function consulta_simples($asteristico, $tabela)
	{
		return $this->db->select($asteristico)->from($tabela)->get()->result();
	}

	public function consulta_condicional($asteristico, $tabela, $condicao)
	{
		return $this->db->select($asteristico)->from($tabela)->where($condicao)->get()->result();
	}

	##SELECT tbfuncionarios.*, tbcontatos.*, tbcontatos.id AS id_contato FROM tbfuncionarios INNER JOIN tbcontatos ON tbcontatos.id_funcionario = tbfuncionarios.id AND tbcontatos.id = 3
	public function consulta_inner($asteristico, $tabela1, $tabela2, $on, $condicao = null)
	{
		return $this->db->select($asteristico)->from($tabela1)->join($tabela2, $on, 'INNER')->get()->result();
	}
}
?>