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
                    <input type="text" id="playerName" name="playerName" required>
                </div>
                <div class="form-group">
                    <label for="playerCPF">CPF:</label>
                    <input type="text" id="playerCPF" name="playerCPF" pattern="\d{3}\.\d{3}\.\d{3}-\d{2}" placeholder="Ex: 123.456.789-00" required>
                </div>

                <h3>Placar: (R$ 10,00)</h3>
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
                    <label for="firstGoalScorer">Quem faz o primeiro gol: (opicional R$ 5,00)</label>
                    <select id="firstGoalScorer" name="firstGoalScorer" class="select2-enable" required>
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
                    <label for="firstCardTeam">Quem leva o primeiro cartão: (opicional R$ 5,00)</label>
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

                <div class="form-group" style="display: none;">
                    <label for="firstGoalTime">Minuto aproximado do primeiro gol?</label>
                    <input type="number" id="firstGoalTime" name="firstGoalTime" min="0" max="120" placeholder="Ex: 23">
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

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.22.0/dist/sweetalert2.all.min.js"></script>
    {{--<script src="{{ asset('js/script.js') }}"></script>--}}
    <script>
        document.addEventListener('DOMContentLoaded', () => {
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
            async function loadBets() {
                try {
                    const response = await fetch('/get_bets'); // Use a rota Laravel
                    const bets = await response.json();

                    betsTableBody.innerHTML = '';
                    if (bets.length === 0) {
                        const noBetsRow = betsTableBody.insertRow();
                        const cell = noBetsRow.insertCell();
                        cell.colSpan = 4;
                        cell.textContent = 'Nenhuma aposta registrada ainda. Seja o primeiro!';
                        cell.style.textAlign = 'center';
                        cell.style.padding = '20px';
                        cell.style.color = '#aaa';
                    } else {
                        bets.forEach(bet => {
                            const row = betsTableBody.insertRow();
                            row.insertCell().textContent = bet.playerName;
                            row.insertCell().textContent = `${bet.scoreTeam1} x ${bet.scoreTeam2}`;
                            row.insertCell().textContent = bet.firstCardTeam;
                            row.insertCell().textContent = bet.firstGoalScorer;
                        });
                    }
                } catch (error) {
                    console.error('Erro ao carregar apostas:', error);
                    const errorRow = betsTableBody.insertRow();
                    const cell = errorRow.insertCell();
                    cell.colSpan = 4;
                    cell.textContent = 'Erro ao carregar apostas. Tente novamente mais tarde.';
                    cell.style.textAlign = 'center';
                    cell.style.padding = '20px';
                    cell.style.color = 'red';
                }
            }

            // Lida com o envio do formulário
            if (betForm) {
                betForm.addEventListener('submit', async (event) => {
                    event.preventDefault();

                    const formData = new FormData(betForm);
                    const data = Object.fromEntries(formData.entries());

                    if (!data.playerName || !data.playerCPF || data.scoreTeam1 === '' || data.scoreTeam2 === '' || !data.firstCardTeam || !data.firstGoalScorer) {
                        alert('Por favor, preencha todos os campos obrigatórios da aposta.');
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
                            alert('Sua aposta foi registrada com sucesso!');
                            betForm.reset();
                            $('.select2-enable').val(null).trigger('change'); // Reseta Select2
                            loadBets();
                        } else {
                            alert('Erro ao registrar a aposta: ' + result.message);
                        }
                    } catch (error) {
                        console.error('Erro ao enviar aposta:', error);
                        alert('Ocorreu um erro ao enviar sua aposta. Tente novamente.');
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

                    let randonomImage = Math.floor(Math.random() * 7) + 1; // Gera um número aleatório entre 1 e 7

                    console.log(randonomImage)
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
                                    <li>Placar do jogo: R$10,00</li>
                                    <li>Autor do primeiro gol: R$5,00</li>
                                    <li>Primeiro jogador a tomar cartão: R$5,00</li>
                                </ul>
                            <p>O pagamento pode ser efetuado no dia do jogo, via dinheiro em espécie ou via pix.</p>
                            <p>O ganhador receberá o valor no dia do jogo.</p>
                            <p>Caso tenha mais de um ganhador, o valor será dividido igualmente entre os ganhadores.</p>
                            <p>Qualquer contestação deverá ser enviada ao advogado Igor Camargo Rangel para avaliação do caso.</p>
                            </div>`,
                        imageUrl: `{{$url_image}}/${randonomImage}.webp`,
                        imageWidth: 400,
                        //imageHeight: 200,
                        imageAlt: "Custom image",
                        confirmButtonText: 'Entendi'
                    });
                });
            }

            loadBets();
        });
    </script>
</body>
</html>
