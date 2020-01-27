<?php

namespace App\Http\Controllers;

use App\Charts\Chart;
use App\model\Bee;
use App\model\Ledger;
use App\User;
use Carbon\Carbon;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
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

    private function arrayData($oldArray, $newArray)
    {
        $countOld = count($oldArray);
        $old = 0;
        $countNew = count($newArray);
        $new = 0;
        foreach ($oldArray as $key => $value) {
            $old += $value;
        }
        foreach ($newArray as $key => $value) {
            $new += $value;
        }
        $getOldPercent = $old * $countOld / 100;
        $getNewPercent = $new * $countNew / 100;
        if ($new) {
            $total = (($new - $old) / $countNew) / 100;
        } else {
            $total = 0;
        }

        if ($getOldPercent < $getNewPercent) {
            return $data = ["text" => 'text-success', "icon" => 'fas fa-caret-up', "percent" => $total];
        } else if ($getOldPercent == $getNewPercent) {
            return $data = ["text" => 'text-warning', "icon" => 'fas fa-caret-left', "percent" => $total];
        } else {
            return $data = ["text" => 'text-danger', "icon" => 'fas fa-caret-down', "percent" => $total];
        }
    }

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index()
    {
        $month = Bee::where('user', '!=', null)->get()->groupBy(function ($item) {
            return Carbon::parse($item->start)->format('m');
        });
        $mount = array();
        foreach ($month as $id => $item) {
            array_push($mount, $this->convertMonth($id));
        }

        //income
        $incomeOld = array();
        $ledgerOld = Ledger::whereYear('created_at', (Carbon::now()->format('Y') - 1))->get()->groupBy(function ($item) {
            return Carbon::parse($item->created_at)->format('m');
        });
        foreach ($ledgerOld as $id => $item) {
            $countDebit = 0;
            foreach ($item->whereIn('ledger_type', [0, 2]) as $subId => $subItem) {
                $countDebit += $subItem->credit;
            }
            array_push($incomeOld, $countDebit);
        }

        $income = array();
        $ledger = Ledger::whereYear('created_at', Carbon::now()->format('Y'))->get()->groupBy(function ($item) {
            return Carbon::parse($item->created_at)->format('m');
        });
        foreach ($ledger as $id => $item) {
            $countCredit = 0;
            foreach ($item->whereIn('ledger_type', [0, 2]) as $subId => $subItem) {
                $countCredit += $subItem->credit;
            }
            array_push($income, $countCredit);
        }

        //outcome
        $outcomeOld = array();
        foreach ($ledgerOld as $id => $item) {
            $countDebit = 0;
            foreach ($item->whereIn('ledger_type', [1, 3]) as $subId => $subItem) {
                $countDebit += $subItem->debit + $subItem->credit;
            }
            array_push($outcomeOld, $countDebit);
        }

        $outcome = array();
        foreach ($ledger as $id => $item) {
            $countCredit = 0;
            foreach ($item->whereIn('ledger_type', [1, 3]) as $subId => $subItem) {
                $countCredit += $subItem->debit + $subItem->credit;
            }
            array_push($outcome, $countCredit);
        }

        $chartData = new Chart;
        $chartData->labels($mount);
        $chartData->dataset('Pemasukan', 'line', $income)->color("rgba(66,165,214,1)")->backgroundcolor("rgba(66,165,214,1)")->fill(false)->linetension(0.1);
        $chartData->dataset('Pengeluaran', 'line', $outcome)->color("rgba(214,79,66,1)")->backgroundcolor("rgba(214,79,66,1)")->fill(false)->linetension(0.1);

        $data = [
            'chart' => $chartData,
            'income' => $this->arrayData($incomeOld, $income),
            'outcome' => $this->arrayData($outcomeOld, $outcome),
            'CountBee' => Bee::whereYear('start', Carbon::now()->format('Y'))->where('user', '!=', null)->count() * 2000000,
            'CountIncome' => Ledger::whereYear('created_at', Carbon::now()->format('Y'))->whereIn('ledger_type', [0, 2])->sum('credit'),
            'CountOutcome' => Ledger::whereYear('created_at', Carbon::now()->format('Y'))->whereIn('ledger_type', [1, 3])->sum('debit')
                + Ledger::whereYear('created_at', Carbon::now()->format('Y'))->whereIn('ledger_type', [1, 3])->sum('credit'),
        ];

        return view('home', $data);
    }

    /**
     * @return JsonResponse
     */
    public function isOnlineStatus()
    {
        $count = 0;
        $online = 0;
        $offline = 0;
        $user = User::all();
        foreach ($user as $item) {
            foreach ($item->tokens as $subItem) {
                if ($subItem->revoked == 0) {
                    $online += 1;
                }
            }
            if ($item->isOnline()) {
                $online += 1;
            } else {
                $offline += 1;
            }
            $count += 1;
        }

        $data = [
            'count' => $count,
            'online' => $online,
            'offline' => $offline,
        ];

        return response()->json($data, 200);
    }

    /**
     * @return JsonResponse
     */
    public function authOnline()
    {
        return response()->json(['response' => Auth::user()->isOnline()], 200);
    }

    private function convertMonth($month)
    {
        $raw = ['January', 'February', 'Mart', 'April', 'Mei', 'June', 'July', 'Augustus', 'September', 'October', 'November', 'December'];
        return $raw[str_replace('0', '', $month)];
    }
}
