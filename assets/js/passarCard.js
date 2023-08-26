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

function passarEtapa() { 
    
    var currentActive = document.querySelector(".active-display"); 
    var nextActive = next(currentActive, 'div');

    currentActive.classList.remove("active-display"); 
    nextActive.classList.add("active-display"); 
}