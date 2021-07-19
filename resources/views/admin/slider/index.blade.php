@extends('admin.admin_master')

@section('admin')

    <div class="py-12">

    <!------------------------------- All Categories Section ----------------------------------->
        <div class="container">
            <div class="row"> 
            <h4 class="mr-3"> Home Slider: </h4>
                 <a href="{{route('add.slider')}}">  <button class="btn btn-info mb-1"> Add Slider </button> </a>
                <br> <br>
            <div class="col-md-12">
              <div class="card">

              @if(session('success'))
                <div class="alert alert-success alert-dismissable fade show" role="alert">
                  <strong> {{ session('success') }}</strong>
                <button type="button" class="close" data-dimsiss="alert" aria-label="Close"> 
                  <span aria-hidden="true"> &times; </span>
                </button>                
                </div>
              @endif
              
              <div class="card-header"> All Sliders </div>
            
            <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col" width="5%" >SL No</th>
                <th scope="col" width="15%" > Slider Title</th>
                <th scope="col" width="25%" > Slider Description </th>
                <th scope="col" width="15%" > Slider Image </th>
                <th scope="col" width="15%" > Action </th>
              </tr>
            </thead>
            <tbody>
            <!-- Fetch the Data From Database -->
                @php($i=1)
              @foreach($sliders as $slider)
              <tr>
                <th scope="row"> {{ $i++ }}  </th>
                <td> {{$slider->title}} </td>
                <td> {{$slider->description}} </td>
              <!--<td> {{Str::limit($slider->description, 20)}} </td>-->



                <td> <img src="{{asset($slider->image)}}" style="height:40px; width:70px;" alt=""> </td>
                <td> 
                    <a href="{{url('slider/edit/'.$slider->id)}}" class="btn btn-info"> Edit </a>
                    <a href="{{url('slider/delete/'.$slider->id)}}" onclick="return confirm('Are You Sure to delete ')"  class="btn btn-danger"> Delete </a>  
                </td>
               </tr>
            @endforeach
  </tbody>
</table>
      </div>
     </div>
    
        </div>
    </div>


    </div>
    
@endsection

