<?php

namespace App\Http\Controllers;

use App\model\Bee;
use App\model\BuyHistory;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BuyHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->rule == 0) {
            $buyHistory = BuyHistory::all();
        } else {
            $buyHistory = BuyHistory::where('user', Auth::user()->id)->get();
        }
        $buyHistory->map(function ($item) {
            $item->user_data = User::find($item->user);
            if ($item->sand) {
                $item->send_data = User::find($item->send);
            }
            $item->bee = Bee::where('code', $item->code)->get();
            return $item;
        });

        $data = [
            'buyHistory' => $buyHistory,
        ];

        return view('bee.history.index', $data);
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
        $this->validate($request, [
            'stupe' => 'required|numeric|min:1',
        ]);
        $buyHistory = new BuyHistory();
        $buyHistory->user = Auth::user()->id;
        $buyHistory->code = Carbon::now()->format("dmYHis");
        $buyHistory->count = $request->stupe;
        $buyHistory->save();

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\model\BuyHistory  $buyHistory
     * @return \Illuminate\Http\Response
     */
    public function show(BuyHistory $buyHistory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\model\BuyHistory  $buyHistory
     * @return \Illuminate\Http\Response
     */
    public function edit(BuyHistory $buyHistory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\model\BuyHistory  $buyHistory
     * @return \Illuminate\Http\Response
     */
    public function update($id, $status, $count, $user, $code)
    {
        $buyHistory = BuyHistory::find($id);
        $buyHistory->status = $status;
        $buyHistory->save();
        if ($buyHistory->status != 4) {
            for ($i = 0; $i < $count; $i++) {
                $bee = Bee::whereNull('user')->whereNull('code')->first();
                $bee->user = $user;
                $bee->code = $code;
                $bee->status = 0;
                $bee->save();
            }
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\model\BuyHistory  $buyHistory
     * @return \Illuminate\Http\Response
     */
    public function destroy(BuyHistory $buyHistory)
    {
        //
    }
}
