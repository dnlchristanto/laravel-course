<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;

class KategoriController extends Controller
{
    public function index()
    {
        $kategori=Kategori::all();
        //return view('kategori\index',compact('product'));
        print_r($kategori);
    }

    public function store()
    {
        Kategori::create([
            'kategori'=>'Bahan Bangunan',
            'keterangan'=>'Bahan Bangunan Atas'
        ]);

        echo 'Menambah data eloquent berhasil';
    }

    public function update()
    {
        Kategori::where('id',1)->update([
            'kategori'=>'Bahan Bahan Bangunan',
            'keterangan'=>'Bahan Bangunan Bagian Atas'
        ]);

        echo 'Mengubah data eloquent berhasil';
    }

    public function delete()
    {
        Kategori::where('id',1)->delete();

        echo 'Menghapus data eloquent berhasil';
    }
}
