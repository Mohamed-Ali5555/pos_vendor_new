<?php

namespace App\Http\Controllers;

use App\Models\Aboutus;
use Illuminate\Http\Request;

class AboutusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $about = Aboutus::first();
        // dd( $about->count());
        // $about = $about->delete();
        return view('admin.aboutus.aboutus',compact('about'));
    }



    
    public function update(Request $request, Aboutus $aboutus)
    {
        $about = Aboutus::first();
        $about = $about->update([
            'heading'=> $request->heading,
            'content'=> $request->content,
            'image'=> $request->image,
            'happy_customer'=> $request->happy_customer,
            'experience'=> $request->experience,
            'return_customer'=> $request->return_customer,
            'team_advisor'=> $request->team_advisor,

        ]);
        if($about){
            return back()->with('success','AbouteUs updated successfuly');
        }else{
            return back()->with('error','Something went wrong');
        }
    }


}
