# Движок для REST-API проектов

##Поддерживаемые стандарты
###PSR
- Logger: PSR-3 https://www.php-fig.org/psr/psr-3
- Autoload: PSR-4 https://www.php-fig.org/psr/psr-4
- Container Interface: PSR-11 https://www.php-fig.org/psr/psr-11

###YAML
- 1.2.1 https://yaml.org/spec/1.2.1/

## Требования

- ^PHP 8.0

###php extentions
- MySQLi https://www.php.net/manual/ru/book.mysqli.php
- Yaml https://www.php.net/manual/ru/book.yaml.php

##Формат описания роута:
json:                                                 - тип (html/json)
  blog_list:                                          - название маршрута
    path:       /blog/{page}                          - путь
    controller: App\Controller\BlogController::list   - используемый контроллер и метод в нем
    methods:    GET|HEAD                              - метод запроса
    defaults:                                         - значение по умолчанию
      page: 1                                         - в параметр {page}, по умолчанию будет подставлено значение 1
    requirements:                                     - валидация
      page: '\d+'                                     - параметр {page} должен соответствовать регулярному выражению '\d+'