function viewport_change(){
    largura =  window.innerWidth;
    if(largura <= 600){
        console.log("Breakpoint Mobile");
    } else {
        console.log("Tamanho Desktop");
    }

}

function botaoToggle(){

    //Fiz manualmente o botão toggle porque o label não estava funcionando
    //Não descobri o porquê

    palito = window.document.querySelector("#toggle-effect");
    botao = window.document.querySelector(".btn-toggle");

    checkbox = window.document.querySelector("input#check");
    if(checkbox.checked != true){
        checkbox.checked = true;
        console.log(checkbox.checked);

        palito.style.transform = "translateX(57px)";
        botao.textContent = "On";
        botao.style.background = "#65afff";
        botao.style.borderRadius = "5px 0px 0px 5px";

    } else if(checkbox.checked){
        checkbox.checked = false;
        console.log(checkbox.checked);

        botao.textContent = "Off";
        palito.style.transform = "translateX(0px)";
        botao.style.background = "#efefef";
    }

}






