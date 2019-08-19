<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

function sortFunction( $a, $b ) {
        return strtotime($a["date"]) - strtotime($b["date"]);
    }

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
             //
        $products = Storage::disk('local')->get('public/products.json');
        $products = json_decode($products, true);
        $products = collect($products)->sortBy('date', false)->all();
        return view('create', ['products' => $products]);
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
        $name       = $request->input('name');
        $quantity   = $request->input('quantity');
        $price      = $request->input('price');
        $date       = date("Y-m-d H:i:s");

        //reading all products from file
        $products = Storage::disk('local')->get('public/products.json');
        $products = json_decode($products, true);

        $id = count($products) + 1;
        //saving new producto in memory
        $products[] = [
                'id' => $id
                ,'name' => $name
                , 'quantity' => $quantity
                , 'price' => $price
                , 'date' => $date
            ];

        Storage::put('public/products.json', json_encode($products));
        // dd($products);
        return redirect('/');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        //dd($request->all());

        $id         = $request->input('eid');
        $name       = $request->input('ename');
        $quantity   = $request->input('equantity');
        $price      = $request->input('eprice');
        $date       = date("Y-m-d H:i:s");

        //reading all products from file
        $products = Storage::disk('local')->get('public/products.json');
        $products = json_decode($products, true);

        //$id = count($products) + 1;
        //saving new producto in memory
        for ($i=0; $i < count($products); $i++) { 
            if($products[$i]['id'] == $id){
               $products[$i] = [
                    'id' => $id
                    ,'name' => $name
                    , 'quantity' => $quantity
                    , 'price' => $price
                    , 'date' => $date
                ];
            }
        }
       

        Storage::put('public/products.json', json_encode($products));
        // dd($products);
        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    
}
