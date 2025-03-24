CREATE DATABASE IF NOT EXISTS desafio_php;
USE desafio_php;

CREATE TABLE equipamentos (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(100) NOT NULL,
  numero_serie VARCHAR(100) NOT NULL,
  tipo ENUM('Tensão', 'Corrente', 'Óleo') NOT NULL,
  data_cadastro DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE alarmes (
  id INT AUTO_INCREMENT PRIMARY KEY,
  descricao VARCHAR(255) NOT NULL,
  classificacao ENUM('Urgente', 'Emergente', 'Ordinário') NOT NULL,
  equipamento_id INT NOT NULL,
  data_cadastro DATETIME DEFAULT CURRENT_TIMESTAMP,
  status ENUM('on', 'off') DEFAULT 'off',
  FOREIGN KEY (equipamento_id) REFERENCES equipamentos(id)
);

CREATE TABLE atuacoes (
  id INT AUTO_INCREMENT PRIMARY KEY,
  alarme_id INT NOT NULL,
  data_entrada DATETIME DEFAULT CURRENT_TIMESTAMP,
  data_saida DATETIME,
  FOREIGN KEY (alarme_id) REFERENCES alarmes(id)
);

CREATE TABLE logs (
  id INT AUTO_INCREMENT PRIMARY KEY,
  acao VARCHAR(255) NOT NULL,
  data_log DATETIME DEFAULT CURRENT_TIMESTAMP
);
