<?php

namespace App\Http\Controllers;

use App\Models\medicine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session as Session;

class MedicineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->user()->username !== 'master') {
            abort(403);
        }
        $data = medicine::orderBy('created_at', 'desc')->paginate(10);
        return view('/medicine/index')->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('medicine/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Session::flash('mid', $request->mid);
        Session::flash('name', $request->name);
        Session::flash('dosage', $request->dosage);
        Session::flash('usage', $request->usage);
        Session::flash('price', $request->price);
        Session::flash('qty', $request->qty);

        $request->validate([
            'mid' => 'required|unique:medicine',
            'name' => 'required',
            'dosage' => 'required',
            'usage' => 'required',
            'price' => 'required|numeric',
            'qty' => 'required|numeric'
        ]);

        $data = [
            'mid' => $request->input('mid'),
            'name' => $request->input('name'),
            'dosage' => $request->input('dosage'),
            'usage' => $request->input('usage'),
            'price' => $request->input('price'),
            'qty' => $request->input('qty')
        ];
        medicine::create($data);
        return redirect('medicine')->with('success', 'Data Succesfully Stored!');
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
        $data = medicine::where('mid', $id)->first();
        return view('medicine/edit')->with('data', $data);
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
            'dosage' => 'required',
            'usage' => 'required',
            'price' => 'required|numeric',
            'qty' => 'required|numeric'
        ]);
        $data = [
            'name' => $request->input('name'),
            'dosage' => $request->input('dosage'),
            'usage' => $request->input('usage'),
            'price' => $request->input('price'),
            'qty' => $request->input('qty')
        ];
        medicine::where('mid', $id)->update($data);
        return redirect('/medicine')->with('success', 'Success Update Data!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        medicine::where('mid', $id)->delete();
        return redirect('/medicine')->with('success', 'Success Delete Data!');
    }
}
