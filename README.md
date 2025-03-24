# Desafio de Alarmes - PHP

Este projeto é um sistema simples de cadastro e manipulação de alarmes relacionados a equipamentos. Desenvolvido em **PHP** com **Bootstrap** e **MySQL**, executado via **Docker**.

---

## ✅ Tecnologias utilizadas

- PHP 8.1 (via Docker)
- Apache
- MySQL 5.7
- Bootstrap 5

---

## 🚀 Como rodar o projeto (usando Docker)

> 💡 **Pré-requisitos**: Docker e Docker Compose instalados

1. Clone este repositório:

```bash
git clone https://github.com/seu-usuario/desafio-alarmes-php.git
cd desafio-alarmes-php
```

2. Suba os containers:

```bash
docker compose up --build
```

3. Acesse o sistema:

```bash
http://localhost:8000
```

---

## 🛠️ Banco de Dados

- O banco é automaticamente inicializado com as tabelas e estrutura do arquivo `database.sql`.
- Se desejar resetar o banco, execute:

```bash
docker compose down -v
```

---

## 📂 Estrutura do Projeto

```bash
equipamentos/        # CRUD completo de equipamentos
alarmes/             # CRUD completo de alarmes + ativação/desativação com simulação de envio de e-mail
atuacoes/            # Visualização de atuações com filtros, ordenações e top 3
includes/            # Conexão com o banco (db.php)
logs/                # Armazena simulações de envio de e-mail para alarmes urgentes
```

---

## 🧠 Funcionalidades

- Cadastro e gerenciamento de **equipamentos**
- Cadastro e gerenciamento de **alarmes** vinculados a equipamentos
- Ativação e desativação de alarmes com:
  - Registro de data de entrada/saída
  - Simulação de envio de e-mail para alarmes **urgentes**
- Página com **visualização de atuações**:
  - Filtro por descrição
  - Ordenação por colunas
  - Top 3 alarmes mais atuados

---

## 📧 Simulação de envio de e-mail

- Ao ativar um alarme com classificação **Urgente**, uma linha é adicionada ao arquivo `logs/emails.log`

---

## ✍️ Autor

**ImSamuelCovalero** — [GitHub](https://github.com/imsamuelcovalero)