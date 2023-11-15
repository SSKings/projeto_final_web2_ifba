CREATE TABLE fornecedor (
    id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    nome VARCHAR(100),
    endereco VARCHAR(255),
    email VARCHAR(100),
    telefone VARCHAR(20),
    usuario_id INT, 
    FOREIGN KEY (usuario_id) REFERENCES usuario(id) ON DELETE CASCADE
);
