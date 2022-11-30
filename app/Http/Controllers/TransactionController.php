<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;
use App\Models\Collection;
use App\Models\DetailTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Datatables;
use Illuminate\Support\Carbon;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('transaction.daftarTransaksi');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::get();
        $collections = Collection::where('jumlahSisa', '>', 0)->get();
        return view('transaction.transaksiTambah', compact('collections', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'userIdPeminjam' => 'required|integer|gt:0',
            'koleksi1' => 'required'
        ],[
            'userIdPeminjam.gt' => 'Pilih satu',
            'koleksi1.gt' => 'Pilih jenis item'
        ]);

        $transaction = new Transaction;
        $transaction -> userIdPeminjam = $request -> userIdPeminjam;
        $transaction -> userIdPetugas = auth()->user()->id;
        $transaction -> tanggalPinjam = Carbon::now()->toDateString();
        $transaction -> save();

        $lastTransactionIdStored = $transaction->id;

        $detailTransaksi1 = new DetailTransaction;
        $detailTransaksi1 -> transactionId = $lastTransactionIdStored;
        $detailTransaksi1 -> collectionId = $request->koleksi1;
        $detailTransaksi1 -> status = 1;
        $detailTransaksi1 -> save();

        DB::table('collections')->where('id', $request -> koleksi1) -> decrement('jumlahSisa');
        DB::table('collections')->where('id', $request -> koleksi1) -> increment('jumlahKeluar');

        if($request->koleksi2 > 0) {
            $detailTransaksi2 = new DetailTransaction;
            $detailTransaksi2 -> transactionId = $lastTransactionIdStored;
            $detailTransaksi2 -> collectionId = $request->koleksi2;
            $detailTransaksi2 -> status = 1;
            $detailTransaksi2 -> save();

            DB::table('collections')->where('id', $request -> koleksi2) -> decrement('jumlahSisa');
            DB::table('collections')->where('id', $request -> koleksi2) -> increment('jumlahKeluar');
        }

        if($request->koleksi3 > 0) {
            $detailTransaksi3 = new DetailTransaction;
            $detailTransaksi3 -> transactionId = $lastTransactionIdStored;
            $detailTransaksi3 -> collectionId = $request->koleksi3;
            $detailTransaksi3 -> status = 1;
            $detailTransaksi3 -> save();

            DB::table('collections')->where('id', $request -> koleksi3) -> decrement('jumlahSisa');
            DB::table('collections')->where('id', $request -> koleksi3) -> increment('jumlahKeluar');
        }

        return redirect()->route('transaksi')->with('status', 'Peminjaman berhasil');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        $transaction = DB::table('transactions')
        ->select(
            'transactions.id as id',
            'u1.fullname as fullnamePeminjam',
            'u2.fullname as fullnamePetugas',
            'tanggalPinjam as tanggalPinjam',
            'tanggalSelesai as tanggalSelesai',
        )
        ->join('users as u1', 'userIdPeminjam', '=', 'u1.id')
        ->join('users as u2', 'userIdPetugas', '=', 'u2.id')
        ->where('transactions.id', '=', $transaction->id)
        ->orderBy('tanggalPinjam', 'asc')
        ->first();

        return view('transaction.transaksiView', compact('transaction'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        //
    }

    public function getAllTransaction()
    {
        $transactions = DB::table('transactions')
        ->select(
            'transactions.id as id',
            'u1.fullname as peminjam',
            'u2.fullname as petugas',
            'tanggalPinjam as tanggalPinjam',
            'tanggalSelesai as tanggalSelesai',
        )
        ->join('users as u1', 'userIdPeminjam', '=', 'u1.id')
        ->join('users as u2', 'userIdPetugas', '=', 'u2.id')
        ->orderBy('tanggalPinjam', 'asc')
        ->get();

        return Datatables::of($transactions)
        ->addColumn('action', function($transaction) {
            $html = '
            <a href="'.route('transaksiView', $transaction->id).'">
            <i class="fas fa-edit"></i>
            </a>
            ';
            return $html;
        })
        ->make(true);
    }
}
