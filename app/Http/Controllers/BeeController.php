<?php

namespace App\Http\Controllers;

use App\model\Bee;
use App\model\Ledger;
use App\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class BeeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        $bee = Bee::orderBy('created_at', 'desc')->get();
        $bee->map(function ($item) {
            $item->user = User::find($item->user);
        });

        $data = [
            'bees' => $bee
        ];

        return view('bee.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
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
        $ledgerAdmin->save();
        $ledger->save();
    }

    /**
     * Display the specified resource.
     *
     * @param Bee $bee
     * @return Response
     */
    public function show(Bee $bee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Bee $bee
     * @return Response
     */
    public function edit(Bee $bee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Bee $bee
     * @return Response
     */
    public function update(Request $request, Bee $bee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Bee $bee
     * @return Response
     */
    public function destroy(Bee $bee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return Factory|View
     */
    public function QRCode($id)
    {
        $id = base64_decode($id);
        $bee = Bee::find($id);

        $data = [
            'bee' => $bee
        ];

        return view('bee.qrCode', $data);
    }
}
