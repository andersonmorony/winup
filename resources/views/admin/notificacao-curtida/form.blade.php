<div class="form-group {{ $errors->has('curtida_id') ? 'has-error' : ''}}">
    <label for="curtida_id" class="col-md-4 control-label">{{ 'Curtida Id' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="curtida_id" type="number" id="curtida_id" value="{{ $notificacaocurtida->curtida_id or ''}}" required>
        {!! $errors->first('curtida_id', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('notificacao_visualizada') ? 'has-error' : ''}}">
    <label for="notificacao_visualizada" class="col-md-4 control-label">{{ 'Notificacao Visualizada' }}</label>
    <div class="col-md-6">
        <div class="radio">
    <label><input name="{{ notificacao_visualizada }}" type="radio" value="1" {{ (isset($notificacaocurtida) && 1 == $notificacaocurtida->notificacao_visualizada) ? 'checked' : '' }}> Yes</label>
</div>
<div class="radio">
    <label><input name="{{ notificacao_visualizada }}" type="radio" value="0" @if (isset($notificacaocurtida)) {{ (0 == $notificacaocurtida->notificacao_visualizada) ? 'checked' : '' }} @else {{ 'checked' }} @endif> No</label>
</div>
        {!! $errors->first('notificacao_visualizada', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText or 'Cadastrar' }}">
    </div>
</div>
