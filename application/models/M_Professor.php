<?php
    // -- Class Name : M_Professor
    // -- Descrição : 
    // -- Created On : 
    class M_Professor extends MY_Model
    {
        // -- Function Name : __construct
        // -- Params : 
        // -- Descrição : 
        function __construct()
        {
            parent::__construct();
        }

        // -- Function Name : get_id_p
        // -- Params : $asteristico, $tabela ,$id
        // -- Descrição : 
        function get_id_p($asteristico, $tabela ,$id)
        {
            $query = $this->db->select($asteristico)->from($tabela)->where('id_professor', $id)->get();
            
            if($query->num_rows() > 0)
            {
                return $query->result();
            }
            else
            {
                throw new Exception("Nada encontrado", 2);
            }
        }

        public
        // -- Function Name : get_inner_p
        // -- Params : $asteristico, $tabela1, $tabela2, $on
        // -- Descrição :  
        /* SELECT (exbir) FROM tb1 AS cp 
           INNER JOIN tb2 AS c ON c.id_curso = cp.curso_id 
           INNER JOIN tb_professores AS p ON p.id_professor = cp.professor_id
           AND p.id_professor = $paramentro 
        */
        function get_inner_p($asteristico, $tabela1, $tabela2, $on)
        {
            $query = $this->db->select($asteristico)->from($tabela1)->join($tabela2, $on)->get();
        
            if($query->num_rows() > 0)
            {
                return $query;
            } 
            else
            {
              throw new Exception("Nada encontrado", 2);
            }
        }

        public
        // -- Function Name : get_inner_p
        // -- Params : $asteristico, $tabela1, $tabela2, $tabela3, $on1, $on2
        // -- Descrição : 
        /* SELECT (exbir) FROM tb1 AS cp 
           INNER JOIN tb2 AS c ON c.id_curso = cp.curso_id 
           INNER JOIN tb3 AS p ON p.id_professor = cp.professor_id
           AND p.id_professor = $paramentro 
        */
        function two_get_inner_p($asteristico, $tabela1, $tabela2, $tabela3, $on1, $on2)
        {
            $query = $this->db->select($asteristico)->from($tabela1)->join($tabela2, $on1)->join($tabela3, $on2)->get();
        
            if($query->num_rows() > 0)
            {
                return $query;
            } 
            else
            {
              throw new Exception("Nada encontrado", 2);
            }
        }

    }