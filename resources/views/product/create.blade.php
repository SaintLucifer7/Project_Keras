@extends('master')
<link rel="stylesheet" href="../css/add.css">
@section('content')
<div class="row">
        <div class="col-md-12">
            <h3 align="center" id="add">Add Product</h3>
        <br>
        @if(count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
            </ul>
        </div>
        @endif
        @if(\Session::has('success'))
        <div class="alert alert-success">
            <p>{{ \Session::get('succcess') }}</p>
        </div>
        @endif

        <div class = "buttonContainer">
        <form method="post" action="{{url('product')}}">
        {{csrf_field()}}
        <div class="form-group">
            Product ID:  <input type="text" name="id" class="form-control" placeholder="Enter id">
        </div>
        <div class="form-group">
            Product Name: <input type="text" name="name" class="form-control" placeholder="Enter name">
        </div>
        <div class="form-group">
            Product Price: <input type="text" name="price" class="form-control" placeholder="Enter price">    
        </div>
        <div class="form-group">
            Product Stock: <input type="number" name="stock" class="form-control" placeholder="Enter stock">
        </div>
        <div class="form-group">
            Product Description: <input type="text" name="description" class="form-control" placeholder="Enter product desctiption">
        </div>
        <div class="form-group">
            Product Location: <input type="text" name="location" class="form-control" placeholder="Enter product location">
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Submit" id="btns">
        </div>
        </form>
        </div>
    </div>
    
    </div>
</div>
@endsection