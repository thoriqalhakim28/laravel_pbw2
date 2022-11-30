<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Datatables;

class CollectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('koleksi.daftarKoleksi');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('koleksi.registrasi');
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
            'namaKoleksi' => ['required', 'string'],
            'jenisKoleksi' => ['required', 'numeric' ],
            'jumlahKoleksi' => ['required', 'numeric']
        ]);

        $user = Collection::create([
            'namaKoleksi' => $request->namaKoleksi,
            'jenisKoleksi' => $request->jenisKoleksi,
            'jumlahKoleksi' => $request->jumlahKoleksi,
            'jumlahSisa' => $request->jumlahKoleksi,
            'jumlahKeluar' => 0
        ]);

        return to_route('koleksi');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Collection  $collection
     * @return \Illuminate\Http\Response
     */
    public function show(Collection $collection)
    {
        return view('koleksi.infoKoleksi', ['collection' => $collection]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Collection  $collection
     * @return \Illuminate\Http\Response
     */
    public function edit(Collection $collection)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Collection  $collection
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Collection $collection)
    {
        $request->validate([
            'jenisKoleksi' => ['required'],
            'jumlahSisa' => ['required'],
            'jumlahKeluar' => ['required'],
        ]);

        $collection->update([
            'jenisKoleksi' => $request->jenisKoleksi,
            'jumlahSisa' => $request->jumlahSisa,
            'jumlahKeluar' => $request->jumlahKeluar
        ]);

        return to_route('koleksi');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Collection  $collection
     * @return \Illuminate\Http\Response
     */
    public function destroy(Collection $collection)
    {
        $collection = Collection::find($collection);
        $collection->delete();
    }

    public function getAllCollection() {
        $collections = DB::table('collections')
        ->select(
            'id as id',
            'namaKoleksi as judul',
            DB::raw('
                (case
                when jenisKoleksi = "1" then "Buku"
                when jenisKoleksi = "2" then "Majalah"
                when jenisKoleksi = "3" then "Cakram Digital"
                end) as jenis
                '),
            'jumlahSisa as jumlah',
        )
        ->orderBy('judul', 'asc')
        ->get();

        return Datatables::of($collections)
        ->addColumn('action', function($collection) {
            $html = '
            <a data-rowid="" class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top"
                data-container="body" title="Edit" href="'. route('koleksiView', $collection -> id) .'">
            <i class="fa-regular fa-pen-to-square"></i></a>
            ';
            return $html;
        })
        ->make(true);
    }
}
