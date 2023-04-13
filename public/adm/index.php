<?php
ob_start();
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="code/estilo.css">
    <link rel="stylesheet" href="code/grafico.css">
    <script src="code/logica.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.2.1/dist/chart.umd.min.js"></script>
    <script src="code/grafico.js"></script>
    <title>pedidOnline</title>
</head>
<body>
    <nav>
        <h1>pedidOnline</h1>
        <ul>
            <li class="btnselect">Inicio</li>
            <li onclick="">Gestão</li>
            <li>Conta</li>
            <a href="../acesso/logout.php"><li>Sair</li></a>
        </ul>
    </nav>
    <section>
        <article id="dashboard">
            <h4>
                Olá <?php echo($_SESSION['nome']); ?> bem vindo!
            </h4>
            <div id="dashboardbloco">
                <div>
                    <canvas id="nomegrafico4" data-type="doughnut" data-titulo="Status Pedidos"></canvas>
                </div>
                <div>
                    <canvas id="nomegrafico2" data-type="polarArea" data-titulo="Titulo do Card"></canvas>
                </div>
                <div class="ladodois">
                    <canvas id="nomegrafico6" data-type="line"></canvas>
                </div>
                <div class="ladodois">
                    <canvas id="nomegrafico7" data-type="bar"></canvas>
                </div>
                <div>
                </div>
                <div>
                </div>
            </div>
        </article>
        <article id="gestao">
            <div>
                <div id="displayGestao">
                    <div id="blocoRegistros">
                        <table>
                            <thead>
                                <tr class="linha-topo">
                                </tr>
                            </thead>
                            <tbody id="registros">
                            </tbody>
                        </table>
                        <h4></h4> 
                    </div>
                    <form id="camposForm">
                        <div><label for="">ID</label><input type="text" placeholder="Digite alguma info"></div>
                        <div><label for="">ID</label><input type="text" placeholder="Digite alguma info"></div>
                    </form>
                </div>
                <nav>
                    <div id="barraRegistros">
                        <button id="btnNovo">Novo</button>
                        <button onclick="recarregaDados()">Recarregar</button>
                        <div id="camposFiltro">
                            <select id="tipocadastro">
                                <option value="false">Selecione Cadastro</option>
                                <option value="usuario">Usuario</option>
                                <option value="grupousuario">Grupo Usuario</option>
                                <option value="ramo">Ramo Atividade</option>
                                <option value="anunciante">Anunciante</option>
                                <option value="categoria">Categoria Prod.</option>
                                <option value="produto">Produto</option>
                                <option value="pedido">Pedido</option>
                            </select>
                        </div>
                    </div>
                    <div id="barraCampos">
                        <button id="btnSalvar">Salvar</button>
                        <button onclick="alteraTelas(false)">Cancelar</button>
                    </div>
                </nav>
            </div>
        </article>
        <article id="conta">
            <div>
                <img src="<?php $linkImg='https://static.vecteezy.com/ti/vetor-gratis/p2/2275847-avatar-masculino-perfil-icone-de-homem-caucasiano-sorridente-vetor.jpg'; if(isset($_SESSION['linkimagem'])){$linkImg=$_SESSION['linkimagem'];} echo($linkImg)?>" alt="">
                <form id="formUser">
                    <input name="id" value="<?php echo($_SESSION['id']);?>" placeholder="Nome" type="text" disabled="true" style="display:none">
                    <input name="nome" value="<?php echo($_SESSION['nome']);?>" placeholder="Nome" type="text" disabled="true">
                    <input name="email" value="<?php echo($_SESSION['email']);?>" placeholder="Email" type="text" disabled="true">
                    <input name="senha" value="" type="text" placeholder="Senha" disabled="true">
                    <button>Editar Infos</button>
                </form>
            </div>
        </article>
        <article id="sair" style="display:none"></article>
        <p id="mesagemAlerta" onclick="ocultaBloco('mesagemAlerta')">Um teste de comportamento mensagem</p>
    </section>
    <div id="registroContext">
        <p id="btnEditaContext">Editar</p>
        <p id="btnDeleta">Deletar</p>
    </div>
</body>
</html>