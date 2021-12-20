<?php

namespace App\Http\Controllers;

use App\Models\Cabang;
use App\Models\Korea;
use App\Models\Pelaporan;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KoreaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Pelaporan::join('users', 'user_id', '=', 'users.id')
        ->where('user_id', Auth::user()->id)
        ->get();
        // return $data->toArray();
        // return $data->toJson();
        // dd($data->all());
        return view('korea.index');
    }

    public function read()
    {
        $data = Pelaporan::where('user_id', Auth::user()->id)->get();
        // dd($data);
        return view('korea.read')->with([
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
        return view('korea.create')->with([
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
        $data = Korea::findOrFail($id);
        $cabangs = Cabang::get();
        return view('korea.edit')->with([
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
        $data = Korea::findOrFail($id);
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
        $data = Pelaporan::findOrFail($id);
        $data->delete();
    }
}
