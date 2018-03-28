<div class="form-group {{ $errors->has('titulo') ? 'has-error' : ''}}">
    <label for="titulo" class="col-md-4 control-label">{{ 'Titulo' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="titulo" type="text" id="titulo" value="{{ $tiponotificacao->titulo or ''}}" required>
        {!! $errors->first('titulo', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText or 'Cadastrar' }}">
    </div>
</div>
