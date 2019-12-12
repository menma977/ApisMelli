<?php

namespace App\Http\Controllers;

use App\model\Bee;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->rule == 0) {
            $bee = Bee::all();
        } else {
            $bee = Bee::where('user', Auth::user()->id)->get();
        }
        $bee->map(function ($item) {
            $item->user_data = User::find($item->id);
            return $item;
        });

        $data = [
            'bee' => $bee,
        ];

        return view("bee.index", $data);
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
        for ($i = 0; $i < $request->stupe; $i++) {
            $bee = new Bee();
            $bee->pin = $this->generateRandomString(10);
            if (Bee::where('pin', $bee->pin)->count()) {
                $request->stupe++;
            } else {
                $bee->save();
            }
        }

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\model\Bee  $bee
     * @return \Illuminate\Http\Response
     */
    public function show(Bee $bee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\model\Bee  $bee
     * @return \Illuminate\Http\Response
     */
    public function edit(Bee $bee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\model\Bee  $bee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bee $bee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\model\Bee  $bee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bee $bee)
    {
        //
    }

    public function generateRandomString($length = 20)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
