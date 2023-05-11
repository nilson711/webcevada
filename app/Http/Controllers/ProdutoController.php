<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $produtosCad = DB::SELECT("SELECT *  FROM produtos AS P
        -- WHERE c.id_estado = 7
        ORDER BY Produto
        ;");

        // dd($produtosCad);
        
        return view('cadProdutos', ['produtosCad'=>$produtosCad]);
        
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
        // SALVA OS DADOS DOS INPUTS USANDO CREATE 
        // (fillable tem que estar setado no model para preenchimento em massa)
        // $TBProduto = new Produto();

        // Valida os campos cod e produto
        $request->validate([
                
            'cod' =>  'required|min:8|max:13' 
        ]);
     
        
        return redirect()->route('cadProdutos', [
            'modal' => 'addProduto'
        ]);

        // Verifica na tabela produtos se exite código de barras ou o nome do produto já cadastrados.
        $findProduto = DB::table('produtos')
                        ->where('cod', '=', $request->input('cod')) 
                        ->orwhere('Produto', '=', $request->input('Produto'))
                        ->count();
                        
                        // dd($findProduto);

        // if ($findProduto >0) {
                     
            
            
        // } else {
        //     $TBProduto = new Produto;
        //     $TBProduto->create($request->all());
        //     return back()->withInput();
        // }
        
        
            


             



    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function show(Produto $produto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function edit(Produto $produto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Produto $produto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Produto $produto)
    {
        //
    }
}
