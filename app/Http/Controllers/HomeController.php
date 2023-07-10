<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Pagto;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        
        $comandas = DB::SELECT("SELECT V.id, C.nomeClient, V.data, V.valorProdutos, 
                                COALESCE(SUM(P.valor), 0) AS pgts
                                 FROM vendas AS V
                                LEFT JOIN clientes AS C
                                ON C.id = V.clientes_id
                               
                                LEFT JOIN pagtos as P
                                ON P.venda_id = V.id
                               
                                WHERE V.valorProdutos > 0
                                GROUP BY V.id
                                HAVING pgts < V.valorProdutos

                                ;");



        dd($comandas);  

    return view('home', ['comandas' => $comandas]);

    }
}
