<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Tarikan;

class HomeController extends Controller
{
    protected $totalDonation;
    protected $totalMembers;
    protected $latestDonations;

    public function __construct()
    {
        $this->totalDonation    = Tarikan::sum('nominal');
        $this->totalMembers     = Member::count();
        $this->latestDonations  = Tarikan::with('member')
            ->latest()
            ->take(10)
            ->get();
    }

    /*
    |--------------------------------------------------------------------------
    | Home Page
    |--------------------------------------------------------------------------
    */
    public function index()
    {
        return view('home', [
            'totalDonation'   => $this->totalDonation,
            'totalMembers'    => $this->totalMembers,
            'latestDonations' => $this->latestDonations,
        ]);
    }
}
