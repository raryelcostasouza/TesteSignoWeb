<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Enquete;
use App\Models\Opcao;

class VotacaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $enquete = Enquete::findOrFail($id);
        return view('votacao', compact('enquete'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $voto = $request->voto;
        $e = Enquete::findOrFail($id);
        
        //se a data atual estiver no período válido de respostas da enquete
        if ((date("Y-m-d") > $e->data_inicio) && ((date("Y-m-d") < $e->data_termino)))
        {
            if ($voto != null)
            {
               $opcao = Opcao::findOrFail($voto);

               $opcao->update([
                'num_votos' => ($opcao->num_votos + 1)
                ]);
             }
             return redirect('/enquete')->with('success', 'Voto Registrado com êxito');
        }
        //senao retorna erro
        else
        {
            return redirect('/enquete')->withErrors('Período de Votação Inválido');
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
