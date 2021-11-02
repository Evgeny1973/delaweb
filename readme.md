Версия PHP - 8.0<br>
Дамп БД прилагается, пароль для пользователей - 12345,
либо можно создать всё заново:<br>
`php bin/console doctrine:database:create`
`php bin/console doctrine:migrations:migrate`
`php bin/console doctrine:fixtures:load`