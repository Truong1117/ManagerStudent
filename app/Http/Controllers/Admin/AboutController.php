<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Abouts;
class AboutController extends Controller
{
    //
    public function index(){
        $arr['abouts'] = Abouts::all();
        return view('admin.abouts',$arr);
    }

    public function store(Request $req){

        $aboutus = new Abouts;
        $aboutus->title = $req->input('title');
        $aboutus->subtitle = $req->input('subtitle');
        $aboutus->description = $req->input('description');

        $aboutus->save();
        return redirect('abouts')->with('status','Data added for About us');
    }

    public function edit($id){
        $aboutus = Abouts::findOrFail($id);
        return view('admin.abouts.edit')
        ->with('aboutus',$aboutus)
        ;
    }

    public function update(Request $req, $id){
        $aboutus = Abouts::findOrFail($id);
        $aboutus->title = $req->input('title');
        $aboutus->subtitle = $req->input('subtitle');
        $aboutus->description = $req->input('description');
        $aboutus->update();
        return redirect('abouts')->with('status','Data update completed');
    }

    public function delete($id){
        $aboutus = Abouts::findOrFail($id);
        $aboutus->delete();
        return redirect('abouts')->with('status','Data delete completed');
    }
}
