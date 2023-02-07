## Описание

Этот проект является решением тестового задания от компании Perfect Panel.
Задание доступно по ссылке: https://docs.google.com/document/d/12-fuxHCodTHYEch_3JKTZgkD55aSSrOHKyhgjvMZk14/edit?usp=sharing


## Задание 1

SELECT 
    users.id as ID,
    CONCAT(users.first_name, " ", users.last_name) as Name,
    books.author as Author,
    GROUP_CONCAT(books.name) as Books
FROM
    users
LEFT JOIN user_books on users.id = user_books.user_id
LEFT JOIN books on user_books.book_id = books.id
WHERE
    users.age > 7
    OR users.age < 17
HAVING
    COUNT(books.id) = 2
GROUP BY
    books.author;


## Задание 2

В качестве фреймворка использую Laravel 9.
Инструкция по развёртыванию вот тут в документации https://laravel.com/docs/9.x#getting-started-on-linux

Предварительная настройка:
1. В .env добавить строку (или любую другую по вашему усмотрению)
```
API_TOKEN='v4dfhm9yna6no0ngxeep___vwvnyh3l4g6fydl5WQ118rnno-7kd1s9mrkis2ust'
```
2. В папке с проектом выполнить 
```
sudo chmod -R 777 storage/logs/
```


Чтобы запустить приложение делаем так:
1. ./vendor/bin/sail up -d
2. В браузере открываем http://localhost
3. Profit!