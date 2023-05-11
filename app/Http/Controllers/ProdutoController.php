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
 
        // Valida os campos cod e produto
        $request->validate(
            // REGRAS
            [
                //o código deve ter mínimo 8 caracteres e no máximo 13, deve ser numérico e não pode ser repetido no banco
                'cod' =>  'required|min:8|numeric|unique:produtos',  

                // o produto deve ter mínimo 8 caracteres e não pode ser repetido no banco
                'Produto' =>  'required|min:8|unique:produtos'
            ],

            // MENSAGENS DE FEEDBACK
            [
                'cod.min' => 'Cód deve ter entre 8 e 13 números!',
                'cod.numeric' => 'Cód não pode conter letras apenas números!',
                'cod.unique' => 'Este código já está cadastrado!',
                'Produto.min' => 'A descrição do produto não pode conter menos que 8 caracteres!',
                'Produto.unique' => 'Este produto já está cadastrado!',
            ]
        );

        // SALVA OS DADOS DOS INPUTS USANDO CREATE 
        $TBProduto = new Produto;
        $TBProduto->create($request->all());
        return redirect()->route('cadProdutos');
        

        // Verifica na tabela produtos se exite código de barras ou o nome do produto já cadastrados.
        // $findProduto = DB::table('produtos')
        //                 ->where('cod', '=', $request->input('cod')) 
        //                 ->orwhere('Produto', '=', $request->input('Produto'))
        //                 ->count();


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
