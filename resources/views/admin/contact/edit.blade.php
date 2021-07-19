@extends('admin.admin_master')

@section('admin')
<div class="col-lg-12">
        <div class="card card-default">
            <div class="card-header card-header-border-bottom">
                <h2> Edit Contact Page </h2>
            </div>
            <div class="card-body">

        
                <form action="{{ url('update/contact/'.$contact->id) }}" method="POST" enctype="multipart/form-data">                                        
                    @csrf 


                    <div class="form-group">
                        <label for="exampleFormControlInput1"> Contact Email </label>
                        <input type="email" class="form-control" name="email" id="exampleFormControlInput1" 
                        value="{{$contact->email}}">
                    </div>





                    <div class="form-group">
                        <label for="exampleFormControlInput1"> Contact phone </label>
                        <input type="contact" class="form-control" name="phone" id="exampleFormControlInput1" 
                        value="{{$contact->phone}}">
                    </div>


                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Contact Address</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1"
                         name="address" rows="3"  > {{ $contact->address }} </textarea>
                    </div>
               
                    <div class="form-footer pt-4 pt-5 mt-4 border-top">
                        <button type="submit" class="btn btn-primary btn-default"> Update </button>
                    </div>

                </form>
            </div>
        </div>


@endsection