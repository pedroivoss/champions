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


