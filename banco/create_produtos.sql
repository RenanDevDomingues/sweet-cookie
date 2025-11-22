CREATE TABLE IF NOT EXISTS produtos (
id int(11) NOT NULL AUTO_INCREMENT,
nome varchar(100),
descricao varchar(255),
tipo varchar(80) NOT NULL,
categoria varchar(100) NOT NULL,
preco decimal(10,2) NOT NULL,
imagem varchar(255) NOT NULL,
  PRIMARY KEY (id)
);