<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Champions League 2025 Final - Bolão!</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.22.0/dist/sweetalert2.min.css" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/custom-select2.css') }}">
</head>
<body>
    <div class="background-overlay"></div>

    <header>
        <div class="container">
            <img src="{{asset('images/ucl_final_munich.png')}}" alt="UEFA Champions League 2025 Final Munique" class="header-banner">
            <h1>Bolão da Final da UEFA Champions League 2025</h1>
            </div>
    </header>

    <main class="container">
        <section id="betting-form">
            <h2>Faça Suas Apostas</h2>
            <form id="betForm" action="{{ url('/submit_bet') }}" method="POST">
                @csrf <div class="form-group">
                    <label for="playerName">Nome:</label>
                    <input type="text" id="playerName" name="playerName" placeholder="Nome" required>
                </div>
                <div class="form-group">
                    <label for="playerCPF">CPF:</label>
                    <input type="text" id="playerCPF" name="playerCPF" pattern="\d{3}\.\d{3}\.\d{3}-\d{2}" placeholder="Ex: 123.456.789-00" required>
                </div>

                <h3>Placar: (R$ 15,00)</h3>
                <div class="score-input-container">
                    <div class="team-score-input">
                        <img src="{{asset('images/logos/psg.png')}}" alt="Logo PSG" class="team-logo-small">
                        <input type="number" id="scoreTeam1" name="scoreTeam1" min="0" required>
                    </div>
                    <span class="score-separator">X</span>
                    <div class="team-score-input">
                        <input type="number" id="scoreTeam2" name="scoreTeam2" min="0" required>
                        <img src="{{asset('images/logos/Internazionale_Milano.png')}}" alt="Logo Inter Milan" class="team-logo-small">
                    </div>
                </div>

                <div class="form-group">
                    <label for="firstGoalScorer">Quem faz o primeiro gol: (opcional R$ 10,00)</label>
                    <select id="firstGoalScorer" name="firstGoalScorer" class="select2-enable">
                        <option value="">Selecione o Jogador</option>
                        <optgroup label="Inter de Milão">
                            <option value="Inter - Yann Sommer">Yann Sommer</option>
                            <option value="Inter - Raffaele Di Gennaro">Raffaele Di Gennaro</option>
                            <option value="Inter - Josep Martínez">Josep Martínez</option>
                            <option value="Inter - Denzel Dumfries">Denzel Dumfries</option>
                            <option value="Inter - Stefan De Vrij">Stefan De Vrij</option>
                            <option value="Inter - Francesco Acerbi">Francesco Acerbi</option>
                            <option value="Inter - Benjamin Pavard">Benjamin Pavard</option>
                            <option value="Inter - Carlos Augusto">Carlos Augusto</option>
                            <option value="Inter - Yann Bisseck">Yann Bisseck</option>
                            <option value="Inter - Federico Dimarco">Federico Dimarco</option>
                            <option value="Inter - Matteo Darmian">Matteo Darmian</option>
                            <option value="Inter - Gabriele Re Cecconi">Gabriele Re Cecconi</option>
                            <option value="Inter - Alessandro Bastoni">Alessandro Bastoni</option>
                            <option value="Inter - Piotr Zieliński">Piotr Zieliński</option>
                            <option value="Inter - Davide Frattesi">Davide Frattesi</option>
                            <option value="Inter - Hakan Çalhanoğlu">Hakan Çalhanoğlu</option>
                            <option value="Inter - Kristjan Asllani">Kristjan Asllani</option>
                            <option value="Inter - Henrikh Mkhitaryan">Henrikh Mkhitaryan</option>
                            <option value="Inter - Nicolò Barella">Nicolò Barella</option>
                            <option value="Inter - Nicola Zalewski">Nicola Zalewski</option>
                            <option value="Inter - Marko Arnautović">Marko Arnautović</option>
                            <option value="Inter - Marcus Thuram">Marcus Thuram</option>
                            <option value="Inter - Lautaro Martínez">Lautaro Martínez</option>
                            <option value="Inter - Mehdi Taremi">Mehdi Taremi</option>
                        </optgroup>
                        <optgroup label="Paris Saint-Germain">
                            <option value="PSG - Gianluigi Donnarumma">Gianluigi Donnarumma</option>
                            <option value="PSG - Matvey Safonov">Matvey Safonov</option>
                            <option value="PSG - Arnau Tenas">Arnau Tenas</option>
                            <option value="PSG - Achraf Hakimi">Achraf Hakimi</option>
                            <option value="PSG - Presnel Kimpembe">Presnel Kimpembe</option>
                            <option value="PSG - Marquinhos">Marquinhos</option>
                            <option value="PSG - Lucas Hernandez">Lucas Hernandez</option>
                            <option value="PSG - Nuno Mendes">Nuno Mendes</option>
                            <option value="PSG - Lucas Beraldo">Lucas Beraldo</option>
                            <option value="PSG - Yoram Zague">Yoram Zague</option>
                            <option value="PSG - Naoufel El Hannach">Naoufel El Hannach</option>
                            <option value="PSG - Willian Pacho">Willian Pacho</option>
                            <option value="PSG - Fabian Ruiz">Fabian Ruiz</option>
                            <option value="PSG - Vitinha">Vitinha</option>
                            <option value="PSG - Lee Kang-in">Lee Kang-in</option>
                            <option value="PSG - Senny Mayulu">Senny Mayulu</option>
                            <option value="PSG - Warren Zaire-Emery">Warren Zaire-Emery</option>
                            <option value="PSG - João Neves">João Neves</option>
                            <option value="PSG - Khvicha Kvaratskhelia">Khvicha Kvaratskhelia</option>
                            <option value="PSG - Gonçalo Ramos">Gonçalo Ramos</option>
                            <option value="PSG - Ousmane Dembélé">Ousmane Dembélé</option>
                            <option value="PSG - Désiré Doué">Désiré Doué</option>
                            <option value="PSG - Bradley Barcola">Bradley Barcola</option>
                            <option value="PSG - Ibrahim Mbaye">Ibrahim Mbaye</option>
                        </optgroup>
                    </select>
                </div>

                <div class="form-group">
                    <label for="firstCardTeam">Quem leva o primeiro cartão: (opcional R$ 5,00)</label>
                    <select id="firstCardTeam" name="firstCardTeam" class="select2-enable">
                        <option value="">Selecione o Jogador</option>
                        <optgroup label="Inter de Milão">
                            <option value="Inter - Yann Sommer">Yann Sommer</option>
                            <option value="Inter - Raffaele Di Gennaro">Raffaele Di Gennaro</option>
                            <option value="Inter - Josep Martínez">Josep Martínez</option>
                            <option value="Inter - Denzel Dumfries">Denzel Dumfries</option>
                            <option value="Inter - Stefan De Vrij">Stefan De Vrij</option>
                            <option value="Inter - Francesco Acerbi">Francesco Acerbi</option>
                            <option value="Inter - Benjamin Pavard">Benjamin Pavard</option>
                            <option value="Inter - Carlos Augusto">Carlos Augusto</option>
                            <option value="Inter - Yann Bisseck">Yann Bisseck</option>
                            <option value="Inter - Federico Dimarco">Federico Dimarco</option>
                            <option value="Inter - Matteo Darmian">Matteo Darmian</option>
                            <option value="Inter - Gabriele Re Cecconi">Gabriele Re Cecconi</option>
                            <option value="Inter - Alessandro Bastoni">Alessandro Bastoni</option>
                            <option value="Inter - Piotr Zieliński">Piotr Zieliński</option>
                            <option value="Inter - Davide Frattesi">Davide Frattesi</option>
                            <option value="Inter - Hakan Çalhanoğlu">Hakan Çalhanoğlu</option>
                            <option value="Inter - Kristjan Asllani">Kristjan Asllani</option>
                            <option value="Inter - Henrikh Mkhitaryan">Henrikh Mkhitaryan</option>
                            <option value="Inter - Nicolò Barella">Nicolò Barella</option>
                            <option value="Inter - Nicola Zalewski">Nicola Zalewski</option>
                            <option value="Inter - Marko Arnautović">Marko Arnautović</option>
                            <option value="Inter - Marcus Thuram">Marcus Thuram</option>
                            <option value="Inter - Lautaro Martínez">Lautaro Martínez</option>
                            <option value="Inter - Mehdi Taremi">Mehdi Taremi</option>
                        </optgroup>
                        <optgroup label="Paris Saint-Germain">
                            <option value="PSG - Gianluigi Donnarumma">Gianluigi Donnarumma</option>
                            <option value="PSG - Matvey Safonov">Matvey Safonov</option>
                            <option value="PSG - Arnau Tenas">Arnau Tenas</option>
                            <option value="PSG - Achraf Hakimi">Achraf Hakimi</option>
                            <option value="PSG - Presnel Kimpembe">Presnel Kimpembe</option>
                            <option value="PSG - Marquinhos">Marquinhos</option>
                            <option value="PSG - Lucas Hernandez">Lucas Hernandez</option>
                            <option value="PSG - Nuno Mendes">Nuno Mendes</option>
                            <option value="PSG - Lucas Beraldo">Lucas Beraldo</option>
                            <option value="PSG - Yoram Zague">Yoram Zague</option>
                            <option value="PSG - Naoufel El Hannach">Naoufel El Hannach</option>
                            <option value="PSG - Willian Pacho">Willian Pacho</option>
                            <option value="PSG - Fabian Ruiz">Fabian Ruiz</option>
                            <option value="PSG - Vitinha">Vitinha</option>
                            <option value="PSG - Lee Kang-in">Lee Kang-in</option>
                            <option value="PSG - Senny Mayulu">Senny Mayulu</option>
                            <option value="PSG - Warren Zaire-Emery">Warren Zaire-Emery</option>
                            <option value="PSG - João Neves">João Neves</option>
                            <option value="PSG - Khvicha Kvaratskhelia">Khvicha Kvaratskhelia</option>
                            <option value="PSG - Gonçalo Ramos">Gonçalo Ramos</option>
                            <option value="PSG - Ousmane Dembélé">Ousmane Dembélé</option>
                            <option value="PSG - Désiré Doué">Désiré Doué</option>
                            <option value="PSG - Bradley Barcola">Bradley Barcola</option>
                            <option value="PSG - Ibrahim Mbaye">Ibrahim Mbaye</option>
                        </optgroup>
                    </select>
                </div>

                <div class="form-actions">
                    <button type="button" class="btn-secondary" id="rulesButton">Regras</button>
                    <button type="button" class="btn-secondary" id="clearButton">Limpar</button>
                    <button type="submit" class="btn-submit">Enviar</button>
                </div>
            </form>
        </section>

        <section id="leaderboard">
            <h2>Apostas dos Bagres</h2>
            <p>Veja os Bagres que apostaram!</p>
            <table id="betsTable">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Placar</th>
                        <th>1º Cartão</th>
                        <th>1º Gol</th>
                    </tr>
                </thead>
                <tbody>
                    </tbody>
            </table>
        </section>
    </main>

    <footer>
        <div class="container">
            <p>&copy; 2025 Bolão Champions League. Feito para amigos!</p>
        </div>
    </footer>

{{--<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>--}}
    <script src="{{ asset('js/plugins/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('js/plugins/select2.min.js') }}"></script>
    <script src="{{ asset('js/plugins/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('js/plugins/blockUI.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const chave_pix = "{{ env('CHAVE_PIX') }}";
            const betForm = document.getElementById('betForm');
            const betsTableBody = document.querySelector('#betsTable tbody');
            const clearButton = document.getElementById('clearButton');
            const rulesButton = document.getElementById('rulesButton');
            const playerCPFInput = document.getElementById('playerCPF');

            // Inicializa o Select2 para todos os elementos com a classe 'select2-enable'
            $('.select2-enable').select2({
                placeholder: "Digite para buscar o jogador...",
                allowClear: true, // Permite limpar a seleção
                width: '100%' // Garante que o Select2 ocupe 100% da largura do pai
            });

            // Função para formatar o CPF enquanto o usuário digita
            playerCPFInput.addEventListener('input', (e) => {
                let value = e.target.value.replace(/\D/g, ''); // Remove tudo que não é dígito
                if (value.length > 11) {
                    value = value.substring(0, 11);
                }
                if (value.length > 9) {
                    value = value.replace(/^(\d{3})(\d{3})(\d{3})(\d{2})$/, '$1.$2.$3-$4');
                } else if (value.length > 6) {
                    value = value.replace(/^(\d{3})(\d{3})(\d{3})$/, '$1.$2.$3');
                } else if (value.length > 3) {
                    value = value.replace(/^(\d{3})(\d{3})$/, '$1.$2');
                } else if (value.length > 0) {
                    value = value.replace(/^(\d{3})$/, '$1');
                }
                e.target.value = value;
            });

            // Função para carregar apostas existentes
            // Função para carregar apostas existentes
            async function loadBets() {
                const betsTableBody = document.getElementById('betsTable').querySelector('tbody'); // Garante que betsTableBody está definido
                try {
                    const response = await fetch("{{ route('get.bets')}}");
                    const bets = await response.json(); // 'bets' agora será um array de objetos Aposta

                    betsTableBody.innerHTML = ''; // Limpa o corpo da tabela

                    if (bets.length === 0) {
                        const noBetsRow = betsTableBody.insertRow();
                        const cell = noBetsRow.insertCell();
                        cell.colSpan = 4; // Certifique-se de que o colSpan corresponde ao número de colunas do seu thead
                        cell.textContent = 'Nenhuma aposta registrada ainda. Seja o primeiro!';
                        cell.style.textAlign = 'center';
                        cell.style.padding = '20px';
                        cell.style.color = '#aaa';
                    } else {
                        // O erro 'map' ou 'forEach' em undefined será evitado aqui porque bets será sempre um array (mesmo que vazio)
                        bets.forEach(bet => {
                            const row = betsTableBody.insertRow();
                            // Ajuste os nomes das propriedades para corresponder às colunas do seu banco de dados
                            row.insertCell().textContent = bet.nome; // Era bet.playerName
                            row.insertCell().textContent = `PSG ${bet.timeA} x ${bet.timeB} Inter`; // Eram bet.scoreTeam1, bet.scoreTeam2
                            row.insertCell().textContent = bet.pri_cartao; // Era bet.firstCardTeam
                            row.insertCell().textContent = bet.pri_gol; // Era bet.firstGoalScorer
                        });
                    }
                } catch (error) {
                    console.error('Erro ao carregar apostas:', error);
                    const errorRow = betsTableBody.insertRow();
                    const cell = errorRow.insertCell();
                    cell.colSpan = 4; // Ajuste conforme seu thead
                    cell.textContent = 'Erro ao carregar apostas. Tente novamente mais tarde.';
                    cell.style.textAlign = 'center';
                    cell.style.padding = '20px';
                    cell.style.color = 'red';
                }
            }

            // Chame a função para carregar as apostas quando a página carregar
            document.addEventListener('DOMContentLoaded', loadBets);

            // Lida com o envio do formulário
            if (betForm) {
                betForm.addEventListener('submit', async (event) => {
                    event.preventDefault();

                    const formData = new FormData(betForm);
                    const data = Object.fromEntries(formData.entries());

                    // Nova validação de CPF no JS
                    if (!isValidCPF(data.playerCPF)) {
                        Swal.fire({
                            icon: 'error',
                            title: 'CPF Inválido',
                            text: 'Por favor, insira um CPF válido no formato.'
                        });
                        return; // Impede o envio do formulário
                    }

                    if (!data.playerName || !data.playerCPF || data.scoreTeam1 === '' || data.scoreTeam2 === '') {
                            Swal.fire({
                                icon: 'warning',
                                title: 'Campos Obrigatórios',
                                text: 'Por favor, preencha todos os campos obrigatórios da aposta.'
                            });
                        return;
                    }

                    try {
                        const response = await fetch(betForm.action, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            body: JSON.stringify(data)
                        });

                        const result = await response.json();

                        if (result.success) {
                            // Exibe um alerta de sucesso
                             @php
                                $url_image = env('APP_URL'). '/images/figurinhas';
                            @endphp

                            let randonomImage =  randonImage()

                            Swal.fire({
                                icon: 'success',
                                title: 'Aposta Registrada!',
                                html: `<div style="text-align: left;">
                                        <p><strong>Valor Total da Aposta: R$${result.data.valor_aposta}</strong></p>
                                        <p>O pagamento pode ser efetuado via dinheiro em espécie ou via pix.</p>
                                        <p><strong>Chave Pix:</strong> <span id="pixKeySuccessModal">${chave_pix}</span>
                                            <button id="copyPixButtonSuccessModal" style="
                                                background-color: #f7d002; /* Amarelo do tema */
                                                color: #1a1740; /* Azul escuro do tema */
                                                border: none;
                                                border-radius: 5px;
                                                padding: 5px 10px;
                                                margin-left: 10px;
                                                cursor: pointer;
                                                font-weight: bold;
                                                transition: background-color 0.3s ease;
                                            ">Copiar</button>
                                        </p>
                                        </div>`,
                                imageUrl: `{{$url_image}}/${randonomImage}.webp`,
                                imageWidth: 400,
                                imageAlt: 'Imagem de Sucesso',
                                confirmButtonText: 'Entendi',
                                // Adicione a função didOpen para anexar o evento de clique após o modal ser aberto
                                didOpen: () => {
                                    const copyButton = document.getElementById('copyPixButtonSuccessModal');
                                    const pixKeySpan = document.getElementById('pixKeySuccessModal');

                                    copyButton.addEventListener('click', () => {
                                        const pixKey = pixKeySpan.textContent;
                                        navigator.clipboard.writeText(pixKey).then(() => {
                                            copyButton.textContent = 'Copiado!';
                                            setTimeout(() => {
                                                copyButton.textContent = 'Copiar';
                                            }, 2000);
                                        }).catch(err => {
                                            console.error('Erro ao copiar a chave Pix: ', err);
                                            alert('Falha ao copiar a chave Pix. Por favor, copie manualmente.');
                                        });
                                    });
                                }
                            });

                            betForm.reset();
                            $('.select2-enable').val(null).trigger('change'); // Reseta Select2
                            loadBets();
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Erro ao Registrar Aposta',
                                text: result.message
                            });
                        }
                    } catch (error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Erro',
                            text: 'Ocorreu um erro ao enviar sua aposta. Tente novamente.'
                        });
                    }
                });
            }

            // Funcionalidade para o botão Limpar
            if (clearButton) {

                clearButton.addEventListener('click', () => {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Warning',
                        html: `Tem certeza que deseja limpar todos os campos do formulário?`,
                        showDenyButton: true,
                        confirmButtonText: "Sim, Limpa logo!",
                        denyButtonText: `Não, estou muito Louco ja!`
                    }).then((result) => {
                        /* Read more about isConfirmed, isDenied below */
                        if (result.isConfirmed) {
                            betForm.reset();
                            $('.select2-enable').val(null).trigger('change'); // Reseta Select2
                        } else if (result.isDenied) {
                            Swal.fire("Ação Cancelada", "", "info");
                        }
                    });
                });
            }

            // Funcionalidade para o botão Regras
            if (rulesButton) {
                rulesButton.addEventListener('click', () => {
                    @php
                        $url_image = env('APP_URL'). '/images/figurinhas';
                    @endphp

                    let randonomImage =  randonImage()

                    Swal.fire({
                        icon: 'info',
                        title: "Regras do Bolão!",
                        html: `<div style="text-align: left;">
                                <p>As apostas podem ser alteradas no dia do jogo.</p>
                                <p>O placar do jogo é válido para o tempo regular. Não será considerado o tempo extra.</p>
                                <p>O autor do primeiro gol será considerado o jogador que fizer o primeiro gol, seja a favor ou contra.</p>
                                <p>O primeiro jogador a tomar cartão será o primeiro jogador que receber cartão, seja amarelo ou vermelho.</p>
                                <p>Os valores das apostas são:</p>
                                <ul>
                                    <li>Placar do jogo: R$15,00</li>
                                    <li>Autor do primeiro gol: R$10,00</li>
                                    <li>Primeiro jogador a tomar cartão: R$5,00</li>
                                </ul>
                                <p>O pagamento pode ser efetuado no dia do jogo, via dinheiro em espécie ou via pix.</p>

                                <p><strong>Chave Pix:</strong> <span id="pixKey">${chave_pix}</span>
                                    <button id="copyPixButton" style="
                                        background-color: #f7d002; /* Amarelo do tema */
                                        color: #1a1740; /* Azul escuro do tema */
                                        border: none;
                                        border-radius: 5px;
                                        padding: 5px 10px;
                                        margin-left: 10px;
                                        cursor: pointer;
                                        font-weight: bold;
                                        transition: background-color 0.3s ease;
                                    ">Copiar</button>
                                </p>
                                <p>O ganhador receberá o valor no dia do jogo.</p>
                                <p>Caso tenha mais de um ganhador, o valor será dividido igualmente entre os ganhadores.</p>
                                <p>Qualquer contestação deverá ser enviada ao advogado Igor Camargo Rangel para avaliação do caso.</p>
                            </div>`,
                        imageUrl: `{{$url_image}}/${randonomImage}.webp`,
                        imageWidth: 400,
                        imageAlt: "Custom image",
                        confirmButtonText: 'Entendi',
                        // Adicione a função didOpen para anexar o evento de clique após o modal ser aberto
                        didOpen: () => {
                            const copyButton = document.getElementById('copyPixButton');
                            const pixKeySpan = document.getElementById('pixKey');

                            copyButton.addEventListener('click', () => {
                                const pixKey = pixKeySpan.textContent;
                                navigator.clipboard.writeText(pixKey).then(() => {
                                    // Feedback visual para o usuário
                                    copyButton.textContent = 'Copiado!';
                                    setTimeout(() => {
                                        copyButton.textContent = 'Copiar';
                                    }, 2000); // Volta ao texto original após 2 segundos
                                }).catch(err => {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Erro ao Copiar',
                                        text: 'Falha ao copiar a chave Pix. Por favor, copie manualmente.'
                                    });
                                });
                            });
                        }
                    });
                });
            }

            loadBets();
        });
    </script>

</body>
</html>
