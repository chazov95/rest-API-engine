# Движок для REST-API проектов

##Standarts
###PSR
- Logger: PSR-3 https://www.php-fig.org/psr/psr-3
- Autoload: PSR-4 https://www.php-fig.org/psr/psr-4
- Container Interface: PSR-11 https://www.php-fig.org/psr/psr-11

## Requirements

- ^PHP 8.0

###php extentions
- MySQLi https://www.php.net/manual/ru/book.mysqli.php
- Yaml https://www.php.net/manual/ru/book.yaml.php

##Routs format:
'json:                                                 - тип (html/json)
  blog_list:                                          - название маршрута
    path:       /blog/{page}                          - путь
    controller: App\Controller\BlogController::list   - используемый контроллер и метод в нем
    methods:    GET|HEAD                              - метод запроса
    defaults:                                         - значение по умолчанию
      page: 1                                         - в параметр {page}, по умолчанию будет подставлено значение 1
    requirements:                                     - валидация
      page: '\d+'                                     - параметр {page} должен соответствовать регулярному выражению '\d+'

### Структура контейнера

Сервисы в контейнере лежат в массиве с двумя главными ключами
[
tag_object => [], В этом массиве ключом является тэг. Он нужен, чтобы хранить неограниченное кол-во экземпляров одного сервиса
fqn_object => [], В этом массиве ключом является FQN. В нем может находиться только один экземпляр одного сервиса
]

Метод has контейнера проверят наличие сервиса в fqn_object
Метод hasByTag контейнера проверят наличие сервиса в tag_object