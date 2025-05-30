const randonImage = () =>{
    return Math.floor(Math.random() * 7) + 1; // Gera um número aleatório entre 1 e 7
}

const isValidCPF = (cpf) => {
    cpf = cpf.replace(/[^\d]+/g, ''); // Remove caracteres não numéricos

    if (cpf.length !== 11 || /^(\d)\1{10}$/.test(cpf)) {
        return false; // Verifica se tem 11 dígitos e não é uma sequência de dígitos iguais
    }

    let sum;
    let rest;
    sum = 0;

    for (let i = 1; i <= 9; i++) {
        sum = sum + parseInt(cpf.substring(i - 1, i)) * (11 - i);
    }

    rest = (sum * 10) % 11;

    if ((rest === 10) || (rest === 11)) {
        rest = 0;
    }

    if (rest !== parseInt(cpf.substring(9, 10))) {
        return false;
    }

    sum = 0;

    for (let i = 1; i <= 10; i++) {
        sum = sum + parseInt(cpf.substring(i - 1, i)) * (12 - i);
    }

    rest = (sum * 10) % 11;
    if ((rest === 10) || (rest === 11)) {
        rest = 0;
    }

    if (rest !== parseInt(cpf.substring(10, 11))) {
        return false;
    }

    return true;
}

const bloquear = () => {

    let randonomImage = randonImage(); // Assume que esta função retorna o nome da imagem

    $.blockUI({
        // ESTILOS PARA O BOX DA MENSAGEM (ONDE A IMAGEM E O TEXTO FICAM)
        css: {
            border: "none",            // Remove borda do box da mensagem
            padding: "20px",           // Espaçamento interno do box
            backgroundColor: "transparent", // Faz o box da mensagem em si transparente (o fundo escuro é o overlay)
            color: "#fff",             // Cor do texto
            "z-index": 9999,           // Garante que fique acima de tudo
            cursor: 'wait',            // Altera o cursor para "carregando"
            // Para garantir que o box da mensagem não tenha um tamanho fixo e se ajuste
            left: '50%',               // Posiciona o canto superior esquerdo no meio da tela
            top: '50%',                // Posiciona o canto superior esquerdo no meio da tela
            transform: 'translate(-50%, -50%)', // Move o box de volta em 50% da sua própria largura/altura para centralizá-lo
            // Opcional: min-width para o box se a imagem for muito pequena
            // minWidth: '150px'
        },
        // ESTILOS PARA O OVERLAY (O FUNDO QUE COBRE A TELA INTEIRA)
        overlayCSS: {
            backgroundColor: '#000',   // Fundo preto
            opacity: 0.8,              // Semi-transparente (ajuste de 0.1 a 1.0)
            cursor: 'wait'             // Cursor de carregando para o fundo também
        },
        // O CONTEÚDO DA MENSAGEM
        message:
            `<div>
                <img src="${base_URL}/images/figurinhas/${randonomImage}.webp" class="ld ld-beat" style="
                    display: block;   /* Garante que a imagem seja um bloco */
                    margin: 0 auto;   /* Centraliza a imagem horizontalmente dentro da div */
                    max-width: 200px; /* Tamanho máximo da imagem. Ajuste conforme necessário. */
                    height: auto;     /* Mantém a proporção da imagem */
                    animation: spin 2s linear infinite; /* Exemplo de animação, se 'ld-beat' não funcionar ou quiser algo diferente */
                "/>
                <p style="
                    margin-top: 15px; /* Espaçamento entre a imagem e o texto */
                    font-size: 1.5em; /* Tamanho do texto. Ajuste conforme necessário. */
                    font-weight: bold;
                    color: #fff;      /* Cor do texto (redundante se já no .css, mas garante) */
                    text-align: center; /* Garante que o texto esteja centralizado */
                ">Aguarde...</p>
            </div>`
    });
}

// Opcional: Se 'ld-beat' não estiver animando, você pode adicionar um CSS para uma animação de giro.
// Adicione isso ao seu arquivo CSS (por exemplo, custom-select2.css ou style.css)
/*
@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}
*/

const desbloquear = () => {
    $.unblockUI();
}

let loadHtmlModal = (url,_data,idModal,dataTable) => {

    fetch(url, {
            method: 'POST',
            body: _data
        }).then(function(response) {
            response.json().then(function(data) {
                if(true == data.success){
                    document.getElementById(idModal).innerHTML = '';
                    document.getElementById(idModal).innerHTML = data.html;
                }else{
                    Swal.fire(
                        'Atenção!',
                        data.message,
                        'warning'
                    )
                }
            });
        }).catch(function(err) {
            desbloquear()
            Swal.fire('Erro!',err,'error')
        });
}

let recuperaModalHtml = (tipo, id, url,html,dataTable) => {
    let formData = new FormData()
    formData.append('tipo', tipo)
    if("A" == tipo || "C" == tipo || "S" == tipo || "CI" == tipo){
        formData.append('id', id)
    }
    formData.append('_token', `${csrf_token}`)

    loadHtmlModal(url,formData,html,dataTable)

}//função recupera modal
