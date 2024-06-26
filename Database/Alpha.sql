CREATE DATABASE Alpha;


CREATE TABLE administrador( 
 Id INT PRIMARY KEY AUTO_INCREMENT,
 ADM_NOME VARCHAR(255),
 ADM_SENHA VARCHAR(50), 
 ADM_ATIVO ENUM('1', '2')
);

INSERT INTO administrador(ADM_NOME, ADM_SENHA, ADM_ATIVO) VALUES ('adm_1','12345','1');

CREATE TABLE PRODUTOS(
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(255),
    descricao TEXT,
    preco DECIMAL(10,2),
    imagem VARCHAR(255),
    url_imagem VARCHAR(255)
);