@extends('layouts.app')

@section('content')

<div class="container" style="max-height: 150px !important;">
        <div class="fb-profile" style="max-height: 150px">
            <div class="cover"  style="height: 250px ;background: url('https://images.unsplash.com/photo-1470596914251-afb0b4510279?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=2d891d3197dceea7e61777ebd80e503c&auto=format&fit=crop&w=750&q=80') no-repeat; background-size: cover;">                  
            </div>
        </div>
</div>
    <div class="col-md-12 espaco-capa" style="margin-top: 110px;"></div>
    <div class="container">
        <div class="row">
            @include('usuario.sidebar.perfilUsuario')

            <div class="col-md-9">   
                @include ('loyoutPost')
            </div>
        </div>
    </div>
@endsection

