# Metas — Sistema de Gestão de Tarefas

O **Metas** é uma aplicação web desenvolvida como projeto escolar, com o objetivo de facilitar a organização pessoal e o gerenciamento de tarefas. O sistema permite cadastrar atividades, definir prioridades, estabelecer prazos e acompanhar o progresso das tarefas por meio de uma interface simples e intuitiva.

## 🎯 Objetivo do projeto

Desenvolver uma ferramenta que auxilie os usuários no planejamento de suas atividades diárias, proporcionando uma melhor organização e acompanhamento das tarefas pendentes e concluídas.

## ⚙️ Funcionalidades

- **Cadastro de tarefas:** criação de atividades com título e descrição.
- **Categorização:** organização das tarefas por Trabalho, Pessoal, Estudos e Casa.
- **Definição de prioridades:** classificação em Baixa, Normal e Alta.
- **Controle de prazos:** possibilidade de estabelecer datas de entrega.
- **Acompanhamento:** marcação de tarefas como concluídas ou pendentes.
- **Filtros:** visualização de todas as tarefas, somente pendentes ou somente concluídas.
- **Indicadores de progresso:** exibição da quantidade de tarefas e do percentual de conclusão.
- **Exclusão:** remoção de tarefas cadastradas, mediante confirmação.

## 🛠️ Tecnologias utilizadas

| Tecnologia | Aplicação |
|---|---|
| PHP | Lógica e processamento do sistema |
| MySQL | Banco de dados |
| RedBeanPHP | Interação com o banco de dados |
| HTML5 | Estrutura das páginas |
| CSS3 | Estilização e responsividade |

## 🎨 Prototipação e documentação

O desenvolvimento do projeto também conta com materiais de planejamento e representação visual:

- [Protótipo das interfaces — Figma](https://www.figma.com/design/jVZ2ioj2b0ZTF4yE2oFByS/Projeto-Tarefas-I?m=auto&t=SHA3sWiOCFH8OK16-6)
- [Mapa de navegação — Draw.io](https://viewer.diagrams.net/?tags=%7B%7D&lightbox=1&highlight=0000ff&edit=_blank&layers=1&nav=1&title=mapa-navegacao.drawio&dark=auto#Uhttps%3A%2F%2Fdrive.google.com%2Fuc%3Fid%3D1eAcrh1OhKB8hKaQ3GjVgpgg6XxbezSOt%26export%3Ddownload#%7B%22pageId%22%3A%22mapa-metas%22%7D)

## 💻 Como executar o projeto

### Pré-requisitos

- PHP 8 ou superior.
- MySQL.
- Apache ou servidor web compatível com PHP.
- Extensões PDO, PDO MySQL e mbstring habilitadas.

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

### 3. Configurar a conexão

O arquivo `gestao-tarefas/conexao.php` contém as configurações de conexão com o banco de dados.

Por padrão, o sistema utiliza:

- Host: `127.0.0.1`
- Porta: `3306`
- Banco: `gestao_tarefas`
- Usuário: `root`
- Senha: vazia

Esses parâmetros também podem ser configurados por meio das variáveis de ambiente `DB_HOST`, `DB_PORT`, `DB_NAME`, `DB_USER` e `DB_PASS`.

A tabela necessária para o funcionamento do sistema é criada automaticamente na primeira conexão.

### 4. Executar a aplicação

Coloque a pasta do projeto no diretório do servidor local (por exemplo, `htdocs`, no XAMPP), inicie o Apache e o MySQL e acesse:

```text
http://localhost/gestao-tarefas/gestao-tarefas/
```

## 📁 Estrutura do projeto

```text
gestao-tarefas/
│
├── README.md
│
└── gestao-tarefas/
    ├── assets/
    │   └── css/
    │       └── style.css
    │
    ├── class/
    │   └── rb.php
    │
    ├── conexao.php
    ├── index.php
    ├── inclusao.php
    └── exclusao.php
```

## 📚 Contexto acadêmico

Projeto desenvolvido com finalidade educacional, aplicando conhecimentos de desenvolvimento web, programação em PHP, estilização com CSS e integração com banco de dados MySQL.

---

**Metas — Organização e produtividade em um só lugar.**
