<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diarista extends Model
{
  use HasFactory;

  /**
   * Define os campos a serem gravados
   *
   * @var array
   */
  protected $fillable = [
    'nome_completo',
    'cpf',
    'email',
    'telefone',
    'logradouro',
    'numero',
    'complemento',
    'bairro',
    'cidade',
    'estado',
    'cep',
    'codigo_ibge',
    'foto_usuario'
  ];

  /**
   * Definie campos visíveis na API
   *
   * @var array
   */
  protected $visible = [
    'nome_completo',
    'cidade',
    'foto_usuario',
    'reputacao'
  ];

  /**
   * Inclui reputação na serialização
   *
   * @var array
   */
  protected $appends = ['reputacao'];

  /**
   * Busca diaristas por código IBGE
   *
   * @param integer $codigoIbge
   * @return void
   */
  static public function BuscaPorCodigoIbge(int $codigoIbge)
  {
    return self::where('codigo_ibge', $codigoIbge)->limit(6)->get();
  }

  /**
   * Retorna a quantidade de diaristas
   *
   * @param integer $codigoIbge
   * @param integer $limite
   * @return void
   */
  static public function QuantidadePorCodigoIbge(int $codigoIbge, int $limite)
  {
    $quantidade = self::where('codigo_ibge', $codigoIbge)->count();
    return $quantidade > $limite ? $quantidade - $limite : 0;
  }

  /**
   * Monta URl da imagem
   *
   * @param String $valor
   * @return void
   */
  public function getFotoUsuarioAttribute(String $valor)
  {
    return config('app.url') . $valor;
  }

  /**
   * Retorna reputação randomica
   *
   * @return void
   */
  public function getReputacaoAttribute()
  {
    return mt_rand(1,5);
  }
}
