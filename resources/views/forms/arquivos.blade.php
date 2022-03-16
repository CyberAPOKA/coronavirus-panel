<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Upload de arquivos</div>

                <div class="card-body">
                    <form action="/arquivos-upload" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="upload" class="col-md-2 col-form-label text-md-right">Arquivo</label>
                            <input type="file" name="file" accept="application/pdf">
                        </div>

                        <div class="row justify-content-center">
                            <div class="col-md-8 ">
                                <button type="submit" class="btn btn-primary">
                                    Enviar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

</body>



