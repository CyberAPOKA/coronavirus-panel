<body style="background-color: #f3f5fa">
    <div class="col-8 mx-auto">
        <div class="card-deck" style="margin-top: 50px" style="margin:auto">
            <div class="card text-center shadow p-3 mb-5 bg-white rounded" style="width:280px">
                <img class="card-img-top" src="{{ asset('assets/img/cadastro.png') }}" alt="">
                <div class="card-body">
                    {{-- <h4 class="card-title">Home</h4>
                    <p class="card-text"></p> --}}
                    <a href="{{route('casos.cadastro')}}" type="button" class="btn btn-outline-primary  stretched-link">Cadastro</a>
                </div>
            </div>
            <div class="card text-center shadow p-3 mb-5 bg-white rounded" style="width:280px">
                <img class="card-img-top" src="{{ asset('assets/img/lupa.png') }}" alt="">
                <div class="card-body">
                    {{-- <h4 class="card-title">Home</h4>
                    <p class="card-text"></p> --}}
                    <a href="{{route('casos.lista')}}" type="button" class="btn btn-outline-primary  stretched-link">Listagem</a>
                </div>
            </div>
            <div class="card text-center shadow p-3 mb-5 bg-white rounded" style="width:280px">
                <img class="card-img-top" src="{{ asset('assets/img/auditor.png') }}" alt="">
                <div class="card-body">
                    {{-- <h4 class="card-title">Home</h4>
                    <p class="card-text"></p> --}}
                    <a href="{{route('casos.audit')}}" type="button" class="btn btn-outline-primary  stretched-link">Auditoria</a>
                </div>
            </div>
        </div>
        </div>
</body>

