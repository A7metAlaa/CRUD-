<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Multipic;

use App\Models\HomeAbout;

use Illuminate\Support\Carbon;
class AboutController extends Controller
{
    public function HomeAbout(){
        $homeabout = HomeAbout::latest()->get();
        return view('admin.home.index',compact('homeabout'));
    }


  

    public function AddAbout(){
        return view('admin.home.create');
    }

      //Inserting BioGraphy

      public function StoreAbout (Request $request) {
 
        $validatedData = $request->validate([
            'title'=>'required|min:5',
            'short_dis'=>'required|min:5',
            'long_dis'=>'required|min:5',

        ],
        
        [
            'title.required'=>'please Enter the Title',
            'short_dis.required'=>'please Enter the Title',
            'long_dis.required'=>'please Enter the Title',

        ]);
            HomeAbout::insert([
                'title'=>$request->title,
                'long_dis'=>$request->long_dis,
                'short_dis'=>$request->short_dis,
                'Created_at'=>Carbon::now(),
            ]);

            return Redirect()->route('home.about')->with('success','Your Biography added Successfully');
      }



      //Update About

      public function EditAbout($id){

        $homeabout = HomeAbout::find($id);

        return view('admin.home.edit',compact('homeabout'));
      }



      public function UpdateAbout(Request $request,$id){

      $update = HomeAbout::find($id)->update([
          'title'=>$request->title,
          'short_dis'=>$request->short_dis,
          'long_dis'=>$request->long_dis,
      ]);
      return Redirect()->route('home.about')->with('success',' About Updated Successfully');
      }


      //Delete About

      public function DeleteAbout($id){
        $delete = HomeAbout::FindOrFail($id)->delete();
        return Redirect()->back()->with('success',' About Deleted Successfully');
      }
      
      public function Portfolio(){
          $images = Multipic::all();
          return view('pages.portfolio',compact('images'));
      }

}
