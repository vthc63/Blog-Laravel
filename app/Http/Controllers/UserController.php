<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rows = User::all();
        $rows = User::paginate(10);
        $data['rows'] = $rows;
        $data['page_title'] = 'Users';

        return view('admin.users', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show( $id)
    {
        $row = User::find($id);
        return view('admin.delete_user', [
            'page_title'=>'Delete user',
            'row' => $row,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $row = User::find($id);

        return view('admin.edit_user', [
            'page_title'=>'Edit User',
            'row' => $row,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = new User();
        
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
        ]);

        $data['name'] = $request->input('name');
        $data['email'] = $request->input('email');
        $data['updated_at'] = Carbon::now();
        if(!empty($request->input('password'))){
            $data['password'] = Hash::make($request->input('password'));
        }

        $user->where('id', $id)->update($data);  
        return redirect('admin/users');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $user = new User;
        $row = $user->find($id);
        if($row->id != 1) {
                    $row->delete();
                }
                return redirect('admin/users');

                if($request->method() == 'POST'){  
                    if($row->id != 1) {
                        $row->delete();
                    }
                    return redirect('admin/users');
                }
                
                
    }
}
