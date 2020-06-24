<?php

namespace App\Http\Controllers;

use App\Info;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        $user = auth()->user();
        $user->load('info');
      return view('profile',[
          'user'=>$user
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
        //
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
    public function edit()
    {
        $user = auth()->user();
        $user->load('info');
        return view('profile_edit',['user' =>$user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $user = auth()->user();

        $rules =[
            'email' => 'required|email|unique:users,email,'.auth()->id(),
            'grade' => 'required|string',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'gender'=> ['required',Rule::in(['male','female'])],
            'avatar' => 'nullable|mimes:jpg,jpeg,png,bmp,gif,svg,webp'
        ];
        $data = $this->validate($request,$rules);
        $avatarName = $user->info->avatar;
        if($request->hasFile('avatar'))
        {
            $avatarName = time() . '.' . request()->avatar->getClientOriginalExtension();
            $request->avatar->storeAs('avatars', $avatarName);
        }
        User::where('id',$user->id)->update([
            'email'=>$request->email,
        ]);
        Info::where('user_id',$user->id)->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'grade' => $request->grade,
            'avatar' => $avatarName,
            'gender' =>  $request->gender
        ]);
        return redirect('/profile');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
