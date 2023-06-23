<?php

namespace App\Http\Controllers;

use App\Models\Iten;
use Illuminate\Http\Request;

class ItenController extends Controller
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
        
        $itens = json_decode($request->input('allsalesData'));

        // dd($itens);

        foreach ($itens as $iten) {
            // Crie uma nova instância do modelo Venda
            $novoIten = new Iten();
            
            // Atribua os valores aos campos do modelo
            $novoIten->produto_id = $iten->idProd;
            $novoIten->qtd = $iten->qtd;
            $novoIten->vlUnit = $iten->preco;
            $novoIten->totItem = $iten->subtotal;
            $novoIten->vendas_id = $iten->idVenda;

            // $novoIten->produto = $iten->produto;
            
            // Salve a nova venda no banco de dados
            $novoIten->save();
        }
         // Redireciona para a página de edição do registro adicionado
         return redirect()->route('editvenda', ['venda' => $iten->idVenda]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Iten  $iten
     * @return \Illuminate\Http\Response
     */
    public function show(Iten $iten)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Iten  $iten
     * @return \Illuminate\Http\Response
     */
    public function edit(Iten $iten)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Iten  $iten
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Iten $iten)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Iten  $iten
     * @return \Illuminate\Http\Response
     */
    public function destroy(Iten $iten)
    {
        //
    }
}
