
# Project E-ticket

Order online movie tickets


## Author

- [@mariussandulache](https://github.com/msandulache)
## License

[MIT](https://choosealicense.com/licenses/mit/)


Instalation:
run:

docker compose up -d --build

Configuration:
run:

docker compose exec php bash

php vendor/bin/phinx migrate
php vendor/bin/phinx seed:run -s GenreSeeder

(for database migration I use Phinx)
https://book.cakephp.org/phinx/0/en/index.html

