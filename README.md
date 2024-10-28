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

## Login

Username: `admin@z.com`

Password: `123`

## Project Assumptions

#### Secure Auth

Laravel standard authentication mechanism implements the bcrypt hashing algorithm and stores it
on the database alongside uniquely generated salt for the hash. As such, its considered a secure
authentication mechanism.

#### List of Posts and Follow functionality

Authenticated users are able to see every post, and they can choose to follow an author
based on a post they see. They're also able to unfollow authors that they are already following.

#### Post notification

When a new post is published, a background job is dispatched which will be responsible for
collecting all followers of the post's author and notify them of the new post. There is a
route under `/posts/{post}/notification` which gives a preview of how the notification
looks like.
