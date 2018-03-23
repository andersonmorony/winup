
$(document).ready( function () {
        $('#myTable').DataTable( {
        "lengthMenu": [[10, 25, 50, 100, 1000, -1], [10, 25, 50, 100, 1000, "Todas"]],
        "language": {
            "lengthMenu": "_MENU_ Quantidade",
            "zeroRecords": "Nenhum registro encontrado",
            "info": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
            "infoEmpty": "Nenhum registo disponível",
            "infoFiltered": "(Filtrados de _MAX_ registros)",
            "search": "Pesquisar",
            "paginate": {
                "next": "Próximo",
                "previous": "Anterior",
                "first": "Primeiro",
                "last": "Último"
            }
        }
    });
});