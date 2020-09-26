@extends('master')
<link rel="stylesheet" href="../css/DashboardAdmin.css">
@section('content')
<br>
<p class="dash">Menu</p>
    <div class = buttonContainer>
    
        @hasrole('Admin')
        <div class = "box1">
            <a href="/add-stock"><img src="../image/plus.png" alt="addStock"></a>
            <br>
            <p class="add">Add Stock </p>
        </div>
        @endhasrole
        <div class = "box3">
            <a href="printInvoice.html"><img src="../image/prin.png" alt="invoice"></a>
            
            <p class ="print">Print Invoice </p>
        </div>
    </div>
@endsection