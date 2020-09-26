@extends('master')
@section('content')

<div class ="column middle"> 
    <h3 align="center" id="user">List of Users</h3>
    <br>
    @if($message = Session::get('success'))
    <div class="alert alert-success">
        <h2>{{$message}}</h2>
    </div>
    @endif
    
    
    <table class="table table-striped table-dark">
        <thead>
            <tr>
                <th>User ID</th>
                <th>Name </th>
                <th>Username </th>
                <th>Role</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            @foreach($user as $row)
            <tr>
                <td>{{$row['id']}}</td> 
                <td>{{$row['name']}}</td>
                <td>{{$row['username']}}</td>
                <td>{{$row['role']}}</td>
                <td>
                    <form method="post" class="delete_form" action="{{action('UserController@destroy', $row['id'])}}">
                        {{csrf_field()}}
                        <input type="hidden" name="_method" value="DELETE">
                        @if($row['username'] == Session::get('username')) <h6>(Me)</h6> @endif
                        @if($row['username'] != Session::get('username'))<button type="submit" class="btn btn-danger">Delete User</button>@endif
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
