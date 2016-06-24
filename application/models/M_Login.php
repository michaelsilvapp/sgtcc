<?php

    // -- Class Name : M_Login
    // -- Purpose : 
    // -- Created On : 
    class M_Login extends MY_Model
    {
        // -- Function Name : __construct
        // -- Params : 
        // -- Purpose : 
        function __construct()
        {
            parent::__construct();
        }

        public
        // -- Function Name : logar
        // -- Params : $asteristico, $tabela, $email, $senha
        // -- Purpose : 
        function logar($asteristico, $tabela, $email, $senha)
        {
            $query = $this->db->select($asteristico)->from($tabela)->where('email', $email)->where('senha', $senha)->get();
            
            if($query->num_rows() > 0):
               return $query;
            else:
                throw new Exception("Nenhum valor retornado");
            endif;
        }

    }