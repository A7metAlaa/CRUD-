<x-app-layout>
    <x-slot name="header">

          <!-- Greeting the user -->
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Hi Mr .. <b> {{  Auth::user()->name }} </b>
            <!-- Count the users -->
            <b style="float:right"> Total Users:  <span class="badge badge-danger">
               {{count($users)}} </span>
             </b>
        </h2>
        
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row"> 
            <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">SL No</th>
      <th scope="col">Name </th>
      <th scope="col">Email </th>
      <th scope="col">Created At </th>
    </tr>
  </thead>
  <tbody>
  <!-- Fetch the Data From Database -->
  @php($i=1)
    @foreach($users as $user)
    <tr>
      <th scope="row">{{ $i++ }}</th>
      <td> {{$user->name}}</td>
      <td> {{$user->email}} </td>
      <td> {{Carbon\Carbon::parse($user->created_at)->diffForHumans() }} </td>
    </tr>
    @endforeach
    
  </tbody>
</table>
            </div>
        </div>
    </div>
</x-app-layout>
