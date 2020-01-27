<?php

namespace App\Http\Controllers;

use App\model\Bee;
use App\model\Binary;
use App\model\Ledger;
use App\Model\Stup;
use App\User;
use Carbon\Carbon;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
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
    $user = User::where('role', 1)->get();
    $bee = Bee::orderBy('id', 'desc')->get();
    $bee->map(function ($item) {
      $item->user = User::find($item->user);
    });

    $stup = Stup::all();
    $stup->map(function ($item) {
      $item->user = User::find($item->user);
    });

    $data = [
      'user' => $user,
      'bees' => $bee,
      'stup' => $stup,
    ];

    return view('bee.index', $data);
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
      'count' => 'required|numeric|max:1000',
    ]);

    for ($i = 0; $i < $request->count; $i++) {
      $lastId = Bee::count();

      $bee = new Bee();
      $bee->qr = $lastId;
      $bee->code = 'QR' . date("YmdHis") . $lastId;
      $bee->save();
    }

    return redirect()->back();
  }

  /**
   * Update the specified resource in storage.
   *
   * @param $stup
   * @param $status
   * @return RedirectResponse
   */
  public function update($stup, $status)
  {
    $stup = base64_decode($stup);
    $status = base64_decode($status);
    if ($status == 1) {
      $stup = Stup::find($stup);
      $stup->status = 1;

      $countBee = Bee::whereNull('user')->count();
      if ($countBee < $stup->total) {
        return back()->withErrors(['count' => ['Jumlah Stup yang ada kurang dari permintaan']]);
      } else {
        $stup->save();
      }

      $getUser = User::find($stup->user);
      if (Binary::where('user', $getUser->id)->first()) {
        $sponsor = Binary::where('user', $getUser->id)->first()->sponsor;
      } else {
        $sponsor = $getUser->id;
      }

      for ($i = 0; $i < $stup->total; $i++) {
        $ledgerAdmin = new Ledger();
        $ledgerAdmin->code = 'REG' . date("YmdHis");
        $ledgerAdmin->credit = 2000000;
        $ledgerAdmin->description = 'Pendaftaran User : Rp' . number_format($ledgerAdmin->credit, 0, ',', '.');
        $ledgerAdmin->user = 1;
        $ledgerAdmin->ledger_type = 0;

        $ledger = new Ledger();
        $ledger->code = 'REGBON' . date("YmdHis");
        $ledger->credit = (2 / 100) * $ledgerAdmin->credit;
        $ledger->description = 'anda mendapatkan bonus 2% dari pembelian sebesar : Rp' . number_format($ledger->credit, 0, ',', '.');
        $ledger->user = $sponsor;
        $ledger->ledger_type = 2;

        $ledgerAdmin->save();
        $ledger->save();

        $bee = Bee::whereNull('user')->first();
        $bee->user = $getUser->id;
        $bee->start = Carbon::now()->format('Y-m-d');
        $bee->end = Carbon::now()->addMonth(3)->format('Y-m-d');
        $bee->save();
      }
    } else {
      Stup::destroy($status);
    }

    return redirect()->back();
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

    $QR = QrCode::format('png')->size(500)->merge('../public/dist/img/ApisMelli.png', 0.3, true)->errorCorrection('H')->generate($bee->qr);

    $data = [
      'qr' => $QR,
    ];

    return view('bee.qrCode', $data);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param Request $request
   * @return Factory|View
   * @throws ValidationException
   */
  public function QRCodeList(Request $request)
  {
    $this->validate($request, [
      'count' => 'required|numeric|max:1000',
    ]);
    $bee = Bee::whereNull('user')->whereNull('user')->take($request->count)->get();
    $bee->map(function ($item) {
      $item->BarCode = QrCode::format('png')->size(250)->merge('../public/dist/img/ApisMelli.png', 0.3, true)->errorCorrection('H')->generate($item->qr);
    });

    $data = [
      'bee' => $bee
    ];

    return view('bee.listQRCode', $data);
  }
}
