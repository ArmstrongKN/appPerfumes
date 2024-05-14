<?php

namespace App\Http\Controllers;

use App\Models\Perfume;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PerfumeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function indexPerfume()
    {
        $perfumes = Perfume::All();

        $contador = $perfumes->count();

        return 'N° de Clientes: ' . $contador . '<br>' .  $perfumes . Response()->json([], Response::HTTP_NO_CONTENT);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storePerfume(Request $request)
    {
        $perfumes = $request->All();

        $validacao = Validator::make($perfumes, [
            'marca' =>  'required',
            'fragancia' =>  'required',
            'mL' =>  'required',
            'descricao' =>  'required'
        ]);

        if ($validacao->fails()) {
            return 'Dados inválidos' . $validacao->error(true) . 500;
        }

        $cadastro = Perfume::create($perfumes);

        if ($cadastro) {
            return 'Perfume armazenado com sucesso'  . Response()->json([], Response::HTTP_NO_CONTENT);
        } else {
            return 'Perfume não armazenado ' . Response()->json([], Response::HTTP_NO_CONTENT);
        }
    }

    /**
     * Display the specified resource.
     */
    public function showPerfume(string $id)
    {
        $perfumes = Perfume::find($id);

        if ($perfumes) {
            return 'Perfume detectado ' . $perfumes;
        } else {
            return 'Perfume desconhecido ' . Response()->json([], Response::HTTP_NO_CONTENT);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function updatePerfumes(Request $request, string $id)
    {
        $perfumes = $request->all();

        $validacao = Validator::make($perfumes, [
            'marca' =>  'required',
            'fragancia' =>  'required',
            'mL' =>  'required',
            'descricao' =>  'required'
        ]);

        if ($validacao->fails()) {
            return 'Dados inválidos' . $validacao->error(true) . 500;
        }

        $alteracao = Perfume::find($id);
        $alteracao->marca = $perfumes['marca'];
        $alteracao->fragancia = $perfumes['fragancia'];
        $alteracao->mL = $perfumes['mL'];
        $alteracao->descricao = $perfumes['descricao'];

        $retorno = $alteracao->save();

        if ($retorno) {
            return 'Perfume modificado com sucesso ' . Response()->json([], Response::HTTP_NO_CONTENT);
        } else {
            return 'Perfume não modificado ' . Response()->json([], Response::HTTP_NO_CONTENT);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroyPerfume(string $id)
    {
        $perfumes = Perfume::find($id);

        if ($perfumes->delete()) {
            return 'O perfume foi descartado ' . response()->json([], Response::HTTP_NO_CONTENT);
        }

        return 'O perfume não foi descartado ' . response()->json([], Response::HTTP_NO_CONTENT);
    }
}
