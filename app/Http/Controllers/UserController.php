<?php

namespace App\Http\Controllers;

use App\model\Bee;
use App\model\BuyHistory;
use App\model\District;
use App\model\Ledger;
use App\model\Province;
use App\model\SubDistrict;
use App\User;
use Carbon\Carbon;
use DateInterval;
use DatePeriod;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Request;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("user.password.edit");
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
     * @param  \App\model\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $user = Auth::user();
        if ($user->province) {
            $user->province = Province::find($user->province)->name;
        } else {
            $user->province = "tidak diketahui";
        }
        if ($user->district) {
            $user->district = District::find($user->district)->name;
        } else {
            $user->district = "tidak diketahui";
        }
        if ($user->sub_district) {
            $user->sub_district = SubDistrict::find($user->sub_district)->name;
        } else {
            $user->sub_district = "tidak diketahui";
        }

        $object = [];
        $begin = Carbon::now()->subMonth(1);
        $end = Carbon::now()->subDay(-1);

        $interval = DateInterval::createFromDateString('1 day');
        $period = new DatePeriod($begin, $interval, $end);

        foreach ($period as $id => $dt) {
            $ledger = Ledger::where('user', $user->id)->whereDate('created_at', $dt->format("Y-m-d"))->first();
            $buyHistory = BuyHistory::where('user', $user->id)->whereDate('created_at', $dt->format("Y-m-d"))->first();
            if ($ledger && $buyHistory) {
                $buyHistory->bee = Bee::where('code', $buyHistory->code)->get();
                $buyHistory->bee->map(function ($item) {
                    $now = Carbon::now();
                    $begin = Carbon::parse($item->buy);
                    $end = Carbon::parse($item->sell);
                    $diffNow = $begin->diffInDays($now);
                    $diff = $end->diffInDays($begin);
                    $item->percent = number_format(($diffNow / $diff * 100), 2, '.', '');
                });
                $object[$id] = [
                    "id" => $id,
                    "date" => $dt->format("l d/m/Y"),
                    "time" => $dt->format("H:i:s\n"),
                    "ledger" => $ledger,
                    'buyHistory' => $buyHistory,
                ];
            } else if ($ledger) {
                $object[$id] = [
                    "id" => $id,
                    "date" => $dt->format("l d/m/Y"),
                    "time" => $dt->format("H:i:s\n"),
                    "ledger" => $ledger,
                    'buyHistory' => null,
                ];
            } else if ($buyHistory) {
                $buyHistory->bee = Bee::where('code', $buyHistory->code)->get();
                $buyHistory->bee->map(function ($item) {
                    $now = Carbon::now();
                    $begin = Carbon::parse($item->buy);
                    $end = Carbon::parse($item->sell);
                    $diffNow = $end->diffInDays($now);
                    $diff = $end->diffInDays($begin);
                    $item->percent = $diffNow / $diff * 100;
                });
                $object[$id] = [
                    "id" => $id,
                    "date" => $dt->format("l d/m/Y"),
                    "time" => $dt->format("H:i:s\n"),
                    "ledger" => null,
                    'buyHistory' => $buyHistory,
                ];
            }
        }

        // dump(array_reverse($object));

        $data = [
            'user' => $user,
            'object' => array_reverse($object),
        ];
        return view('user.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\model\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\model\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\model\User  $user
     * @return \Illuminate\Http\Response
     */
    public function editPassword()
    {
        return view("user.password.edit");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\model\User  $user
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(Request $request)
    {
        $this->validate($request, [
            'password' => ['required', 'string', function ($attribute, $value, $fail) {
                if (!Hash::check($value, Auth::user()->password)) {
                    return $fail(__('The current password is incorrect.'));
                }
            }],
            'passwordNew' => 'required|string|min:6|same:passwordNewConfirmation',
        ]);
        $user = User::find(Auth::user()->id);
        $user->password = bcrypt($request->passwordNew);
        $user->save();

        return redirect("user/show");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\model\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
