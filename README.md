<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Теория
- Написал сортировку пузырьком.
- Знаю из чего состоит http-запрос и http-ответ (стартовая строка, заголовки, тело).
- Знанию, что такое куки, зачем они нужны.
- Умею валидировать с помощью FormRequest в контроллере и использовать валидатор отдельно.
- Умею создавать модели, использовать crud-операции, использовал массовое заполнение атрибутов.
- Знаю, что такое синглтон и умею создавать базовый вариант синглтона на основе класса. - сделать синглтон.
- Умею делать ajax-вызовы jquery (get, post, ajax), подгружать данные через ajax. Отправлять формы.
- Умею разложить слово на кириллице на буквы и вывести побуквенно без регулярных выражений.
- Смогу поменять формат даты в тексте, используя замену по регулярному выражению.
- Могу построить корректный url из параметров в массиве.
- Работа с датой и временем.
- Индекс fulltext.
- Могу показать, какие сейчас выполняются запросы на сервере.
- Знаю типы блокировок таблиц бд, знаю зачем используется get_lock, release_lock могу написать скрипт с гарантией единовременного выполнения одного экземпляра с использованием бд.
- Знаю и могу рассказать необходимость inner join, left/right join, join condition - нужны примеры.
- Знаю и могу на примере рассказать необходимость первых 4 нормальных форм.
- Unix less, wc, screen, mc.
- Могу рассказать и на примере показать, какие права на файлы бывают в linux (все четыре группы)
- Знаю, как посмотреть текущего пользователя, список всех пользователей и список всех групп.
- Знаю, как посмотреть код возврата команды. Могу рассказать, зачем он нужен и что он означает.


## Задача:
### Развернуть проект на laravel.

1. В нём сделать страницу, которая вешает несколько кук (одна висит до закрытия браузера, другая висит час);
    - все куки для конкретного домена, исключая поддомены;
    - в куках хранятся числа;
    - при входе на страницу число в куке увеличивается на единицу и сохраняется.
    - на странице есть поле ввода и кнопка, которая позволяет ввести число для выбранной куки и установить его (с валидацией
через formRequest и отображением ошибок alert).
    - кнопка работает с помощью jquery ajax.
    - куксервис сделать в виде синглтона.

2. Так же на странице вывести форму, в которой можно вводить слово, и при нажатии кнопки в поле ниже отображается слово
   разложенное на буквы, склеенные через пробел.

3. Так же на странице вывести форму, в которой вводится текст, содержащий русские даты вида `21.01.1991`. При нажатии
   на кнопку бэк меняет месяц и год местами в датах и текст в поле становится новым.

4. Создать таблицу заметок (имя, контент) с `fulltext` индексом. Создать отдельную страницу с crud-формой, где можно
   отображать записи и искать их с помощью полнотекстового поиска.

5. Создать страницу, где будет выведен результат работы с датой и временем (по градации - просто вывод того, что там
   требуется, без ввода своих данных).

6. Создать страницу, где выведен результат сортировки пузырьком массива случайных чисел (100 штук).

7. Создать консольный скрипт, который проверяет, запущен ли он с помощью блокировки внутри бд.

-----
## Найти ответы на вопросы:

- Могу показать, какие сейчас выполняются запросы на сервере.
- Могу построить корректный url из параметров в массиве.
- Знаю из чего состоит http-запрос и http-ответ (стартовая строка, заголовки, тело)
- Знаю и могу рассказать необходимость `inner join`, `left/right join`, `join condition` - нужны примеры
- Unix `less`, `wc`, `screen`, `mc`
- Могу рассказать и на примере показать, какие права на файлы бывают в linux (все четыре группы)
- Знаю, как посмотреть текущего пользователя, список всех пользователей и список всех групп.
- Знаю, как посмотреть код возврата команды. Могу рассказать, зачем он нужен и что он означает.
- Знаю и могу на примере рассказать необходимость первых 4 нормальных форм

- Могу добавить своё соответствие класс-интерфейс в контейнер, используя сервис-провайдер. Могу модифицировать поведение встроенного http-клиента laravel с помощью внедрения зависимости в провайдере.
- Могу поймать и логировать запрос на моментах: любой запрос к приложению, до роутинга, до старта сессии, после проверки на csrf
- Могу сделать так, чтобы запросы с get-параметром ?bad=1 не доходили до роутинга, возвращали ошибку 403.
- В состоянии объяснить контент файла Http/Kernel.php
- Могу написать простой http-кэш, который работая с memcached, отрабатывает до роутинга, но не кэширует никакие статусы кроме успешных (200).
- Могу написать приложение с 3 связанными моделями, в котором будут связи: один к одному, один ко многим, многие ко многим, полиморфная. Будет crud для удаления и добавления связанных элементов по условию.
- Умение установить и настроить админку (одну любую)
- Могу написать апи, в котором у запроса будет валидация входных параметров, а для ответа будет использоваться Resource.
- Могу сформировать ссылку на маршрут, используя route, ссылку с параметрами, относительную и абсолютную ссылку.
- Могу выбрать одно поле у коллекции моделей, могу выбрать модель с максимальным значением одного поля, могу отфильтровать модели по значению одного поля.
- Могу написать scope и выбрать модель, используя scope.
- Могу написать сброс всего кэша приложения, который срабатывает при изменении любой модели.
- Могу кастомизировать `view` из пакета.


## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 1500 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[Many](https://www.many.co.uk)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[OP.GG](https://op.gg)**
- **[CMS Max](https://www.cmsmax.com/)**
- **[WebReinvent](https://webreinvent.com/?utm_source=laravel&utm_medium=github&utm_campaign=patreon-sponsors)**
- **[Lendio](https://lendio.com)**
- **[Romega Software](https://romegasoftware.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
