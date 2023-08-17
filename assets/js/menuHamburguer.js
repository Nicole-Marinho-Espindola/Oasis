class mobileNav {
    constructor( icon, menuLateral, navLinks) { //toda classe recebe o metodo constructor
        this.icon = document.querySelector(icon);
        this.menuLateral = document.querySelector(menuLateral);
        this.navLinks = document.querySelector(navLinks);
        this.activeClass = "active";

        this.handleClick = this.handleClick.bind(this);
    }

    handleClick(){
        this.menuLateral.classList.toggle(this.activeClass);
    }

    addClickEvent(){
        this.icon.addEventListener( "click",() => this.handleClick());
    }

    init() {
        if (this.icon){
            this.addClickEvent();
        }
        return this;
    }
}

const mobileNavbar = new mobileNav(
    ".icon",
    ".barra-lateral",
    ".navLinks",
);
mobileNavbar.init();
