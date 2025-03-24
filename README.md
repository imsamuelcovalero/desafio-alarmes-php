# 🚨 Desafio de Alarmes - PHP

Sistema completo para cadastro e gerenciamento de equipamentos e alarmes, com visualização de atuações e simulação de envio de alertas. Desenvolvido em **PHP**, **MySQL**, **Bootstrap**, executado via **Docker**.

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

3. Acesse o sistema no navegador:

```bash
http://localhost:8000
```

---

## 🛠️ Banco de Dados

- O banco é automaticamente inicializado com as tabelas e estrutura do arquivo `database.sql`.
- Para resetar o banco e os dados:

```bash
docker compose down -v
```

---

## 📂 Estrutura do Projeto

```bash
index.php             # Página inicial de navegação
equipamentos/         # CRUD completo de equipamentos
alarmes/              # CRUD de alarmes + ativação/desativação + log de urgência
atuacoes/             # Visualização de atuações com filtros, ordenações e top 3
includes/             # Arquivo de conexão com banco (db.php)
logs/                 # Simulação de envio de e-mail (emails.log)
```

---

## 🧠 Funcionalidades

- 📋 Cadastro e gerenciamento de **equipamentos**
- 🚨 Cadastro e gerenciamento de **alarmes** vinculados aos equipamentos
- 🔁 Ativação e desativação de alarmes com:
  - Registro de **entrada e saída** nas atuações
  - Simulação de envio de e-mail para alarmes **Urgentes**
- 📊 Página de **atuações** com:
  - Filtro por descrição
  - Ordenação por colunas
  - Exibição do **Top 3 alarmes mais atuados**

---

## 📧 Simulação de envio de e-mail

- Toda vez que um alarme **Urgente** for ativado, é registrada uma entrada no arquivo:

```
logs/emails.log
```

Exemplo:

```
[URGENTE] Alarme ativado: Transformador X
```

---

## ✍️ Autor

**ImSamuelCovalero** — [GitHub](https://github.com/imsamuelcovalero)
