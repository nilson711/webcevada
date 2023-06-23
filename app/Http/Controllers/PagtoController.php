<?php

namespace App\Http\Controllers;

use App\Models\Pagto;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PagtoController extends Controller
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
      $pagtos = json_decode($request->input('allPagtos'));

        //   dd($pagtos);

        foreach ($pagtos as $pagto) {
            // Cria uma nova instancia do model Pagto
            $novoPagto = new Pagto();

            // Converte a data para o formato desejado usando Carbon
            $dataPagto = Carbon::parse($pagto->data)->format('Y-m-d H:i:s');


            // atribui os valores aos campos da tabela pagtos
            $novoPagto->venda_id = $pagto->idv;
            $novoPagto->dtPagto = $dataPagto;
            $novoPagto->forma = $pagto->forma;
            $novoPagto->valor = $pagto->valor;
            
            // Salva
            $novoPagto->save();

        }
        
        // Volta para a venda atual
        return redirect()->route('editvenda', ['venda' => $pagto->idv]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pagto  $pagto
     * @return \Illuminate\Http\Response
     */
    public function show(Pagto $pagto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pagto  $pagto
     * @return \Illuminate\Http\Response
     */
    public function edit(Pagto $pagto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pagto  $pagto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pagto $pagto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pagto  $pagto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pagto $pagto)
    {
        //
    }
}
