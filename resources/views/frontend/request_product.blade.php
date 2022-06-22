@extends('frontend.layouts.app')

@section('content')
<section class="pt-4 mb-4">
    <div class="container text-center">
        <div class="row">
            <div class="col-lg-6 text-center text-lg-left">
                <h1 class="fw-600 h4">{{ translate('Track Order') }}</h1>
            </div>
            <div class="col-lg-6">
                <ul class="breadcrumb bg-transparent p-0 justify-content-center justify-content-lg-end">
                    <li class="breadcrumb-item opacity-50">
                        <a class="text-reset" href="{{ route('home') }}">{{ translate('Home') }}</a>
                    </li>
                    <li class="text-dark fw-600 breadcrumb-item">
                        <a class="text-reset" href="{{ route('orders.track') }}">"{{ translate('Track Order') }}"</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>
<section class="mb-5">
    <div class="container text-left">
        <div class="row">
            <div class="col-xxl-5 col-xl-6 col-lg-8 mx-auto">
                <form  action="{{route('request.product')}}" method="POST" enctype="multipart/form-data" novalidate>
                    @csrf
                    <div class="bg-white rounded shadow-sm">
                        <div class="fs-15 fw-600 p-3 border-bottom text-center">
                        </div>
                        <div class="form-box-content p-3">
                            
                            <div class="form-group">
                                <input type="text" class="form-control mb-3 @error ('product_name') is-invalid
                          @enderror"  name="product_name" placeholder="Product Name" value="{{ old('product_name') }}" required>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control mb-3 @error ('details') is-invalid
                          @enderror" placeholder="Details" value="{{ old('details') }}"  name="details" required>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control mb-3 @error ('customer_name') is-invalid
                          @enderror" placeholder="Customer Name" name="customer_name" value="{{ old('customer_name') }}"  required>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control mb-3 @error ('phone_number') is-invalid
                          @enderror" placeholder="Phone Number"  name="phone_number" value="{{ old('phone_number') }}" required>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-success">Request product</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
</section>

@endsection
