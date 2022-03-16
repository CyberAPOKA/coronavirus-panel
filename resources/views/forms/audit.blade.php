<script type="text/javascript">
$(document).ready(function() {
    $('#tabelaAuditoria').DataTable({
            select: false,
            responsive: false,
            "order": [
                [0, "asc"]
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
                <h5 class="col-12 modal-title text-center">Consulta de auditoria</h5>
             </div>
             <div class="card-body">
    <div class="table"style="margin-top:0;" >
        <table class="table table-striped dataTable" style="width: 100%;margin-top:0;" id="tabelaAuditoria">
            <thead align="center">
                <tr>
                <th>Responsável</th>
                    <th>Data/Hora</th>
                    
                    <th>Evento</th>
                    <th>IP</th>
                    <th>URL</th>
                </tr>
            </thead>
            <tbody align="center">
                @foreach ($audits as $auditoria  )
                <tr>
                <td>{{ $auditoria->user_name }}</td>
                    <td data-sort="{{ $auditoria->created_at }}">{{ $auditoria->created_at->format('d/m/Y H:i') }}</td>
                    <td>{{ $auditoria->event }}</td>
                    <td>{{ $auditoria->ip_address }}</td>
                    <td>{{ $auditoria->url }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    </div>
    </div>
</body>

