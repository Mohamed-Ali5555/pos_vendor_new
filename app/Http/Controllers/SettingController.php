<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
   

    
    public function settings(){
        $setting = Setting::first();
        return view('admin.settings.settings',compact('setting'));

    }

    public function settingUpdate(Request $request){
        $setting = Setting::first();
        $validated = $request->validate([
            'title' => 'string|required',
            'meta_description' =>'string|required',
            
            'email' => 'email|required',


            'logo' => 'nullable',
            'favicon' => 'required',

            'status' => 'nullable|in:active,inactive',

            'fax' => 'required|numeric',
            'phone' => 'required|numeric',

            'address' => 'string|required', 
            'footer' => 'string|required',
            'facebook_url' => 'nullable',
            'twitter_url' => 'nullable',
            'linkedin_url' => 'nullable',
            'pinterest_url' => 'nullable',
        ]);
        $setting = $setting->update([

        'title'=>$request->title,
        'meta_description'=>$request->meta_description,
        // 'meta_keywords'=>$request->meta_keywords,
        'logo'=>$request->logo,
        'favicon'=>$request->favicon,
        'address'=>$request->address,
        'email'=>$request->email,
        'phone'=>$request->phone,
        'fax'=>$request->fax,
        'footer'=>$request->footer,
        'facebook_url'=>$request->facebook_url,
        'twitter_url'=>$request->twitter_url,
        'linkedin_url'=>$request->linkedin_url,
        'pinterest_url'=>$request->pinterest_url,
        ]);

        if($setting){
            return back()->with('success','Setting updated successfuly');
        }else{
            return back()->with('error','Something went wrong');
        }
    }
   

    public function smtp(){
        return view('admin.settings.smtp');
    }


    public function smtpUpdate(Request $request){

        foreach($request->types as $key =>$type){
            $this->overWriteEnvFile($type,$request[$type]);
        }
        return back()->with('success','SMTP configration updated successfuly');
    }
  

   public function overWriteEnvFile($type,$val){
    $path = base_path('.env');
    if(file_exists($path)){
        $val = '"'.trim($val).'"';
        if(is_numeric(strpos(file_get_contents($path),$type)) && strpos(file_get_contents($path),$type)>=0){
            file_get_contents($path,str_replace(
                $type.'="'.env($type).'"',$type.'='.$val,file_get_contents($path)
            ));
        }else{
            file_get_contents($path,file_get_contents($path)."\r\n".$type.'='.$val);
        }
    }

   }
}
