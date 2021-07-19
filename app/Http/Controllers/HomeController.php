<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;
use Illuminate\Support\Carbon;
use Image;
use Auth;
use File;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    //Get all Sliders
    public function HomeSlider(){
      
        $sliders = Slider::latest()->get();
        return view('admin.slider.index',compact('sliders'));
    }

    //Add a new Slider

    public function AddSlider(){
        return view('admin.slider.create');
    }

    //Store Slider
    public function StoreSlider(Request $request){
        $slider_image =  $request->file('image');
        $name_gen = hexdec(uniqid()).'.'.$slider_image->getClientOriginalExtension();
        Image::make($slider_image)->resize(1920,1088)->save('image/slider/'.$name_gen);
        $last_img = 'image/slider/'.$name_gen;
        Slider::insert([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $last_img,
            'created_at' => Carbon::now()
        ]);
        return Redirect()->route('home.slider')->with('success','Slider Inserted Successfully');

    }

    //Edit Slider Page
    public function EditSlider($id){
        $sliders = Slider::find($id);
        return view('admin.slider.edit',compact('sliders'));
    }



    public function UpdateSlider(Request $request , $id) {

    $old_image = $request->old_image; //name="old_image for input hidden"
    $brand_image = $request->file('image'); //the name in the input
    if($brand_image){
    $name_gen = hexdec(uniqid()); //encryption 
    $img_ext = strtolower($brand_image->getClientOriginalExtension()); //extension .png .jpg
    $img_name = $name_gen .'.'.$img_ext;//Migrate Image name with extension profile.png
    $up_location = 'image/slider/';
    $last_img = $up_location.$img_name;
    $brand_image->move($up_location,$img_name);
    unlink(public_path($old_image));
    Slider::find($id)->update([
        'title' => $request->title,
        'description' => $request->description,
        'image' => $last_img,
        'created_at' => Carbon::now(),
    ]);
    $notification = array(
        'message' => 'Slider Updated Successfully',
        'alert-type'=>'warning',
    );

    return Redirect()->route('home.slider')->with($notification);

    }else{
        Slider::find($id)->update([
            'title' => $request->title,
            'description' => $request->description,
            'created_at'=>Carbon::now()
        ]);
        
        $notification = array(
            'message' => 'Slider Title Updated Successfully',
            'alert-type'=>'warning',
        );


        return Redirect()->route('home.slider')->with($notification);
    }   
}
    
    //Delete Slider

    public function Delete($id){

        $image = Slider::find($id);
        $old_image = $image->image;
        unlink(public_path($old_image));
        Slider::find($id)->delete();

         $notification = array(
                'message' => 'Slider  Deleted Successfully',
                'alert-type'=>'warning',
            );
        return Redirect()->back()->with($notification);
    
    }






    
}







