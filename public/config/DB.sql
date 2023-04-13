USE database; 


/*
namespace Acesso
*/
CREATE TABLE grupousuario (
  id INT PRIMARY KEY AUTO_INCREMENT,
  nome VARCHAR(255) NOT NULL,
  descricao VARCHAR(255),
  permpost BOOLEAN NOT NULL,
  permget BOOLEAN NOT NULL,
  permput BOOLEAN NOT NULL,
  permdel BOOLEAN NOT NULL
);
CREATE TABLE usuario (
  id INT PRIMARY KEY AUTO_INCREMENT,
  nome VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL UNIQUE,
  senha VARCHAR(255) NOT NULL,
  situacao BOOLEAN DEFAULT FALSE,
  data_criacao TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  grupousuario_id INT DEFAULT 1,
  endereco VARCHAR(255),
  referencia VARCHAR(255),
  complemento VARCHAR(255),
  cep VARCHAR(255),
  cidade VARCHAR(255),
  uf VARCHAR(255),
  numero VARCHAR(255),
  linkimagem VARCHAR(255),
  FOREIGN KEY (grupousuario_id) REFERENCES grupousuario(id)
);




/*
namespace Negocio
*/
CREATE TABLE ramo (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    descricao TEXT,
    percimpos FLOAT DEFAULT 0
);
CREATE TABLE anunciante (
  id INT PRIMARY KEY AUTO_INCREMENT,
  nome VARCHAR(255) NOT NULL,
  cnpj VARCHAR(14) NOT NULL,
  ramo_id INT NOT NULL,
  email VARCHAR(255) NOT NULL,
  telefone VARCHAR(15),
  celular VARCHAR(15),
  endereco VARCHAR(255) NOT NULL,
  referencia VARCHAR(255),
  complemento VARCHAR(255),
  cep VARCHAR(255),
  cidade VARCHAR(255),
  uf VARCHAR(255),
  numero VARCHAR(255),
  linklogo VARCHAR(255) CHECK (linklogo LIKE 'http%' OR linklogo LIKE 'https%'),
  FOREIGN KEY (ramo_id) REFERENCES ramo(id)
);



/*
namespace Comercio 
*/
CREATE TABLE categoria (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(255) NOT NULL,
  descricao TEXT
);
CREATE TABLE produto (
  id INT PRIMARY KEY AUTO_INCREMENT,
  nome VARCHAR(255) NOT NULL,
  categoria_id INT DEFAULT 0,
  anunciante_id INT NOT NULL,
  custo FLOAT DEFAULT 0 CHECK (custo >= 0),
  preco FLOAT DEFAULT 0 CHECK (preco >= 0),
  quantidade INTEGER DEFAULT 0 CHECK (quantidade >= 0),
  datavalidade DATE,
  relevancia INTEGER DEFAULT 1 CHECK (relevancia >= 0),
  linkimagem VARCHAR(255) CHECK (linkimagem REGEXP '^(https?|ftp)://[^\s/$.?#].[^\s]*$'),
  FOREIGN KEY (anunciante_id) REFERENCES anunciante(id),
  FOREIGN KEY (categoria_id) REFERENCES categoria(id)
);
CREATE TABLE pedido (
  id INT PRIMARY KEY AUTO_INCREMENT,
  
  situacao BOOLEAN DEFAULT FALSE,
  data_criacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  usuario_id INT NOT NULL,
  produto_id INT NOT NULL,
  quantidade INT DEFAULT 0,
  FOREIGN KEY (usuario_id) REFERENCES usuario(id),
  FOREIGN KEY (produto_id) REFERENCES produto(id)
);







INSERT INTO grupousuario SET
nome="Administrador",
descricao="Usuario que tem todas as permissões concedidadas",
permpost=true,
permget=true,
permput=true,
permdel=true;

INSERT INTO ramo SET
nome="Geral",
descricao="Ramo de atividade genérico";

INSERT INTO categoria SET
nome="Geral",
descricao="Categoria genérica";

ALTER TABLE pedido ADD nome VARCHAR(255);