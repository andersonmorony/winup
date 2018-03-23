<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name" class="col-md-4 control-label">{{ 'Nome' }}</label>
    <div class="col-md-6">
        <input class="form-control" type="text" name="name" value="{{ $dadosuser->name or ''}}" id="name" required="" placeholder="Nome">        
            {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
    <label for="email" class="col-md-4 control-label">{{ 'Email' }}</label>
    <div class="col-md-6">
        <input class="form-control" type="text" name="email" value="{{ $dadosuser->email or ''}}" id="email" required="" placeholder="Email">        
            {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
    </div>
</div>