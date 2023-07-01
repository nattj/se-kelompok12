<?php

namespace App\Http\Controllers;

use App\Models\patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = patient::orderBy('created_at', 'desc')->paginate(10);
        return view('/patient/index')->with('data', $data);
    }

    public function indexDashboard()
    {
        $data = patient::orderBy('nik', 'asc')->take(10);
        return view('dashboard/index')->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('patient/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Session::flash('nik', $request->nik);
        Session::flash('name', $request->name);
        Session::flash('gender', $request->gender);
        Session::flash('age', $request->age);
        Session::flash('phone', $request->phone);
        Session::flash('address', $request->address);
        Session::flash('disease', $request->disease);
        Session::flash('desc', $request->desc);

        $request->validate([
            'nik' => 'required|unique:patient',
            'name' => 'required|string|min:3',
            'gender' => 'required',
            'age' => 'required|numeric',
            'phone' => 'required|string|min:10|max:14',
            'address' => 'required',
            'disease' => 'required',
            'desc' => 'required'
        ]);

        $data = [
            'nik' => $request->input('nik'),
            'name' => $request->input('name'),
            'gender' => $request->input('gender'),
            'age' => $request->input('age'),
            'phone' => $request->input('phone'),
            'address' => $request->input('address'),
            'disease' => $request->input('disease'),
            'desc' => $request->input('desc')
        ];
        patient::create($data);
        return redirect('patient')->with('success', 'Data Succesfully Stored!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = patient::where('nik', $id)->first();
        return view('patient/edit')->with('data', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|min:3',
            'gender' => 'required',
            'age' => 'required|numeric',
            'phone' => 'required|string|min:10|max:14',
            'address' => 'required',
            'disease' => 'required',
            'desc' => 'required'
        ]);
        $data = [
            'name' => $request->input('name'),
            'gender' => $request->input('gender'),
            'age' => $request->input('age'),
            'phone' => $request->input('phone'),
            'address' => $request->input('address'),
            'disease' => $request->input('disease'),
            'desc' => $request->input('desc')
        ];
        patient::where('nik', $id)->update($data);
        return redirect('/patient')->with('success', 'Success Update Data!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        patient::where('nik', $id)->delete();
        return redirect('/patient')->with('success', 'Success Delete Data!');
    }
}
