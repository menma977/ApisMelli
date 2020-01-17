<?php

namespace App\Http\Controllers;

use App\model\Binary;
use App\model\Ledger;
use App\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        $user = User::all();

        $data = [
            'users' => $user
        ];

        return view('user.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'username' => 'required|string|min:6|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'c_password' => 'required|min:6|same:password',
            'phone' => 'required|numeric|min:10|unique:users',
            'id_identity_card' => 'required|numeric|unique:users',
            'identity_card_image' => 'required|image|mimes:jpeg,jpg,png|max:20000',
            'identity_card_image_salve' => 'required|image|mimes:jpeg,jpg,png|max:20000',
            'image' => 'required|image|mimes:jpeg,jpg,png|max:20000',
            'province' => 'required|exists:provinces,id',
            'district' => 'required|exists:districts,id',
            'sub_district' => 'required|exists:sub_districts,id',
            'village' => 'required',
            'number_address' => 'required|numeric',
            'description_address' => 'required',
        ]);

        $ledgerAdmin = new Ledger();
        $ledgerAdmin->code = 'REG' . date("YmdHis");
        $ledgerAdmin->credit = 2000000;
        $ledgerAdmin->description = 'Pendaftaran User : Rp' . $ledgerAdmin->credit;
        $ledgerAdmin->user = Auth::user()->id;
        $ledgerAdmin->ledger_type = 0;

        $ledger = new Ledger();
        $ledger->code = 'REGBON' . date("YmdHis");
        $ledger->credit = (2 / 100) * $ledgerAdmin->credit; // 2% from ledgerAdmin
        $ledger->description = 'anda mendapatkan bonus 2% dari pendaftaran sebesar : Rp' . $ledger->credit;
        $ledger->user = Auth::user()->id;
        $ledger->ledger_type = 2;

        $user = new User();
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->phone = $request->phone;
        $user->id_identity_card = $request->id_identity_card;
        $user->identity_card_image = $request->identity_card_image;
        $user->identity_card_image_salve = $request->identity_card_image_salve;
        $user->image = $request->image;
        $user->province = $request->province;
        $user->district = $request->district;
        $user->sub_district = $request->sub_district;
        $user->village = $request->village;
        $user->number_address = $request->number_address;
        $user->description_address = $request->description_address;

        $ledgerAdmin->save();
        $ledger->save();
        $user->save();
        $binary = new Binary();
        $binary->sponsor = Auth::user()->id;
        $binary->user = $user->id;
        $binary->save();

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $id = base64_decode($id);
        $user = User::find($id);
        $binary = Binary::where('user', $user->id)->frist();
        $sponsor = User::find($binary->sponsor);
        $ledger = Ledger::where('user', $user->id)->get();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
