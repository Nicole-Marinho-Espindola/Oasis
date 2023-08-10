function eyeClick() {

    const passwordInput = document.getElementById("password")

    const eyePng = document.getElementById("eyePng")

    let inputTypeIsPassword = passwordInput.type == "password"

    if(inputTypeIsPassword) {

        passwordInput.setAttribute( "type", "text")
        eyePng.setAttribute( "src", "../img/close-eye.png")
    }

    else {

        passwordInput.setAttribute( "type", "password")
        eyePng.setAttribute( "src", "../img/view.png")
    }
}

function buttonToggle() {

    const email = document.querySelector('#email').value;
    const password = document.querySelector('#password').value;

    if( email && password) {

        document.querySelector('#button').disabled = false
        return
    }
    document.querySelector('#button').disabled = true

}

function formatar(mascara, documento){
    var i = documento.value.length;
    var saida = mascara.substring(0,1);
    var texto = mascara.substring(i)

if (texto.substring(0,1) != saida){
    documento.value += texto.substring(0,1);
    }
}