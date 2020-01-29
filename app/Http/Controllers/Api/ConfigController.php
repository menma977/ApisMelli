<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\model\Bee;
use App\model\Binary;
use App\model\Ledger;
use App\Model\Stup;
use App\model\Withdraw;
use App\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\File;

class ConfigController extends Controller
{
  /**
   * @return JsonResponse
   */
  public function verification()
  {
    return response()->json(['response' => Auth::check()], 200);
  }

  /**
   * @param Request $request
   * @return JsonResponse
   * @throws ValidationException
   */
  public function login(Request $request)
  {
    $this->validate($request, [
      'username' => 'required|string',
      'password' => 'required|string',
    ]);
    if (Auth::attempt(['username' => request('username'), 'password' => request('password')])) {
      $user = Auth::user();
      if ($user->status == 0) {
        $data = [
          'message' => 'The given data was invalid.',
          'errors' => [
            'validation' => ['Akun Anda telah ditangguhkan. silakan hubungi admin.'],
          ],
        ];
        return response()->json($data, 422);
      } else {
        $token = Auth::user()->tokens;
        foreach ($token as $key => $value) {
          $value->delete();
        }
        $user->token = $user->createToken('App')->accessToken;
        return response()->json(['response' => $user->token], 200);
      }
    } else {
      $data = [
        'message' => 'The given data was invalid.',
        'errors' => [
          'validation' => ['username atau password tidak valid.'],
        ],
      ];
      return response()->json($data, 422);
    }
  }

  /**
   * @return JsonResponse
   */
  public function show()
  {
    return response()->json(['response' => Auth::user()], 200);
  }

  /**
   * @return JsonResponse
   */
  public function logout()
  {
    $token = Auth::user()->tokens;
    foreach ($token as $key => $value) {
//      $value->revoke();
//      $value->save();
      $value->delete();
    }
    return response()->json([
      'response' => 'Successfully logged out',
    ], 200);
  }

  /**
   * @param Request $request
   * @return JsonResponse
   * @throws ValidationException
   */
  public function register(Request $request)
  {
    $this->validate($request, [
      'sponsor' => 'required|string|exists:users,username',
      'name' => 'required|string',
      'username' => 'required|string|min:6|unique:users',
      'email' => 'required|email|unique:users',
      'password' => 'required|min:6',
      'c_password' => 'required|min:6|same:password',
      'id_identity_card' => 'required|numeric|unique:users',
      'phone' => 'required|unique:users|numeric|digits_between:10,15',
      'province' => 'required|string',
      'district' => 'required|string',
      'sub_district' => 'required|string',
      'village' => 'required|string',
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
    $user->province = $request->province;
    $user->district = $request->district;
    $user->sub_district = $request->sub_district;
    $user->village = $request->village;
    $user->number_address = $request->number_address;
    $user->description_address = $request->description_address;
    $user->save();

    $binary = new Binary();
    $binary->sponsor = User::where('username', $request->sponsor)->first()->id;
    $binary->user = $user->id;
    $binary->save();

    return response()->json(['response' => 'User telah terdaftar mohon login untuk meneruskan'], 200);
  }

  /**
   * @param Request $request
   * @return JsonResponse
   * @throws ValidationException
   */
  public function update(Request $request)
  {
    if (Hash::check($request->password, Auth::user()->password)) {
      $this->validate($request, [
        'password' => 'required',
        'new_password' => 'required|min:6',
        'new_c_password' => 'required|same:new_password',
      ]);

      $user = Auth::user();
      $user->password = bcrypt($request->new_password);
      $user->save();

      $data = [
        'response' => 'Password anda saat ini adalah: ' . $request->new_password,
      ];
      return response()->json($data, 200);
    } else {
      $data = [
        'message' => 'The given data was invalid.',
        'errors' => [
          'password' => ['Password lama anda tidak cocok'],
        ],
      ];
      return response()->json($data, 422);
    }
  }

  public function balance()
  {
    $balance = Ledger::where('user', Auth::user()->id)->sum('credit') - Ledger::where('user', Auth::user()->id)->sum('debit');

    $data = [
      'balance' => 'Rp ' . number_format($balance, 0, ',', '.'),
    ];

    return response()->json($data, 200);
  }

  /**
   * @param Request $request
   * @return JsonResponse
   * @throws ValidationException
   */
  public function updateProfile(Request $request)
  {
    $user = Auth::user();
    if ($request->image) {
      $this->validate($request, [
        'image' => 'required|mimes:jpeg,png,jpg',
      ]);
      if ($user->image) {
        $fileName = explode("/", $user->image);
        File::delete('dist/img/' . $fileName[4]);
      }
      $imageName = time() . '.' . $request->image->extension();

      $request->image->move("images", $imageName);
      $user->image = $request->root() . '/images' . '/' . $imageName;
    }
    if ($request->identity_card_image) {
      $this->validate($request, [
        'identity_card_image' => 'required|mimes:jpeg,png,jpg',
      ]);
      if ($user->identity_card_image) {
        $fileName = explode("/", $user->identity_card_image);
        File::delete('dist/img/ktp/' . $fileName[4]);
      }
      $imageName = time() . '.' . $request->identity_card_image->extension();

      $request->identity_card_image->move("dist/img/ktp/", $imageName);
      $user->identity_card_image = $request->root() . '/dist/img/ktp' . '/' . $imageName;
    }
    if ($request->identity_card_image_salve) {
      $this->validate($request, [
        'identity_card_image_salve' => 'required|mimes:jpeg,png,jpg',
      ]);
      if ($user->identity_card_image_salve) {
        $fileName = explode("/", $user->identity_card_image_salve);
        File::delete('dist/img/ktp/user/' . $fileName[4]);
      }
      $imageName = time() . '.' . $request->identity_card_image_salve->extension();

      $request->identity_card_image_salve->move("dist/img/ktp/user/", $imageName);
      $user->identity_card_image_salve = $request->root() . '/dist/img/ktp/user/' . $imageName;
    }
    $user->save();
    return response()->json(['response' => $user], 200);
  }

  /**
   * @param Request $request
   * @return JsonResponse
   * @throws ValidationException
   */
  public function updateData(Request $request)
  {
    $user = Auth::user();
    if ($request->name) {
      $this->validate($request, [
        'name' => 'required|string',
      ]);
      $user->name = $request->name;
    }
    if ($request->province) {
      $this->validate($request, [
        'province' => 'required|string',
      ]);
      $user->province = $request->province;
    }
    if ($request->district) {
      $this->validate($request, [
        'district' => 'required|string',
      ]);
      $user->district = $request->district;
    }
    if ($request->sub_district) {
      $this->validate($request, [
        'sub_district' => 'required|string',
      ]);
      $user->sub_district = $request->sub_district;
    }
    if ($request->village) {
      $this->validate($request, [
        'village' => 'required|string',
      ]);
      $user->village = $request->village;
    }
    if ($request->number_address) {
      $this->validate($request, [
        'number_address' => 'required|string',
      ]);
      $user->number_address = $request->number_address;
    }
    if ($request->description_address) {
      $this->validate($request, [
        'description_address' => 'required|string|min:10',
      ]);
      $user->description_address = $request->description_address;
    }
    $user->save();
    return response()->json(['response' => 'Data telah di update'], 200);
  }

  /**
   * @return JsonResponse
   */
  public function withdrawValidate()
  {
    $withdraw = Withdraw::where('user', Auth::user()->id)->where('status', 0)->count();
    return response()->json(['response' => $withdraw], 200);
  }

  /**
   * @param Request $request
   * @return JsonResponse
   * @throws ValidationException
   */
  public function withdraw(Request $request)
  {
    $limit = Ledger::where('user', Auth::user()->id)->sum('credit') - Ledger::where('user', Auth::user()->id)->sum('debit');
    $this->validate($request, [
      'nominal' => 'required|numeric|min:100000|max:' . $limit,
    ]);

    $withdraw = new Withdraw();
    $withdraw->user = Auth::user()->id;
    $withdraw->total = $request->nominal;
    $withdraw->status = 0;
    $withdraw->save();

    return response()->json(['response' => 'Withdraw Sedang di proses oleh ADMIN'], 200);
  }

  /**
   * @param Request $request
   * @return JsonResponse
   * @throws ValidationException
   */
  public function checkSetup(Request $request)
  {
    $this->validate($request, [
      'qr' => 'required|string|exists:bees,qr',
    ]);

    $bee = Bee::where('qr', $request->qr)->first();
    if ($bee->user == Auth::user()->id) {
      return response()->json(['response' => $bee], 200);
    } else {
      $data = [
        'message' => 'The given data was invalid.',
        'errors' => [
          'qr' => ['Barcode ini bukan milik anda'],
        ],
      ];
      return response()->json($data, 422);
    }
  }

  /**
   * @param Request $request
   * @return JsonResponse
   * @throws ValidationException
   */
  public function requestStup(Request $request)
  {
    $this->validate($request, [
      'total' => 'required|numeric',
    ]);

    $stup = new Stup();
    $stup->user = Auth::user()->id;
    $stup->total = $request->total;
    $stup->status = 0;
    $stup->save();

    return response()->json(['response' => 'Stup Anda sedang di proses oleh admin'], 200);
  }
}
