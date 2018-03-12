<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  App\Model\Deputados;

class DeputadosDumpController extends Controller
{
    //
    public function getList(){
        return planAtividades::all();
    }

    public function postNewDeputado($dados){

        planAtividades::create($dados);

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


        return print_r($aDeputados['dados'][1],true);
        curl_close($ch);

        //return view('teste');
    }
}
