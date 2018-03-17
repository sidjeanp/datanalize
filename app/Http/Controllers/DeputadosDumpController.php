<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  App\Model\Deputados;
use App\Model\DeputadosDetalhes;
use App\Model\DeputadosUltimoStatus;
use App\Model\DeputadosRedeSocial;
use App\Model\DeputadosGabinete;
use App\Model\DeputadosLink;
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
            //return $aux;
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

            $aDados = array_merge( array("idDeputados"=>$aDeputados['dados']['id']),$aDeputados['dados']);

            $deputadoDetalhe = DeputadosDetalhes::create($aDados);

            foreach ($aDados['redeSocial'] as $item) {
                $dadosRedeSocial = array_merge(['idDeputados' => $deputadoDetalhe->idDeputados], ['url'=>$item]);
                DeputadosRedeSocial::create($dadosRedeSocial);
            }

            foreach ($aDeputados['links'] as $item) {
                $dadosLink = array_merge(['idDeputados' => $deputadoDetalhe->idDeputados], $item);
                DeputadosLink::create($dadosLink);
            }



            $deputadosDetalhesStatus = DeputadosUltimoStatus::create(
                array_merge(array("idDeputados"=>$deputadoDetalhe->idDeputados),$aDados['ultimoStatus']));

            DeputadosGabinete::create(
                array_merge(array("idDeputadosStatus"=>$deputadosDetalhesStatus->id),$aDados['ultimoStatus']['gabinete']));

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
