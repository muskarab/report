<?php

namespace App\Http\Controllers;

use App\Models\Cabang;
use App\Models\Pelaporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $topik = [];
        // $data = Pelaporan::join('users', 'user_id', '=', 'users.id')
        // ->where('user_id', Auth::user()->id)
        // ->get()->toArray();
        // $i = 0;
        // foreach ($data as $data) {
        //     $topik[$i] = explode((","), $data['topik']);
        //     $i++;
        // }
        // dd($topik);
        // return $data->toArray();
        // return $data->toJson();
        return view('report.index');
    }

    public function read()
    {
        $data = Pelaporan::where('user_id', Auth::user()->id)->get();
        // dd($data);
        return view('report.read', compact('data'))->with('i');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cabangs = Cabang::get();
        return view('report.create')->with([
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
        // $validator = Validator::make($request->all(), [
        //     'tempat' => 'required',
        //     'topik' => 'required',
        //     'pembahasan' => 'required'
        // ]);

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
        // if ($validator->passes()) {
        //     return response()->json(['success' => 'Added new records.']);
        // }
        // return response()->json(['error' => $validator->errors()->all()]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // dd($id);
        $data = Pelaporan::findOrFail($id);
        $cabangs = Cabang::get();
        return view('report.edit', compact('data', 'cabangs'));
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
        $data = Pelaporan::findOrFail($id);
        $data->cabang_id = $request->cabang;
        $data->cair = $request->cair;
        $data->tempat = $request->tempat;
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
