<div class="form-group {{ $errors->has('post') ? 'has-error' : ''}}">
    <label for="post" class="col-md-4 control-label">{{ 'Post' }}</label>
    <div class="col-md-6">
        <textarea class="form-control" rows="5" name="post" type="textarea" id="post" required>{{ $post->post or ''}}</textarea>
        {!! $errors->first('post', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('imagem') ? 'has-error' : ''}}">
    <label for="imagem" class="col-md-4 control-label">{{ 'Imagem' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="imagem" type="text" id="imagem" value="{{ $post->imagem or ''}}" required>
        {!! $errors->first('imagem', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('video') ? 'has-error' : ''}}">
    <label for="video" class="col-md-4 control-label">{{ 'Video' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="video" type="text" id="video" value="{{ $post->video or ''}}" required>
        {!! $errors->first('video', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('user_id') ? 'has-error' : ''}}">
    <label for="user_id" class="col-md-4 control-label">{{ 'User Id' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="user_id" type="number" id="user_id" value="{{ $post->user_id or ''}}" required>
        {!! $errors->first('user_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText or 'Cadastrar' }}">
    </div>
</div>
