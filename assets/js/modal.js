
function formatDate(date) {
    const options = { day: 'numeric', month: 'numeric', year: 'numeric' };
    return date.toLocaleDateString('pt-BR', options);
}


function openModal(data) {
    const modal = document.getElementById('modalWindow');
    modal.classList.add('open');

    modal.addEventListener('click', (e) => {
        if (e.target.id == 'close' || e.target.id == 'modalWindow') {
            modal.classList.remove('open');
        }
    });

    document.getElementById('modalDia').innerText = formatDate(new Date(data));
}


function openSecondModal() {
    const modal = document.getElementById('SecondModalWindow');
    modal.classList.add('open');

    modal.addEventListener('click', (e) => {
        if (e.target.id == 'close' || e.target.id == 'SecondModalWindow') {
            modal.classList.remove('open');
        }
    });
}
