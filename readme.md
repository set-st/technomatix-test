Тестовое задание
--
для кандидата на позицию PHP Developer

Создать систему "Склад". Система должна уметь:
- Авторизация.
- Доступные роли Администратор, Менеджер, Сотрудник.
- Добавлять Товар, может Администратор/Менеджер.
- Добавлять Приход/Расход, может Администратор/Менеджер/Сотрудник.
- История операций с фильтрами по товарам, операциям, авторам и диапазону дат,
может Администратор/Менеджер.

Инструменты:

 Основные:
 - Yii 1+
 - PHP 5.6
 - MySQL 5.6
 - Bootstrap 3+
 - jQuery
 - Doctrine 2
 - Git

Дополнительные:
 - PHP 7.0+
 - MySQL 5.7+
 - Composer
 - Codeception
 - Docker

Для запуска необходимо выполнить следующее:
развернуть репозиторий, создать базу данных `test`, а так же настроить виртуальный хост.

затем перейти в каталог `protected`

выполнить следующие команды
`./yiic migrate`

`./yiic rbac init`

в базу будут добавлены пользователи

`admin@local.com` c паролем `admin`

`manager@local.com` c паролем `manager`

`staff@local.com` c паролем `staff`

с соответствующими ролями.
