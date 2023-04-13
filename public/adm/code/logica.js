let tipoCadastro,tipoRequisicao,idSelecionado,funcoesTrat,sitEditaUser;

window.addEventListener('load', (event)=>{
    btnsClick=Array.from(document.querySelectorAll('ul li'));
    btnsClick.forEach((btn,key)=>{
        btn.addEventListener('click',(e)=>{
            ind=btnsClick.indexOf(btn);
            pos=document.querySelector("section article").offsetWidth*ind;
            scrollHorinzontal("section", pos);
            document.querySelector(".btnselect").removeAttribute("class");
            e.target.setAttribute("class", "btnselect");
        });
    });
    document.getElementById("tipocadastro").addEventListener('change',(e)=>{
        tipoCadastro=e.target.value
        if(tipoCadastro!="false"){
            reqApi("/api/read.php", {}, 0);
            reqApi("/api/getColums.php",{}, 3);
        }
    });
    ehid('formUser').addEventListener("submit",(e)=>{
        e.preventDefault();
        if(sitEditaUser){
            tipoRequisicao="usuario";
            reqApi("/api/update.php",Object.assign({cadastro:tipoRequisicao},obtemDadosCampos("formUser")),2);
            sitEditaUser=false;
        }else{
            sitEditaUser=true;
        }
        var campos=Array.from(ehquery("#formUser input"));
        var innerBtn=[]
        innerBtn[true]="Salvar"
        innerBtn[false]="Editar Infos"
        campos.forEach((campo)=>{
            if(!sitEditaUser){
                campo.setAttribute("disabled",(!sitEditaUser));
            }else{
                campo.removeAttribute("disabled");
            }
        });
        ehquerySingle("#formUser button").innerText=innerBtn[sitEditaUser];
    });

    ehid("btnNovo").addEventListener('click',()=>{
        alteraTelas(true);
        tipoRequisicao="create";
    });
    ehid("btnDeleta").addEventListener('click',()=>{  
        reqApi("/api/delete.php",{id:idSelecionado}, 2);
    });
    ehid("btnSalvar").addEventListener('click',()=>{ 
        var jsonEnvia=Object.assign({id:idSelecionado},obtemDadosCampos("camposForm"));
        reqApi("/api/"+tipoRequisicao+".php",jsonEnvia, 2)
    });
    ehid("btnEditaContext").addEventListener('click',()=>{
        reqApi("/api/readSingle.php",{id:idSelecionado}, 1)
    });
});

function ehid(txt){
    return document.getElementById(txt)
}
function ehquery(txt){
    return document.querySelectorAll(txt)
}
function ehquerySingle(txt){
    return document.querySelector(txt)
}

function scrollHorinzontal(idBloco, pos) {

    document.querySelector(idBloco).scrollLeft = pos;
}

function alteraDisplay(id1,id2){
    ehid(id1).style.zIndex=-1;
    ehid(id1).style.opacity=0;
    ehid(id2).style.zIndex=1;
    ehid(id2).style.opacity=1;
}
function alteraTelas(sit){
    if(sit){
        alteraDisplay("blocoRegistros","camposForm");
        alteraDisplay("barraRegistros","barraCampos");
    }else{
        limpaCampos()
        alteraDisplay("camposForm","blocoRegistros");
        alteraDisplay("barraCampos","barraRegistros");
    }
}
function removeAllNameClass(nomeclass){
    Array.from(document.getElementsByClassName(nomeclass)).forEach(element => {
        element.removeAttribute("class",nomeclass);
    });
}
function removeAllClass(nomeclass){
    Array.from(document.getElementsByClassName(nomeclass)).forEach(element => {
        element.remove();
    });
}
function ocultaBloco(id){
    document.getElementById(id).style.display="none"
}

function recarregaDados(){
    reqApi("/api/read.php", {}, 0);
}

function escreveNot(data){
    var corNot;
    switch (data['status']) {
        case true:
            corNot="rgba(0,200,0)"
            break;
        case false:
            corNot="rgba(200,0,0)"
            break;
        default:
            corNot="yellow"
            break;
    }
    document.getElementById('mesagemAlerta').innerText=data['msg'];
    document.getElementById('mesagemAlerta').style.background=corNot;
    document.getElementById('mesagemAlerta').style.display="block";
    setTimeout(()=>ocultaBloco('mesagemAlerta'),6000);
}

function obtemDadosCampos(idForm){
    return Array.from(ehid(idForm).querySelectorAll("input")).reduce((obj, campo) => {
        if(campo.value.replace(" ","").length>0&&campo.name.replace(" ","").length>0){
            obj[campo.name] = campo.value;
        }
        return obj;
      }, {});
}

function limpaCampos(){
    Array.from(ehid("camposForm").querySelectorAll("input")).forEach((campo)=>{campo.value=""})
}

function processarInfos(arrayInfos){
    let blocos = {
        'topo': ehquerySingle("#blocoRegistros thead>tr"),
        'registros': ehid("registros")
      };
      
      for (let key in blocos) {
        blocos[key].innerHTML = '';
      }
    var criatop=true;
    arrayInfos.forEach((info)=>{
        blocos['registros'].innerHTML+="<tr id='linha"+info.id+"' data-id='"+info.id+"'></tr>";
        novalinha=ehid("linha"+info.id);
        colunas=Object.keys(info);
        colunas.forEach((key)=>{
            
            if(criatop){
                blocos['topo'].innerHTML+="<th>"+key+"</th>";
            }
            var infoCampo="";
            if(info[key]){
                infoCampo=info[key];
            }
            novalinha.innerHTML+="<td class='colum-"+key+"'>"+infoCampo+"</td>";
        });
        criatop=false;
    });
    addEventdimencionaCols();
    addEventLinhas();
}
function processarCampos(arrayInfos){
    ehid("camposForm").innerHTML="";
    arrayInfos.forEach((campo)=>{
        console.log(campo)
        var field=campo.Field, tipoCampo=campo.Type,tipe;

        console.log("field: "+field+" tipo: "+tipoCampo);
        txtContent="<div><label for='"+field+"id'>"+field+"</label>";

        if(tipoCampo.indexOf("int")!=-1||tipoCampo.indexOf("float")!=-1){
            tipe="number";
        }else if(tipoCampo.indexOf("tiny")!=1||tipoCampo.indexOf("bol")!=-1){
            tipe="ratio";
        }else if(tipoCampo.indexOf("date")!=1||tipoCampo.indexOf("time")!=-1){
            tipe="date";
        }else{
            tipe="text";
        }

        if(tipoCampo.indexOf("bol")!=-1){
            txtContent+="<div><label><input type='radio' name='"+field+"' value='1'>Verificado</label><label><input type='radio' name='"+field+"' value='0'>Tradicional</label></div>"
        }else if(field=="id"||campo.Key.indexOf("PRI")!=-1){
            txtContent+="<input id='"+field+"id' type='number' disabled>";
        }else{
            txtContent+="<input id='"+field+"id' name='"+field+"' type='"+tipe+"' placeholder='Digite'>";
        }
        txtContent+="</div>"
        ehid("camposForm").innerHTML+=txtContent;
    });
}

function preencheCampos(valoresObj){
    Object.keys(valoresObj).forEach((key)=>{
        console.log(key+"id");
        if(!!ehid(key+"id")){
            ehid(key+"id").value=valoresObj[key];
        }
    });
    
    //Requisita obtem informações
    alteraTelas(true);
    tipoRequisicao="update";
}


function reqApi(url, jsonBody, funcTrat){
    fetch(url, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(Object.assign({cadastro:tipoCadastro},jsonBody))
        })
    .then(response => response.text())
    .then(data => {
        try {
            var arrayData=JSON.parse(data);
            console.log("arrayData");
            console.log(arrayData);
            if(arrayData["status"]){
                funcoesTrat[funcTrat](arrayData);
            }else{
                escreveNot(arrayData)
            }
        } catch (error) {
            escreveNot({status:false,msg:"Erro! não foi possivel tratar requisição"+error});
        }
    })
    .catch(error => console.log(error));
}

funcoesTrat=[
    (dados)=>{//Read
        processarInfos(Object.values(dados['data']))
    },
    (dados)=>{//ReadSingle
        preencheCampos(dados['data']);
    },
    (dados)=>{//Update E Create
        escreveNot(dados)
        recarregaDados()
        alteraTelas(false)
    },
    (dados)=>{
        processarCampos(dados['data'])
    }
];


function abreblocoOpcoes(linBloco, posX,posY){
    idSelecionado=linBloco.getAttribute("id").replace("linha","");
    removeAllNameClass("linhamarcada")
    linBloco.setAttribute("class", "linhamarcada");
    ehid("registroContext").style="display:block; left:"+(posX/window.innerWidth)*100+"vw; top:"+(posY/window.innerHeight)*100+"vh";

    // Adiciona um ouvinte de eventos de clique ao documento
    document.addEventListener('click', ocultaBlocoOpcoes);
}

function ocultaBlocoOpcoes(event) {
    // Verifica se o elemento clicado é o elemento desejado ou um de seus descendentes
    const clicouDentroDoElemento = ehid("registroContext").contains(event.target);
    
    // Executa o código desejado se o clique não estiver dentro do elemento desejado
    if (!clicouDentroDoElemento) {
        ehid("registroContext").style="display:none;";
        document.removeEventListener("click",ocultaBlocoOpcoes);
        Array.from(document.getElementsByClassName("linhamarcada")).forEach(element => {
            element.removeAttribute("class","linhamarcada");
        });
    }
}

function addEventLinhas(){
    var linhaRegistro=document.querySelectorAll("#blocoRegistros tbody>tr");
    for (let i = 0; i < linhaRegistro.length; i++) {
        linhaRegistro[i].addEventListener("dblclick",toggleSelect);
        linhaRegistro[i].addEventListener('contextmenu', e => {
            e.preventDefault();
            var linhaClicada;
            if(e.target.tagName!="TR"){
                linhaClicada=e.target.parentNode;
            }else{
                linhaClicada=e.target;
            }
            abreblocoOpcoes(linhaClicada, e.pageX, e.pageY);
        });
    }
}

function toggleSelect(){
    idSelecionado=this.getAttribute("id").replace("linha","");
    reqApi("/api/readSingle.php",{cadastro:tipoCadastro,id:idSelecionado}, 1)
}

function addEventdimencionaCols(){
    // Seleciona todas as células da tabela
    var cells = document.querySelectorAll('td, th');

    // Define a margem dentro da qual o redimensionador será exibido
    var resizerMargin = 5;

    // Variável que armazena a célula atualmente sendo redimensionada
    let currentCell;
    // Percorre todas as células da tabela
    cells.forEach((cell) => {
    // Verifica se a célula é da linha do topo
    if (cell.parentElement.classList.contains('linha-topo')) {
        // Adiciona um ouvinte de eventos de mousemove à célula para detectar a posição do cursor do mouse
        cell.addEventListener('mousemove', (event) => {
        var cellRect = cell.getBoundingClientRect();
        var isLeftEdge = event.clientX < cellRect.left + resizerMargin;
        var isRightEdge = event.clientX > cellRect.right - resizerMargin;
            //console.log(isLeftEdge +"||"+isRightEdge)
        // Se o cursor do mouse estiver dentro da margem da borda esquerda ou direita da célula, cria o redimensionador e define o cursor
        if (isLeftEdge || isRightEdge) {
            // Cria o elemento redimensionador
            var resizer = document.createElement('div');
            resizer.classList.add('resizer');
            // Adiciona o redimensionador à célula
            cell.appendChild(resizer);

            // Define o estilo da célula para alterar o cursor
            cell.style.cursor = 'ew-resize';

            // Armazena a célula atualmente sendo redimensionada
            currentCell = cell;

            // Define as variáveis para armazenar a posição inicial do mouse e a largura da célula
            var startX;
            var startWidth;

            // Adiciona um ouvinte de eventos ao redimensionador para detectar o início do arraste
            resizer.addEventListener('mousedown', (event) => {
            startX = event.clientX;
            startWidth = parseInt(getComputedStyle(currentCell).width, 10);
            // Adiciona ouvintes de eventos globais para detectar o movimento e o fim do arraste
            document.addEventListener('mousemove', resize);
            document.addEventListener('mouseup', stopResize);
            });

            // Define a função de tratamento de eventos para o movimento do mouse durante o arraste
            function resize(event) {
            var width = startWidth + event.clientX - startX;
            currentCell.style.minWidth = `${width}px`;
            }

            // Define a função de tratamento de eventos para o fim do arraste
            function stopResize() {
            // Remove os ouvintes de eventos globais
            document.removeEventListener('mousemove', resize);
            document.removeEventListener('mouseup', stopResize);

            // Remove o redimensionador e redefine o cursor da célula
            resizer.remove();
            currentCell.style.cursor = '';
            currentCell = null;
            }
        } else {
            // Se o cursor do mouse não estiver dentro da margem da borda esquerda ou direita da célula, remove o redimensionador (se houver) e redefine o cursor
            removeAllClass("resizer")
            cell.style.cursor = '';
        }
        });
    }
    });
}
