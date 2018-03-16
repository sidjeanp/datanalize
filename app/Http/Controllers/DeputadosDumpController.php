<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  App\Model\Deputados;
use App\Model\DeputadosDetalhes;
use App\Model\DeputadosUltimoStatus;
use Mockery\Exception;

class DeputadosDumpController extends Controller
{
    //
    public function getList(){
        return Deputados::all();
    }

    public function postNewDeputado($dados){

        Deputados::create($dados);

        return 'Planilha criada com sucesso';
    }

    public function buscaDadosAbertosDeputados($page = 0,$itens=10){

        $pagina = $page +1;


        //Paramotros do rest
        $data = array('pagina' => $pagina, 'itens' => $itens);
        $params = "?pagina=$pagina&intens=$itens";

        //URL do servidor rest que disponibiliza os dados abertos dos deputados
        $url = 'https://dadosabertos.camara.leg.br/api/v2/deputados'.$params;

        try{



        $ch = curl_init();
        //curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt_array($ch, [

            CURLOPT_URL => $url,

            //CURLOPT_POST => false,
            //CURLOPT_POSTFIELDS => $data,

            CURLOPT_HTTPHEADER => [
                //'Authorization: Bearer ' . $token,
                'Content-Type: application/json'
                //,'x-li-format: json'
            ],

            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_PROTOCOLS => CURLPROTO_HTTPS
        ]);

        $response = curl_exec($ch);
        $aDeputados = json_decode($response, true);

        //return print_r($aDeputados,true);

        foreach ($aDeputados['dados'] as $dado){
            //$aux .= $dado['id'].' - '.$dado['nome'].'<br />';
            $this->postNewDeputado($dado);
        }
        }
        catch(Exception $e){
            return print_r($e,true);
        }

        if(count($aDeputados['dados']) > 0){
            $this->buscaDadosAbertosDeputados($pagina ,$itens);
        }
        else{
            return '<h1>Acabou sorria</h1>';
        }
    }

    public function dumpDeputadosDetalhes(){

        $deputados = Deputados::all(['id']);


        $aux ='';
        foreach ($deputados as $deputado){
            $aux .= $deputado->id.'<br />';
            $aux = $this->getDeputadosDetalhes($deputado->id);
            return $aux;
        }

        return $aux;
    }

    public function getDeputadosDetalhes($id){
        //Paramotros do rest

        //URL do servidor rest que disponibiliza os dados abertos dos deputados
        $url = 'https://dadosabertos.camara.leg.br/api/v2/deputados/'.$id;

        try{
            $ch = curl_init();
            //curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt_array($ch, [

                CURLOPT_URL => $url,

                CURLOPT_HTTPHEADER => [
                    //'Authorization: Bearer ' . $token,
                    'Content-Type: application/json'
                    //,'x-li-format: json'
                ],

                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_PROTOCOLS => CURLPROTO_HTTPS
            ]);

            $response = curl_exec($ch);
            $aDeputados = json_decode($response, true);

            //return print_r($aDeputados['dados'],true);
            //return print_r($dado,,true);

            //foreach ($aDeputados as $dado){
                //return print_r($dado,true);
                $arrTeste = array("idDeputado"=>$aDeputados['dados']['id']);
                $aDados = array_merge( $arrTeste,$aDeputados['dados']);
                //$dado['idDeputado']=$dado['id'];
                DeputadosDetalhes::create($aDados);
                $dus = DeputadosUltimoStatus::create($aDados['ultimoStatus']);
                return print_r($dus->attributes,true);

                $dadosRedeSocial = array();
                foreach ($aDados['redeSocial'] as $itens){
                    $dadosRedeSocial[] = array_merge(['idDeputadosStatus'=>''], $itens);
                }

                DeputadosUltimoStatus::create($dadosRedeSocial);
            //}
        }
        catch(Exception $e){
            return print_r($e,true);
        }


    }

    public function inputDeputadosUltimoStatus($dados){

    }

    public function getDadosAbertosDeputados(){
        //$headers = array('Accept' => 'application/json');
        //$data = array('name' => 'Blog', 'company' => 'Universidade CodeIgniter');
        $url = 'https://dadosabertos.camara.leg.br/api/v2/deputados';

        $ch = curl_init();
        curl_setopt_array($ch, [

            CURLOPT_URL => $url,

            //CURLOPT_POST => true,


            CURLOPT_HTTPHEADER => [
                //'Authorization: Bearer ' . $token,
                'Content-Type: application/json'
                //,'x-li-format: json'
            ],

            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_PROTOCOLS => CURLPROTO_HTTPS
        ]);

        $response = curl_exec($ch);
        $aDeputados = json_decode($response, true);

        $aux = '';
        foreach ($aDeputados['dados'] as $dado){
            $aux .= $dado['id'].' - '.$dado['nome'].'<br />';
            $this->postNewDeputado($dado);
        }

        return $aux;



        //return print_r($aDeputados['dados'],true);
        curl_close($ch);

        //return view('teste');
    }
}
