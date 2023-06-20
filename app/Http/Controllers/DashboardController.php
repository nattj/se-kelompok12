<?php

namespace App\Http\Controllers;

use App\Models\patient;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data = patient::orderBy('created_at', 'desc')->take(5)->get();
        return view('dashboard/index')->with('data', $data);
    }
    public function indexPatient()
    {
        // $data = patient::orderBy('created_at', 'desc')->take(5)->get();
        return view('dashboard/patient');
    }
    public function countDoctor()
    {

    }
}
