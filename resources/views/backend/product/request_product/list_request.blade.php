@extends('backend.layouts.app')

@section('content')
<div class="aiz-titlebar text-left mt-2 mb-3">
    <h5 class="mb-0 h6">{{translate('Request Product')}}</h5>
</div>


<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Produt Name</th>
      <th scope="col">Details</th>
      <th scope="col">Customer Name</th>
      <th scope="col">Phone Number</th>
    </tr>
  </thead>
  <tbody>
    @php 
     $i=1;
    @endphp
    @foreach($request_product as $row)
    
    <tr>
      <th scope="row">{{$i++}}</th>
      <td>{{$row->product_name}}</td>
      <td>{{$row->details}}</td>
      <td>{{$row->customer_name}}</td>
      <td>{{$row->phone_number}}</td>
    </tr>
  @endforeach  
  </tbody>
</table>
<div class="float-right">
  {{ $request_product->links() }}
</div>
@endsection
