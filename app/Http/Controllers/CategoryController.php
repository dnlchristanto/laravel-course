<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories=Category::all();
        //echo "<pre>";
        //print_r($users);

        foreach($categories as $cat){
            echo $cat->category_name;
            echo "<br>";
            echo $cat->keterangan;
            echo "<br>";
            //echo $cat->product;
            //echo "<br>";
            foreach($cat->product as $prod){
                echo $prod->nama;
                echo "<br>";
                echo $prod->qty;
            }
        }
    }
}
