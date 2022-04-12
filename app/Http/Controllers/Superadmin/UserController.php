<?php

namespace App\Http\Controllers\Superadmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use App\User;
use App\Roles;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['users']=User::with('roles')->orderBy('created_at','desc')->get();
        // dd($data);
        return view('super_admin/user.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['roles']=Roles::get();
        // dd($data);
        return view('super_admin/user.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
    }

    public function store(Request $request)
    {
         // $this->validate($request,[
         //    'name' => 'required|string|max:255',
         //    'email' => 'required|string|email|max:255|unique:users',
         //    'password' => 'required|string|min:6|confirmed',
         //    'role'=> 'required',
         //    ]);


        $data['users']=User::create([
            'roles_id' => $request['role'],
            'name' => $request['name'],
            'alamat' => $request['alamat'],
            'no_hp' => $request['no_hp'],
            'email' => $request['email'],
             'password' => Hash::make($request['password']),
        ]);
        // dd($data);

        // return redirect()-> route('user.index')->with(['success' => 'Data Berhasil Ditambahkan!']);    }

        // dd($data);
        return redirect()-> route('user.index');
        // $data['users']=User::create([
        //     'roles_id' => $request['role'],
        //     'name' => $request['name'],
        //     'alamat' => $request['alamat'],
        //     'no_hp' => $request['no_hp'],
        //     'email' => $request['email'],
        //     'password' => bcrypt($request['password'])
        // ]);

        // return redirect()-> route('super_admin/user.index')->with(['success' => 'Data Berhasil Ditambahkan!']);   
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
    public function edit($id)
    {
        $data['users'] = User::find($id);
        $data['roles'] = Roles::get();
    
        // dd($data);
        return view('super_admin/user.edit',$data);
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
        $data = User::find($id);
        $data->fill($request->all());
        $data->update();

        return redirect('user');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = User::find($id)->delete();
        return response()->json($data);
    }
}
