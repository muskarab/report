<?php

namespace App\Http\Controllers;

use App\Models\Cabang;
use App\Models\Korwil;
use App\Models\Pelaporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KorwilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('korwil.index');
    }

    public function read()
    {
        $data = Pelaporan::where('user_id', Auth::user()->id)->get();
        // dd($data);
        return view('korwil.read')->with([
            'data' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cabangs = Cabang::get();
        return view('korwil.create')->with([
            'cabangs' => $cabangs
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data['cair'] = $request->cair;
        $data['tempat'] = $request->tempat;
        $data['user_id'] = Auth::user()->id;
        $data['cabang_id'] = $request->cabang;
        $data['rceo'] = $request->rceo;
        $data['am'] = $request->am;
        $data['acfm'] = $request->acfm;
        $data['bm'] = $request->bm;
        $data['crbmcbs'] = $request->crbmcbs;
        $data['lain'] = $request->lainlain;
        $data['topik'] = $request->topik;
        $data['pembahasan'] = $request->pembahasan;
        $data['created_at'] = now();
        Pelaporan::insert($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Korwil::findOrFail($id);
        $cabangs = Cabang::get();
        return view('korwil.edit')->with([
            'data' => $data,
            'cabangs' => $cabangs
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
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
        $data = Korwil::findOrFail($id);
        $data->tempat = $request->tempat;
        $data->cabang = $request->cabang;
        $data->rceo = $request->rceo;
        $data->am = $request->am;
        $data->acfm = $request->acfm;
        $data->bm = $request->bm;
        $data->crbmcbs = $request->crbmcbs;
        $data->lain = $request->lain;
        $data->topik = $request->topik;
        $data->pembahasan = $request->pembahasan;
        $data->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Korwil::findOrFail($id);
        $data->delete();
    }
}
