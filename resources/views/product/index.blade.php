@extends('master')
@section('content')
<link rel="stylesheet" href="../css/table.css">
<div class ="column middle" id="middle"> 
    <h3 align="center" id="prod">Product Data</h3>
    <br>
    @if($message = Session::get('success'))
    <div class="alert alert-success">
        <h2>{{$message}}</h2>
    </div>
    @endif

    <div class="col-md-12 d-flex">
        <form action="/search" method="get">
            <div class="input-group">
                <input type="search"  class="form-control" id="name" name="search">
                <span class ="form-group-prepend">
                    <button type="submit" class="btn btn-primary" id="btnsearch">Search</button>
                </span>
            </div> 
        </form>
        @hasrole('Admin')
        <div class="btnAddPro">
            <a href="/add-stock" class="btn btn-primary" id="btna"> Add Product</a>
            <a href="/import_excel" class="btn btn-primary" id="btni"> Add Product from excel</a>
            <br>
            <br>
        </div>
        @endhasrole
    </div>

    @if($errors->any())
    <div class="alert alert-danger">
        <h2>{{$errors}}</h2>
    </div>
    @endif
    <table class="table table-striped table-dark" >
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Price</th>
                <th>Stock</th>
                <th>Product Desctiption</th>
                <th>Product Location</th>
                <th>Edit</th>
                <th>Add to Cart</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $row)
            <tr>
                <td>{{$row['id']}}</td> 
                <td>{{$row['name']}}</td>
                <td>Rp {{$row['price']}}</td>
                <td>{{$row['stock']}}</td>
                <td>{{$row['description']}}</td>
                <td>{{$row['location']}}</td>
                <td><a href="{{action('ProductController@edit', $row['id'])}}"><button type="button" class="btn btn-primary btn-sm">Edit</button></a></td>
                <td><a href="{{action('CartController@cutStock', $row['id'])}}"><button type="button" class="btn btn-primary btn-sm">Cut Stock</button></a></td>
                <td>
                    <form method="post" class="delete_form" action="{{action('ProductController@destroy', $row['id'])}}">
                        {{csrf_field()}}
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
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