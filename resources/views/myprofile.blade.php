@extends('master')
@section('content')
<link rel="stylesheet" href="../css/myprofile.css">
<div class="col-md-12 d-flex" id="out">
        <div class ="column middle" id="middle"> 
            <h3 align="center">Your Profile</h3>
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
            <form method="post" action="">
                {{csrf_field()}}
                <div class="form-group">
                Name: <input type="text" class="form-control" value="{{Session::get('name')}}" readonly>
                </div>
                <div class="form-group">
                Username: <input type="text"  class="form-control" value="{{Session::get('username')}}" readonly>
                </div>
                <div class="form-group">
                Password: <input type="text" class="form-control" value="{{Session::get('password')}}" readonly>    
                </div>
            </form>
                <div class="form-group">
                    <a href="/updateprofile"><input type="submit" class="btn btn-primary" value="Update Profile"id="btn"><a>
                    
                    <a href = "/changepassword"><input type="submit" class="btn btn-primary" value="Change Password" id="btn"></a>
                </div>
        </div>
    </div>
   
</div>
@endsection