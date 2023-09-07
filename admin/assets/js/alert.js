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
        title: 'Alterado com sucesso!',
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