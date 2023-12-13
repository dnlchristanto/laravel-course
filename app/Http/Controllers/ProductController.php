<?php

namespace App\Http\Controllers;
use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index(){
        //return "Mengakses Fungsi di Controller Menggunakan Route";
        $products=DB::table('products')
        ->join('categories','products.id_kategori','=','categories.id')
        ->select('products.*','categories.*')
        ->get();
        //dd($products);
        $title="Daftar Produk Pakai Query Builder";
        //$pelanggan=['Ina','Ani','Ita','Indra'];
        return view('index',compact('products','title'));
    }

    public function showAll(){
        $products=Product::get();
        $title="Daftar Produk Pakai Eloquent";
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

    public function store(){
        DB::table('products')
        ->insert([
            'nama'=>'Sabun',
            'id_kategori'=>1,
            'qty'=>5,
            'harga_beli'=>8000,
            'harga_jual'=>10000
        ]);
        echo "Data berhasil ditambahkan";
    }

    public function update(){
        DB::table('products')
        ->where('id',3)
        ->update([
            'nama'=>'Sabun Muka',
            'id_kategori'=>1,
            'qty'=>5,
            'harga_beli'=>80000,
            'harga_jual'=>100000
        ]);
        echo "Data berhasil diperbarui";
    }

    public function delete(){
        DB::table('products')
        ->where('id',3)
        ->delete();
        echo "Data berhasil dihapus";
    }
}
