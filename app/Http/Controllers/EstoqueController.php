<?php

namespace App\Http\Controllers;

use App\Models\Estoque;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EstoqueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    /*
    Busca a quantidade de Produto em Estoque,
    Busca a quantidade de Produtos Vendidos
    Calcula a diferente entre Comprados - Vendidos 
    retornando o estoque atual. 
    Caso o valor de qtdVenda seja NULL a função COALESCE retorna a qtdComprada para a coluna emEstoque
    */

    $estoquesCad = DB::SELECT("SELECT P.id, P.cod, P.Produto, E.qtdComprada, I.qtdVenda,
                        COALESCE(E.qtdComprada - I.qtdVenda, E.qtdComprada) AS emEstoque -- retorna o primeiro valor não nulo encontrado na lista
                        FROM produtos AS P
                        LEFT JOIN (
                            SELECT produtos_id, SUM(qtd) AS qtdComprada
                            FROM estoques
                            GROUP BY produtos_id
                        ) AS E ON P.id = E.produtos_id
                        LEFT JOIN (
                            SELECT produto_id, SUM(qtd) AS qtdVenda
                            FROM itens
                            GROUP BY produto_id
                        ) AS I ON P.id = I.produto_id;
                        
                        ");

    $FornecedorsCad = DB::SELECT("SELECT * FROM fornecedors AS F ORDER BY fornecedor;");
        
                            
        $msgSalvo = 0;
        return view('estoque', ['estoquesCad'=>$estoquesCad, 'FornecedorsCad'=>$FornecedorsCad, 'msgSalvo'=>$msgSalvo]);
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

      // SALVA OS DADOS DOS INPUTS USANDO CREATE 
      $TBEstoque = new Estoque;
      $TBEstoque->create($request->all());
      return redirect()->route('estoque');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Estoque  $estoque
     * @return \Illuminate\Http\Response
     */
    public function show(Estoque $estoque)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Estoque  $estoque
     * @return \Illuminate\Http\Response
     */
    public function edit(Estoque $estoque)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Estoque  $estoque
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Estoque $estoque)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Estoque  $estoque
     * @return \Illuminate\Http\Response
     */
    public function destroy(Estoque $estoque)
    {
        //
    }
}
