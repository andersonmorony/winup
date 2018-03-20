<div class="form-group {{ $errors->has('datanascimento') ? 'has-error' : ''}}">
    <label for="datanascimento" class="col-md-4 control-label">{{ 'Data Nascimento' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="datanascimento" type="date" id="datanascimento" value="{{ $dadosuser->datanascimento or ''}}" required>
        {!! $errors->first('datanascimento', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('sexo') ? 'has-error' : ''}}">
    <label for="sexo" class="col-md-4 control-label">{{ 'Sexo' }}</label>
    <div class="col-md-6">
        <select name="sexo" class="form-control" id="sexo" required>
    @foreach (json_decode('{"0":"Masculino","1":"Feminino"}', true) as $optionKey => $optionValue)
        <option value="{{ $optionKey }}" {{ (isset($dadosuser->sexo) && $dadosuser->sexo == $optionKey) ? 'selected' : ''}}>{{ $optionValue }}</option>
    @endforeach
</select>
        {!! $errors->first('sexo', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('telefone') ? 'has-error' : ''}}">
    <label for="telefone" class="col-md-4 control-label">{{ 'Telefone/Celular' }}</label>
    <div class="col-md-6">
        <input class="form-control" type="text" name="telefone" id="telefone" required="" placeholder="(XX) XXXX-XXXX">
            {{ $dadosuser->telefone or ''}}</textarea>
        {!! $errors->first('telefone', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<input type="hidden" name="user_id" value="{{ $user->id or '' }}">


<!-- <div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText or 'Finalizar' }}">
    </div>
</div> -->
