var next = function (elem, selector) {

	// Get the next element
	var nextElem = elem.nextElementSibling;

	// If there's no selector, return the next element
	if (!selector) {
		return nextElem;
	}

	// Otherwise, check if the element matches the selector
	if (nextElem && nextElem.matches(selector)) {
		return nextElem;
	}

	// if it's not a match, return null
	return null;

};

function passarEtapa() { // como clicar no botão com javascript

    var currentActive = document.querySelector(".active"); 
    var nextActive = next(currentActive, 'div');

    currentActive.classList.remove("active"); 
    nextActive.classList.add("active"); 


}

function voltarEtapa() { // como clicar no botão com javascript
    var currentActive = document.querySelector(".active"); // Pesquisa o elemento com a classe "active-display"
    var prevActive = currentActive.previousElementSibling; // como voltar para o elemento anterior

    if (prevActive && prevActive.matches("div")) {
        currentActive.classList.remove("active"); // Remove a classe "active-display" do elemento atual
        prevActive.classList.add("active"); // Adiciona a classe "active-display" ao elemento anterior

    }

}


