@extends('master')
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
@section('content')
<div class ="column middle" id="middle"> 
    <h3 align="center" id="cart">In Your Cart</h3>
    <br>
    @if($message = Session::get('success'))
    <div class="alert alert-success">
        <h2>{{$message}}</h2>
    </div>
    @endif
    <table class="table table-striped table-dark">
        <thead>
            <tr>
                <th>ID</th>
                <th>Product ID</th>
                <th>Product Name</th>
                <th>Product Price</th>
                <th>Product Quantity</th>
                <th>Amount</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cart as $row)
            <tr>
                <td>{{$row['id']}}</td> 
                <td>{{$row['product_id']}}</td>
                <td>{{$row['name']}}</td>
                <td>Rp {{$row['price']}}</td>
                <td>{{$row['quantity']}}</td>
                <td>Rp {{$row['amount']}}</td>
                <td>
                    <form method="post" class="delete_form" action="{{action('CartController@destroy', $row['id'])}}">
                        {{csrf_field()}}
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="btn btn-danger">Remove</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="buttonPrint">
        <a href="/download"><button class="btn btn-primary" id="down">Download Excel</button></a>
    </div>
    <div class="buttonFlush">
        <a href="/flush"><button class="btn btn-primary" id="flush">Flush</button></a>
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