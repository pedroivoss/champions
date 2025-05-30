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
                                        <th>Nome</th>
                                        <th>CPF</th>
                                        <th>Placar</th>
                                        <th>1º Gol</th>
                                        <th>1º Cartão</th>
                                        <th>Data</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- Loop para exibir as últimas 5 apostas --}}
                                    @foreach ($apostas as $a)
                                        <tr>
                                            <td>{{ $a->nome }}</td>
                                            <td>{{ $a->cpf }}</td>
                                            <td>PSG {{ $a->timeA }} x {{ $a->timeB }} Inter </td>
                                            <td>{{ $a->pri_gol }}</td>
                                            <td>{{ $a->pri_cartao }}</td>
                                            <td>{{ $a->created_at->format('d/m/Y H:i') }}</td>
                                            <td>
                                                <button class="btn btn-custom-secondary btn-sm" data-toggle="modal" data-target="#apostaDetailsModal"
                                                        data-id="{{ $a->id }}"
                                                        {{--data-nome="{{ $a->nome }}"
                                                        data-cpf="{{ $a->cpf }}"
                                                        data-placar="{{ $a->placar }}"
                                                        data-pri_gol="{{ $a->pri_gol }}"
                                                        data-pri_cartao="{{ $a->pri_cartao }}"
                                                        data-data="{{ $a->created_at->format('d/m/Y H:i') }}"--}}>
                                                    Ver Detalhes
                                                </button>
                                            </td>
                                        </tr>

                                    @endforeach

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Nome</th>
                                        <th>CPF</th>
                                        <th>Placar</th>
                                        <th>1º Gol</th>
                                        <th>1º Cartão</th>
                                        <th>Data</th>
                                        <th></th> {{-- Coluna de ações não precisa de busca --}}
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
                <div class="modal-header">
                    <h5 class="modal-title text-dark" id="apostaDetailsModalLabel">Detalhes da Aposta</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-dark">
                    <p><strong>Nome:</strong> <span id="modal-nome"></span></p>
                    <p><strong>CPF:</strong> <span id="modal-cpf"></span></p>
                    <p><strong>Placar:</strong> <span id="modal-placar"></span></p>
                    <p><strong>Primeiro Gol:</strong> <span id="modal-pri_gol"></span></p>
                    <p><strong>Primeiro Cartão:</strong> <span id="modal-pri_cartao"></span></p>
                    <p><strong>Data da Aposta:</strong> <span id="modal-data"></span></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>


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
                        if (column.index() < 6) { // Aplica a pesquisa apenas nas primeiras 6 colunas
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

            // Lidar com o clique no botão "Ver Detalhes" para popular o modal
            $('#apostasTable').on('click', '.view-details', function() {
                var nome = $(this).data('nome');
                var cpf = $(this).data('cpf');
                var placar = $(this).data('placar');
                var pri_gol = $(this).data('pri_gol');
                var pri_cartao = $(this).data('pri_cartao');
                var data = $(this).data('data');

                $('#modal-nome').text(nome);
                $('#modal-cpf').text(cpf);
                $('#modal-placar').text(placar);
                $('#modal-pri_gol').text(pri_gol);
                $('#modal-pri_cartao').text(pri_cartao);
                $('#modal-data').text(data);
            });
        });
    </script>
</body>
</html>
