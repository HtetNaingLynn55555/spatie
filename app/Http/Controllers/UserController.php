<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view( 'user.index',compact('users') );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::pluck( 'name' )->all();

        return view( 'user.create', compact( 'roles' ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $inputs = $request->all();
        $inputs['password'] = Hash::make( $request->input( 'password' ) );

        $user = User::create($inputs);

        $user->assignRole( $request->input( 'roles' ));

        return redirect()->route('userIndex');


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::find($id);
        $roles = Role::pluck( 'name' )->all();
        $userRoles = $user->roles->pluck('name');

        return view( 'user.edit',compact( 'user','roles','userRoles' ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {


        $inputs = $request->all();

        if( !empty( $inputs[ 'password' ] ) )
        {
            $inputs['password'] = Hash::make( $request->input('password') );
            $user = User::find($id);
            $user->name = $inputs['name'];
            $user->email = $inputs['email'];
            $user->password = $inputs['password'];
            $user->save();
        } else {
            $user = User::find($id);
            $user->name = $inputs['name'];
            $user->email = $inputs['email'];
            $user->save();
        }

        DB::table('model_has_roles')->where('model_id',$id)->delete();
        $user->assignRole($request->input('roles'));

        return redirect()->route('userIndex');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        User::findOrFail($id)->delete();

        return redirect()->route('userIndex');
    }
}
