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
			
			if($query->num_rows() > 0):
				return $query->result_array();
			else:
				throw new Exception("Nenhum valor retornado");
			endif;
		}

		public
		// -- Function Name : consulta_simples
		// -- Params : $asteristico, $tabela
		// -- Purpose : 
		function consulta_simples($asteristico, $tabela)
		{
			$query = $this->db->select($asteristico)->from($tabela)->get();

			if($query->num_rows() > 0):
				return $query->result();
			else:
				throw new Exception("Nenhum valor retornado");
			endif;
			
		}

		public
		// -- Function Name : get_codicional
		// -- Params : $asteristico, $tabela, $condicao
		// -- Purpose : 
		function get_codicional($asteristico, $tabela, $condicao)
		{
			$query = $this->db->select($asteristico)->from($tabela)->where($condicao)->get();

			if($query->num_rows() > 0):
			   return $query;
			else:
				throw new Exception("Nenhum valor retornado");
			endif;
		}

		public
        // -- Function Name : get_one_inner
        // -- Params : $asteristico, $tabela1, $tabela2, $on
        // -- Descrição :  
        /* SELECT (exbir) FROM tb1 AS cp 
           INNER JOIN tb2 AS c ON c.id_curso = cp.curso_id 
           INNER JOIN tb_professores AS p ON p.id_professor = cp.professor_id
           AND p.id_professor = $paramentro 
        */
        function get_one_inner($asteristico, $tabela1, $tabela2, $on)
        {
            $query = $this->db->select($asteristico)->from($tabela1)->join($tabela2, $on)->get();
        
            if($query->num_rows() > 0):
                return $query;
            else:
              throw new Exception("Nada encontrado", 2);
            endif;
        }

        public
        // -- Function Name : get_two_inner
        // -- Params : $asteristico, $tabela1, $tabela2, $tabela3, $on1, $on2
        // -- Descrição : 
        /* SELECT (exbir) FROM tb1 AS cp 
           INNER JOIN tb2 AS c ON c.id_curso = cp.curso_id 
           INNER JOIN tb3 AS p ON p.id_professor = cp.professor_id
           AND p.id_professor = $paramentro 
        */
        function get_two_inner($asteristico, $tabela1, $tabela2, $tabela3, $on1, $on2)
        {
            $query = $this->db->select($asteristico)->from($tabela1)->join($tabela2, $on1)->join($tabela3, $on2)->get();
        
            if($query->num_rows() > 0):
                return $query;
            else:
              throw new Exception("Nada encontrado", 2);
            endif;
        }

	}

