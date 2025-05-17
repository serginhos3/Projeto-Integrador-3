# Projeto Integrador 3

## Sobre o Projeto

Este sistema é uma aplicação web desenvolvida em Laravel para gestão de eventos, com foco em locação de trajes para noivos, padrinhos e controle de pedidos. O projeto visa facilitar o gerenciamento de clientes, eventos, pedidos e pagamentos, proporcionando uma interface intuitiva e processos automatizados para o negócio.

## Como subir o projeto

1. **Clone o repositório:**
   ```sh
   git clone <url-do-repositorio>
   cd projetointegrador3
   ```
2. **Instale as dependências PHP e Node.js:**
   ```sh
   composer install
   npm install
   ```
3. **Configure o ambiente:**
   - Copie o arquivo `.env.example` para `.env`:
     ```sh
     copy .env.example .env
     ```
   - Gere a chave da aplicação:
     ```sh
     php artisan key:generate
     ```
4. **Configure o banco de dados:**
   - Por padrão, o projeto utiliza SQLite. O arquivo `database/database.sqlite` já está presente. Ajuste o `.env` se necessário.
5. **Rode as migrations:**
   ```sh
   php artisan migrate
   ```
6. **Inicie o servidor de desenvolvimento:**
   ```sh
   php artisan serve
   ```
7. **Compile os assets:**
   ```sh
   npm run dev
   ```

## Como rodar os testes

- Para rodar todos os testes (Feature e Unit):
  ```sh
  php artisan test
  ```
- Para rodar apenas os testes de Feature:
  ```sh
  php artisan test --testsuite=Feature
  ```

Os testes são executados automaticamente antes de cada commit via Husky (pré-commit hook).

## CI/CD

O projeto utiliza GitHub Actions para CI/CD. O workflow está em `.github/workflows/cicd.yaml` e executa as seguintes etapas a cada push ou pull request na branch `main`:
- Instala dependências
- Copia o `.env.example` para `.env`
- Gera a chave da aplicação
- Executa as migrations
- Roda os testes

Se algum teste falhar, o pipeline é interrompido.

## Estrutura principal
- `app/` - Código principal da aplicação (Models, Controllers, etc)
- `database/` - Migrations, seeders e factories
- `resources/views/` - Views Blade
- `public/` - Arquivos públicos e ponto de entrada
- `tests/` - Testes automatizados

## Contato
Dúvidas ou sugestões? Entre em contato com a equipe de desenvolvimento.
