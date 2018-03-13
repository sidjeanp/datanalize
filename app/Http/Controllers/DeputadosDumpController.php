<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  App\Model\Deputados;

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
