<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use App\Models\Transaksi;
class TransaksiController extends Controller
{
    public function exportPdf()
    {
        $transactions = Transaksi::all(); // Retrieve all transactions

        $pdf = PDF::loadView('pdf/transaksi', compact('transactions'));

        return $pdf->download('data_transaksi.pdf');
    }
}
