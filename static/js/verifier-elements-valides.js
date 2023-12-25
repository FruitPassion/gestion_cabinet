
function activerModification() {
    let btn_modifier = document.getElementById("btn-validation");
    btn_modifier.disabled = false;
    let verif = document.getElementsByClassName(" a-verifier");
    for (let i = 0; i < verif.length; i++) {
        if (verif[i].value === "") {
            btn_modifier.disabled = true;
            return;
        }
    }
}