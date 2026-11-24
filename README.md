# Metas — Sistema de Gestão de Tarefas

O **Metas** é uma aplicação web desenvolvida com o objetivo de facilitar a organização pessoal e o gerenciamento de tarefas. O sistema permite que diferentes usuários criem suas próprias contas, cadastrem atividades, definam prioridades, estabeleçam prazos e acompanhem seu progresso por meio de uma interface simples e intuitiva.

## 🎯 Objetivo do projeto

Desenvolver uma ferramenta que auxilie os usuários no planejamento de suas atividades diárias, proporcionando maior organização, produtividade e controle sobre as tarefas pendentes e concluídas.

## ⚙️ Funcionalidades

- **Cadastro de usuários:** criação de contas individuais com nome, e-mail e senha.
- **Autenticação:** acesso ao sistema por meio de e-mail e senha.
- **Gerenciamento individual:** cada usuário visualiza e administra somente suas próprias tarefas.
- **Cadastro de tarefas:** criação de atividades com título e descrição.
- **Categorização:** organização das tarefas por Trabalho, Pessoal, Estudos e Casa.
- **Definição de prioridades:** classificação em Baixa, Normal e Alta.
- **Controle de prazos:** possibilidade de estabelecer datas de entrega.
- **Acompanhamento:** marcação de tarefas como concluídas ou pendentes.
- **Filtros:** visualização de todas as tarefas, somente pendentes ou somente concluídas.
- **Indicadores de progresso:** exibição da quantidade de tarefas e do percentual de conclusão.
- **Exclusão:** remoção de tarefas cadastradas mediante confirmação.
- **Encerramento de sessão:** opção para sair da conta com segurança.

## 🛠️ Tecnologias utilizadas

| Tecnologia | Aplicação |
|---|---|
| PHP | Lógica de programação, processamento e funcionalidades do sistema |
| MySQL | Armazenamento dos usuários e das tarefas |
| RedBeanPHP | Abstração e interação com o banco de dados |
| HTML5 | Estrutura das páginas e formulários |
| CSS3 | Estilização e responsividade da interface |
| Git e GitHub | Versionamento e hospedagem do código-fonte |

## 🔐 Autenticação e segurança

O sistema possui um mecanismo de autenticação para garantir que cada usuário tenha acesso individual às suas tarefas.

Entre os recursos implementados estão:

- Armazenamento de senhas utilizando `password_hash()`.
- Verificação de credenciais com `password_verify()`.
- Gerenciamento de sessões com PHP.
- Regeneração do identificador da sessão durante a autenticação.
- Validação dos dados enviados pelos formulários.
- Consultas de tarefas vinculadas ao identificador do usuário autenticado.

## 💻 Como executar o projeto

### Pré-requisitos

- PHP 8 ou superior.
- MySQL.
- Apache ou servidor web compatível com PHP.
- Extensões PDO, PDO MySQL e mbstring habilitadas.

Recomenda-se utilizar o XAMPP para configurar o ambiente de desenvolvimento local.

### 1. Clonar o repositório

```bash
git clone https://github.com/Bryan0029/gestao-tarefas.git
```

### 2. Configurar o banco de dados

Crie o banco de dados MySQL:

```sql
CREATE DATABASE gestao_tarefas
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;
```

As tabelas `usuarios` e `tarefas` são criadas automaticamente pelo sistema na primeira conexão com o banco de dados.

### 3. Configurar a conexão

O arquivo `gestao-tarefas/conexao.php` contém as configurações de conexão com o banco de dados.

Por padrão, o sistema utiliza:

- Host: `127.0.0.1`
- Porta: `3306`
- Banco: `gestao_tarefas`
- Usuário: `root`
- Senha: vazia

Também é possível configurar esses parâmetros por meio das seguintes variáveis de ambiente:

- `DB_HOST`
- `DB_PORT`
- `DB_NAME`
- `DB_USER`
- `DB_PASS`

### 4. Executar a aplicação

Coloque a pasta do projeto no diretório do servidor local (por exemplo, `htdocs`, no XAMPP), inicie o Apache e o MySQL e acesse:

```text
http://localhost/gestao-tarefas/gestao-tarefas/
```

Ao acessar a aplicação, será possível criar uma conta e começar a utilizar o sistema.

## 📁 Estrutura do projeto

```text
gestao-tarefas/
│
├── README.md
│
└── gestao-tarefas/
    │
    ├── assets/
    │   └── css/
    │       └── style.css
    │
    ├── class/
    │   └── rb.php
    │
    ├── cadastro.php
    ├── conexao.php
    ├── exclusao.php
    ├── inclusao.php
    ├── index.php
    ├── login.php
    └── logout.php
```

### 📄 Descrição dos principais arquivos

| Arquivo | Responsabilidade |
|---|---|
| `index.php` | Página principal, listagem, filtros e indicadores de progresso das tarefas. |
| `cadastro.php` | Cadastro de novos usuários e validação das informações. |
| `login.php` | Autenticação dos usuários. |
| `logout.php` | Encerramento da sessão do usuário. |
| `conexao.php` | Conexão com o MySQL, criação das tabelas e funções auxiliares. |
| `inclusao.php` | Formulário e processamento do cadastro de tarefas. |
| `exclusao.php` | Confirmação e exclusão de tarefas. |
| `class/rb.php` | Biblioteca RedBeanPHP utilizada na comunicação com o banco de dados. |
| `assets/css/style.css` | Estilos visuais e responsividade da aplicação. |

## 📚 Contexto acadêmico

Projeto desenvolvido com finalidade educacional, aplicando conhecimentos de desenvolvimento web, programação em PHP, estruturação de páginas com HTML5, estilização com CSS3 e integração com banco de dados MySQL.

O desenvolvimento também proporciona a aplicação prática de conceitos como autenticação, gerenciamento de sessões, operações CRUD e organização de dados relacionados a diferentes usuários.

---

**Metas — Organização e produtividade em um só lugar.**
