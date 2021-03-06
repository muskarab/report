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
        if (Auth::user()->role->name == 'admin') {
            $data =Pelaporan::paginate(5);
        }else{
            $data = Pelaporan::where('user_id', Auth::user()->id)->paginate(5);
        }
        // dd($data);
        // return view('report.read', compact('data'))->with('i');
        return view('report.index', compact('data'))->with('i');
    }

    public function search(Request $request)
    {
        if (Auth::user()->role->name == 'admin') {
            $data = Pelaporan::join('users', 'pelaporans.user_id', '=', 'users.id')
            ->where('users.name', 'LIKE', '%' . $request->f_search . '%')
            ->orwhere('cair', 'LIKE', '%' . $request->f_search . '%')
            ->orWhere('tempat', 'LIKE', '%' . $request->f_search . '%')
            ->orWhere('rceo', 'LIKE', '%' . $request->f_search . '%')
            ->orWhere('am', 'LIKE', '%' . $request->f_search . '%')
            ->orWhere('acfm', 'LIKE', '%' . $request->f_search . '%')
            ->orWhere('bm', 'LIKE', '%' . $request->f_search . '%')
            ->orWhere('crbmcbs', 'LIKE', '%' . $request->f_search . '%')
            ->orWhere('lain', 'LIKE', '%' . $request->f_search . '%')
            ->orWhere('topik', 'LIKE', '%' . $request->f_search . '%')
            ->orWhere('pembahasan', 'LIKE', '%' . $request->f_search . '%')
            ->paginate();
            return view('report.index', compact('data'))->with('i');
        }else {
            $data = Pelaporan::Where('user_id', Auth::user()->id)
            ->Where('tempat', 'LIKE', '%' . $request->f_search . '%')
            ->orWhere('rceo', 'LIKE', '%' . $request->f_search . '%')
            ->orWhere('am', 'LIKE', '%' . $request->f_search . '%')
            ->orWhere('acfm', 'LIKE', '%' . $request->f_search . '%')
            ->orWhere('bm', 'LIKE', '%' . $request->f_search . '%')
            ->orWhere('crbmcbs', 'LIKE', '%' . $request->f_search . '%')
            ->orWhere('lain', 'LIKE', '%' . $request->f_search . '%')
            ->orWhere('topik', 'LIKE', '%' . $request->f_search . '%')
            ->orWhere('pembahasan', 'LIKE', '%' . $request->f_search . '%')
            ->paginate();
            return view('report.index', compact('data'))->with('i');
        }
        // dd($request->all());
    }

    public function read()
    {
        if (Auth::user()->role->name == 'admin') {
            $data =Pelaporan::paginate(1);
        }else{
            $data = Pelaporan::where('user_id', Auth::user()->id)->paginate(1);
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
        if ($request->image != null) {
            Storage::disk('local')->delete('public/image/' . $request->image_old);
            $file = $request->file('image');
            $filename = $file->getClientOriginalName();
            $file->storeAs('public/image', $filename);
        }
        // return view('report.index');
        return redirect('/report');
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
        // return view('report.index', compact('data'))->with('i');
        return redirect('/report');
    }
}
