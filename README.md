
# E-ticket

Hello,


This project is intended to be an e-commerce web app through which a user can browse movies imported regulary from themoviedb (https://www.themoviedb.org/) through their API and can order tickets for the desired movies with the help of Stripe (https://stripe.com/en-gb-ro).


It is intended to be a fun and educational PHP application to understand how to use libraries such as: Twig (https://twig.symfony.com/) as a template engine, Phinx for database migration (https://book.cakephp.org/phinx/0/en/index.html).


It uses Tailwind CSS (https://tailwindcss.com) for design.


## Run Locally

Clone the project

```bash
  git clone https://github.com/msandulache/ecommerce_2023.git
```

Go to the project directory

```bash
  cd ecommerce_2023
```

Build and start Docker containers

```bash
  docker compose up -d --build
```

Enter into php running container

```bash
  docker compose exec php bash
```

Install dependencies into vendor folder

```bash
  composer install
```

Run database migrations

```bash
  php vendor/bin/phinx migrate
```

Insert test data into database (optional)

```bash
  php vendor/bin/phinx seed:run
```

Now access in browser:

http://localhost:8100/


## For local database access

http://localhost:8081/

```bash
    server = database
    user = marius
    pass = pass
```


## License

[MIT](https://choosealicense.com/licenses/mit/)


## Author

- [Marius Sandulache](https://github.com/msandulache)
## Contributing

Contributions are always welcome!


## Feedback

If you have any feedback, please reach out to us at mariussandulache2015@gmail.com

