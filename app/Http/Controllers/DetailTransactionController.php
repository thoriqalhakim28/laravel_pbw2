<?php

namespace App\Http\Controllers;

use App\Models\DetailTransaction;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Datatables;
use Illuminate\Support\Carbon;

class DetailTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DetailTransaction  $detailTransaction
     * @return \Illuminate\Http\Response
     */
    public function show(DetailTransaction $detailTransaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DetailTransaction  $detailTransaction
     * @return \Illuminate\Http\Response
     */
    public function edit(DetailTransaction $detailTransaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DetailTransaction  $detailTransaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if($request->status == 1) {

        }else {
            $affected = DB::table('detail_transactions')
            ->where('id', $request->idDetailTransaksi)
            ->update([
                'status' => $request->status,
                'tanggalKembali' => Carbon::now()->toDateString()
            ]);

            if($request->status == 2) {
                DB::table('collections')->increment('jumlahSisa');
                DB::table('collections')->decrement('jumlahKeluar');
            }else {
                DB::table('collections')->increment('jumlahSisa');
            }
        }

        $transaction = Transaction::where('id', '=', $request->idTransaksi)->first();
        return to_route('transaksiView', ['transaction'=> $request->session()->get('transactionId')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DetailTransaction  $detailTransaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(DetailTransaction $detailTransaction)
    {
        //
    }

    public function getAllDetailTransactions(Request $request, $transactionId)
    {
        $request->session()->regenerate();
        $request->session()->put('transactionId', $transactionId);

        if ($request->ajax()) {
$detail_transactions = DB::table('detail_transactions as dt')
        ->select(
            'dt.id',
            'dt.tanggalKembali as tanggalKembali',
            't.tanggalPinjam as tanggalPinjam',
            'dt.status as statusType',
            DB::raw('(case when dt.status="1" then "Pinjam"
                when dt.status="2" then "Kembali"
                when dt.status="3" then "Hilang"
                end) as status'
            ),
            'c.namaKoleksi as koleksi')
        ->join('collections as c', 'c.id', '=', 'collectionId')
        ->join('transactions as t', 't.id', '=', 'dt.transactionId')
        ->where('transactionId', '=', $transactionId)->get();

        return Datatables::of($detail_transactions)
        ->addColumn('action', function($detail_transaction) {
            $html = '';
            if ($detail_transaction->statusType == "1") {
                $html = '
                <a href="'.route('detailTransactionKembalikan', $detail_transaction->id).'">
                <i class="fas fa-edit"></i>
                </a>';
            }
            return $html;
        })
        ->make(true);
        }
    }

    public function detailTransactionKembalikan($detailTransactionId)
    {
        $detailTransaction = DB::table('detail_transactions as dt')
        ->select(
            't.id as idTransaksi',
            'dt.id as id',
            'dt.tanggalKembali as tanggalKembali',
            't.tanggalPinjam as tanggalPinjam',
            'dt.status',
            'uPinjam.fullname as namaPeminjam',
            'uTugas.fullname as namaPetugas',
            'c.namaKoleksi as koleksi')
        ->join('collections as c', 'c.id', '=', 'collectionId')
        ->join('transactions as t', 't.id', '=', 'dt.transactionId')
        ->join('users as uPinjam', 't.userIdPeminjam', '=', 'uPinjam.id')
        ->join('users as uTugas', 't.userIdPetugas', '=', 'uTugas.id')
        ->where('dt.id', '=', $detailTransactionId)->first();

        return view('detailTransaction.detailTransactionKembalikan', compact('detailTransaction'));
    }
}
