
<h1 align="center">Documentação - pedidOnline</h1>

<h5 align="center">API de Pedidos de Produtos em PHP, para o DevEvolution<h5>
  
## 📦 Introdução

<br/>


## 🚀 Preparar Lançamento

<ul>
  <li>Baixe o arquivo zipado do projeto, e descompacte na sua máquina local.</li>
  <li>Instale o NVM(Gerenciador de pacotes), caso não tiver.<br>Com <b>wGet</b>:<code>wget -qO- https://raw.githubusercontent.com/nvm-sh/nvm/v0.39.3/install.sh | bash</code><br/>Ou com <b>Curl</b>:<code>curl -o- https://raw.githubusercontent.com/nvm-sh/nvm/v0.39.0/install.sh | bash
</code></li>
  <li>Instale o Nodejs na versão <b>16.18.0</b>(mais adequada), utilizando o nvm.<br/><code>nvm install 16.18.0</code></li>
  <li>Instale o NPM, caso não tiver, com o comando <code>npm install npm -g</code><br/> E no diretório raiz do projeto execute o comando:<code>npm install</code><br/> para instalar todos os pacotes necessários descritos no arquivo <i>packtage.json</i>.</li>
  <li>Instale o banco de dados <b>MongoDB</b>, através do site oficial: https://www.mongodb.com/</li>
  <li>Opcionalmente pode ser instalado ferramentas facilitadoras de inicialização do servidor.<br/>
  <b>Nodemon:</b><code>npm install nodemon --savedev</code> e <b>Pm2:</b><code>npm install pm2 -g</code></li>
  <li>No terminal acesse o diretório raiz do projeto e execute: <code>node index.js</code></li>
  <li>Show! agora o servidor deve estar acessivel pelo link: https://localhost:3000 <br/>para testar requisições instale o PostMan ou outro programa similar, e consulte as diferentes rotas e funções a seguir.</li>
</ul>
  
## 📋 Listagem de Rotas


### Tipos de {cadastro} e informações
  
| Cadastro     | Campos |
| --------     | --------   |
| usuario      | <code>nome: String,</code><br/><code>email: {type: String, required: true, unique: true, lowercase: true},</code><br/><code>senha: {type: String, required: true},</code><br/><code>grupousuario: {type: String, ref: 'grupousuario'},</code><br/><code>endereco: {type: String, ref: 'endereco'}</code>|
| grupousuario | <code>nome: {type: String, required: true},</code><br/><code>desc: String,</code><br/><code>permpost: {type: Boolean,required: true},</code><br/><code>permget: {type: Boolean,required: true},</code><br/><code>permput: {type: Boolean,required: true},</code><br/><code>permdel: {type: Boolean,required: true}</code> |
| produto      | <code>nome: {type: String,required: true},</code><br/><code>categoria: {type: String,default:"outros"},</code><br/><code>anunciante: {type: String,ref: 'anunciante'},</code><br/><code>custo: {type: Number,default:0,min: 0},</code><br/><code>preco: {type: Number,default:0,min: 0},</code><br/><code>quantidade: {type: Number,default:0,min: 0},</code><br/><code>relevancia: {type: Number,min: 0,default:1},</code><br/><code>datavalidade: {type: Date},</code><br/><code>linkimagem: {type: String}</code> |
| pedido       | <code>status: {type:Boolean, default: false},</code><br/><code>data: {type:Date, default: Date.now()},</code><br/><code>usuario: {type: String, ref: 'usuario'},</code><br/><code>produto: {type: String, ref: 'produto'},</code><br/><code>quantidade: {type:Number, default: 0}</code> |
| anunciante   | <code>nome: {type:String, required: true},</code><br/><code>cnpj: String,</code><br/><code>ramo: String,</code><br/><code>telefone: String,</code><br/><code>celular: String,</code><br/><code>email: String,</code><br/><code>endereco: {type: String, ref: 'endereco'},</code><br/><code>linklogo: String</code> |
| ramo         | <code>nome: {type:String, required: true},</code><br/><code>desc: String,</code><br/><code>percimpos: Number</code> |
| endereco      | <code>endereco: {type: String,required: true},</code><br/><code>referencia: {type: String},</code><br/><code>complemento: {type: String},</code><br/><code>cep: {type: String},</code><br/><code>cidade: {type: String,required: true},</code><br/><code>uf: {type: String,required: true},</code><br/><code>numero: {type: String}</code> |

 
## 🛠️ Arquitetura do Software
O arquivo nomeado como "index.js" que fica localizado na pasta raiz do projeto, cria um  o servidor importando as blibiotecas necessárias e definindo o roteamento da API.<br/>

### Estruturação de diretórios

<b>/src</b><br/>
Configura, autentica e define diferentes fluxos de comunicação para a consulta da API no banco mongoDB;<br/>

<b>/src/routes</b><br/>
Define os dois diferentes tipos de rotas da aplicação(CRUD e Acesso) e envia para o controller praticamente tudo recebe.<br/>

<b>/src/controllers</b><br/>
Filtra os dados que serão utilizados para a consulta porterior, e retorna para a rota a resposta quando finalizado.<br/>

<b>/src/services</b><br/>
Recebe somente os dados necessários para efetuar a consulta no banco, se ocorrer tudo certo retorna para o controller os dados esperados<br/>

<b>/src/setup</b><br/>
Configura o Banco de dados, armazena dados padrões(de alimentação por rota) e o mais importante define os nomes dos documentos/rotas do crud <br/>







## 📌 Versão - 1.0.0


## ✒️ Autor

* **Jean Perondi** - *Projeto Completo - pedidOnline* - [perondjean](https://github.com/Jeanperondi10)


