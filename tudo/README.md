# BookShelf API

API REST para gerenciamento de uma estante de livros pessoal, organizada por gêneros literários. Desenvolvida em Laravel com padrão MVC.

## Requisitos

- PHP 8.4+ com extensão `php8.4-sqlite3`
- Composer

## Instalação

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve
```

## Testando

Abra no navegador: `http://localhost:8000/teste.html`

## Testando com Docker

Requer apenas [Docker](https://docs.docker.com/get-docker/) instalado — sem PHP ou Composer na máquina.

**1. Entre na pasta do projeto**

```bash
cd projetozero/tudo
```

**2. Copie o arquivo de configuração**

```bash
cp .env.example .env
```

**3. Suba o container (primeira vez faz o build automaticamente)**

```bash
docker compose up --build
```

Aguarde até aparecer no terminal:

```
app-1  | INFO  Server running on [http://0.0.0.0:8000].
```

**4. Abra no navegador**

```
http://localhost:8000/teste.html
```

**5. Para parar o servidor**

```bash
# no terminal onde está rodando:
Ctrl+C

# ou em outro terminal:
docker compose down
```

> O banco SQLite fica dentro do container. Cada `docker compose up --build` recria o banco do zero com os seeders.

## Endpoints

| Método | Rota | Ação |
|--------|------|------|
| GET | /api/genres | Listar gêneros |
| POST | /api/genres | Criar gênero |
| GET | /api/genres/{id} | Exibir gênero |
| PUT | /api/genres/{id} | Atualizar gênero |
| DELETE | /api/genres/{id} | Excluir gênero |
| GET | /api/genres/{id}/books | Livros de um gênero |
| GET | /api/books | Listar livros |
| POST | /api/books | Criar livro |
| GET | /api/books/{id} | Exibir livro |
| PUT | /api/books/{id} | Atualizar livro |
| DELETE | /api/books/{id} | Excluir livro |

## Estrutura

- **Models:** `Genre` (hasMany Book) e `Book` (belongsTo Genre)
- **Controllers:** `GenreController` e `BookController` (Resource)
- **Banco:** SQLite com migrations e seeders (4 gêneros, 12 livros)
