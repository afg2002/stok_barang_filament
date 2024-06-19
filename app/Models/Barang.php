<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $table = "barang";

    protected $fillable = [
        'nama', 'deskripsi', 'jumlah', 'harga', 'gambar', 'supplier_id', 'tanggal_masuk'
    ];

    public function supplier() {
        return $this->belongsTo(Supplier::class);
    }
}
