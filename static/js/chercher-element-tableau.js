function chercher_element_tableau(barre_recherche){
    let tableau_body = document.getElementById("body-table");
    let tableau_lignes = tableau_body.getElementsByTagName("tr");
    for (let i = 0; i < tableau_lignes.length; i++) {
        let tableau_colonnes = tableau_lignes[i].getElementsByTagName("td");
        let taille_tableau_colonnes = tableau_colonnes.length;
        let element_trouve = false;
        for (let j = 0; j < tableau_colonnes.length; j++) {
            if (tableau_colonnes[j].innerHTML.toUpperCase().includes(barre_recherche.value.toUpperCase())){
                element_trouve = true;
                tableau_colonnes[j].parentElement.style.display = "table-row";
            }else{
                taille_tableau_colonnes--;
            }
        }
        if (element_trouve === false) {
            tableau_lignes[i].style.display = "none";
        } else {
            tableau_lignes[i].style.display = "table-row";
        }
        if (taille_tableau_colonnes === 0) {
            tableau_lignes[i].style.display = "none";
        }
    }

}