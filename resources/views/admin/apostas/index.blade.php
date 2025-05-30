<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}"> {{-- Importante para requisições AJAX --}}
    <title>Painel Administrativo - Bolão</title>
    <link rel="icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon">


    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

    <link href="//cdn.datatables.net/2.3.1/css/dataTables.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/3.0.0/css/responsive.dataTables.min.css" rel="stylesheet">
    {{-- <link rel="stylesheet" href="{{ asset('css/style.css') }}"> --}}
    {{-- <link rel="stylesheet" href="{{ asset('css/custom-select2.css') }}"> --}}

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #1a1740; /* Cor de fundo escura do tema */
            color: #fff; /* Cor do texto principal */
            min-height: 100vh; /* Garante que o body ocupa a altura total da viewport */
            display: flex;
            flex-direction: column; /* Para footer fixo, se for usar */
        }
        .navbar {
            background-color: #f7d002; /* Cor de destaque para a navbar */
            padding: 1rem 1.5rem;
        }
        .navbar-brand, .navbar-nav .nav-link {
            color: #1a1740 !important; /* Cor do texto da navbar */
            font-weight: 600;
        }
        .navbar-brand:hover, .navbar-nav .nav-link:hover {
            color: #4a4473 !important; /* Um tom mais escuro no hover */
        }
        .container-fluid {
            flex: 1; /* Faz o container crescer para preencher o espaço disponível */
            padding-top: 30px;
            padding-bottom: 30px;
        }
        .card-custom {
            background-color: #2b2752; /* Um tom um pouco mais claro que o fundo para os cards */
            border: 1px solid #4a4473; /* Borda sutil */
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
            margin-bottom: 30px;
        }
        .card-header-custom {
            background-color: #f7d002; /* Cor de destaque para o cabeçalho do card */
            color: #1a1740;
            font-weight: 700;
            border-bottom: 1px solid #f7d002;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            padding: 15px 20px;
        }
        .table-custom {
            color: #fff; /* Cor do texto da tabela */
            background-color: #3a3560; /* Fundo das linhas da tabela */
        }
        .table-custom thead th {
            background-color: #4a4473; /* Fundo do cabeçalho da tabela */
            color: #f7d002; /* Cor do texto do cabeçalho */
            border-color: #5d5781;
        }
        .table-custom tbody tr:nth-of-type(odd) {
            background-color: #35305c; /* Fundo para linhas ímpares (zebra-striping) */
        }
        .table-custom tbody tr:hover {
            background-color: #5d5781; /* Fundo no hover */
        }
        .table-custom td, .table-custom th {
            border-color: #4a4473; /* Cor das bordas das células */
        }
        .btn-custom-primary {
            background-color: #f7d002;
            color: #1a1740;
            border-color: #f7d002;
            font-weight: bold;
        }
        .btn-custom-primary:hover {
            background-color: #ffd700;
            border-color: #ffd700;
            color: #1a1740;
        }
        .btn-custom-secondary {
            background-color: #4a4473;
            color: #fff;
            border-color: #4a4473;
        }
        .btn-custom-secondary:hover {
            background-color: #5d5781;
            border-color: #5d5781;
        }
        .footer {
            background-color: #15123a; /* Fundo do rodapé */
            color: #aaa;
            padding: 20px 0;
            text-align: center;
            font-size: 0.9em;
        }

        .swal2-container {
            z-index: 20000 !important;
        }

        .swal2-input{
        z-index: 20000 !important;
        }
        .blockUI {
            z-index: 9998 !important;
        }

        .modal {
            z-index: 9996 !important;
            padding-right: 0px !important;
        }

        .modal-open {
            padding-right: 0px !important;
        }

        .blockOverlay {
            z-index: 9997 !important;
        }

        .select2-container .select2-selection--multiple .select2-selection__choice {
            background-color: #5864c2 !important;
            border-color: #5864c2 !important;
            color: #fff !important;
        }

        .spaceMarginTop {
            margin-top: 2ch;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark">
        <a class="navbar-brand" href="">Painel Admin Bolão</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        {{--<div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('home') }}">Dashboard <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.apostas') }}">Gerenciar Apostas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/">Sair (Ir para Página Principal)</a>
                </li>
            </ul>
        </div>--}}
    </nav>

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-md-12">
                <div class="card card-custom">
                    <div class="card-header card-header-custom">
                        <h4 class="mb-0">Informações Rápidas</h4>
                    </div>
                    <div class="card-body">
                        <div class="row text-center mb-4">
                            <div class="col-md-3">
                                <div class="p-3 card-custom">
                                    <h3>{{$apostasTotal}}</h3>
                                    <p class="text-white-50">Total de Apostas</p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="p-3 card-custom">
                                    <h3>R$ {{$valorTotalArrecadado}}</h3>
                                    <p class="text-white-50">Arrecadação</p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="p-3 card-custom">
                                    <h3>{{$qtdApostasUnicas}}</h3>
                                    <p class="text-white-50">Apostadores Únicos</p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="p-3 card-custom">
                                    <h3>{{$qtdApostasMultiplos}}</h3>
                                    <p class="text-white-50">Apostadores Multiplos</p>
                                </div>
                            </div>
                        </div>

                        <h5 class="mb-3 text-white-50">Últimas Apostas Registradas</h5>
                        <div class="table-responsive">
                            <table class="table table-custom table-hover" id="apostasTable">
                                <thead>
                                    <tr>
                                        <th>Placar</th>
                                        <th>1º Gol</th>
                                        <th>1º Cartão</th>
                                        <th>Nome</th>
                                        <th>CPF</th>
                                        <th>Id</th>
                                        <th>Registro</th>
                                        <th>status</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- Loop para exibir as últimas 5 apostas --}}
                                    @foreach ($apostas as $a)
                                        <tr>
                                            <td>PSG {{ $a->timeA }} x {{ $a->timeB }} Inter </td>
                                            <td>{{ $a->pri_gol }}</td>
                                            <td>{{ $a->pri_cartao }}</td>
                                            <td>{{ $a->nome }}</td>
                                            <td>{{ substr($a->cpf, 0, 3) . '.' . substr($a->cpf, 3, 3) . '.' . substr($a->cpf, 6, 3) . '-' . substr($a->cpf, 9, 2) }}</td>
                                            <td>{{ $a->id }}</td>
                                            <td>{{ $a->created_at->format('d/m/Y H:i') }}</td>
                                            <td>
                                                @if(1 == $a->status)
                                                    <span class="badge badge-success">Ativo</span>
                                                @else
                                                    <span class="badge badge-danger">Excluido</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if(1 == $a->status)
                                                <button class="btn btn-success btn-sm btnApostaDetails" value="{{ $a->id }}" tipo="S">
                                                    Ver Detalhes
                                                </button>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Placar</th>
                                        <th>1º Gol</th>
                                        <th>1º Cartão</th>
                                        <th>Nome</th>
                                        <th>CPF</th>
                                        <th>Id</th>
                                        <th>Registro</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="text-center mt-4">
                            <a href="{{ route('admin.apostas') }}" class="btn btn-custom-primary">Recarregar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="footer">
        <p>&copy; {{ date('Y') }} Bolão. Todos os direitos reservados.</p>
    </footer>

    <div class="modal fade" id="apostaDetailsModal" tabindex="-1" role="dialog" aria-labelledby="apostaDetailsModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div id="htmlModalContent"></div>
            </div>
        </div>
    </div>

    <script>
        const base_URL = "{{ env('APP_URL') }}";
        const csrf_token = "{{ csrf_token() }}";
    </script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="{{ asset('js/plugins/jquery-3.7.1.min.js') }}"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="//cdn.datatables.net/2.3.1/js/dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/3.0.0/js/dataTables.responsive.min.js"></script>
    <script src="{{ asset('js/plugins/select2.min.js') }}"></script>
    <script src="{{ asset('js/plugins/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('js/plugins/blockUI.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>
    {{-- SweetAlert2 (se estiver usando) --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}

    <script>
        $(document).ready(function() {
            @include("helpers.js.abreModal",[
                    "tipo" =>"editar",
                    "nome_editar"=> "btnApostaDetails",
                    "rota_name"=> "get.modal.manager.aposta",
                    "html"=> "htmlModalContent",
                    "modal"=> "apostaDetailsModal"
            ]){{-- abre modalAddEditPaymentDate --}}

            // Inicializa o DataTables
            var table = $('#apostasTable').DataTable({
                responsive: true, // Habilita a responsividade
                 language: {
                    url: '//cdn.datatables.net/plug-ins/2.0.8/i18n/pt-BR.json' // Caminho para o arquivo de tradução em português
                },
                initComplete: function () {
                    // Adiciona inputs de pesquisa ao rodapé para cada coluna
                    this.api().columns().every(function () {
                        var column = this;
                        if (column.index() < 8) { // Aplica a pesquisa apenas nas primeiras 6 colunas
                            var input = $('<input type="text" placeholder="Pesquisar..." />')
                                .appendTo($(column.footer()).empty())
                                .on('keyup change clear', function () {
                                    if (column.search() !== this.value) {
                                        column.search(this.value).draw();
                                    }
                                });
                        } else {
                            // Deixa a coluna de "Ações" vazia no rodapé
                            $(column.footer()).empty();
                        }
                    });
                }
            });
        });

        $(document).on('click', '#btnSalvarAposta', function() {
                bloquear()

                let id = $(this).val();
                let timeA = document.querySelector("#modal-timeA").value;
                let timeB = document.querySelector("#modal-timeB").value;
                let pri_gol = document.querySelector("#modal-pri_gol").value;
                let pri_cartao = document.querySelector("#modal-pri_cartao").value;

                if(0 == id || null == id || '' == id || isNaN(id)){
                    desbloquear();
                    Swal.fire({
                        title: 'Erro',
                        text: 'ID da aposta não encontrado!',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                    return;
                }

                if(null === timeA || '' === timeA || isNaN(timeA)){
                    desbloquear();
                    Swal.fire({
                        title: 'Erro',
                        text: 'Placar do PSG não pode ser vazio ou inválido!',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                    return;
                }

                if(null === timeB || '' === timeB || isNaN(timeB)){
                    desbloquear();
                    Swal.fire({
                        title: 'Erro',
                        text: 'Placar do Inter não pode ser vazio ou inválido!',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                    return;
                }

                desbloquear()

                $("#apostaDetailsModal").modal("hide");


                Swal.fire({
                    title: 'Tem certeza?',
                    text: 'Você realmente deseja alterar esta aposta?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc3545', // Cor de perigo (vermelho)
                    cancelButtonColor: '#4a4473', // Cor do seu tema
                    confirmButtonText: 'Sim, alterar!',
                    cancelButtonText: 'Cancelar',
                    input: 'text', // Adiciona um campo de input
                    inputPlaceholder: 'Digite a senha!',
                    inputValidator: (value) => {
                        if (value !== 'bazu') {
                            return 'errou a senha!';
                        }
                    }
                }).then((result) => {
                    if (result.isConfirmed) {

                        bloquear()

                        let formData = new FormData()

                        formData.append('id', id)
                        formData.append('timeA', timeA)
                        formData.append('timeB', timeB)
                        formData.append('pri_gol', pri_gol)
                        formData.append('pri_cartao', pri_cartao)

                        formData.append("_token","{{ csrf_token() }}")

                        fetch(`{{ route('update.aposta')}}`, {
                                method: 'POST',
                                body: formData,
                        }).then(function(response) {
                            response.json().then(function(data) {
                                if(true == data.success){
                                    desbloquear()
                                    Swal.fire({
                                        title: 'Success!',
                                        text: data.message,
                                        icon: 'success',
                                        confirmButtonColor: '#3085d6',
                                        confirmButtonText: 'Ok'
                                    }).then(function () {
                                        bloquear()
                                        window.location.reload();
                                    })
                                }else{
                                    desbloquear()
                                    Swal.fire(
                                        'Warning!',
                                        data.message,
                                        'warning'
                                    )
                                    $("#apostaDetailsModal").modal('show')
                                }
                            })//fim response
                        }).catch(function(err) {
                            desbloquear()
                            Swal.fire('Erro!',err,'error')
                            $("#apostaDetailsModal").modal("show");

                        })//fim fetch

                    }else{
                        $("#apostaDetailsModal").modal("show");
                    }
                });

        });

        $(document).on('click', '#btnDeleteAposta', function() {

            $("#apostaDetailsModal").modal("hide");
            let id = $(this).data('id');

            Swal.fire({
                title: 'Tem certeza?',
                text: 'Você realmente deseja apagar esta aposta? Esta ação é irreversível!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545', // Cor de perigo (vermelho)
                cancelButtonColor: '#4a4473', // Cor do seu tema
                confirmButtonText: 'Sim, apagar!',
                cancelButtonText: 'Cancelar',
                input: 'text', // Adiciona um campo de input
                inputPlaceholder: 'Digite a senha!',
                inputValidator: (value) => {
                    if (value !== 'bazu') {
                        return 'errou a senha!';
                    }
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    let formData = new FormData()

                    formData.append('id', id)
                    formData.append("_token","{{ csrf_token() }}")

                    fetch(`{{ route('delete.aposta')}}`, {
                            method: 'POST',
                            body: formData,
                    }).then(function(response) {
                        response.json().then(function(data) {
                            if(true == data.success){
                                desbloquear()
                                Swal.fire({
                                    title: 'Success!',
                                    text: data.message,
                                    icon: 'success',
                                    confirmButtonColor: '#3085d6',
                                    confirmButtonText: 'Ok'
                                }).then(function () {
                                    window.location.reload();
                                })
                            }else{
                                desbloquear()
                                Swal.fire(
                                    'Warning!',
                                    data.message,
                                    'warning'
                                )
                                $("#apostaDetailsModal").modal('show')
                            }
                        })//fim response
                    }).catch(function(err) {
                            desbloquear()
                            Swal.fire('Erro!',err,'error')
                    })//fim fetch
                }else{
                    $("#apostaDetailsModal").modal("show");
                }
            });
        });

    </script>
</body>
</html>
