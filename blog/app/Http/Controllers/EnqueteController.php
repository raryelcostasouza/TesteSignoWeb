<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Enquete;
use App\Models\Opcao;

class EnqueteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $enquetes = Enquete::all();
        
        return view('index',compact('enquetes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request ->validate([
           'data_inicio'=> 'required|date|before:data_termino',
            'data_termino'=> 'required|date',
            'titulo'=> 'required|max:255'
            ]);
        
        $enquete = Enquete::create($validatedData);
        
        //cria as opcoes da enquete e salva no banco
        $opcoes = $request->opcao_resposta;
        foreach ($opcoes as $opcao)
        {
            $enquete->opcoes()->create([
                'opcao_resposta' => $opcao,
                'foreign_key' => $enquete->id
            ]);
        }
        
        return redirect('/enquete')->with('success', 'Enquete salva com êxito');
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
        return view('edit', compact('enquete'));
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
        $validatedData = $request->validate([
            'data_inicio'=> 'required|date|before:data_termino',
            'data_termino'=> 'required|date',
            'titulo'=> 'required|max:255'            
        ]);
        $e = Enquete::find($id);
        $e->update($validatedData);
        
        $opcoes_alteradas = $request->opcao_resposta;
        
        
        //se opcoes novas foram adicionadas ou as existentes modificadas
        if (sizeof($opcoes_alteradas) >=$e->opcoes->count())
        {
            $i = 0;
            foreach ($opcoes_alteradas as $opcao_alterada)
            {
                // se a opcao já estava na lista atualiza
                if ($i < $e->opcoes->count())
                {
                    $this->updateOpcoesExistentes($e->opcoes[$i], $opcao_alterada, $e->id);

                    /*$opcao = $e->opcoes[$i];
                    $opcao->update([
                    'opcao_resposta' => $opcao_alterada,
                    'foreign_key' => $e->id
                ]);*/
                }
                //senão cria uma nova e adiciona
                else
                {
                    $this->createNovasOpcoes($opcao_alterada, $e);
                    /*$e->opcoes()->create([
                    'opcao_resposta' => $opcao_alterada,
                    'foreign_key' => $e->id
                ]);*/
                }

                $i++;
            }
        }
        //caso o número de opções tenha diminuído... atualiza as mantidas e deleta as que sobrarem
        else
        {
            $i = 0;
            foreach ($e->opcoes as $opcaoOld)
            {
                //nas opcoes que se mantiveram atualiza os dados
                if ($i < sizeof($opcoes_alteradas))
                {
                    $this->updateOpcoesExistentes($opcaoOld, $opcoes_alteradas[$i], $e->id);
                }
                //nas posteriores... que não existem mais... remove
                else
                {
                    $this->deleteOpcoesExistentes($e->opcoes, $i);
                }
                $i++;
            }
        }
        
        
        

        return redirect('/enquete')->with('success', 'Dados da Enquete atualizados com êxito');
    }
    
    private function updateOpcoesExistentes($opcaoOld, $opcaoNew, $enquete_id)
    {
        $opcaoOld->update([
        'opcao_resposta' => $opcaoNew,
        'foreign_key' => $enquete_id
        ]);
    }
    
    private function createNovasOpcoes($opcaoNew, $enquete)
    {
        $enquete->opcoes()->create([
        'opcao_resposta' => $opcaoNew,
        'foreign_key' => $enquete->id
         ]);
    }
    
    private function deleteOpcoesExistentes($opcoesOld, $indexStart)
    {
        //loop pelas opcoes restantes deletando todas
        for ($i = $indexStart; $i < $opcoesOld->count(); $i++) 
        {
            $opcoesOld[$i]->delete();
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
        $enquete = Enquete::findOrFail($id);
        foreach($enquete->opcoes as $opcao)
        {
            $opcao->delete();
        }
        $enquete->delete();
        return redirect('/enquete')->with('success', 'Enquete removida com êxito');
    }
}
