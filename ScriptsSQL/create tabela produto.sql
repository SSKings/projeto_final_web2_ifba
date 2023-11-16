CREATE TABLE produto (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(100),
    preco DECIMAL(10, 2),
    qtd_estoque INT,
    usuario_id INT,
    fornecedor_id INT,
    FOREIGN KEY (usuario_id) REFERENCES usuario(id),
    FOREIGN KEY (fornecedor_id) REFERENCES fornecedor(id)
);
