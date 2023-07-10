<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

             // verifica se o usuário está logado e busca as informações dele
             if(auth()->check()) {
                $idUser = auth()->user()->id;
                $nameUser = auth()->user()->name;
            }

        $ClientesCad = DB::SELECT("SELECT id, nomeClient, EndClient, tel1Client, tel2Client, users_id  FROM clientes AS C 
                                    WHERE C.users_id = $idUser
                                    ORDER BY nomeClient
                                ;");

        return view('cadClientes', ['ClientesCad'=>$ClientesCad, 'idUser'=>$idUser]);
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
        // dd($request->all());
        $TBCliente = new Cliente;
        $TBCliente->create($request->all());
        
        return redirect()->route('cadClientes');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function show(Cliente $cliente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function edit(Cliente $cliente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cliente $cliente)
    {
        //
        // dd($request->all());

        Cliente::where('id', $request->IdClient)
        ->update(
            ['nomeClient' => $request->input('newCliente'), 
            'EndClient' => $request->input('newEnd'), 
            'tel1Client' =>$request->input('newTel'),
            'users_id' =>$request->input('users_idEdit')
        ]);

        // $produtosCad = DB::SELECT("SELECT *  FROM produtos AS P ORDER BY Produto;");
        // $msgSalvo = 1;
        return redirect()->route('cadClientes');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cliente $cliente)
    {
        //
    }
}
