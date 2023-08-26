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

function passarCard() { 
    var currentActive = document.querySelector(".active-display"); //pesquisa qual elemento possui essa classe
    var nextActive = next(currentActive, 'div'); // faz passar para a proxima div

    currentActive.classList.remove("active-display"); // remove a classe da div que possuia
    nextActive.classList.add("active-display"); // adciona a classe na proxima div que não possui a classe
}