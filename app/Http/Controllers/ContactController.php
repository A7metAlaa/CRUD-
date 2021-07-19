<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\contact;
use App\Models\ContactForm;

class ContactController extends Controller
{
    /*
    public function __construct(){  
        //auth is called modelor 
        $this->middleware('auth');
    }
    public function index(){
        return view('contact');
    }
*/

    //Fetching
    Public function AdminContact(){
        $contacts = Contact::all();
        return view('admin.contact.index',compact('contacts'));
    }

   
    public function AdminAddContact(){

        return view('admin.contact.create');

    }

    //Inserting
    public function AdminStoreContact(Request $request){
       
        $validated = $request->validate([
           'phone'=>'required|min:11',
           'email'=>'required',
           'address' => 'required',
        ],
       [
           'phone.required'=>'please enter a valid phone number',
           'email.required'=>'We need to know your email address!',
           'address.required'=>'We need to know your  address!',


       ]);



       Contact::insert([
           'address'=>$request->address,
           'phone'=>$request->phone,
           'email'=>$request->email,
           'created_at'=>Carbon::now(),
       ]);
        return Redirect()->route('admin.contact')->with('success','Contact Inserted Successfully');


    }


  

    //Edit

    public function Edit($id){
        //ORM 
        //$contacts =  contact::find($id);
      //Query Builder 
      $contact = DB::table('contacts')->where('id',$id)->first();        

        return view('admin.contact.edit',compact('contact'));
    }

 
    //Update Contact

    public function UpdateContact(Request $request ,$id){

       $update = contact::find($id)->update([
            'phone'=>$request->phone,
            'email'=>$request->email,
            'address'=>$request->address,
        ]);
        return Redirect()->route('admin.contact')->with('success',' Contact Updated Successfully');

    }
  
    //Delete

    public function DeleteContact($id){
        $delete = contact::FindORFail($id)->delete();
        return Redirect()->back()->with('success','Contact Deleted Successfully');

     
    }

    //Contact

    public function Contact(){
        $contact = DB::table('contacts')->first();
        return view('pages.contact',compact('contact'));
    }


    public function ContactForm(Request $request){
        $validateData = $request->validate([
            'name'    => 'required|min:5',
            'email'   => 'required|unique:contact_forms',
            'subject' => 'required',
            'message' => 'required',
        ],
        
        [
            'name.required' =>' Please Enter Your Name',
            'email.required' => 'Please Enter A Valid Email',
            'subject.required'=> 'Please Enter Your Subject',
            'message.required'=> 'Please Type Your Message'
        ]);

        ContactForm::insert([
            'name'=>$request->name,
            'email'=>$request->email,
            'subject'=>$request->subject,
            'message'=>$request->message,
            'created_at'=> Carbon::now(),

        ]);
        return Redirect()->route('contact')->with('success','Your Message Sent Successfully');
        
    }

    public function AdminMessage(){
        
        $messages = ContactForm::all();
        return view('admin.contact.message',compact('messages'));
    }

    //Delete Message

    public function DeleteMessage($id){
        $deleted = ContactForm::FindOrFail($id)->delete();
        return redirect()->back()->with('success','Your message Has Been Deleted');
    }
}
