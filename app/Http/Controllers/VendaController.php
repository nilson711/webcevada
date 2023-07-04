<?php

namespace App\Http\Controllers;

use App\Models\Venda;
use App\Models\Pagto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VendaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $estoquesCad = DB::SELECT("SELECT P.id, P.cod, P.Produto, P.precoVenda,P.precoAtacado, E.qtdComprada, I.qtdVenda, 
        COALESCE(E.qtdComprada - I.qtdVenda, E.qtdComprada) AS emEstoque
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

    
    $ClientesCad = DB::SELECT("SELECT *  FROM clientes AS C ORDER BY nomeClient;");



    $msgSalvo = 0;
    return view('newpdv', ['estoquesCad'=>$estoquesCad, 'ClientesCad'=>$ClientesCad, 'msgSalvo'=>$msgSalvo]);
        
    }


    public function old()
    {
        //

        $estoquesCad = DB::SELECT("SELECT P.id, P.cod, P.Produto, P.precoVenda,P.precoAtacado, E.qtdComprada, I.qtdVenda, 
        COALESCE(E.qtdComprada - I.qtdVenda, E.qtdComprada) AS emEstoque
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

    
    $ClientesCad = DB::SELECT("SELECT *  FROM clientes AS C ORDER BY nomeClient;");


        $totalPago = DB::SELECT("SELECT SUM(P.valor) as tPag FROM pagtos AS P
        GROUP BY P.venda_id
        ;");

        dd($totalPago);
        
    $msgSalvo = 0;
    return view('newvendasV2', ['estoquesCad'=>$estoquesCad, 'ClientesCad'=>$ClientesCad, 'msgSalvo'=>$msgSalvo, 'totalPago' => $totalPago]);
        
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
        // dd('Entrei no stores da Vendas');

        // Criação do novo registro e salva
        $venda = new Venda();
        $venda->clientes_id = 1;
        $venda->save();
       
        // Redireciona para a página de edição do registro adicionado
        return redirect()->route('editvenda', ['venda' => $venda->id]);
        
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Venda  $venda
     * @return \Illuminate\Http\Response
     */
    public function show(Venda $venda)
    {
        //
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Venda  $venda
     * @return \Illuminate\Http\Response
     */
    public function edit(Venda $venda)
    {
        //
        // Retorna o formulário de edição com o registro especificado
        // return view('newvendasV2', compact('venda'));
        
        $estoquesCad = DB::SELECT("SELECT P.id, P.cod, P.Produto, P.precoVenda,P.precoAtacado, E.qtdComprada, I.qtdVenda, 
        COALESCE(E.qtdComprada - I.qtdVenda, E.qtdComprada) AS emEstoque
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

        $itens = DB::SELECT("SELECT I.vendas_id, I.produto_id, P.Produto, I.qtd, I.vlUnit, I.totItem FROM itens AS I
                            INNER JOIN produtos as P
                            ON P.id = I.produto_id
                            WHERE vendas_id = $venda->id
                            ;");

        $somaItens = DB::SELECT("SELECT SUM(I.totItem) AS total FROM itens AS I
                                WHERE vendas_id = $venda->id
                                GROUP BY I.vendas_id
                                ;");

        $totalItens = ($somaItens) ? $somaItens[0]->total : 0 ;

        $pagtos = DB::SELECT("SELECT P.dtPagto, P.venda_id, P.forma, P.valor
                            FROM pagtos AS P
                            WHERE P.venda_id = $venda->id
                            ;");

        // dd($pagtos);


        $totalPagoArray = DB::SELECT("SELECT SUM(P.valor) as tPag FROM pagtos AS P
                                WHERE P.venda_id = $venda->id
                                GROUP BY P.venda_id
                                ;");

                                

// VERIFICA SE O ARRAY ESTÁ VAZIO
        if (empty($totalPagoArray)) {
            // O array está vazio
            // echo "O array está vazio";
            $totalPago = 0;
        } else {
            // O array não está vazio
            // echo "O array não está vazio";
            $totalPago = $totalPagoArray[0]->tPag;
        }

        // dd($totalPago);

        $saldo  = $totalPago - $totalItens ;

        // dd($saldo);

        // dd($totalItens);

        $ClientesCad = DB::SELECT("SELECT *  FROM clientes AS C ORDER BY nomeClient;");

        $msgSalvo = 0;
        return view('newvendasV2', ['estoquesCad'=>$estoquesCad, 'saldo' => $saldo, 'totalPago' => $totalPago, 'ClientesCad'=>$ClientesCad, 'msgSalvo'=>$msgSalvo, 'itens'=>$itens, 'totalItens'=>$totalItens, 'pagtos'=>$pagtos], compact('venda'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Venda  $venda
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Venda $venda)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Venda  $venda
     * @return \Illuminate\Http\Response
     */
    public function destroy(Venda $venda)
    {
        //
    }
}
