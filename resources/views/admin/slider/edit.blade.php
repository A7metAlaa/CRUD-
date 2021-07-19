@extends('admin.admin_master')

@section('admin')


    @if(session('success'))
            <div class="alert alert-success alert-dismissable fade show" role="alert">
              <strong> {{ session('success') }}</strong>
            <button type="button" class="close" data-dimsiss="alert" aria-label="Close"> 
              <span aria-hidden="true"> &times; </span>
            </button>                
            </div>
      @endif
              

    <div class="py-12">
        <div class="container">
            <div class="row"> 
           
  <div class="col-md-8">
      <div class="card">
        <div class="card-header"> Edit Slider </div>
        
        <div class="card-body"> 

          <!-- Slider Title -->
          <form action="{{url('slider/update/'.$sliders->id)}}" method="POST" enctype="multipart/form-data">
          @csrf 
            <input type="hidden" name="old_image" value="{{$sliders->image}}">

            <div class="form-group">
              <label for="exampleInputEmail1"> Update Slider Title </label>
              <input type="text" name="title" class="form-control" 
             id="exampleInputEmail1" aria-describedby="emailHelp" 
             value="{{$sliders->title}}">  

              @error('title')
                  <span class="text-danger"> {{ $message }}   </span>
              @enderror
            </div>


            <!-- Update Slider Description -->
            <div class="form-group">
              <label for="exampleInputEmail1"> Update Slider Description </label>
            <textarea class="form-control" id="exampleFormControlTextarea1"
              name="description" rows="3"  >   {{$sliders->description}}  </textarea>
              <br> <br>
              @error('description')
                  <span class="text-danger"> {{ $message }}   </span>
              @enderror
            </div>

        <!-- Slider Image -->
        
        <div class="form-group">
              <label for="exampleInputEmail1"> Update Slider Image  </label>
              <input type="file" name="image" class="form-control" 
             id="exampleInputEmail1" aria-describedby="emailHelp" 
             value="{{$sliders->image}}">  
              @error('image')
                  <span class="text-danger"> {{ $message }}   </span>
              @enderror
            </div>

            <div class="form-group">
                <img src="{{asset($sliders->image)}}" style="height:200px; width:400px;" >
            </div>

            <button type="submit" class="btn btn-primary"> Update  Slider</button>
        </form>


        </div>
      </div>
      </div>
            </div>
        </div>
    </div>


    @endsection
