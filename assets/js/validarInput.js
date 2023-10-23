const form   = document.getElementById('form'); // adicionando o Id form a variavel form
const campos = document.querySelectorAll('.required'); // querySelectorAll busca qual o elemento que possui a classe "required" e a adicona a variavel campos
const spans  = document.querySelectorAll('.span-required'); // querySelectorAll busca qual o elemento que possui a classe "span-required" e a adicona a variavel spans
const emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/; // regex para a formatação de email

function error(index){ // iniciando a função  error com escopo interno que busca o index do input 
    campos[index].style.borderBottom = '2px solid #a71f1f'; // campos recebe index do input e adiciona estilo a borda do input
    spans[index].style.display = 'block' // transforma a classe spans-required em display block já que ela possui por padrão o display none
}

function errorRemove(index){
    campos[index].style.borderBottom = ''; //  retira o estilo que a variavel campos recebe na function acima
    spans[index].style.display = 'none' // transforma a classe spans-required em display none já que ela possuia o display block
}

function nameValidate(){ // iniciando a função nameValidate
    if(campos[0].querySelector('input').value.length < 3){ // "se campos no index 0 com o valor de caracteres digitados for menor que 3"
        error(0); // aciona a função error que adicionar a borda vermelha
        // console.log('não deu')
    }else{ // se o if não acontecer então é porque tem mais que 3 caracteres
        errorRemove(0); // aciona a função errorRemove que retorna o input a sua aparencia inicial
        // console.log('deu');
    }
}

function LastNameValidate(){ // iniciando a função nameValidate
    if(campos[1].querySelector('input').value.length < 3){ // "se campos no index 0 com o valor de caracteres digitados for menor que 3"
        error(1); // aciona a função error que adicionar a borda vermelha
        // console.log('não deu')
    }else{ // se o if não acontecer então é porque tem mais que 3 caracteres
        errorRemove(1); // aciona a função errorRemove que retorna o input a sua aparencia inicial
        // console.log('deu');
    }
}

function emailValidate(){
    if(emailRegex.test(campos[0].querySelector('input').value)){
        console.log(campos[0])
        error(4); 
    }else{
        console.log('validado')
        errorRemove(4);
    }
}

function mainPasswordForm(){ // iniciando a função nameValidate
    if(campos[6].querySelector('input').value.length < 6){ // "se campos no index 0 com o valor de caracteres digitados for menor que 3"
        error(6); // aciona a função error que adicionar a borda vermelha
        // console.log('não deu')
    }else{ // se o if não acontecer então é porque tem mais que 3 caracteres
        errorRemove(6); // aciona a função errorRemove que retorna o input a sua aparencia inicial
        // console.log('deu');
    }
}

function mainPasswordValidate(){ // iniciando a função nameValidate
    if(campos[0].querySelector('input').value.length < 6){ // "se campos no index 0 com o valor de caracteres digitados for menor que 3"
        error(0); // aciona a função error que adicionar a borda vermelha
        // console.log('não deu')
    }else{ // se o if não acontecer então é porque tem mais que 3 caracteres
        errorRemove(0); // aciona a função errorRemove que retorna o input a sua aparencia inicial
        // console.log('deu');
    }
}

function PasswordValidate(){ 
    // console.log('não deu', campos, campos[1])
    if(campos[0].querySelector('input').value == campos[1].querySelector('input').value && campos[1].querySelector('input').value.length >= 6){ 
        errorRemove(1); 
        console.log('não deu')
    }else{
        error(1); 
    }
}