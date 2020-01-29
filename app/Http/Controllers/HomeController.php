<?php

namespace App\Http\Controllers;

use App\Charts\Chart;
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

  private function arrayData($oldArray, $newArray, $type)
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
      if ($type == 0) {
        return $data = ["text" => 'text-success', "icon" => 'fas fa-angle-double-down', "percent" => $total];
      } else {
        return $data = ["text" => 'text-danger', "icon" => 'fas fa-angle-double-up', "percent" => $total];
      }
    } else if ($getOldPercent == $getNewPercent) {
      return $data = ["text" => 'text-warning', "icon" => 'fas fa-angle-double-right', "percent" => $total];
    } else {
      if ($type == 0) {
        return $data = ["text" => 'text-danger', "icon" => 'fas fa-angle-double-up', "percent" => $total];
      } else {
        return $data = ["text" => 'text-success', "icon" => 'fas fa-angle-double-down', "percent" => $total];
      }
    }
  }

  /**
   * Show the application dashboard.
   *
   * @return Renderable
   */
  public function index()
  {
    if (Auth::user()->role == 0) {
      $month = Ledger::get()->groupBy(function ($item) {
        return Carbon::parse($item->created_at)->format('m');
      });

      $ledgerOld = Ledger::whereYear('created_at', (Carbon::now()->format('Y') - 1))->get()->groupBy(function ($item) {
        return Carbon::parse($item->created_at)->format('m');
      });

      $ledger = Ledger::whereYear('created_at', Carbon::now()->format('Y'))->get()->groupBy(function ($item) {
        return Carbon::parse($item->created_at)->format('m');
      });

      $countIncome = Ledger::whereYear('created_at', Carbon::now()->format('Y'))->whereIn('ledger_type', [0])->sum('credit');
      $countOutcome = Ledger::whereYear('created_at', Carbon::now()->format('Y'))->whereIn('ledger_type', [1, 2, 3])->sum('debit') + Ledger::whereYear('created_at', Carbon::now()->format('Y'))->whereIn('ledger_type', [1, 2, 3])->sum('credit');
    } else {
      $month = Ledger::where('user', Auth::user()->id)->get()->groupBy(function ($item) {
        return Carbon::parse($item->created_at)->format('m');
      });

      $ledgerOld = Ledger::where('user', Auth::user()->id)->whereYear('created_at', (Carbon::now()->format('Y') - 1))->get()->groupBy(function ($item) {
        return Carbon::parse($item->created_at)->format('m');
      });

      $ledger = Ledger::where('user', Auth::user()->id)->whereYear('created_at', Carbon::now()->format('Y'))->get()->groupBy(function ($item) {
        return Carbon::parse($item->created_at)->format('m');
      });

      $countIncome = Ledger::where('user', Auth::user()->id)->whereYear('created_at', Carbon::now()->format('Y'))->whereIn('ledger_type', [0, 2])->sum('credit');
      $countOutcome = Ledger::where('user', Auth::user()->id)->whereYear('created_at', Carbon::now()->format('Y'))->whereIn('ledger_type', [1, 3])->sum('debit') + Ledger::where('user', Auth::user()->id)->whereYear('created_at', Carbon::now()->format('Y'))->whereIn('ledger_type', [1, 3])->sum('credit');
    }
    if ($countOutcome && $countIncome) {
      $totalProfit = ($countOutcome / $countIncome) * 100;
    } else {
      $totalProfit = 0;
    }

    $mount = array();
    foreach ($month as $id => $item) {
      array_push($mount, $this->convertMonth($id));
    }

    if (Auth::user()->role == 0) {
      //income
      $incomeOld = array();
      foreach ($ledgerOld as $id => $item) {
        $countDebit = 0;
        foreach ($item->whereIn('ledger_type', [0]) as $subId => $subItem) {
          $countDebit += $subItem->credit;
        }
        array_push($incomeOld, $countDebit);
      }

      $income = array();
      foreach ($ledger as $id => $item) {
        $countCredit = 0;
        foreach ($item->whereIn('ledger_type', [0]) as $subId => $subItem) {
          $countCredit += $subItem->credit;
        }
        array_push($income, $countCredit);
      }

      //outcome
      $outcomeOld = array();
      foreach ($ledgerOld as $id => $item) {
        $countDebit = 0;
        foreach ($item->whereIn('ledger_type', [1, 2, 3]) as $subId => $subItem) {
          $countDebit += $subItem->debit + $subItem->credit;
        }
        array_push($outcomeOld, $countDebit);
      }

      $outcome = array();
      foreach ($ledger as $id => $item) {
        $countCredit = 0;
        foreach ($item->whereIn('ledger_type', [1, 2, 3]) as $subId => $subItem) {
          $countCredit += $subItem->debit + $subItem->credit;
        }
        array_push($outcome, $countCredit);
      }
    } else {
      //income
      $incomeOld = array();
      foreach ($ledgerOld as $id => $item) {
        $countDebit = 0;
        foreach ($item->whereIn('ledger_type', [0, 2]) as $subId => $subItem) {
          $countDebit += $subItem->credit;
        }
        array_push($incomeOld, $countDebit);
      }

      $income = array();
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
    }

    $chartData = new Chart;
    $chartData->labels($mount);
    $chartData->dataset('Pemasukan', 'line', $income)->color("rgba(66,165,214,1)")->backgroundcolor("rgba(66,165,214,1)")->fill(false)->linetension(0.1);
    $chartData->dataset('Pengeluaran', 'line', $outcome)->color("rgba(214,79,66,1)")->backgroundcolor("rgba(214,79,66,1)")->fill(false)->linetension(0.1);

    $data = [
      'chart' => $chartData,
      'income' => $this->arrayData($incomeOld, $income, 0),
      'outcome' => $this->arrayData($outcomeOld, $outcome, 1),
      'total' => [
        'text' => 'text-info',
        'icon' => 'fa fa-balance-scale',
        'percent' => $totalProfit,
      ],
      'CountIncome' => $countIncome,
      'CountOutcome' => $countOutcome,
      'CountTotal' => $countIncome - $countOutcome,
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
      if ($item->isOnline()) {
        $online++;
      } else {
        $offline++;
      }
      $count++;
      foreach ($item->tokens as $subItem) {
        if (!$item->isOnline()) {
          if ($subItem->revoked == 0) {
            $online++;
            $offline--;
          } else {
            $online--;
            $offline++;
          }
        }
      }
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
    return $raw[$month - 1];
  }
}
