<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use phpDocumentor\Reflection\Types\Boolean;

class ViaCEP {

  /**
   * Consulta CEP no ViaCep 
   *
   * @param String $cep
   * @return boolean|array
   */
  public function buscar(String $cep)
  {
    $url = sprintf('https://viacep.com.br/ws/%s/json/', $cep);

    $resposta = Http::get($url);

    if ($resposta->failed()){
      return false;
    }

    $dados = $resposta->json();

    if (isset($dados['erro']) && $dados['erro'] === true) {
      return false;
    }

    return $dados;
  }
}
