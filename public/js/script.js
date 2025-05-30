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
            if (confirm('Tem certeza que deseja limpar todos os campos do formulário?')) {
                betForm.reset();
                $('.select2-enable').val(null).trigger('change'); // Reseta Select2
            }
        });
    }

    // Funcionalidade para o botão Regras
    if (rulesButton) {
        rulesButton.addEventListener('click', () => {
            alert('Regras do Bolão:\n\n' +
                  '1. Acerte o Placar Exato: 10 pontos\n' +
                  '2. Acerte o Vencedor (e não o placar exato): 5 pontos\n' +
                  '3. Acerte o Jogador que fará o Primeiro Gol: 5 pontos\n' +
                  '4. Acerte o Jogador que levará o Primeiro Cartão: 3 pontos\n\n' +
                  'Boa sorte a todos os Bagres!');
        });
    }

    loadBets();
});
