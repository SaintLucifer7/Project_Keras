@extends('master')
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="../css/cut.css">
@section('content')
<div class="col-md-12 d-flex" id="out">
        <div class ="column middle" id="middle"> 
            <h3 align="center" id="product">Product Data</h3>
            <br>
            @if($message = Session::get('success'))
            <div class="alert alert-success">
                <h2>{{$message}}</h2>
            </div>
            @endif
            @if($errors->any())
            <div class="alert alert-danger">
                <h2>{{$errors->first()}}</h2>
            </div>
            @endif
            <form method="post" action="{{action('CartController@store')}}" id="mid">
                {{csrf_field()}}
                <div class="form-group">
                Product ID: <input type="text" name="product_id" class="form-control" value="{{$product->id}}" readonly>
                </div>
                <div class="form-group">
                Product Name: <input type="text" name="name" class="form-control" value="{{$product->name}}" readonly>
                </div>
                <div class="form-group">
                Product Price: <input type="text" name="price" class="form-control" value="{{$product->price}}" readonly>    
                </div>
                <div class="form-group">
                Available Stock: <input type="text" name="stock" class="form-control" value="{{$product->stock}}" readonly>    
                </div>
                <div class="form-group">
                Total quantity to be cut: <input type="text" name="quantity" class="form-control" placeholder="Enter quantity">
                </div>  
                <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Cut Stock" id="cuts">
                </div>
            </form>
            
        </div>
    </div>
   
</div>
<script>
    $(document).ready(function()({
        $('.delete_form').on('submit', function()){
            if(confirm("Are you sure you want to delete it?")){
                return true;
            }else{
                return false;
            }
        }
    )};
</script>
@endsection