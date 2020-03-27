<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;

class DashboardController extends Controller
{
    //
    public function registered()
    {
        $arr['users'] = User::all();
        return view('admin.register', $arr);
    }
    public function registerAddUser(Request $request)
    {
        $rules = array(
            'name' => 'required',
            'phone' => 'required|min:10|max:10',
            'email' => 'required|unique',
        );
        $validator = Validator::make($rules);
        if ($validator->fails())
            return Response::json(array('errors' => $validator->getMessageBag()->toarray()));
        else {
            $user = new User();
            $user->name = $request->name;
            $user->phone = $request->phone;
            $user->email = $request->email;
            $user->password = 1;
            $user->usertype = '';
            $user->save();
            return response()->json($user);
        }
    }
    public function registerEdit(Request $req, $id)
    {
        $users = User::find($id);
        // dd($users);
        return view('admin.registerEdit')->with('users', $users);
    }
    public function registerUpdate(Request $req, $id)
    {
        $users = User::find($id);
        $users->name = $req->input('username');
        $users->usertype = $req->input('usertype');
        $users->update();
        return redirect('/roleRegister')->with('status', 'Your data is update compeleted');
    }

    public function registerDelete(Request $req, $id)
    {
        $users = User::find($id);
        $users->delete();
        return redirect('/roleRegister')->with('status', 'Your data is delete compeleted');
    }
}
