<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\model\Bee;
use App\model\Binary;
use App\model\Ledger;
use App\Model\Stup;
use App\model\Withdraw;
use App\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\File;
use PhpParser\Node\Expr\Cast\Object_;

class ConfigController extends Controller
{

  protected $nominal_stup = 2000000;

  /**
   * @return JsonResponse
   */
  public function verification(): JsonResponse
  {
    return response()->json(['response' => Auth::check()], 200);
  }

  /**
   * @return array
   */
  private function adminData(): array
  {
    $admin = User::find(1);

    return [
      'name' => $admin->name,
      'bank' => $admin->bank,
      'pin_bank' => $admin->pin_bank,
    ];
  }

  /**
   * @param Request $request
   * @return JsonResponse
   * @throws ValidationException
   * @var Object_ $user
   */
  public function login(Request $request): ?JsonResponse
  {
    $this->validate($request, [
      'username' => 'required|string',
      'password' => 'required|string',
    ]);
    if (Auth::attempt(['username' => request('username'), 'password' => request('password')])) {
      $user = Auth::user();
      if (($user !== null) && $user->status == 0) {
        $data = [
          'message' => 'The given data was invalid.',
          'errors' => [
            'validation' => ['Akun Anda telah ditangguhkan. silakan hubungi admin.'],
          ],
        ];
        return response()->json($data, 422);
      }

      $token = Auth::user()->tokens;
      foreach ($token as $key => $value) {
        $value->delete();
        //$value->revoke();
        //$value->save();
      }
      $user->token = $user->createToken('Android')->accessToken;
      return response()->json(['response' => $user->token], 200);
    }

    $data = [
      'message' => 'The given data was invalid.',
      'errors' => [
        'validation' => ['username atau password tidak valid.'],
      ],
    ];
    return response()->json($data, 422);
  }

  /**
   * @return JsonResponse
   */
  public function show(): JsonResponse
  {
    return response()->json(['response' => Auth::user()], 200);
  }

  /**
   * @return JsonResponse
   */
  public function logout(): JsonResponse
  {
    $token = Auth::user()->tokens;
    foreach ($token as $key => $value) {
      $value->delete();
      //$value->revoke();
      //$value->save();
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
  public function register(Request $request): JsonResponse
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
   * @var Object_ $user
   */
  public function update(Request $request): JsonResponse
  {
    if (Hash::check($request->password, Auth::user()->password)) {
      $this->validate($request, [
        'password' => 'required',
        'new_password' => 'required|min:6',
        'new_c_password' => 'required|same:new_password',
      ]);

      $user = Auth::user();
      if ($user !== null) {
        $user->password = bcrypt($request->new_password);
      }
      $user->save();

      $data = [
        'response' => 'Password anda saat ini adalah: ' . $request->new_password,
      ];
      return response()->json($data, 200);
    }

    $data = [
      'message' => 'The given data was invalid.',
      'errors' => [
        'password' => ['Password lama anda tidak cocok'],
      ],
    ];
    return response()->json($data, 422);
  }

  /**
   * @return JsonResponse
   */
  public function balance(): JsonResponse
  {
    $balance = Ledger::where('user', Auth::user()->id)->sum('credit') - Ledger::where('user', Auth::user()->id)->sum('debit');
    $stup = Stup::where('user', Auth::user()->id)->where('status', 0)->get();
    $data = [
      'balance' => 'Rp ' . number_format($balance, 0, ',', '.'),
      'admin' => $this->adminData(),
      'data' => $stup,
      'nominal' => $this->nominal_stup
    ];

    return response()->json($data, 200);
  }

  /**
   * @param Request $request
   * @return JsonResponse
   * @throws ValidationException
   * @var Object_ $user
   */
  public function updateProfile(Request $request): JsonResponse
  {
    $user = Auth::user();
    if ($request->image) {
      $this->validate($request, [
        'image' => 'required|mimes:jpeg,png,jpg',
      ]);
      if (($user !== null) && $user->image) {
        $fileName = explode('/', $user->image);
        File::delete('dist/img/' . $fileName[4]);
      }
      $imageName = time() . '.' . $request->image->extension();

      $request->image->move('images', $imageName);
      $user->image = $request->root() . '/images' . '/' . $imageName;
    }
    if ($request->identity_card_image) {
      $this->validate($request, [
        'identity_card_image' => 'required|mimes:jpeg,png,jpg',
      ]);
      if (($user !== null) && $user->identity_card_image) {
        $fileName = explode('/', $user->identity_card_image);
        File::delete('dist/img/ktp/' . $fileName[4]);
      }
      $imageName = time() . '.' . $request->identity_card_image->extension();

      $request->identity_card_image->move('dist/img/ktp/', $imageName);
      $user->identity_card_image = $request->root() . '/dist/img/ktp' . '/' . $imageName;
    }
    if ($request->identity_card_image_salve) {
      $this->validate($request, [
        'identity_card_image_salve' => 'required|mimes:jpeg,png,jpg',
      ]);
      if (($user !== null) && $user->identity_card_image_salve) {
        $fileName = explode('/', $user->identity_card_image_salve);
        File::delete('dist/img/ktp/user/' . $fileName[4]);
      }
      $imageName = time() . '.' . $request->identity_card_image_salve->extension();

      $request->identity_card_image_salve->move('dist/img/ktp/user/', $imageName);
      $user->identity_card_image_salve = $request->root() . '/dist/img/ktp/user/' . $imageName;
    }
    $user->save();
    return response()->json(['response' => $user], 200);
  }

  /**
   * @param Request $request
   * @return JsonResponse
   * @throws ValidationException
   * @var Object_ $user
   */
  public function updateData(Request $request): JsonResponse
  {
    $user = Auth::user();
    if ($request->name) {
      $this->validate($request, [
        'name' => 'required|string',
      ]);
      if ($user !== null) {
        $user->name = $request->name;
      }
    }
    if ($request->province) {
      $this->validate($request, [
        'province' => 'required|string',
      ]);
      if ($user !== null) {
        $user->province = $request->province;
      }
    }
    if ($request->district) {
      $this->validate($request, [
        'district' => 'required|string',
      ]);
      if ($user !== null) {
        $user->district = $request->district;
      }
    }
    if ($request->sub_district) {
      $this->validate($request, [
        'sub_district' => 'required|string',
      ]);
      if ($user !== null) {
        $user->sub_district = $request->sub_district;
      }
    }
    if ($request->village) {
      $this->validate($request, [
        'village' => 'required|string',
      ]);
      if ($user !== null) {
        $user->village = $request->village;
      }
    }
    if ($request->number_address) {
      $this->validate($request, [
        'number_address' => 'required|string',
      ]);
      if ($user !== null) {
        $user->number_address = $request->number_address;
      }
    }
    if ($request->description_address) {
      $this->validate($request, [
        'description_address' => 'required|string|min:10',
      ]);
      if ($user !== null) {
        $user->description_address = $request->description_address;
      }
    }
    $user->save();
    return response()->json(['response' => 'Data telah di update'], 200);
  }

  /**
   * @return JsonResponse
   */
  public function withdrawValidate(): JsonResponse
  {
    $withdraw = Withdraw::where('user', Auth::user()->id)->where('status', 0)->count();
    return response()->json(['response' => $withdraw], 200);
  }

  /**
   * @param Request $request
   * @return JsonResponse
   * @throws ValidationException
   */
  public function withdraw(Request $request): JsonResponse
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
  public function checkSetup(Request $request): ?JsonResponse
  {
    $this->validate($request, [
      'qr' => 'required|exists:bees,qr',
    ]);

    $bee = Bee::where('qr', $request->qr)->first();
    if ($bee->user == Auth::user()->id) {
      $bee->user = Auth::user()->username;
      return response()->json(['response' => $bee], 200);
    }

    $data = [
      'message' => 'The given data was invalid.',
      'errors' => [
        'qr' => ['Barcode ini bukan milik anda'],
      ],
    ];
    return response()->json($data, 422);
  }

  /**
   * @param Request $request
   * @return JsonResponse
   * @throws ValidationException
   * @throws Exception
   */
  public function requestStup(Request $request): JsonResponse
  {
    $this->validate($request, [
      'total' => 'required|numeric',
    ]);

    $stup = new Stup();
    $stup->user = Auth::user()->id;
    $stup->total = $request->total;
    $stup->code = random_int(99, 999);
    $stup->status = 0;
    $stup->save();

    $data = [
      'response' => 'Stup Anda sedang di proses oleh admin',
      'admin' => $this->adminData(),
      'total' => ($stup->total * $this->nominal_stup) + $stup->code,
    ];

    return response()->json($data, 200);
  }
}
