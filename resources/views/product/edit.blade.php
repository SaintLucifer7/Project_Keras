@extends('master')
@section('content')

 <!-- <div class="row">
    <div class="topnav">
        <a class="active" href="/dashboard">STOCK LIST</a>
        <div class="topnav-right">
            <a href="/cart-list"><img src="../image/cart.png" alt="cart"></a>
</div>

    <div class ="content">
        <div class = "menuBar">
            <div class = "menus">
                <a href="/dashboard">Dashboard</a>
            </div>
            <div class = "menus">
                <a href="/stock-list">Stock List</a>
            </div>
            <div class = "menus">
                <a href="/history">History</a>
            </div>
            @hasrole('Admin')
            <div class = "menus">
                <a href="/account">Accounts</a>
            </div>
            @endhasrole
            <div class = "menus">
                <a href="/myprofile">My Profile</a>
            </div>
        </div>  -->

        <div class="col-md-12">
            <br>
            <h3>Edit Record</h3>
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
            <form method="post" action="{{action('ProductController@update', $id)}}">
                {{csrf_field()}}
                <input type="hidden" name="_method" value="PATCH">
                <div class="form-group">
                    <input type="text" name="id" class="form-control" value="{{$product->id}}" readonly>
                </div>
                <div class="form-group">
                    <input type="text" name="name" class="form-control" value="{{$product->name}}" placeholder="Enter product name">
                </div>
                <div class="form-group">
                <input type="text" name="price" class="form-control" value="{{$product->price}}" placeholder="Enter price">    
                </div>
                <div class="form-group">
                <input type="text" name="stock" class="form-control" placeholder="Add to existing stock">
                </div>
                <div class="form-group">
                <input type="text" name="description" class="form-control" value="{{$product->description}}" placeholder="Enter description">
                </div>
                <div class="form-group">
                <input type="text" name="location" class="form-control" value="{{$product->location}}" placeholder="Enter location">
                </div>
                <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Edit">
                </div>
            </form>
      </div>

    </div>

</div>

@endsection