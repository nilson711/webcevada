<?php

namespace App\Http\Controllers;

use App\Models\Fornecedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FornecedorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $FornecedorsCad = DB::SELECT("SELECT * FROM fornecedors AS F ORDER BY fornecedor;");
        return view('cadFornecedores', ['FornecedorsCad' => $FornecedorsCad]);
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
        // dd($request);
        $TBFornec = new Fornecedor;
        $TBFornec->create($request->all());
        return redirect()->route('cadFornecedores');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Fornecedor  $fornecedor
     * @return \Illuminate\Http\Response
     */
    public function show(Fornecedor $fornecedor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Fornecedor  $fornecedor
     * @return \Illuminate\Http\Response
     */
    public function edit(Fornecedor $fornecedor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Fornecedor  $fornecedor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Fornecedor $fornecedor)
    {
        //

        // dd('entrei no update do fornecedor');
        // dd($request->all());

        Fornecedor::where('id', $request->idFornec)
        ->update(['fornecedor' => $request->input('newFornecedor'), 'telefone' => $request->input('newTel') ]);

        // $produtosCad = DB::SELECT("SELECT *  FROM produtos AS P ORDER BY Produto;");
        // $msgSalvo = 1;
        return redirect()->route('cadFornecedores');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Fornecedor  $fornecedor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fornecedor $fornecedor)
    {
        //
    }
}
