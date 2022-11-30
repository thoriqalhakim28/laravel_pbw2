<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\DB;
use Datatables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pengguna.daftarPengguna');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pengguna.registrasi');
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
         'username' => ['required', 'string', 'max:100'],
            'fullname' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string','email', 'max:255'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'address' => ['required', 'string', 'max:1000'],
            'birthdate' => ['required', 'date'],
            'phoneNumber' => ['required', 'string', 'max:20'],
            'religion' => ['required', 'string', 'max:20'],
            'gender' => ['required', 'string', 'max:20'],
        ]);

        $user = User::create([
            'username' => $request->username,
            'fullname' => $request->fullname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'address' => $request->address,
            'birthdate' => $request->birthdate,
            'phoneNumber' => $request->phoneNumber,
            'religion' => $request->religion,
            'gender' => $request->gender,
        ]);

        event(new Registered($user));

        return redirect(RouteServiceProvider::HOME);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('pengguna.infoPengguna', ['user' => $user]);
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
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        // $request->validate([
        //     'fullname'  => ['required'],
        //     'address'  => ['required'],
        //     'password'  => ['required', 'confirmed'],
        //     'phonenumber'  => ['required']
        // ]);

        // $user->update([
        //     'fullname' => $request->fullname,
        //     'address' => $request->address,
        //     'password' => Hash::make($request->password),
        //     'phoneNumber' => $request->phoneNumber,
        // ]);

        return to_route('user');
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
    }

    public function getAllUser() {
        $users = DB::table('users')
        ->select(
            'id as id',
            'fullname as namaLengkap',
            'email as email',
            'address as alamat',
            'phoneNumber as telepon',
            'religion as agama',
            DB::raw('
                (case
                when gender = "1" then "Laki-laki"
                when gender = "2" then "Perempuan"
                end) as jenisKelamin
                '),
            'birthdate as tanggalLahir',
        )
        ->orderBy('namaLengkap', 'asc')
        ->get();

        return Datatables::of($users)
        ->addColumn('action', function($user) {
            $html = '
            <a data-rowid="" class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top"
                data-container="body" title="Edit Pengguna" href="'.route('userView', $user->id).'">
            <i class="fa-regular fa-pen-to-square"></i></a>
            ';
            return $html;
        })
        ->make(true);
    }

}
