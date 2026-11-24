<div align="center">Metas
Organize suas tarefas. Acompanhe seu progresso. Mantenha o foco.

Uma aplicação web para organizar atividades pessoais em um só lugar, com categorias, prioridades, prazos e acompanhamento de conclusão.

Acessar aplicação · Repositório
</div>Sobre o projeto
O Metas é um sistema de gerenciamento de tarefas desenvolvido para ajudar o usuário a planejar atividades e acompanhar o que já foi realizado. Cada conta possui seu próprio espaço, permitindo cadastrar, organizar, editar e acompanhar tarefas de forma simples.

O projeto foi desenvolvido com foco na aplicação prática de conceitos de desenvolvimento web, integração com banco de dados, autenticação e operações CRUD.
Funcionalidades
- Contas de usuário: cadastro, login e encerramento de sessão.
- Tarefas individuais: cada usuário acessa somente as próprias atividades.
- CRUD de tarefas: criação, edição, listagem e exclusão.
- Organização por categorias: Trabalho, Pessoal, Estudos e Casa.
- Níveis de prioridade: Baixa, Normal e Alta.
- Prazos: definição de data de entrega para cada tarefa.
- Controle de conclusão: alternância entre tarefas pendentes e concluídas.
- Filtros: visualização de todas as tarefas, das pendentes ou das concluídas.
- Painel de progresso: total de tarefas, quantidade concluída, pendências e percentual de conclusão.
- Interface responsiva: layout adaptável para diferentes tamanhos de tela.
Tecnologias
Tecnologia	Utilização
PHP	Regras de negócio, autenticação e processamento das requisições
MySQL	Persistência de usuários e tarefas
RedBeanPHP	Abstração e interação com o banco de dados
HTML5	Estrutura das páginas
CSS3	Estilização e responsividade
Git e GitHub	Versionamento e hospedagem do código-fonte


Executar localmente
Requisitos
- PHP 8 ou superior;
- MySQL;
- Apache ou outro servidor web compatível com PHP;
- Extensões PHP PDO, pdo_mysql e mbstring.
O XAMPP pode ser utilizado para configurar o ambiente local.
1. Clone o repositório
git clone https://github.com/Bryan0029/gestao-tarefas.git
2. Crie o banco de dados
No MySQL, execute:
CREATE DATABASE gestao_tarefas
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;
As tabelas usuarios e tarefas são criadas automaticamente pelo sistema na primeira conexão.
3. Configure a conexão
As configurações estão no arquivo gestao-tarefas/conexao.php.

Por padrão, a aplicação utiliza:
Parâmetro	Valor padrão
Host	127.0.0.1
Porta	3306
Banco	gestao_tarefas
Usuário	root
Senha	(vazia)


Se necessário, personalize a conexão por meio das variáveis de ambiente:
- DB_HOST
- DB_PORT
- DB_NAME
- DB_USER
- DB_PASS
4. Inicie a aplicação
Coloque a pasta do projeto no diretório do servidor local — por exemplo, htdocs, no XAMPP — e inicie o Apache e o MySQL.

Acesse:
http://localhost/gestao-tarefas/gestao-tarefas/
Crie uma conta para começar a utilizar o sistema.
Estrutura do projeto
gestao-tarefas/
├── README.md
└── gestao-tarefas/
    ├── assets/
    │   └── css/
    │       └── style.css
    ├── class/
    │   └── rb.php
    ├── cadastro.php
    ├── conexao.php
    ├── editar.php
    ├── exclusao.php
    ├── inclusao.php
    ├── index.php
    ├── login.php
    └── logout.php
Principais arquivos
Arquivo	Responsabilidade
index.php	Exibe as tarefas, filtros e indicadores de progresso.
cadastro.php	Registra novos usuários.
login.php	Autentica o usuário.
logout.php	Encerra a sessão.
conexao.php	Configura a conexão, inicializa o banco e reúne funções auxiliares.
inclusao.php	Cadastra novas tarefas.
editar.php	Atualiza os dados de uma tarefa.
exclusao.php	Confirma e realiza a exclusão de uma tarefa.
class/rb.php	Biblioteca RedBeanPHP.
assets/css/style.css	Estilos da interface e regras de responsividade.


Segurança e organização dos dados
O projeto implementa mecanismos básicos para proteger o acesso às contas e separar os dados de cada usuário:
- Senhas armazenadas com password_hash() e verificadas com password_verify();
- controle de autenticação por sessões PHP;
- regeneração do identificador da sessão durante o login;
- validação e escape de dados apresentados na interface;
- operações de tarefas vinculadas ao identificador do usuário autenticado.
Contexto acadêmico
Projeto de caráter educacional, desenvolvido para praticar programação web com PHP, integração com MySQL, construção de interfaces com HTML e CSS e implementação de operações CRUD. Também foram aplicados conceitos de autenticação, sessões e relacionamento entre usuários e tarefas.
<div align="center">Desenvolvido por Bryan e Pedro Gonçalves

GitHub · Metas — Aplicação
</div>
