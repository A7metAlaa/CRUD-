@extends('admin.admin_master')

@section('admin')

    <div class="py-12">

    <!------------------------------- All Categories Section ----------------------------------->
        <div class="container">
            <div class="row"> 
            <h4 class="m-3"> Contact Page </h4> 
                <a href="{{route('add.contact')}}" class="float-right" >  <button class="btn btn-info  "> Add Contact </button> </a>
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
              
              <div class="card-header"> All Contacts Data  </div>
            
            <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col" width="5%" >SL No</th>
                <th scope="col" width="15%" > Contact Address</th>
                <th scope="col" width="25%" > Contact Phone </th>
                <th scope="col" width="15%" > Contact Email </th>
                <th scope="col" width="15%" > Action </th>
              </tr>
            </thead>
            <tbody>
            <!-- Fetch the Data From Database -->
                @php($i=1)
              @foreach($contacts as $con)
              <tr>
                <th scope="row"> {{ $i++ }}  </th>
                <td> {{$con->address}} </td>
                <td> {{$con->email}} </td>
                <td> {{$con->phone}} </td>
        


                <td> 
                    <a href="{{url('contact/edit/'.$con->id)}}" class="btn btn-info"> Edit </a>
                    <a href="{{url('contact/delete/'.$con->id)}}" onclick="return confirm('Are You Sure to delete ')"  class="btn btn-danger"> Delete </a>  
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

