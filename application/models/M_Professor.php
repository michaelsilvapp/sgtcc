<?php

class M_Professor extends MY_Model
{

  function __construct() 
  {
    parent::__construct();
  }

  public function retorna_id_professor($tabela ,$id)
  {
     $query = $this->db->from($tabela)->where('id_professor', $id)->get();
    return $query->row();
  }
  
}
