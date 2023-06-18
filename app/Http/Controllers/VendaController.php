<?php

namespace App\Http\Controllers;

use App\Models\Venda;
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



    $msgSalvo = 0;
    return view('newvendasV2', ['estoquesCad'=>$estoquesCad, 'ClientesCad'=>$ClientesCad, 'msgSalvo'=>$msgSalvo]);
        
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
