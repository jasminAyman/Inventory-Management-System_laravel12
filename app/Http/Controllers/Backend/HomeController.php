<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Feature;
use App\Models\Clarify;
use App\Models\Financial;
use App\Models\Usability;
use App\Models\UsabilityData;
use App\Models\Faqs;
use App\Models\App;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class HomeController extends Controller
{
    //Feature
    public function AllFeature(){

        $feature = Feature::latest()->get();
        return view('admin.backend.feature.all_feature', compact('feature'));
    }
    //End Method

    public function AddFeature(){

        return view('admin.backend.feature.add_feature');
    }
    //End Method

    public function StoreFeature(Request $request){

        Feature::create([
            'title'=> $request->title,
            'icon'=> $request->icon,
            'description'=> $request->description,
        ]);

        $notification = array(
            'message' => 'Feature Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.feature')->with($notification);
    }
    //End Method

    public function EditFeature($id){
        $feature = Feature::find($id);
        return view('admin.backend.feature.edit_feature', compact('feature'));
    }
    //End Method

    public function UpdateFeature(Request $request){

        $fea_id = $request->id;

        Feature::find($fea_id)->update([
            'title'=> $request->title,
            'icon'=> $request->icon,
            'description'=> $request->description,
        ]);

        $notification = array(
            'message' => 'Feature Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.feature')->with($notification);
    }
    //End Method

    public function DeleteFeature($id){

        Feature::find($id)->delete();

        $notification = array(
            'message' => 'Feature Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }//End Method features

/*...................................................................................... */

    //Clarifies
    public function GetClarifies(){

        $clarify = Clarify::find(1);
        return view('admin.backend.clarify.get_clarify', compact('clarify'));
    }
    //End Method

    public function UpdateClarify(Request $request){

        $clarify_id = $request->id;
        $clarify = Clarify::find($clarify_id);

        if($request->file('image')){
            $image = $request->file('image');
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            $img = $manager->read($image);
            $img->resize(302,618)->save(public_path('upload/clarify/'.$name_gen));
            $save_url = 'upload/clarify/'.$name_gen;

            if(file_exists(public_path($clarify->image))){
                @unlink(public_path($clarify->image));
            }

            Clarify::find($clarify_id)->update([
                'title'=> $request->title,
                'description'=> $request->description,
                'image'=> $save_url,
            ]);

            $notification = array(
                'message' => 'Clarify Updated with image Successfully',
                'alert-type' => 'success'
            );

            return redirect()->back()->with($notification);
        }
        else{

            Clarify::find($clarify_id)->update([
                'title'=> $request->title,
                'description'=> $request->description,
            ]);

            $notification = array(
                'message' => 'Clarify Updated without image Successfully',
                'alert-type' => 'success'
            );

            return redirect()->back()->with($notification);
        }
    }
    //End clarifies

/*...................................................................................... */

    //Financials
    public function GetFinancial(){

        $financial = Financial::find(1);
        return view('admin.backend.financial.get_financial', compact('financial'));
    }
    //End Method

    public function UpdateFinancial(Request $request){

        $financial_id = $request->id;
        $financial = Financial::find($financial_id);

        if($request->file('image')){
            $image = $request->file('image');
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            $img = $manager->read($image);
            $img->resize(307,619)->save(public_path('upload/financial/'.$name_gen));
            $save_url = 'upload/financial/'.$name_gen;

            if(file_exists(public_path($financial->image))){
                @unlink(public_path($financial->image));
            }

            Financial::find($financial_id)->update([
                'title'=> $request->title,
                'description'=> $request->description,
                'image'=> $save_url,
            ]);

            $notification = array(
                'message' => 'Financial Updated with image Successfully',
                'alert-type' => 'success'
            );

            return redirect()->back()->with($notification);
        }
        else{

            Financial::find($financial_id)->update([
                'title'=> $request->title,
                'description'=> $request->description,
            ]);

            $notification = array(
                'message' => 'Financial Updated without image Successfully',
                'alert-type' => 'success'
            );

            return redirect()->back()->with($notification);
        }
    }
    //End Method financials
/*...................................................................................... */

    //usability
    public function GetUsability(){

        $usability = Usability::find(1);
        return view('admin.backend.usability.get_usability', compact('usability'));
    }
    //End Method

    public function UpdateUsability(Request $request){

        $usability_id = $request->id;
        $usability = Usability::find($usability_id);

        if($request->file('image')){
            $image = $request->file('image');
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            $img = $manager->read($image);
            $img->resize(560,400)->save(public_path('upload/usability/'.$name_gen));
            $save_url = 'upload/usability/'.$name_gen;

            if(file_exists(public_path($usability->image))){
                @unlink(public_path($usability->image));
            }

            Usability::find($usability_id)->update([
                'title'=> $request->title,
                'description'=> $request->description,
                'link'=> $request->link,
                'youtube'=> $request->youtube,
                'image'=> $save_url,
            ]);

            $notification = array(
                'message' => 'Usability Updated with image Successfully',
                'alert-type' => 'success'
            );

            return redirect()->back()->with($notification);
        }
        else{

            Usability::find($usability_id)->update([
                'title'=> $request->title,
                'link'=> $request->link,
                'youtube'=> $request->youtube,
                'description'=> $request->description,
            ]);

            $notification = array(
                'message' => 'Usability Updated without image Successfully',
                'alert-type' => 'success'
            );

            return redirect()->back()->with($notification);
        }
    }
    //End Method usabilities
/*...................................................................................... */

    //usability Data
    public function AllUsabilityConnect(){

        $connect = UsabilityData::latest()->get();
        return view('admin.backend.usabilitydata.all_usabilitydata', compact('connect'));
    }
    //End Method

    public function AddUsabilityConnect(){

        return view('admin.backend.usabilitydata.add_usabilitydata');
    }
    //End Method


    public function StoreUsabilityConnect(Request $request){

        UsabilityData::create([
            'title'=> $request->title,
            'description'=> $request->description,
        ]);

        $notification = array(
            'message' => 'Usability Data Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.connect')->with($notification);
    }
    //End Method

    public function EditUsabilityConnect($id){
        $connect = UsabilityData::find($id);
        return view('admin.backend.usabilitydata.edit_usabilitydata', compact('connect'));
    }
    //End Method

    public function UpdateUsabilityConnect(Request $request){

        $connect_id = $request->id;

        UsabilityData::find($connect_id)->update([
            'title'=> $request->title,
            'description'=> $request->description,
        ]);

        $notification = array(
            'message' => 'Usability Data Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.connect')->with($notification);
    }
    //End Method

    public function DeleteUsabilityConnect($id){

        UsabilityData::find($id)->delete();

        $notification = array(
            'message' => 'Usability Data Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }//End Method

    //عشان اخلي اليوزر يعدل في الداتا من خلال الموقع مش لازم من فورم الباك اند
    public function UpdateConnect(Request $request, $id){

        $connect = UsabilityData::findOrFail($id);

        $connect->update($request->only(['title','description']));

        return response()->json(['success' => true, 'message' => 'Updated Successfully']);

    }
    // End Method
/*...................................................................................... */

    //faqs Data
    public function AllFaqs(){

        $faqs = Faqs::latest()->get();
        return view('admin.backend.faqs.all_faqs', compact('faqs'));
    }
    //End Method

    public function AddFaqs(){

        return view('admin.backend.faqs.add_faqs');
    }
    //End Method

    public function StoreFaqs(Request $request){

        Faqs::create([
            'title'=> $request->title,
            'description'=> $request->description,
        ]);

        $notification = array(
            'message' => 'Faqs Data Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.faqs')->with($notification);
    }
    //End Method

    public function EditFaqs($id){
        $faqs = Faqs::find($id);
        return view('admin.backend.faqs.edit_faqs', compact('faqs'));
    }
    //End Method

    public function UpdateFaqs(Request $request){

        $faqs_id = $request->id;

        Faqs::find($faqs_id)->update([
            'title'=> $request->title,
            'description'=> $request->description,
        ]);

        $notification = array(
            'message' => 'Faqs Data Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.faqs')->with($notification);
    }
    //End Method

    public function DeleteFaqs($id){
        Faqs::find($id)->delete();

        $notification = array(
            'message' => 'Faqs Data Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

/*...................................................................................... */

    //Apps
    //عشان اخلي اليوزر يعدل في الداتا من خلال الموقع مش لازم من فورم الباك اند
    public function UpdateApps(Request $request, $id){
        $apps = App::findOrFail($id);

        $apps->update($request->only(['title','description']));

        return response()->json(['success' => true, 'message' => 'Updated Successfully']);

    }

    // عشان اخلي اليوزر يعدل في الصورة من خلال الموقع مش لازم من فورم الباك اند ويحط الصورة اللي اختارها
    public function UpdateAppsImage(Request $request, $id){
        $apps = App::findOrFail($id);

        if($request->file('image')){
            $image = $request->file('image');
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            $img = $manager->read($image);
            $img->resize(306,481)->save(public_path('upload/apps/'.$name_gen));
            $save_url = 'upload/apps/'.$name_gen;

            if(file_exists(public_path($apps->image))){
                @unlink(public_path($apps->image));
            }

            $apps->update([
                "image" => $save_url,
            ]);

            return response()->json([
                'success' => true,
                'image_url' => asset($save_url),
                'message' => 'Image Updated Successfully'
            ]);
        }

        return response()->json(['success' => false, 'message' => 'Image Upload Faild'], 400);
    }
    //End Method

}
