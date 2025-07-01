<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContractorDashboardController extends Controller
{
    public function index()
    {
        return view('contractor.dashboard');
    }

    public function myWork()
    {
        return view('contractor.mywork');
    }

    public function notifications()
    {
        return view('contractor.notifications');

    }

    public function help()
    {
        return view('contractor.help');
    }
    public function settings()
    {
        return view('contractor.settings');
    }



}
