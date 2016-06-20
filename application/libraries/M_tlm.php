<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    final
    // -- Class Name : M_tlm
    // -- Purpose : 
    // -- Created On : 
    class M_tlm
    {
        public

        // -- Function Name : geradorTags
        // -- Params : $valor
        // -- Purpose : 
        function geradorTags($valor)
        {
          $alterado = preg_replace(array("/( |'|''|)/","/(á|à|ã|â|ä )/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë|&)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/","/(Ç|ç)/"),explode(" ","_ a A e E i I o O u U n N c"),$valor);
          return strtolower($alterado);       
        }

        public
        // -- Function Name : criptografar
        // -- Params : $senha
        // -- Purpose : 
        function criptografar($senha)
        {
            return sha1(md5($senha));
        }

        public
        // -- Function Name : remove_aspas
        // -- Params : $valor
        // -- Purpose : 
        function remove_aspas($valor)
        {
            $alterado = preg_replace(array("/('|''|)/"),explode(" ",""),$valor);
            return $alterado;
        }

        public

        // -- Function Name : nome_mes
        // -- Params : 
        // -- Purpose : 
        function nome_mes()
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

        public
        // -- Function Name : data_br
        // -- Params : $data_eua
        // -- Purpose : 
        function data_br($data_eua)
        {
            $data = explode('-', $data_eua);
            $data_br = @$data[2].'/'.@$data[1].'/'.$data[0];
            return $data_br;
        }

        public
        // -- Function Name : data_eua
        // -- Params : $data_br
        // -- Purpose : 
        function data_eua($data_br)
        {
            $data = explode('/', $data_br);
            $data_eua = $data[2].'-'.$data[1].'-'.$data[0];
            return $data_eua;
        }
    }
?>