<?php

namespace App\Http\Controllers;
use App\Models\product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        return "Mengakses Fungsi di Controller Menggunakan Route";
    }

    public function showAll(){
        $products=Product::get();
        $title="Daftar Produk";
        $pelanggan=['Ina','Ani','Ita','Indra'];
        //dd($products);
        //print($products);

        return view('showAll',compact('products','title','pelanggan'));
        //$this->fungsilain();
        //$data=$this->fungsilainreturn();
        //echo $data;
    }

    public function fungsilain(){
        echo "Fungsi Lain tanpa return";
        echo "</br>";
    }

    public function fungsilainreturn(){
        return "Fungsi Lain dengan return";
    }
}
