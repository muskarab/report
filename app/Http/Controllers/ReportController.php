<?php

namespace App\Http\Controllers;

use App\Models\Cabang;
use App\Models\Pelaporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('report.index');
    }

    public function read()
    {
        if (Auth::user()->role->name == 'admin') {
            $data =Pelaporan::get();
        }else{
            $data = Pelaporan::where('user_id', Auth::user()->id)->get();
        }
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
        // dd($request->all());
        // $request->validate([
        //     'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        // ]);
        
        $data['cair'] = $request->cair;
        $data['tempat'] = $request->tempat;
        if (Auth::user()->role->name != 'admin') {
            $data['user_id'] = Auth::user()->id;
        }
        $data['cabang_id'] = $request->cabang;
        $data['rceo'] = $request->rceo;
        $data['am'] = $request->am;
        $data['acfm'] = $request->acfm;
        $data['bm'] = $request->bm;
        $data['crbmcbs'] = $request->crbmcbs;
        $data['lain'] = $request->lainlain;
        $data['topik'] = $request->topik;
        $data['pembahasan'] = $request->pembahasan;
        $data['image'] = $request->image;
        $data['created_at'] = now();
        // $file = $request->image;
        // $filename = $file->getClientOriginalName();
        // $file->storeAs('public/image', $file);
        Pelaporan::insert($data);
    }
    public function store_image(Request $request)
    {
        // dd($request->all());
        $file = $request->file('image');
        $filename = $file->getClientOriginalName();
        $file->storeAs('public/image', $filename);
        return view('report.index');
    }

    public function update_image(Request $request)
    {
        // if ($file = $request->file('image_update') == null) {
        //     return view('report.index');
        // }else {
        //     $file = $request->file('image_update');
        //     $filename = $file->getClientOriginalName();
        //     $file->storeAs('public/image', $filename);
        //     return view('report.index');
        // }
        $pelaporans = Pelaporan::get();
        $images = Storage::disk('local')->files('public/image/');
        // foreach ($pelaporans as $pelaporan) {
        //     if ($pelaporan->image != Storage::disk('local')->files('public/image/')) {
        //         Storage::disk('local')->delete('public/image/' . $pelaporan->image);
        //     }
        // }
        dd($images);
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
        $data->image = $request->image;
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
        Storage::disk('local')->delete('public/image/' . $data->image);
        $data->delete();
    }
}
