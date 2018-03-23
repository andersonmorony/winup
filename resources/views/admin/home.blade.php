@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="btn-group btn-group-justified" role="group" aria-label="...">
                      <div class="btn-group" role="group">
                        <a href="{{ url('/admin/user/dados-user') }}" type="button" class="btn btn-default"><img src="https://png.icons8.com/color/50/000000/circled-user-male-skin-type-4.png"></a>
                      </div>
                      <div class="btn-group" role="group">
                        <button type="button" class="btn btn-default"><img src="https://png.icons8.com/color/50/000000/activity-feed.png"></button>
                      </div>
                      <div class="btn-group" role="group">
                        <button type="button" class="btn btn-default"><img src="https://png.icons8.com/color/50/000000/thumb-up.png"></button>
                      </div>
                </div>
            </div>
        </div>
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
