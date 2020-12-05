function carregar(){

    //Esconder o container de publicação
    container_public = window.document.querySelector("div.container_publicacao");
    container_public.style.display = "none";
        
}

function viewport_change(){
    largura =  window.innerWidth;
    if(largura <= 600){
        console.log("Breakpoint Mobile");
    } else {
        console.log("Tamanho Desktop");
    }

}









