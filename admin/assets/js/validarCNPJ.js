function validateCnpj(cnpj) {
    // Remover caracteres não numéricos do CNPJ
    cnpj = cnpj.replace(/[^0-9]/g, '');

    // Verificar se o CNPJ possui 14 dígitos
    if (cnpj.length !== 14) {
        return false;
    }

    // Verificar se todos os dígitos são iguais (CNPJ inválido)
    if (/(\d)\1{13}/.test(cnpj)) {
        return false;
    }

    // Calcular os dígitos verificadores
    let j = 5;
    let k = 6;
    let soma1 = 0;
    let soma2 = 0;

    for (let i = 0; i < 12; i++) {
        soma1 += parseInt(cnpj[i]) * j;
        soma2 += parseInt(cnpj[i]) * k;
        j = (j === 2) ? 9 : j - 1;
        k = (k === 2) ? 9 : k - 1;
    }

    const digito1 = (soma1 % 11 < 2) ? 0 : 11 - (soma1 % 11);
    const digito2 = (soma2 % 11 < 2) ? 0 : 11 - (soma2 % 11);

    // Verificar os dígitos verificadores
    if (cnpj[12] !== String(digito1) || cnpj[13] !== String(digito2)) {
        return false;
    }

    return true;
}
