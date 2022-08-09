<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Riasat;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Morilog\Jalali\Jalalian;


class HomeController extends Controller
{

    public function index()
    {


        $lastfourmonth= \App\Models\CreateLetter::groupBy('date')
            ->orderBy('date', 'desc')
            ->take(6)
            ->get([
                DB::raw('MONTH(arch_date_register) as date'),
                DB::raw('count(id) as total')
            ]);




        return view('dashboard.home',compact('lastfourmonth'));
        }

    public function chart()
    {




        $lastfourmonth= \App\Models\CreateLetter::groupBy('date')
            ->orderBy('date', 'desc')
            ->take(12)
            ->get([
                DB::raw('MONTH(arch_date_register) as date'),
                DB::raw('count(id) as total')
            ]);
        return response()->json($lastfourmonth);


    }

    public function charDaily()
    {


        $dialy=Jalalian::now()->format('Y-m-d');

        $dates = \App\Models\CreateLetter::where('arch_date_register','=',$dialy)
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->get(array(
                DB::raw('Date(arch_date_register) as date'),
                DB::raw('COUNT(*) as "total"')
            ));
        return response()->json($dates);

    }

    public function chartWeekly()
    {

        $one_week_ago = Jalalian::now()->subDays(6)->format('Y-m-d');
        $dates = \App\Models\CreateLetter::where('arch_date_register', '>=', $one_week_ago)
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->take(6)
            ->get(array(
                DB::raw('Date(arch_date_register) as date'),
                DB::raw('COUNT(*) as "total"')
            ));

        return response()->json($dates);
    }

}


