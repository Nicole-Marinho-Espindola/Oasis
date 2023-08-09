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
    // console.log('Funcionou');
    // var mudarClasse = document.querySelector(".active");
    // console.log(mudarClasse);
    // mudarClasse.classList.remove("section1");
    // console.log('Funcionou');

    // var mudarClasse = document.querySelector(".section1"); // atribui á variavel mudarClasse a busca que é feita pelo queryselector
    // mudarClasse.classList.add("active"); // classList busca todas as classes do elemento e add adicona a classe entre parenteses ao elemento

    var currentActive = document.querySelector(".active"); 
    var nextActive = next(currentActive, 'div');

    currentActive.classList.remove("active"); 
    nextActive.classList.add("active"); 

    // var mudarClasse2 = document.querySelector(".section2"); 
    // mudarClasse2.classList.add("active"); 

    // var mudarClasse3 = document.querySelector(".section3"); 

    // console.log('oi');

}
