@extends('admin.admin_master')

@section('admin')

    <div class="py-12">

    <!------------------------------- All Categories Section ----------------------------------->
        <div class="container">
            <div class="row"> 
        <!-- Rigt Section For Adding Images -->
            <div class="col-md-8">

              <div class="card-group">
                <!-- From Controller compact image in Get all Methods -->
                
                <!-- Left Section For Displayin Images -->
                    @foreach($images as $multi) 
                    <div class="col-md-4 mt-5"> 
                        <div class="card">

                          <img src="{{asset($multi->image)}}" alt="">
                        
                        </div>
                        
                    </div>

                    @endforeach           

              </div><!-- End Card-group class-->

            </div> <!-- End Col-md-8 -->


    <div class="col-md-4">
      <div class="card">
        <div class="card-header"> Multi Image </div>
        
        <div class="card-body">


        <!----------------------------- Form Section ------------------------------------------->

          <form action="{{route('store.image')}}" method="POST" enctype="multipart/form-data">
                                               
          @csrf 
            <!-------------------------- Brand Image -------------------------->
         
            <div class="form-group">
              <label for="exampleInputEmail1">Brand Image </label>
              <input type="file" name="image[]" 
              class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" 
              placeholder="Enter Brand Image" multiple="">
                @error('image')
                  <span class="text-danger"> {{ $message }}   </span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Add Images</button>
        </form>
<!------------------------------- End Form Section ----------------------------------------->


        


        </div>
      </div>
      </div>
            </div>
        </div>
    </div>

@endsection