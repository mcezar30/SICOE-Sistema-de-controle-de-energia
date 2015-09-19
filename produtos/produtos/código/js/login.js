/**
 * Troca o tipo de login de acordo com o selecionado
 * @param obj
 */
function alterarTipoLogin(obj) {
    var href = obj.getAttribute("href");

    // Remove a classe active anteriormente selecionada
    document.querySelectorAll(".tabs a.active")[0].classList.remove('active');
    // Insere a classe active na opção clicada
    obj.classList.add("active");

    // Verifica o tipo de usuário e alterar os parâmetros nescessários
    if (href == '#areaAdministrativa') {
        document.getElementById("tipoUsuario").value = 0;
        document.getElementById("titulo").innerHTML = "Área Administrativa";
        document.getElementById("opcaoCadastrar").classList.remove("show");
        document.getElementById("opcaoCadastrar").classList.add("hide");
    } else {
        document.getElementById("tipoUsuario").value = 1;
        document.getElementById("titulo").innerHTML = "Login Usuário";
        document.getElementById("opcaoCadastrar").classList.remove("hide");
        document.getElementById("opcaoCadastrar").classList.add("show");
    }
}