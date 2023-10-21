function alert(){
    Swal.fire({
        title: 'Cadastro feito com sucesso!',
        text:'tudo certo por aqui...',
        width: 600,
        padding: '3em',
        color: '#AB7BC8',
        background: '#fff',
        backdrop: `
          rgba(0,0,123,0.4)
          url("../img/PYh.gif")
          left top
          no-repeat
        `
      })
}

function alertEmail(){
  Swal.fire({
      title: 'Email repetido',
      text:'reveja seu cadastro...',
      width: 600,
      padding: '3em',
      color: '#AB7BC8',
      background: '#fff',
      backdrop: `
        rgba(0,0,123,0.4)
        url("../img/PYh.gif")
        left top
        no-repeat
      `
    })
}

function alertExcluir(){
    Swal.fire({
        imageUrl: 'https://unsplash.it/400/200',
        imageWidth: 400,
        imageHeight: 200,
        imageAlt: 'Custom image',
        title: 'Excluido com sucesso!',
        text:'tudo certo por aqui...',
        width: 600,
        padding: '3em',
        color: '#AB7BC8',
        background: '#fff',
        backdrop: `
          rgba(0,0,123,0.4)
          url("/images/nyan-cat.gif")
          left top
          no-repeat
        `
      })
}

function alertAlterar(){
    Swal.fire({
        title: 'Editado com sucesso!',
        text:'tudo certo por aqui...',
        width: 600,
        padding: '3em',
        color: '#AB7BC8',
        background: '#fff',
        backdrop: `
          rgba(0,0,123,0.4)
          url("/images/nyan-cat.gif")
          left top
          no-repeat
        `
      })
}

function alertSelecao(){
  Swal.fire({
      title: 'Você só pode selecionar até 3 interesses',
      text:'reveja seu cadastro...',
      width: 600,
      padding: '3em',
      color: '#AB7BC8',
      background: '#fff',
      backdrop: `
        rgba(0,0,123,0.4)
        url("../img/PYh.gif")
        left top
        no-repeat
      `
    })
}

function alertAcesso(){
  Swal.fire({
      title: 'Faça login para continuar',
      text:'entre em sua conta...',
      width: 600,
      padding: '3em',
      color: '#AB7BC8',
      background: '#fff',
      backdrop: `
        rgba(0,0,123,0.4)
        url("../img/PYh.gif")
        left top
        no-repeat
      `
    })
}

function alertLogin(){
  Swal.fire({
      title: 'Nome de usuário ou senha incorretos',
      text:'tente novamente...',
      width: 600,
      padding: '3em',
      color: '#AB7BC8',
      background: '#fff',
      backdrop: `
        rgba(0,0,123,0.4)
        url("../img/PYh.gif")
        left top
        no-repeat
      `
    })
}

function alertEmailUnconfirmed(){
  Swal.fire({
      title: 'Confirme seu email',
      text:'Necessário confirmar o email antes de fazer login.',
      width: 600,
      padding: '3em',
      color: '#AB7BC8',
      background: '#fff',
      backdrop: `
        rgba(0,0,123,0.4)
        url("../img/PYh.gif")
        left top
        no-repeat
      `
    })
}

function alertLogout(){
  Swal.fire({
      title: 'Você saiu com sucesso',
      text:'volte sempre...',
      width: 600,
      padding: '3em',
      color: '#AB7BC8',
      background: '#fff',
      backdrop: `
        rgba(0,0,123,0.4)
        url("../img/PYh.gif")
        left top
        no-repeat
      `
    })
}

function alertSessao(){
  Swal.fire({
      title: 'Sua sessão expirou',
      text:'entre novamente...',
      width: 600,
      padding: '3em',
      color: '#AB7BC8',
      background: '#fff',
      backdrop: `
        rgba(0,0,123,0.4)
        url("../img/PYh.gif")
        left top
        no-repeat
      `
    })
}

function alertEmailConfirm(){
  Swal.fire({
    position: 'center',
    icon: 'success',
    title:'Email confirmado com sucesso!',
    text: 'por favor, entre na sua conta para continuar',
    showConfirmButton: false,
  })
}

function alertEmailSent(){
  Swal.fire({
    position: 'center',
    title: 'Email enviado com sucesso',
    text: 'Confira sua caixa de entrada',
    showConfirmButton: false,
  })
}

function alertEmailFail(){
  Swal.fire({
    icon: 'error',
    title: 'Falha ao enviar o email',
    text: 'Algo deu errado, tente novamente!',
    showConfirmButton: false,
  })
}

function alertSenhaConfirm(){
  Swal.fire({
    position: 'center',
    icon: 'success',
    title:'Senha alterada com sucesso!',
    text: 'Um email de confirmação foi enviado',
    showConfirmButton: false,
  })
}

function alertSenhaFail(){
  Swal.fire({
    icon: 'error',
    title: 'Falha ao alterar a senha',
    text: 'Algo deu errado, tente novamente!',
    showConfirmButton: false,
  })
}

function alertSenhaRepeat(){
  Swal.fire({
    icon: 'error',
    title: 'Falha ao alterar a senha',
    text: 'Link inválido ou já utilizado. Solicite um novo link para atualizar a senha!',
    showConfirmButton: false,
  })
}

function alertSenhaExpired(){
  Swal.fire({
    icon: 'error',
    title: 'Falha ao alterar a senha',
    text: 'Este link de redefinição de senha expirou. Solicite um novo link.',
    showConfirmButton: false,
  })
}


function alertCompartilhamento() {
  Swal.fire({
      icon: 'center',
      title: '🌿 O link da Oásis foi copiado! ',
      text: 'Obrigado por fazer parte do movimento por um futuro mais sustentável.',
      showConfirmButton: false,
      
  });
}