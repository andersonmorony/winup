<div class="form-group {{ $errors->has('user_id') ? 'has-error' : ''}}">
    <label for="user_id" class="col-md-4 control-label">{{ 'User Id' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="user_id" type="number" id="user_id" value="{{ $curtir->user_id or ''}}" >
        {!! $errors->first('user_id', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('post_id') ? 'has-error' : ''}}">
    <label for="post_id" class="col-md-4 control-label">{{ 'Post Id' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="post_id" type="number" id="post_id" value="{{ $curtir->post_id or ''}}" >
        {!! $errors->first('post_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText or 'Cadastrar' }}">
    </div>
</div>
