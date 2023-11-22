<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Settings;
use Illuminate\Support\Facades\File;
use Auth;
use Redirect;
use Validator;

class SettingsController extends Controller
{

  function __construct()
    {
       $this->middleware('permission:manage-settings,admin', ['only' => ['index','postSettings']]);
    }

  public function index()
  {
    $this->data['page_title'] = 'Admin | Settings';
    $this->data['settings']=Settings::orderBy('id', 'DESC')->first();
    return view('admin.settings.settings', $this->data);
  }
  public function postSettings(Request $request)
  {
    //dd($request->all()); 
    $count=Settings::count();
    if($count==0)
    {
      $address= $request->address;      
      $email= $request->email;
      $phone = $request->phone;
      $fax = $request->fax;
      $header_logo= $request->header_logo;
      $footer_logo = $request->footer_logo;

      $footer_title = $request->footer_title;
      $footer_description = $request->footer_description;

      if ($request->hasFile('header_logo')) :
        $file = $request->file('header_logo');
        $filename = time() . '_header.' . $file->getClientOriginalExtension();
        $file->move(public_path().'/uploads/settings', $filename);
        //$image = $filename;
      endif;
      if(!empty($filename))
      {
        $header_logo = $filename;
      }
      else
      {
        $header_logo="";
      }
      if ($request->hasFile('footer_logo')) :
        $file1 = $request->file('footer_logo');
        $filename1 = time() . '_footer.' . $file1->getClientOriginalExtension();
        $file1->move(public_path().'/uploads/settings', $filename1);
        //$image = $filename;
      endif;
      if(!empty($filename1))
      {
        $footer_logo = $filename1;
      }
      else
      {
        $footer_logo="";
      }
      $settings=Settings::create([
        'address' => $address,
        'email'=>$email,
        'phone'=>$phone,
        'fax' => $fax,
        'footer_title' => $footer_title,
        'footer_description' => $footer_description,
        'header_logo'=>$header_logo,
        'footer_logo'=>$footer_logo
      ]);
      if ($settings != null) {
          
        $successMsg = 'Settings Updated Successfully';
        return Redirect('admin/settings')
                ->withSuccess($successMsg);    
      }
    }
    else
    {
      $address= $request->address; 
      $email= $request->email;
      $phone = $request->phone;
      $fax = $request->fax;
      $header_logo= $request->header_logo;
      $footer_logo = $request->footer_logo;
      $settings_id=$request->settings_id;
      $header_logo_old=$request->header_logo_old;
      $footer_logo_old=$request->footer_logo_old;
      $footer_title = $request->footer_title;
      $footer_description = $request->footer_description;

      if ($request->hasFile('header_logo')) :
        $file = $request->file('header_logo');
        $filename = time() . '_header.' . $file->getClientOriginalExtension();
        $file->move(public_path().'/uploads/settings', $filename);
        //$image = $filename;
      endif;
      if(!empty($filename) && File::exists(public_path("uploads/settings/".$header_logo_old)))
      {
        //echo $file_path = public_path().'/uploads/settings/'.$header_logo_old; die;
        File::delete(public_path("uploads/settings/".$header_logo_old));
      }
      if(!empty($filename))
      {
        $header_logo = $filename;
      }
      else
      {
        $header_logo=$header_logo_old;
      }
      if ($request->hasFile('footer_logo')) :
        $file1 = $request->file('footer_logo');
        $filename1 = time() . '_footer.' . $file1->getClientOriginalExtension();
        $file1->move(public_path().'/uploads/settings', $filename1); 
        //$image = $filename;
      endif;
      if(!empty($filename1) && File::exists(public_path("uploads/settings/".$footer_logo_old)))
      {
        //$file_path = public_path().'/uploads/cms/'.$cms_old_image;
        File::delete(public_path("uploads/settings/".$footer_logo_old));
      }
      if(!empty($filename1))
      {
        $footer_logo = $filename1;
      }
      else
      {
        $footer_logo=$footer_logo_old;
      }
      $settingsUpdate=Settings::where('id',$settings_id)->update([
        'address' => $address,
        'email'=>$email,
        'phone'=>$phone,
        'fax' => $fax,
        'footer_title' => $footer_title,
        'footer_description' => $footer_description,
        'header_logo'=>$header_logo,
        'footer_logo'=>$footer_logo
      ]);
      if ($settingsUpdate != null) {
          
        $successMsg = 'Settings Updated Successfully';
        return Redirect('admin/settings')
                ->withSuccess($successMsg);    
      }

    }
  }
  public function postSettingsSocial(Request $request)
  {
    $count=Settings::count();
    if($count==0)
    { 
      $settingsSocial=Settings::create([
        'facebook'=>$request->facebook,
        'youtube'=>$request->youtube,
        'linkedin'=>$request->linkedin,
        'instagram'=>$request->instagram,
        'twitter'=>$request->twitter
      ]);
      if ($settingsSocial != null) {          
        $successMsg = 'Settings Updated Successfully';
        return Redirect('admin/settings')
                ->withSuccess($successMsg);    
      }
    }
    else
    {
      $settings_id=$request->settings_id;
      $settingsSocialUpdate=Settings::where('id',$settings_id)->update([
        'facebook'=>$request->facebook,
        'youtube'=>$request->youtube,
        'linkedin'=>$request->linkedin,
        'instagram'=>$request->instagram,
        'twitter'=>$request->twitter
      ]);
      if ($settingsSocialUpdate != null) {          
        $successMsg = 'Settings Updated Successfully';
        return Redirect('admin/settings')
                ->withSuccess($successMsg);    
      }
    }  
  }
}
