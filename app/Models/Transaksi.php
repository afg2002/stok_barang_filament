<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = "transaksi";
    protected $fillable = [
        'barang_id',
        'jumlah',
        'jenis_transaksi',
        'tanggal_transaksi',
        'keterangan',
    ];

    protected $casts = [
        'tanggal_transaksi' => 'datetime', // Ensure tanggal_transaksi is cast to datetime
    ];

    // Definisikan relasi dengan model Barang
    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::created(function ($transaksi) {
            $transaksi->updateBarangJumlah('created');
        });

        static::updated(function ($transaksi) {
            $transaksi->updateBarangJumlah('updated');
        });

        static::deleted(function ($transaksi) {
            $transaksi->updateBarangJumlah('deleted');
        });
    }

    public function updateBarangJumlah($event)
    {
        $barang = $this->barang;

        if ($event === 'created') {
            if ($this->jenis_transaksi == 'masuk') {
                $barang->jumlah += $this->jumlah;
            } elseif ($this->jenis_transaksi == 'keluar') {
                $barang->jumlah -= $this->jumlah;
            }
        } elseif ($event === 'updated') {
            $original = $this->getOriginal();
            if ($original['jenis_transaksi'] == 'masuk') {
                $barang->jumlah -= $original['jumlah'];
            } elseif ($original['jenis_transaksi'] == 'keluar') {
                $barang->jumlah += $original['jumlah'];
            }

            if ($this->jenis_transaksi == 'masuk') {
                $barang->jumlah += $this->jumlah;
            } elseif ($this->jenis_transaksi == 'keluar') {
                $barang->jumlah -= $this->jumlah;
            }
        } elseif ($event === 'deleted') {
            if ($this->jenis_transaksi == 'masuk') {
                $barang->jumlah -= $this->jumlah;
            } elseif ($this->jenis_transaksi == 'keluar') {
                $barang->jumlah += $this->jumlah;
            }
        }

        $barang->save();
    }
}
