<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    public $timestamps = true;
    protected $table = "produk";
    protected $guarded = ['id'];
    public function kategori()
    {
        return $this->belongsTo(Kategori::class);

    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
 * Mendefinisikan relasi satu ke banyak dengan model FotoProduk.
 *
 * Fungsi ini digunakan untuk mengambil semua foto produk yang terkait dengan produk tertentu.
 * Relasi ini menggunakan foreign key 'produk_id' di tabel foto_produk untuk menghubungkan 
 * dengan tabel produk.
 */
public function fotoProduk()
{
    return $this->hasMany(FotoProduk::class, 'produk_id');
}


}
