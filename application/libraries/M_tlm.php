<?php
defined('BASEPATH') OR exit('No direct script access allowed');

final class M_tlm
{
  ######################## Método Para Remover Acentos e caracteres especiais ########################
	public function geradorTags($valor)
	{
	   $alterado = preg_replace(array("/( |'|''|)/","/(á|à|ã|â|ä )/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë|&)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/","/(Ç|ç)/"),explode(" ","_ a A e E i I o O u U n N c"),$valor);
   		return strtolower($alterado);
	}

  ######################## Método Para Criptografar Senhas ########################
	public function criptografar($senha)
  {
      return sha1(md5($senha));
  }

  ######################## Método Para remover aspas ########################
  public function remove_aspas($valor)
  {
      $alterado = preg_replace(array("/('|''|)/"),explode(" ",""),$valor);
      return $alterado;
  }


  ######################## Método para retornar o mês em Portugues ########################
  public function nome_mes()
  {
      $mes = date('m');

      switch ($mes)
      {
        case '1': return 'Janeiro'; break;

        case '2': return 'Fevereiro'; break;

        case '3': return 'Março'; break;

        case '4': return 'Abril'; break;

        case '5': return 'Maio'; break;

        case '6': return 'Junho'; break;

        case '7': return 'Julho'; break;

        case '8': return 'Agosto'; break;

        case '9': return 'Setembro'; break;

        case '10': return 'Outubro'; break;

        case '11': return 'Novembro'; break;

        case '12': return 'Dezembro'; break;
      }

  }

  ######################## Método que formata data em formato Americando para Brasilieiro ########################
  public function data_br($data_eua)
  {
   	  $data = explode('-', $data_eua);
   	  $data_br = @$data[2].'/'.@$data[1].'/'.$data[0];
   	  return $data_br;
  }

  ######################## Método que formata data em formato Brasileiro para Americano ########################
  public function data_eua($data_br)
  {
    	$data = explode('/', $data_br);
    	$data_eua = $data[2].'-'.$data[1].'-'.$data[0];
    	return $data_eua;
  }

  ######################## Método Para Calcular Valor do Frete(Retonando valor, dias de entrega) ########################
  public function calcular_Frete($cep_origem, $cep_destino, $peso, $valor, $tipo_do_frete, $altura, $largura, $comprimento)
  {
   		$url = "http://ws.correios.com.br/calculador/CalcPrecoPrazo.aspx?";
   		$url .="sCdEmpresa=";
   		$url .="&nDsSenha=";
   		$url .="&sCepOrigem=".$cep_origem;
   		$url .="&sCepDestino=".$cep_destino;
   		$url .="&nVlPeso=". $peso;
   		$url .="&nVlLargura=". $largura;
   		$url .="&nVlAltura=". $altura;
   		$url .="&nCdFormato=1";
   		$url .="&nVlComprimento=". $comprimento;
   		$url .="&sCdMaoPropria=n";
   		$url .="&nVlValorDeclarado=". $valor;
   		$url .="&sCaAvisoRecebimento=n";
   		$url .="&nCdServico=" . $tipo_do_frete;
   		$url .="&nVlDiametro=0";
   		$url .="&StrRetorno=xml";

   		//sedex: 40010
   		//pac: 41106

      if(!$url)
      {
         $url = "Erro";
      }

   		$xml = simplexml_load_file($url);

      return $xml->cServico;

 	}
}

?>