<?php

namespace App\Http\Controllers;

use App\Models\DetailTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Datatables;

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
    public function update(Request $request, DetailTransaction $detailTransaction)
    {
        //
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

    public function getAllDetailTransactions(DetailTransaction $transactionId)
    {
        $detail_trasactions = DB::table('detail_transactions as dt')
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

        return Datatables::of($detail_trasactions)
        ->addColumn('action', function($detail_trasaction) {
            $html = '';
            if ($detail_trasaction->statusType == "1") {
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
