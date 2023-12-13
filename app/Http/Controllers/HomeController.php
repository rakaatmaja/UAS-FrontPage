<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tb_produk;
use App\Models\Tb_kategori;
class HomeController extends Controller
{
    //
    function index(){
        // $title="Landing Page";
        // $packages=[(object)[
        //     'package_code'=>'DUmmy Code',
        //     'packages_name'=>'DUmmy Name',
        //     'packages_desc'=>'DUmmy Desc'
        // ],(object)[
        //     'package_code'=>'DUmmy Code ',
        //     'packages_name'=>'DUmmy Name ',
        //     'packages_desc'=>'DUmmy Desc '
        // ],(object)[
        //     'package_code'=>'DUmmy Code ',
        //     'packages_name'=>'DUmmy Name ',
        //     'packages_desc'=>'DUmmy Desc '
        // ]];
        $produk=Tb_produk::all();
        return view('frontpage.landingpage',compact('produk'));
        
    }

    function index2(){
        return view('frontpage.landingpromo',['title'=>"Landing Promo"]);
    }

    function index3(){
        return view('frontpage.landingwishlist',['title'=>"Landing Wishlist"]);
    }

    function index4(){
        $item=Tb_produk::find(1);
        return view('frontpage.landinguts',compact('item'));
    }
}
