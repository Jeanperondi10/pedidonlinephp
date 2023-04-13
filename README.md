
<h1 align="center">Documentação - pedidOnline</h1>

<h5 align="center">API de Pedidos de Produtos em PHP, para o DevEvolution<h5>
  
## 📦 Introdução e orientações gerais
A instalação desse projeto cria um servidor Web acessivel no navegador. <br>
- Página inicial: contém um exemplo de site genérico, com um Banner e alguns artigos que podem ser acessados navegando pela barra de menus localizado na parte superior a direita.<br><br>

## 🚀 Preparar Lançamento
ACESSO:
- Autenticação: para acessar a interface de gerenciamento das informações, é necessário autenticar-se por meio de uma tela de login.<br>
- Registro: para poder se autenticar por login, primeiro é preciso se registrar, preenchendo um formulário na mesma página de acesso.<br>

<br>
  
GERENCIAMENTO
- Dashbord: (Em desenvolvimento) foi iniciado essa funcionalidade, porém não foi possivel terminar a tempo : ( <br>
- Gestão CRUD: permite manipular as informações de tipos de cadastros em uma regra de negócio genérica já definida.<br> 
- Ações/Efeitos: Na barra inferior da tela existe um campo 'select' que permite selecionar um tipo de cadastro para buscar automaticamente todos os registros e listar em uma tabela.<br>Onde com a ação de duplo clique em uma linha é aberto a tela de formulário, com os campos e informações do registro daquele tipo cadastro especifico. Outra ação que pode ser feita para editar um registro é clicar com o botão direito do mouse encima de uma linha da tebela, será aberto uma caixa suspensa com opções de Editar, Deletar e (Selecionar(Em dev)) que permite fazer manipulações nos dados;


## 📋 Tipos de {cadastro} e informações
  
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

### <b>/index.php</b>
Página de um site demonstrativo que contém artigos que são navegados por menus.<br/>

### <b>/api</b>
Rota de arquivos PHP que utilizam das classes para enviar/receber as informações do banco.
- create.php;
- read.php;
- readSingle.php;
- update.php;
- delete.php;
  
### <b>/api/lib.php</b><br/>
Implementa algumas operações básicas em funções especicias que são importadas pelos arquivos das rotas.<br/>
  
### <b>/class</b><br/>
Difinição das classes agrupadas em Namespaces especificos Acesso, Negocio e Comercio. Que herdam de uma única classe abstrata que implementa uma interface básica para a realização das operações CRUD para os diferentes tipos de tabelas.<br/>

### <b>/config</b><br/>
Configuração da conexão com o banco de dados e código SQL base para criar as tabelas do banco de dados.<br/>



## 📌 Versão - 1.0.0


## ✒️ Autor

* **Jean Perondi** - *Projeto Completo - pedidOnline* - [perondjean](https://github.com/Jeanperondi10)


