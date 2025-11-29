
CREATE DATABASE IF NOT EXISTS loja CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE loja;

CREATE TABLE IF NOT EXISTS categorias (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(100) NOT NULL
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS produtos (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(150) NOT NULL,
  descricao TEXT,
  preco DECIMAL(10,2) NOT NULL DEFAULT 0.00,
  estoque INT NOT NULL DEFAULT 0,
  categoria_id INT,
  criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (categoria_id) REFERENCES categorias(id) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS clientes (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(150) NOT NULL,
  email VARCHAR(150),
  telefone VARCHAR(30)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS pedidos (
  id INT AUTO_INCREMENT PRIMARY KEY,
  cliente_id INT,
  total DECIMAL(10,2) NOT NULL DEFAULT 0.00,
  criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (cliente_id) REFERENCES clientes(id) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS itens_pedido (
  id INT AUTO_INCREMENT PRIMARY KEY,
  pedido_id INT NOT NULL,
  produto_id INT NOT NULL,
  quantidade INT NOT NULL DEFAULT 1,
  preco_unitario DECIMAL(10,2) NOT NULL DEFAULT 0.00,
  FOREIGN KEY (pedido_id) REFERENCES pedidos(id) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (produto_id) REFERENCES produtos(id) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB;

INSERT INTO categorias (nome) VALUES ('Eletrônicos'), ('Roupas'), ('Acessórios');

INSERT INTO produtos (nome, descricao, preco, estoque, categoria_id)
VALUES
('Fone Bluetooth', 'Fone sem fio com cancelamento de ruído', 199.90, 10, 1),
('Camiseta', 'Camiseta branca básica', 39.90, 50, 2),
('Relógio', 'Relógio analógico, pulseira de couro', 129.00, 8, 3);

INSERT INTO clientes (nome, email, telefone)
VALUES ('João Silva', 'joao@example.com', '11-99999-0000'),
       ('Mariana Lima', 'mariana@example.com', '11-98888-1111');

INSERT INTO pedidos (cliente_id, total) VALUES (1, 239.90);
INSERT INTO itens_pedido (pedido_id, produto_id, quantidade, preco_unitario) VALUES (1, 1, 1, 199.90), (1, 2, 1, 40.00);
