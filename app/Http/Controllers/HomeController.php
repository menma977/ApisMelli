<?php

namespace App\Http\Controllers;

use App\Charts\ChartModel;

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
        $total = (($new - $old) / $countNew) / 100;

        if ($getOldPercent > $getNewPercent) {
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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $mount = ['January', 'February', 'Mart', 'April', 'Mei', 'June', 'July', 'Augustus', 'September', 'October', 'November', 'December'];

        $countBeeOld = [5000, 5000, 5000, 5000, 5000, 5000, 5000, 5000, 5000, 5000, 5000, 5000];
        $incomeOld = [1000, 2000, 3000, 4000, 5000, 6000, 7000, 8000, 9000, 10000, 11000, 12000];
        $outcomeOld = [1000, 2000, 3000, 4000, 5000, 6000, 7000, 8000, 9000, 10000, 11000, 12000];

        $countBee = [1000, 2000, 3000, 4000, 5000, 6000, 7000, 8000, 9000, 10000, 11000, 12000];
        $income = [12000, 11000, 10000, 9000, 8000, 7000, 6000, 5000, 4000, 3000, 2000, 1000];
        $outcome = [5000, 5000, 5000, 5000, 5000, 5000, 5000, 5000, 5000, 5000, 5000, 5000];

        $chartData = new ChartModel;
        $chartData->labels($mount);
        $chartData->dataset('Jumlah Kandang Terjual', 'line', $countBee)->color("rgba(241,216,67,1)")->backgroundcolor("rgba(241,216,67,1)")->fill(false)->linetension(0.1);
        $chartData->dataset('Pemasukan', 'line', $income)->color("rgba(66,165,214,1)")->backgroundcolor("rgba(66,165,214,1)")->fill(false)->linetension(0.1);
        $chartData->dataset('Pengeluaran', 'line', $outcome)->color("rgba(214,79,66,1)")->backgroundcolor("rgba(214,79,66,1)")->fill(false)->linetension(0.1);

        $data = [
            'chart' => $chartData,
            'countBee' => $this->arrayData($countBeeOld, $countBee),
            'income' => $this->arrayData($incomeOld, $income),
            'outcome' => $this->arrayData($outcomeOld, $outcome),
        ];
        return view('home', $data);
    }
}
