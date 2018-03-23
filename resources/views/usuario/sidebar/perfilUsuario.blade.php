<div class="col-md-3">
    <div class="panel panel-default panel-border">
        <div class="panel-heading center">
            Atalho
        </div>

        <div class="panel-body">
            <ul class="nav" role="tablist">
                <li role="presentation">
                    <a href="{{ url('/meu-perfil') }}">
                        <img src="https://png.icons8.com/color/30/000000/circled-user-male-skin-type-4.png"> Meu Perfil
                    </a>
                </li> 
                <li role="presentation">
                    <a href="{{ url('/editar/meu-perfil') }}">
                        <img src="https://png.icons8.com/color/30/000000/edit.png"> Alterar dados
                    </a>
                </li>                
                <li role="presentation">
                    <a href="{{ url('editar/minha-senha') }}">
                        <img src="https://png.icons8.com/color/30/000000/lock.png"> Mudar senha
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
