<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Validator;
use App\Models\Category;
use App\Models\Brand;


use Auth;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
/*
*/

class CategoryController extends Controller
{
    public function __construct(){  
                                //auth is called modelor 
            $this->middleware('auth');
    }
    public function AllCat(){

        // $categories = DB::table('categories')
        //     ->join('users','categories.user_id','users.id')
        //     ->select('categories.*','users.name')
        //     ->latest()->paginate(5);
        //                 //table:users   table:categories column:user_id iniside categories
        // $categories = DB::table('categories')->latest()->paginate(5);
        
       
        $brands = Brand::latest()->paginate(10);

        $categories = Category::latest()->paginate(5);        
        $trashCat = Category::onlyTrashed()->latest()->paginate(5);

        return view('admin.category.index',compact('categories','trashCat'));
    }

    public function AddCat(Request $request ){
        $validatedData  = $request->validate([
            'category_name'=>'required|unique:categories|max:255',
        ],
        [
            'category_name.required' => 'please Input Category Name',
            'category_name.max' => 'Category Less Than 255',
        ]);
            /***************** ORM old Way ****************************/
        // Category::insert([   
        //     'category_name' =>$request->category_name,
        //     'user_id' => Auth::user()->id,
        //     'created_at'=>Carbon::now()
        // ]);


            /***************** ORM New Way ****************************/
        $Category= New Category;
        $Category->category_name = $request->category_name;
         $Category->user_id = Auth::user()->id;
         $Category->save();

            /******************** QuerBuilder to Insert Data  ******************* */
        // $data = array();
        // $data['category_name'] = $request->category_name;
        // $data['user_id'] = Auth::user()->id; //which user is already logged 

        // DB::table('categories')->insert($data);

        return Redirect()->back()->with('success', 'Category Inserted Successfully');
    }





    /**************************** Edit the Category ********************************/
    public function Edit($id){
        //$categories = Category::find($id);
        $categories = DB::table('categories')->where('id',$id)->first();        
        return view('admin.category.edit',compact('categories'));
    }


    //Update the Category using Query Builder
    public  function Update(Request $request,$id) 
    {
        // $update = Category::find($id)->update
        // ([
        //      //captured from name="category_name
        //     'category_name' => $request->category_name,
        //     'user_id'=>Auth::user()->id
        // ]);

        $data = array();
        $data['category_name'] = $request->category_name ;
        $data['user_id'] = Auth::user()->id;
        DB::table('categories')->where('id', $id)->update($data);
        return Redirect()->route('all.category')->with('success', 'Category updated Successfully');
    }


    //Delete Category Controller


    public function SoftDelete($id){
        $delete = Category::find($id)->delete();
        return Redirect()->back()->EditAboutwith('success','Category Deleted Successfully');
    }

    //Restore Function

    public function Restore($id) {

        $delete = Category::withTrashed()->find($id)->restore();
        return Redirect()->back()->with('success','Category Restored Successfully');
    }


    //Permanently Delte

    public function Pdelete($id){        
        $delete = Category::onlyTrashed()->find($id)->forceDelete();
        return Redirect()->back()->with('success','Category Deleted Permanently Successful');

    }












}
