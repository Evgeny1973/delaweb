Версия PHP - 8.0<br>
Дамп БД прилагается, пароль для пользователей - 12345,
создать всё заново:<br>
`comoposer install`<br>
`php bin/console doctrine:database:create`<br>
`php bin/console doctrine:migrations:migrate`<br>
`php bin/console doctrine:fixtures:load`<br>

Главная страница `/`, <br>
страница входа `/login`, <br>
страница регистрации `/signup`,<br>
страница профиля `/profile`.