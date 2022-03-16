<script type="text/javascript">
$(document).ready(function() {
    $('#tabelaLista').DataTable({
            select: false,
            responsive: false,
            "order": [
                [0, "desc"]
            ],
            "lengthMenu": [10],
            "info": false,
            "sLengthMenu": false,
            "bLengthChange": false,
            "oLanguage": {

                "sEmptyTable": "Nenhum registro encontrado",
                "sInfo": "Mostrando de START até END de TOTAL registros",
                "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
                "sInfoFiltered": "(Filtrados de MAX registros)",
                "sInfoPostFix": "",
                "sInfoThousands": ".",
                "sLengthMenu": "MENU resultados por página",
                "sLoadingRecords": "Carregando...",
                "sProcessing": "Processando...",
                "sZeroRecords": "Nenhum registro encontrado",
                "sSearch": "Pesquisar",
                "oPaginate": {
                    "sNext": "Próximo",
                    "sPrevious": "Anterior",
                    "sFirst": "Primeiro",
                    "sLast": "Último"
                },
                "oAria": {
                    "sSortAscending": ": Ordenar colunas de forma ascendente",
                    "sSortDescending": ": Ordenar colunas de forma descendente"
                }
            }
        });
});

</script>

<body>
    <div class="card">
            <div class="card-header">
                <h5 class="col-12 modal-title text-center">Consulta de registro de casos</h5>
             </div>
             <div class="card-body">
    <div class="table"style="margin-top:0;" >
        <table class="table table-striped dataTable" style="width: 100%;margin-top:0;" id="tabelaLista">
            <thead align="center">
                <tr>
                    <th>Data</th>
                    <th>Casos</th>
                    <th>Recuperados</th>
                    <th>Óbitos</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody align="center">
                @foreach ($casoscadastrados as $casos )
                <tr>
                    <td data-sort="{{ $casos->dia }}">{{ $casos->dia->format('d/m/Y') }}</td>
                    <td>{{ $casos->casos }}</td>
                    <td>{{ $casos->recuperados }}</td>
                    <td>{{ $casos->obitos }}</td>
                    <td>
                        <a href="{{route('casos.editcasos',$casos->id)}}" type="button"
                            class="btn btn-primary">Editar</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    </div>
    </div>
</body>
