<?php

namespace App\Http\Controllers;
use App\Models\Tb_produk;
use App\Models\Tb_kategori;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $produk=new Tb_produk; 
        if(isset($_GET['s'])){ 
            $s=$_GET['s']; 
            //melakukan query like berdasarkan param nama
            $produk=$produk->where('nama_produk', 'like', "%$s%"); 
        } 

        if(isset($_GET['id_kategori'])&&$_GET['id_kategori']!=''){ 
            $produk=$produk->where('id_kategori', $_GET['id_kategori']); 
        } 
           
        $produk=$produk->paginate(5);
        $kategori=Tb_kategori::all();
        return view('backpage.admin',compact('produk','kategori'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        
        $title="Tambah Data"; 
        $kategori=Tb_kategori::all();

        return view('backpage.create',compact('title','kategori'));
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
        $messages = [ 
            'required'=> 'Kolom :attribute harus lengkap', 
            'numeric' => 'Kolom :attribute Harus Angka.', 
            'file'=>'Perhatikan format dan ukuran file'
        ]; 
            //untuk menyimpan data
        $validasi=$request->validate([ 
            'nama_produk'=>'required', 
            'desk_produk'=>'', 
            'harga_produk'=>'numeric', 
            'stok_produk'=>'numeric', 
            'id_kategori'=>'required',
            'gambar_produk' => 'required','mimes:png,jpg'
        ], $messages); 
            
        try { 
            //memberikan kombinasi time dan nama file asli untuk nama foto
            $fileName = time().$request->file('gambar_produk')->getClientOriginalName(); 
            //menggunakan fungsi storeAS untuk upload dan mengambil path upload
            $path = $request->file('gambar_produk')->storeAs('gambarproduk',$fileName); 
            //menyimpan path upload file pada kolom foto
            $validasi['gambar_produk']=$path; 
            $response = Tb_produk::create($validasi); 
            return redirect('admin'); 
        }
        catch (\Exception $e) { 
            echo $e->getMessage(); 
        } 
           
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
        
        $title="Edit Data"; 
        $kategori=Tb_kategori::all(); 
        $produk=Tb_produk::find($id); 
        if($produk != NULL){ 
            return view('backpage.create',compact('title','kategori','produk')); 
        }else{ 
            return view('backpage.create',compact('title','kategori')); 
        } 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $validasi=$request->validate([ 
            'nama_produk'=>'required', 
            'desk_produk'=>'', 
            'harga_produk'=>'numeric', 
            'stok_produk'=>'numeric', 
            'id_kategori'=>'required',
            'gambar_produk' => ''
        ]); 
            
        try {
            //code...
            $fileName = time().$request->file('foto_produk')->getClientOriginalName(); 
            $path = $request->file('foto_produk')->storeAs('upload/produk',$fileName); 
            $validasi['foto_produk']=$path; 
        } catch (\Throwable $th) {
            //throw $th;
        }
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
        try { 
            $produk=Tb_produk::find($id); 
            $produk->delete(); 
            //File::delete($petani->foto);
            return redirect('admin'); 
        } 
        catch (\Exception $e) { 
            echo $e->getMessage(); 
        } 

    }
    public function kategoriku($id){
        //memanggil kelompok berdasarkan id_kelompok_tani
        $kategori=Tb_kategori::where('id_kategori',$id)->first(); 
        //menampilkan nama kelompok pada title
        
        //memanggil daftar petani berdasarkan kelompok
        $produk=$kategori->produk; 
        $kategori=Tb_kategori::all(); 
        return view('backpage.admin',compact('produk','kategori')); 
    } 
        
}
