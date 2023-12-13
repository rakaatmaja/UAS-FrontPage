<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tb_produk extends Model
{
    use HasFactory;
    public $primaryKey='id_produk';
    protected $table = 'tb_produk';
    protected $fillable = ['id_produk','nama_produk','desk_produk','harga_produk','stok_produk','id_kategori','gambar_produk'];
    public function kategori(){
        return $this->belongsto(Tb_kategori::class,'id_kategori','id_kategori');
    }
}
