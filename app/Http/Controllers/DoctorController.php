<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Doctor::orderBy('created_at', 'desc')->paginate(10);
        return view('/doctor/index')->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('doctor/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Session::flash('nid', $request->nid);
        Session::flash('name', $request->name);
        Session::flash('specialization', $request->specialization);
        Session::flash('gender', $request->gender);
        Session::flash('age', $request->age);
        Session::flash('phone', $request->phone);
        Session::flash('address', $request->address);

        $request->validate([
            'nid' => 'required|unique:doctor',
            'name' => 'required',
            'specialization' => 'required',
            'gender' => 'required',
            'age' => 'required|numeric',
            'phone' => 'required',
            'address' => 'required'
        ]);

        $data = [
            'nid' => $request->input('nid'),
            'name' => $request->input('name'),
            'specialization' => $request->input('specialization'),
            'gender' => $request->input('gender'),
            'age' => $request->input('age'),
            'phone' => $request->input('phone'),
            'address' => $request->input('address')
        ];
        Doctor::create($data);
        return redirect('doctor')->with('success', 'Data Succesfully Stored!');
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
        $data = Doctor::where('nid', $id)->first();
        return view('doctor/edit')->with('data', $data);
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
            'name' => 'required',
            'specialization' => 'required',
            'gender' => 'required',
            'age' => 'required|numeric',
            'phone' => 'required',
            'address' => 'required'
        ]);
        $data = [
            'name' => $request->input('name'),
            'specialization' => $request->input('specialization'),
            'gender' => $request->input('gender'),
            'age' => $request->input('age'),
            'phone' => $request->input('phone'),
            'address' => $request->input('address')
        ];
        Doctor::where('nid', $id)->update($data);
        return redirect('/doctor')->with('success', 'Success Update Data!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Doctor::where('nid', $id)->delete();
        return redirect('/doctor')->with('success', 'Success Delete Data!');
    }
}
