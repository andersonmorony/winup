<div class="form-group {{ $errors->has('cep') ? 'has-error' : ''}}">
    <div class="col-md-6">
        <label for="cep" class="control-label">{{ 'Cep' }}</label>
        <input class="form-control" name="cep" type="text" id="cep" value="{{ $enderecouser->cep or ''}}" placeholder="Digite o CEP" >
        {!! $errors->first('cep', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="col-md-4">
        <label for="rua" class="control-label">{{ 'Rua' }}</label>
        <input class="form-control" name="rua" type="text" id="rua" value="{{ $enderecouser->rua or ''}}" required placeholder="Digite seu endereço">
        {!! $errors->first('rua', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="col-md-2">
        <label for="numero" class="control-label">{{ 'Numero' }}</label>
        <input class="form-control" name="numero" type="text" id="numero" value="{{ $enderecouser->numero or ''}}" required placeholder="00">
        {!! $errors->first('numero', '<p class="help-block">:message</p>') !!}
    </div>    
    <div class="col-md-3">
        <label for="complemento" class="control-label">{{ 'Complemento' }}</label>
        <input class="form-control" name="complemento" type="text" id="complemento" value="{{ $enderecouser->complemento or ''}}" >
        {!! $errors->first('complemento', '<p class="help-block">:message</p>') !!}
    </div>    
    <div class="col-md-3">
        <label for="bairro" class="control-label">{{ 'Bairro' }}</label>
        <input class="form-control" name="bairro" type="text" id="bairro" value="{{ $enderecouser->bairro or ''}}" required placeholder="Digite seu bairro">
        {!! $errors->first('bairro', '<p class="help-block">:message</p>') !!}
    </div>
    
    <div class="col-md-3">
        <label for="cidade" class="control-label">{{ 'Cidade' }}</label>
        <input class="form-control" name="cidade" type="text" id="cidade" value="{{ $enderecouser->cidade or ''}}" placeholder="Digite sua cidade" required>
        {!! $errors->first('cidade', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="col-md-3">
        <label for="uf" class="control-label">{{ 'Uf' }}</label>
        <select name="uf" class="form-control" id="uf" required>
    @foreach (json_decode('["AC","AL","AM","AP","BA","CE","DF","ES","GO","MA","MG","MS","MT","PA","PB","PE","PI","PR","RJ","RN","RO","RR","RS","SC","SE","SP","TO"]', true) as $optionKey => $optionValue)
        <option value="{{ $optionKey }}" {{ (isset($enderecouser->uf) && $enderecouser->uf == $optionKey) ? 'selected' : ''}}>{{ $optionValue }}</option>
    @endforeach
</select>
        {!! $errors->first('uf', '<p class="help-block">:message</p>') !!}
    </div>
</div>


