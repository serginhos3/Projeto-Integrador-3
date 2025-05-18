# Projeto Integrador 3 – Ateliê do Noivo

Este projeto é uma aplicação web desenvolvida com o framework Laravel para atender às necessidades de uma loja de aluguel de trajes masculinos, com foco em **gestão de eventos, controle de clientes (noivos e padrinhos), pedidos e pagamentos**. A solução foi criada como parte do Projeto Integrador 3 da UNIVESP, visando modernizar o processo de agendamento e locação, aumentar a eficiência interna e melhorar a experiência dos clientes.

## Funcionalidades

- Cadastro de usuários com autenticação segura.
- Cadastro e edição de noivos e padrinhos.
- Registro de medidas personalizadas para cada cliente.
- Controle completo de pedidos, incluindo itens, pagamentos e status.
- Gestão de datas importantes: provas, retiradas e eventos.
- Visualização de dashboards com indicadores em tempo real.
- Geração de PDF estilizado dos pedidos.
- Sistema com layout responsivo e visual moderno.

## Tecnologias utilizadas

**Front-end:**
- **Tailwind CSS** – Estilização moderna e responsiva.
- **Bootstrap** – Componentes visuais e grid flexível.
- **JavaScript/AJAX** – Interações dinâmicas sem recarregar a página.

**Back-end:**
- **Laravel** – Framework robusto PHP com suporte a MVC, segurança e autenticação.
- **MySQL** – Banco de dados relacional para persistência dos dados.
- ***XAMPP:*** Usado como servidor local para rodar a aplicação Laravel.

**Ferramentas de Desenvolvimento:**
- **Git** – Controle de versão.
- **GitHub** – Repositório e controle colaborativo.
- **GitHub Actions** – Integração e entrega contínua (CI/CD).
- **Composer** – Gerenciamento de dependências PHP.
- **NPM** – Gerenciamento de pacotes do frontend.
- **Visual Studio Code** – IDE para desenvolvimento.


## Pré-requisitos
*Certifique-se de que você tenha as seguintes ferramentas instaladas:*

- **Git:** [*Instalar Git*](https://git-scm.com/book/en/v2/Getting-Started-Installing-Git)
- **Composer:** [*Instalar Composer*](https://getcomposer.org/)
- **XAMPP:** [*Instalar XAMPP*](https://www.apachefriends.org/pt_br/index.html)
- **Node.js:**  [*Instalar Node.js*](https://nodejs.org/pt)
- **Visual Studio Code:**  [*Instalar Visual Studio Code*](https://code.visualstudio.com/)


## Como subir o projeto

### Instruções para instalar

### 1. Clone o repositório

Abra o terminal e execute o comando abaixo para clonar o repositório do projeto:

```bash
git clone https://github.com/serginhos3/Projeto-Integrador-3.git
```
    
*Depois de clonar, entre no diretório do projeto:*
```bash
cd Projeto-Integrador-3
```

**2. Abra o terminal no Visual Studio Code:**

- Abra o Visual Studio Code.
- No menu superior, clique em **File > Open Folder** (ou **Arquivo > Abrir Pasta**).
- Selecione a pasta onde você clonou o repositório e clique em **Abrir**.

*Para abrir o terminal integrado dentro do VSCode, pressione:*

- **Ctrl + `** (a tecla abaixo do Esc) no Windows/Linux.
- **Cmd + `** no macOS.

**3. Instale as dependências com o Composer:**

O Laravel usa o Composer para gerenciar suas dependências. Para instalar as dependências, execute o seguinte comando:

```bash
composer install
```

*Isso vai baixar todas as dependências listadas no arquivo `composer.json` e configurá-las.*

**4. Instale as dependências do JavaScript com o NPM:**

O Laravel utiliza o NPM para gerenciar pacotes JavaScript. Execute o comando abaixo para instalar as dependências JavaScript:

```bash
npm install
```
*Isso vai baixar todas as dependências do frontend necessárias (como, Tailwind CSS, Axios, etc.).*

**5. Configure o arquivo de ambiente:**

O Laravel usa o arquivo `.env` para armazenar configurações sensíveis, como dados de acesso ao banco de dados. Renomeie o arquivo `.env.example` para `.env` com o seguinte comando:

```bash
cp .env.example .env
```
*Abra o arquivo `.env` e configure as informações do seu banco de dados MySQL e da Geocoding API do Google. Por exemplo:*

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nome_do_banco
DB_USERNAME=usuario
DB_PASSWORD=senha

```

**6. Gere a chave da aplicação:**

Laravel usa uma chave de segurança para criptografar sessões e outros dados. Gere a chave da aplicação executando:

```bash
php artisan key:generate
```
*Isso irá gerar a chave no arquivo `.env.`*

**7. Inicie o XAMPP:**

Caso ainda não tenha feito, abra o **XAMPP Control Panel**, inicie o **Apache** (para rodar o servidor web) e o **MySQL** (para rodar o banco de dados). Isso é necessário para que o Laravel possa funcionar corretamente.


**8. Configure o Banco de Dados:**

Certifique-se de que o MySQL esteja rodando no XAMPP e crie um banco de dados para a aplicação. Depois, execute as migrações para criar as tabelas no banco de dados:

```bash
php artisan migrate
```

### 9. Compile os assets

```bash
npm run dev
```

**10. Inicie o servidor local:**

Após configurar o ambiente, você pode iniciar o servidor Laravel utilizando o comando abaixo:

```bash
php artisan serve
```
*Isso fará o servidor local rodar na URL* `http://localhost:8000.`


## Uso/Exemplos

- Acesse http://localhost:8000 no seu navegador para visualizar a aplicação.

- Para o primeiro acesso: Você pode se cadastrar clicando no botão **`'Crie sua conta'`** na página inicial. Após o cadastro, faça login para acessar a página inicial.

## Rodando os testes

Para garantir o funcionamento da aplicação, execute os testes automatizados:

```bash
php artisan test
```

## CI/CD

Este projeto utiliza **GitHub Actions** para automatizar o processo de CI/CD. O pipeline executa:

- Instalação de dependências
- Configuração do `.env`
- Geração da chave da aplicação
- Execução de migrations
- Execução dos testes

O fluxo está definido no arquivo:  
`.github/workflows/cicd.yaml`

Se algum teste falhar, a entrega é bloqueada automaticamente.

## Estrutura do Projeto

```
app/               -> Lógica principal da aplicação (Models, Controllers)
database/          -> Migrations e seeders
resources/views/   -> Arquivos Blade (interface)
public/            -> Assets públicos (logo, scripts)
routes/            -> Definições de rotas web
tests/             -> Testes automatizados
```
