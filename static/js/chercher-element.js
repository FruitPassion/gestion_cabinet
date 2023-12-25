function chercher_element(barre_recherche){
    let liste_elements = document.getElementsByClassName("card-title");
    for (let i = 0; i < liste_elements.length; i++) {
        if (liste_elements[i].innerHTML.toUpperCase().includes(barre_recherche.value.toUpperCase())){
            liste_elements[i].parentElement.parentElement.style.display = "block";
        }else{
            liste_elements[i].parentElement.parentElement.style.display = "none";
        }
    }
}