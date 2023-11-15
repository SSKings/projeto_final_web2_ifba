CREATE TABLE cliente (
    id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    nome VARCHAR(100),
    email VARCHAR(100),
    telefone VARCHAR(20),
    usuario_id INT, 
    FOREIGN KEY (usuario_id) REFERENCES usuario(id) ON DELETE CASCADE
);