## Instructions

Install backend dependencies
```bash
composer install
```

Install frontend dependencies. `@headlessui/vue` and `@heroicons/vue` has been added as dependencies.

```bash
npm install
```

Build the frontend assets.

```bash
npm run build
```

Copy the sample environment variables

```bash
cp .env.example .env
```

Generate a new Encryption Key
```bash
php artisan key:generate
```

Run the database migrations
```bash
php artisan migrate --force
```

Seed the database with sample data
```bash
php artisan db:seed
```

Start a worker for the posts notifications
```bash
php artisan queue:work
```

On another Terminal, start the Web application

```bash
php artisan serve
```

### Shortcut


```bash
composer install && npm install && npm run build && cp .env.example .env && php artisan key:generate && php artisan migrate --force && php artisan db:seed
```
