<div class="form-group {{ $errors->has('user_id') ? 'has-error' : ''}}">
    <label for="user_id" class="col-md-4 control-label">{{ 'User Id' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="user_id" type="number" id="user_id" value="{{ $comentario->user_id or ''}}" >
        {!! $errors->first('user_id', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('post_id') ? 'has-error' : ''}}">
    <label for="post_id" class="col-md-4 control-label">{{ 'Post Id' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="post_id" type="number" id="post_id" value="{{ $comentario->post_id or ''}}" >
        {!! $errors->first('post_id', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('comentario') ? 'has-error' : ''}}">
    <label for="comentario" class="col-md-4 control-label">{{ 'Comentario' }}</label>
    <div class="col-md-6">
        <textarea class="form-control" rows="5" name="comentario" type="textarea" id="comentario" >{{ $comentario->comentario or ''}}</textarea>
        {!! $errors->first('comentario', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('imagemPost') ? 'has-error' : ''}}">
    <label for="imagemPost" class="col-md-4 control-label">{{ 'Imagempost' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="imagemPost" type="text" id="imagemPost" value="{{ $comentario->imagemPost or ''}}" >
        {!! $errors->first('imagemPost', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText or 'Cadastrar' }}">
    </div>
</div>
