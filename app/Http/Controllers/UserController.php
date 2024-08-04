<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('id','DESC')->get();
        return view('admin.user.index',compact(('users')));   
     }



     public function userStatus(Request $request){
        // dd($request->all());
        if($request->mode=='true'){
            DB::table('users')->where('id',$request->id)->update(['status'=>'active']);
        }else{
            DB::table('users')->where('id',$request->id)->update(['status'=>'inactive']);

        }

        return response()->json(['msg'=> 'successfuly updated status','status'=>true]);
    }


    /**
     * Show the form for creating a new resource.
     
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
              // return $request;
              $validated = $request->validate([
                'full_name' => 'string|required',
                'username' => 'string|nullable',
                'email' => 'email|required|unique:users,email',
                'password' => 'min:4|required',
                'phone' => 'string|nullable',
                'photo' => 'required',
                'address' => 'string|nullable',
                'role' => 'required|in:admin,customer,vendor',        
                'status' => 'required|in:active,inactive',
            ]);
            $data = $request->all();


            // return data 
                $new = User::create($data);
                if($new){
                    return redirect()->route('user.index')->with('success',' user successfully created ');
        
                }else{
                     return back()->with('error','something went wrong!');
                }
                // return $request->all();
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
        $user = User::find($id);

        if($user){
            return view('admin.user.edit',compact(['user']));
        }else{
            return back()->with('error','Data not found !');
        }
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
        $user = User::find($id);
        if($user){


            $validated = $request->validate([
                'full_name' => 'string|required',
                'username' => 'string|nullable',
                'email' => 'email|required|exists:users,email',
                // 'password' => 'min:4|required',
                'phone' => 'string|nullable',
                'photo' => 'required',
                'address' => 'string|nullable',
                'role' => 'required|in:admin,customer,vendor',        
                'status' => 'required|in:active,inactive',

            ]);
            $data = $request->all();

         

            $new = $user->fill($data)->save();

            if($new){
                return redirect()->route('user.index')->with('success',' user successfully updated ');

            }else{
                return back()->with('error','something went wrong!');
            }
        }
      }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        if($user){
                  $status = $user->delete();
                  if($status){
                  
                      return redirect()->route('user.index')->with('success','user successfuly deleted');
                  }else{
                      return back()->with('error','something went wrong');
                  }
        }else{
            return back()->with('error','Data not found !');
        }
}
}