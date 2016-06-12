<?php

class M_Login extends MY_Model
{

  function __construct() 
  {
    parent::__construct();
  }

  public function logar($asteristico, $tabela, $email, $senha)
  {
    
    $retorno = $this->db->select($asteristico)->from($tabela)->where('email', $email)->where('senha', $senha)->get()->result();

    return $retorno;
    
  }
  public function consulta_validacao($asteristico, $tabela, $chave, $valor)
  {
    
    $retorno = $this->db->select($asteristico)->from($tabela)->where($chave, $valor)->get()->result();

    return $retorno;
    
  }

  public function atualiza_senha($tabela, $antiga, $nova, $id, $id_referencial, $url)
  {
    $this->load->library('L_metodos_tlm');

    $_id_referencial = $id_referencial;
    $_url = $url;

    $_antiga = $this->l_metodos_tlm->criptografar($antiga);
    $_nova = $this->l_metodos_tlm->criptografar($nova);

    $dados['senha'] = $this->db->select('senha')->from($tabela)->where($id, $_id_referencial)->get()->result();

    $dados_funcionario['senha'] = $_nova;

    if($dados['senha'][0]->senha == $_antiga)
    {
      $this->m_funcionario->atualizar('tbfuncionarios', $dados_funcionario, 'id', $_id_referencial);

      return redirect('c_funcionario/dados_funcionario/'.$_url.'/update_sucesso');  
    }
    else
    {
      return redirect('c_funcionario/dados_funcionario/'.$_url.'/update_falha');  
    }
  }
}
