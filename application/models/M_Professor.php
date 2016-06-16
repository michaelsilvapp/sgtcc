<?php

class M_Professor extends MY_Model
{

  function __construct() 
  {
    parent::__construct();
  }

  public function retorna_id_professor($asteristico, $tabela ,$id)
  {
     $query = $this->db->select($asteristico)->from($tabela)->where('id_professor', $id)->get();
     return $query->row();
  }

  ##$sql = "SELECT tb_professores.nome, tb_professores.area_id, tb_areas.area FROM tb_professores INNER JOIN tb_areas ON tb_professores.area_id = tb_areas.id_area AND tb_professores.id_professor = 2"

  public function consulta_inner_professor($asteristico, $tabela1, $tabela2, $on)
  {
  	$query = "SELECT $asteristico FROM $tabela1 INNER JOIN $tabela2 ON $on";

  	return $this->db->query($query)->row();
  }

  
}
