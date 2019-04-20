<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', [
            'except' => ['create', 'store','show']
        ]);
        $this->middleware('guest', [
            'only'  => ['create']
        ]);
    }

    //用户注册表单页面
    public function create()
    {
    	return view('users.create');
    }

    //用户个人信息展示页面
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name'      => 'required|max:50',
            'email'     => 'required|email|unique:users|max:255',
            'password'  => 'required|confirmed|min:6',
        ]);
        $user = User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => bcrypt($request->password),
        ]);
        // Auth::login($user);
        session()->flash('success', '欢迎，您将在这里开启一段新的旅程~');
        return redirect()->route('users.show', $user);
    }

    public function edit(User $user)
    {
        $this->authorize('update', $user);
        return view('users.edit', compact('user'));
    }

    public function update(User $user, Request $request)
    {
        $this->authorize('update', $user);
        // 验证参数
        $this->validate($request, [
            'name'      => 'required|max:50',
            'password'  => 'required|confirmed|min:6',
        ]);
        $user->update([
            'name'      => $request->name,
            'passsword' => bcrypt($request->password),
        ]);

        return redirect()->route('users.show', $user->id);
    }
}
