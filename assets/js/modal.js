function openModal(){
    const modal = document.getElementById('modalWindow')
    modal.classList.add('open')

    modal.addEventListener('click', (e) => {
        if(e.target.id == 'close' || e.target.id == 'modalWindow') // evento ocorre quando o alvo for o seguinte id
            modal.classList.remove('open')
    })
}