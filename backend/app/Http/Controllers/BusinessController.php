<?php

namespace App\Http\Controllers;

use App\Models\Business;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class BusinessController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
   

    public function GetBusiness()
    {
        $obj = Business::where('state',1)->first();
        
        if($obj){
            return response()->json(['status' => 200,'result' => $obj]);
        }else{
            return response()->json(['status' => 404]);
        }
    }

    public function Update(Request $request)
    {

        try
        {
           
            $name_logo = "";
            if ($request->hasFile('logo')){
                $name_logo = $this->Upload($request->file('logo'),str_slug($request->name),'company/');
            }
            $obj = Business::find($request->id_company);
            $obj->document_type = $request->document_type;
            $obj->document_number = $request->document_number;
            $obj->name = $request->name;
            $obj->tradename = $request->tradename;
            $obj->ubigee = $request->ubigee;
            $obj->address = $request->address;
            $obj->country_code = $request->country_code;
            $obj->user_sol = $request->user_sol;
            $obj->password_sol = $request->password_sol;
            $obj->certificate = $request->certificate;
            $obj->password_certificate = $request->password_certificate;
            $obj->process_type = $request->process_type;
            if (!empty($name_logo)) {
                $obj->logo = $name_logo;
            }
            $obj->phone = $request->phone;
            $obj->email = $request->email;
            $obj->email_backup = $request->email_backup;
            $obj->update();
            return response()->json(['status' => 200,'result' => $obj]);
          
        } catch (\Exception $e){   
            return response()->json(['status' => 404]);
        } 
    }

    public function UpdateTheme(Request $request)
    {

        try
        {
           
            $obj = Business::find($request->id_company);
            $obj->bg_header = $request->bg_header;
            $obj->bg_sidebar = $request->bg_sidebar;
            $obj->bg_sidebar_nav_dropdown_toggle = $request->bg_sidebar_nav_dropdown_toggle;
            $obj->bg_sidebar_nav_dropdown_items = $request->bg_sidebar_nav_dropdown_items;
            $obj->update();
            return response()->json(['status' => 200,'result' => $obj]);
          
        } catch (\Exception $e){   
            return response()->json(['status' => 404]);
        } 
    }


    public function Upload($file,$name,$path)
    {
        $extension = $file->getClientOriginalExtension();
        $filenamestore = str_slug($name)."-".time().".".$extension;
        $file->move($path, $filenamestore);
        return $path.$filenamestore;
    }
    
}
?>
