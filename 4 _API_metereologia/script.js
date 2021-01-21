function pesquisar(cidade){

    console.log(cidade);

    //Para entender o formato do link utilizado para requisição dos dados: https://console.hgbrasil.com/documentation/weather#introducao
    let url = "https://api.hgbrasil.com/weather?format=json-cors&fields=only_results,temp,city_name,date&key=a2e3658a&city_name="+cidade;

    //Criação do Objeto 
    let xmlHttp = new XMLHttpRequest();
    //Abertura da requisição
    xmlHttp.open('GET', url);
    //Envio da requisição
    xmlHttp.send();

    //Método para verificação do stat do Objeto
    xmlHttp.onreadystatechange = () => {
        if(xmlHttp.readyState == 4 && xmlHttp.status == 200) { //Se o state for = 4 e o status = 200
            let dadosJSONText = xmlHttp.responseText;
            console.log(dadosJSONText);

            //Realiza a leitura do texto do arquivo, e conversão para código em formato JSON
            //dadosJSONobj recebe o objeto JSON
            let dadosJSONObj = JSON.parse(dadosJSONText);
            console.log(dadosJSONObj);

            //Atribuição dos valores dos atributos do objeto JSON aos campos input
            document.getElementById('nome_cidade').value = dadosJSONObj.city_name;
            document.getElementById('tempo').value = dadosJSONObj.temp + "ºC";
            document.getElementById('data').value = dadosJSONObj.date;

            //Resultado
            icone = window.document.querySelector("i#icone");
            icone.style.transition = "1s";
            icone.style.color = "#218838";

            let result = window.document.getElementById("container_saida");
            result.style.display = "grid";
            result.style.gridTemplateRows = "repeat(3,1fr)";
            result.style.justifyItems = "center";
            result.style.alignItems = "center";
            result.style.padding = "5px";



            
            
        }

    }
}