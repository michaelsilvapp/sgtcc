<?php

	// -- Class Name : MY_Model
	// -- Purpose : 
	// -- Created On : 
	class MY_Model extends CI_Model
	{
		public
		// -- Function Name : __construct
		// -- Params : 
		// -- Purpose : 
		function __construct()
		{
			parent::__construct();
		}

		public
		// -- Function Name : cadastrar
		// -- Params : $tabela, $dados = null
		// -- Purpose : 
		function cadastrar($tabela, $dados = null)
		{
			$insere_funcionario = $this->db->insert($tabela, $dados);
			return $this->db->insert_id();
		}

		public
		// -- Function Name : excluir
		// -- Params : $tabela, $referencia, $id
		// -- Purpose : 
		function excluir($tabela, $referencia, $id)
		{
			$this->db->where($referencia, $id);
			return $this->db->delete($tabela);
		}

		public
		// -- Function Name : atualizar
		// -- Params : $tabela, $dados, $where
		// -- Purpose : 
		function atualizar($tabela, $dados, $where)
		{
			$this->db->update($tabela, $dados, $where);
			return $this->db->affected_rows();
		}

		public
		// -- Function Name : GetAll
		// -- Params : $tabela, $sort = 'id', $order = 'asc'
		// -- Purpose : 
		function getall($tabela, $sort = 'id', $order = 'asc')
		{
			$query = $this->db->order_by($sort, $order)->get($tabela);
			
			if ($query->num_rows() > 0)
			{
				return $query->result_array();
			}
			else
			{
				throw new Exception("Nenhum valor retornado");
			}

		}

		public
		// -- Function Name : consulta_simples
		// -- Params : $asteristico, $tabela
		// -- Purpose : 
		function consulta_simples($asteristico, $tabela)
		{
			$query = $this->db->select($asteristico)->from($tabela)->get();

			if($query->num_rows() > 0)
			{
				return $query->result();
			}
			else
			{
				throw new Exception("Nenhum valor retornado");
			}
			
		}

		public
		// -- Function Name : consulta_condicional
		// -- Params : $asteristico, $tabela, $condicao
		// -- Purpose : 
		function consulta_condicional($asteristico, $tabela, $condicao)
		{
			$query = $this->db->select($asteristico)->from($tabela)->where($condicao)->get();

			if($query->num_rows() > 0)
			{
			   return $query->result();
			}
			else
			{
				throw new Exception("Nenhum valor retornado");
			}
		}

		public
		// -- Function Name : consulta_inner
		// -- Params : $asteristico, $tabela1, $tabela2, $on, $condicao = null
		// -- Purpose : 
		function consulta_inner($asteristico, $tabela1, $tabela2, $on, $condicao = null)
		{
			return $this->db->select($asteristico)->from($tabela1)->join($tabela2, $on, 'INNER')->get()->result();
		}

	}

