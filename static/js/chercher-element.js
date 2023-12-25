function chercher_element(barre_recherche){
    let liste_elements = document.getElementsByClassName("card-title");
    let taille_liste = liste_elements.length;
    for (let i = 0; i < liste_elements.length; i++) {
        if (liste_elements[i].innerHTML.toUpperCase().includes(barre_recherche.value.toUpperCase())){
            liste_elements[i].parentElement.parentElement.style.display = "block";
            taille_liste++;
        }else{
            liste_elements[i].parentElement.parentElement.style.display = "none";
            taille_liste--;
        }
    }
    if (taille_liste/2 === 0) {
        document.getElementById("aucun_element").style.display = "block";
    } else {
        document.getElementById("aucun_element").style.display = "none";
    }
}