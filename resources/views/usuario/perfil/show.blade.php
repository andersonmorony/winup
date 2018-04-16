@extends('layouts.app')

@section('content')

            <div class="container" style="height: 150px !important;">
                    <div class="fb-profile" style="height: 150px">
                        <div class="cover">                            
                            <img align="left" class="fb-image-lg img-responsive" src="http://www.arabianbusiness.com/sites/default/files/styles/full_img/public/images/2017/01/17/img+worlds+of+adventure+exterior+full+park+image.jpg" alt="Profile image example"/>
                        </div>
                        <img align="left" class="fb-image-profile thumbnail img-responsive" src="/images/{{$dadosuser->foto_perfil}}" alt="Profile image example"/>
                        <div class="fb-profile-text">
                            <h1>{{Auth::user()->name}}</h1>
                        </div>
                    </div>
                </div>
                <div class="col-md-12" style="margin-top: 20px;"></div>
    <div class="container">
        <div class="row">
            @include('usuario.sidebar.perfilUsuario')

            <div class="col-md-9">   
                @include ('loyoutPost')
            </div>
        </div>
    </div>
@endsection

