<?php

namespace App\Http\Controllers;

use App\model\Bee;
use App\model\Binary;
use App\model\District;
use App\model\Ledger;
use App\model\Province;
use App\model\SubDistrict;
use App\User;
use Carbon\Carbon;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Illuminate\Support\Facades\File;

class UserController extends Controller
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
    $user = User::all();
    $user->map(function ($item) {
      $binary = Binary::where('user', $item->id)->first();
      if ($item->role == 0) {
        $item->sponsor = User::find(1);
      } else {
        $item->sponsor = User::find($binary->sponsor);
      }

      return $item;
    });

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
   * @return Factory|View
   */
  public function show($id)
  {
    $id = base64_decode($id);
    $user = User::find($id);
    $user->province = Province::find($user->province);
    $user->district = District::find($user->district);
    $user->sub_district = SubDistrict::find($user->sub_district);
    $binary = Binary::where('user', $user->id)->first();
    if ($user->role == 0) {
      $sponsor = User::find(1);
    } else {
      $sponsor = User::find($binary->sponsor);
    }
    $ledger = Ledger::where('user', $user->id)->get();
    $bee = Bee::where('user', $user->id)->take(100)->orderBy('start', 'desc')->get()->groupBy(function ($item) {
      return Carbon::parse($item->start)->format('Y-m-d');
    });

    $data = [
      'user' => $user,
      'sponsor' => $sponsor,
      'ledger' => $ledger,
      'bee' => $bee,
    ];

    return \view('user.show', $data);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param int $id
   * @param $status
   * @return RedirectResponse
   */
  public function update($id, $status)
  {
    $id = base64_decode($id);
    $status = base64_decode($status);
    $user = User::find($id);
    $user->status = $status;
    if ($status == 1) {
      if ($user->identity_card_image) {
        File::delete('dist/img/ktp/' . $user->identity_card_image);
      }
      if ($user->identity_card_image_salve) {
        File::delete('dist/img/ktp/user/' . $user->identity_card_image_salve);
      }
      $user->identity_card_image = null;
      $user->identity_card_image_salve = null;
    }
    $user->save();

    return redirect()->back();
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param int $id
   * @return RedirectResponse
   */
  public function destroy($id)
  {
    $id = base64_decode($id);
    $user = User::find($id);
    if ($user->status == 0) {
      $user->status = 1;
    } else {
      $user->status = 0;
    }
    $user->save();

    return redirect()->back();
  }
}
