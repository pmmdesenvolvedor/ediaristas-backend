<?php

namespace App\Http\Controllers;

use App\Http\Requests\DiaristaRequest;
use App\Models\Diarista;
use App\Services\ViaCEP;
use Illuminate\Http\Request;

class DiaristaController extends Controller
{

    public function __construct(protected ViaCEP $viaCep) {}

    /**
     * Lista as diaristas
     *
     * @return void
     */
    public function index()
    {

        $diaristas = Diarista::get();

        return view('index', [
            'diaristas' => $diaristas
        ]);
    }

    /**
     * Mostra formulário de inclusão de diaristas
     *
     * @return void
     */
    public function add()
    {
        return view('add');
    }

    /**
     * Armazena uma diarista no banco de dados
     *
     * @param Request $request
     * @return void
     */
    public function store(DiaristaRequest $request)
    {
        $dados = $request->except(('_token'));
        
        if($request->hasFile('foto_usuario')) {
            $dados['foto_usuario'] = $request->foto_usuario->store('public');
        }

        $dados['codigo_ibge'] = $this->viaCep->buscar($dados['cep'])['ibge'];

        Diarista::create($dados);

        return redirect()->route('diaristas.index');
    }

    /**
     * Mostra formulário de ediçao de diaristas já preenchido
     *
     * @param integer $id
     * @return void
     */
    public function edit(int $id)
    {
        $diarista = Diarista::findOrFail($id);

        return view('edit', ['diarista' => $diarista]);
    }

    /**
     * Atualiza uma diarista no banco de dados
     *
     * @param integer $id
     * @param Request $request
     * @return void
     */
    public function update(int $id, DiaristaRequest $request)
    {
        $diarista = Diarista::findOrFail($id);
        $dados = $request->except(['_token', '_method']);

        if($request->hasFile('foto_usuario')) {
            $dados['foto_usuario'] = $request->foto_usuario->store('public');
        }

        $dados['codigo_ibge'] = $this->viaCep->buscar($dados['cep'])['ibge'];

        $diarista->update($dados);

        return redirect()->route('diaristas.index');
    }

    /**
     * Exclui uma diarista do banco de dados
     *
     * @param integer $id
     * @return void
     */
    public function delete(int $id)
    {
        $diarista = Diarista::findOrFail($id);
        $diarista->delete();

        return redirect()->route('diaristas.index');
    }
}
