@extends('master')
<link rel="stylesheet" href="../css/change.css">
@section('content')
<div class="col-md-12 d-flex" id="out">
        <div class ="column middle" id="middle"> 
            <h3 align="center">Change Password</h3>
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
            <form method="post" action="{{action('UserController@updatepass')}}">
                {{csrf_field()}}
                <div class="form-group">
                New Password: <input type="text" name='new' class="form-control">
                </div>
                <div class="form-group">
                Confrm New Password: <input type="text" name='connew' class="form-control">
                </div>
                <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Update Password" id="btn">
                </div>
            </form>
            
        </div>
    </div>
   
</div>
@endsection