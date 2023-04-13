<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="https://unpkg.com/jwt-decode@3.1.2/build/jwt-decode.js"></script>
    <title>pedidOnline</title>
</head>
<body>
    <script src="https://accounts.google.com/gsi/client" async defer></script>
      <script>
        function handleCredentialResponse(response) {
          console.log("Encoded JWT ID token: " + response.credential);
        }
        window.onload = function () {
          google.accounts.id.initialize({
            client_id: "239670396186-vs3ba5c9ehe3g3hacrjjh3oju01kjmnf.apps.googleusercontent.com",
            callback: handleCredentialResponse
          });
          google.accounts.id.renderButton(
            document.getElementById("btngoogle"),
            { theme: "outline", size: "large" }  // customization attributes
          );
          google.accounts.id.prompt(); // also display the One Tap dialog
        }
    </script>
    <nav>
        <h1>pedidOnline</h1>
        <ul>
            <li class="btnselect">Inicio</li>
            <li>Sobre</li>
            <li>Loja Virtual</li>
            <li>Acesso</li>
        </ul>
    </nav>
    <section>
        <article id="banner">
            <h3 id="txtBanner"></h3>
        </article>
        <article>
        
        </article>
        <article id="ecommerce">
            <nav>
                <select name="categoria" id="categoriaselect">
                    <option value="1">Geral</option>
                </select>
                <div>
                
                </div>
            </nav>
        </article>
        <article id="acessoArt">
            <h4>Acesso ao sistema de pedidos</h4>
            <div id="btngoogle"></div>
            <p id="btnacesso"><a href="/acesso/">Ou pela tela de login</a></p>
        </article>
    </section>
    <script>
        let indBanner=0;
        var textosBanner=[
            "Um texto banner inicial",
            "Texto segundo banner",
            "Texto terceiro banner"            
        ];
        var urlImagens=[
            "/arquivos/banner2.jpg",
            "/arquivos/banner1.jpg",
            "/arquivos/banner0.jpg",            
        ];
        window.addEventListener('load', (event)=>{
            btnsClick=Array.from(document.querySelectorAll('ul li'));
            btnsClick.forEach((btn,key)=>{
                btn.addEventListener('click',(e)=>{
                    ind=btnsClick.indexOf(btn);
                    pos=document.querySelector("section article").offsetHeight*ind;
                    scrollHorinzontal("section", pos);
                    document.querySelector(".btnselect").removeAttribute("class");
                    e.target.setAttribute("class", "btnselect");
                });
            });

            indBanner=0;
                iniciaBanner()
            
        });

       



        function scrollHorinzontal(idBloco, pos) {

            document.querySelector(idBloco).scrollTop = pos;
        }

        function iniciaBanner(){

            document.getElementById("banner").style="background-image:url("+urlImagens[indBanner]+")";
            document.querySelector("#txtBanner").innerText=textosBanner[indBanner];
            indBanner++;
            if(indBanner==urlImagens.length){
                indBanner=0;
            }
            setTimeout(iniciaBanner, 5000);
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
            margin:0px;
        }
        *{
            box-sizing: border-box;
            user-select: none;
        }
        p,h1,h2,h3,h4,li, a{
            font-family: Arial, Helvetica, sans-serif;
            margin:0px;
        }
        body>nav{
            position: fixed;
            top:0;
            left:0;
            right: 0;
            height: 9vh;
            background: white;
            overflow: hidden;
        }
        nav>*{
            display: inline-block;
            margin:0;
            height: 100%;
        }
        body>nav h1{
            font-size: 4vh;
            float: left;
            padding: 2vh;
        }
        body>nav ul{
            float:right;
            padding: 0px 1vh;
            list-style: none;
        }
        body>nav ul li{
            display: inline-block;
            font-size: 2vh;
            color: black;
            padding: 2vh;
            padding-bottom:5vh !important;
            margin-top: 1vh;
            font-weight: 100;
            border-top-left-radius: 1vh;
            border-top-right-radius: 1vh;
        }
        .btnselect,nav ul li:hover{
            cursor:pointer;
            background: black;
            color:white;
        }
        #banner{
            position: relative;
            background-size: cover;
            background-position: center;
        }
        #txtBanner{
            position: absolute;
            bottom:0;
            left:0;
            right: 0px;
            height:25vh;
            padding:9vh 1vh;
            font-size:5vh;
            color:white;
            text-align:center;
            background: linear-gradient(0deg, black,transparent)
        }
        section{
            position: relative;
            display: block;
            margin-top: 9vh;
            height: 91vh;
            width: 100vw;
            overflow: auto;
            overflow-x: hidden;
            background-image: url(https://th.bing.com/th/id/OIP.6nz_UwRyKnrJKYh49dB4uQHaEo?pid=ImgDet&rs=1);
            background-size: cover;
            background-position: center;
            box-shadow: 0px 0vh 5vh black inset;
            scroll-behavior: smooth;
        }
        section article{
            display: block;
            min-height: 100%;
            width: 150vh;
            max-width: calc(99vw - 50px);
            min-width: 50vw;
            margin: 0px auto;
            background: rgba(0,0,0,0.9);
        }
        #ecommerce{
            position: relative;
            background:linear-gradient(0deg, black,transparent, black);
        }
        article>nav{
            position:absolute;
            top:0;
            left:0;
            right:0;
            width:100%;
            height:9vh;
            background:black
        }
        #categoriaselect{
            height:100%;
            font-size:2vh;
            background:white;
        }
        #acessoArt{
            display: flex !important;
            flex-direction: column;
            justify-content: space-evenly;
        }
        h4{
            font-size: 4vh;
            color:white;
            text-align: center;
            padding: 3vh 1vh
        }
        #btngoogle{
            display:block;
            width:50vh;
            max-width: 90%;
            margin: 3vh auto; 
        }
        #btnacesso{
            width:100%;
            font-size: 3vh;
            text-align: center;
            text-decoration:none;
        }
        #btnacesso a{
            color:white !important;
        }
    </style>
</body>
</html>