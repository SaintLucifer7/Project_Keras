@extends('master')
<link rel="stylesheet" href="../css/update.css">
@section('content')
<div class="col-md-12 d-flex" id="out">
        <div class ="column middle" id="middle"> 
            <h3 align="center" id="title">Update Profile</h3>
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
            <form method="post" action="{{action('UserController@update')}}">
                {{csrf_field()}}
                <div class="form-group">
                Name: <input type="text" name='name' class="form-control" value="{{Session::get('name')}}" >
                </div>
                <div class="form-group">
                Username: <input type="text" name='username' class="form-control" value="{{Session::get('username')}}" >
                </div>
                <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Update Profile" id="btn">
                </div>
            </form>
            
        </div>
    </div>
   
</div>
@endsection