<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <title>Acesso - Loja</title>
    </head>
    <body>
        <nav>
            <article>
                <a href="http://82.180.133.199:8088/"><h1>pedidOnline</h1></a>
            </article>
        </nav>
        <section>
            <article>
                <ul>
                    <li class="btnselect">Login</li>
                    <li>Registro</li>
                </ul>
                <div id="telasLoginRegistro">
                    <form action = "login.php" method = "POST">
                        <input type="email" name="email" id="emailid" placeholder="Email"/>
                        <input type="password" name="senha" id="senhaid" placeholder="Senha"/>
                        <button>Logar</button>
                    </form>
                    <form action = "registro.php" method = "POST">
                            <input name="nome" id="nomeid" placeholder="Nome Pessoal"/>
                            <input type="email" name="email" id="emailid2" placeholder="Email"/>
                            <input type="password" name="senha" id="senhaid2" placeholder="Senha"/>
                            <input type="password" name="confirmasenha" id="confirmsenhaid" placeholder="ConfirmeSenha"/>
                            <button>Cadastrar</button>
                    </form>
                </div>
            </article>
            <p id="mesagemAlerta" onclick="ocultaBloco('mesagemAlerta')">Um teste de comportamento mensagem</p>
        </section>
    </body>
    <script>
        window.addEventListener('load', (event)=>{
            btnsClick=Array.from(document.querySelectorAll('ul li'));
            btnsClick.forEach((btn,key)=>{
                btn.addEventListener('click',(e)=>{
                    posLeft=0
                    if(key==1){
                        posLeft=document.querySelector("#telasLoginRegistro form").offsetWidth;
                    }
                    scrollHorinzontal("telasLoginRegistro", posLeft);
                    document.querySelector(".btnselect").removeAttribute("class");
                    e.target.setAttribute("class", "btnselect");
                });
            });
            formsEnvia=Array.from(document.querySelectorAll('form'));
            formsEnvia.forEach(form => {
                form.addEventListener('submit', function(event) {
                    // previne o envio padrão do formulário
                    event.preventDefault();
                    var campos = Array.from(form.querySelectorAll("input,textarea"));
                    var corpoCampos = {};
                    campos.forEach(campo => {
                    corpoCampos[campo.name] = campo.value;
                    });

                    fetch(form.action, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(corpoCampos)
                    })
                    .then(response => response.text())
                    .then(data => {
                        var arrayData=JSON.parse(data);
                        escreveNot(JSON.parse(data))
                        if(arrayData['redirect']!=undefined){
                            setTimeout(() => {
                                window.location.href=arrayData['redirect'];
                            }, 500);
                        }
                    })
                    .catch(error => console.error(error));
                });
            });
        });

        function scrollHorinzontal(idBloco, pos) {
            document.getElementById(idBloco).scrollLeft = pos;
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
        
        function ocultaBloco(id){
            document.getElementById(id).style.display="none"
        }
    </script>
    <style>
        body{
            position: fixed;
            top:0;
            left: 0;
            right: 0;
            bottom: 0;
            background: black;
            margin:0px
        }
        *{
            box-sizing: border-box;
        }
        p,h1,h2,h3,h4,li{
            font-family: Arial, Helvetica, sans-serif;
        }
        body>* {
            display: inline-flex;
            float: left;
            height: 100%;
            align-items: center;
            justify-content: center;
        }
        nav{
            width: 40%;
        }
        nav article{
            background: transparent;
        }
        section{
            position:relative;
            width: 60%;
            background-image: url(https://th.bing.com/th/id/OIP.6nz_UwRyKnrJKYh49dB4uQHaEo?pid=ImgDet&rs=1);
            background-size:cover;
        }
        article{
            width: 90%;
            height: 50vh;
            border-radius: 1vh;
            overflow:hidden
        }
        ul{
            width: 100%;
            height: 20%;
            background: black;
            padding: 0px;
            margin: 0px;
        }
        li {
            color: white;
            text-decoration: none;
            list-style: none;
            display: inline-block;
            width: 50%;
            float: left;
            text-align: center;
            font-size: 2vh;
            padding: 3vh 0px;
        }
        li:hover{
            cursor:pointer;
            font-weight:bold
        }
        .btnselect{
            font-size: 3vh;
            border-bottom: 0.5vh white solid;
        }
        .btnselect:hover{
            cursor:normal;
            font-weight:normal
        }
        #telasLoginRegistro {
            display: flex;
            width: 100%;
            height: 80%;
            flex-direction: column-reverse;
            flex-wrap: wrap;
            scroll-behavior: smooth;
            overflow:hidden;
        }
        #telasLoginRegistro form {
            display: flex;
            width: 100%;
            height: 100%;
            flex-direction: column;
            align-content: center;
            justify-content: center;
            align-items: center;
            flex-wrap: nowrap;
            background:rgba(0,0,0,0.8)
        }
        #telasLoginRegistro input{
            border: solid 0.3vh white;
            width:50%;
            height:5vh;
            background: white;
            font-size:2vh;
            margin: 1vh 0px;
            padding:2vh 0px;
            text-align: center;
        }
        #telasLoginRegistro button{
            border-radius:1vh;
            border: solid 0.3vh white;
            width:30%;
            height:6vh;
            font-size:2vh;
            margin: 1vh 0px;
            text-align: center;
            cursor:pointer
        }
        #telasLoginRegistro button:hover{
            background:black;
            color:white
        }
        h1{
            margin: 18vh 0px;
            font-size: 7vh;
            color:white;
            text-align: center;
            text-decoration:none;
            border-top: solid 1vh;
            border-bottom: solid 1vh;
        }
        a{
            text-decoration:none;
        }
        #mesagemAlerta{
            position: absolute;
            padding: 2vh 4vh;
            bottom: 1vh;
            left: 2vh;
            font-size: 2.3vh;
            color: white;
            font-weight: bold;
            -webkit-text-stroke: 0.1vh black;
            border-radius: 1vh;
            box-shadow: 0px 0px 2vh white inset;
            height: auto;
            max-width: calc(100% - 4vh);
            text-align: center;
            display:none;
        }
        #mesagemAlerta:hover{
            cursor:pointer;
            opacity:0.5;
        }
    </style>
</html>