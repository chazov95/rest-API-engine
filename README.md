# Движок для REST-API проектов
Движок разработан для проектов с чистым разделением фронта от бэка. Движок поддерживает grafQL и rest api подходы.
Весь движок является автономным и не имеет внешних зависимостей (composer не нужен)


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

##Планы

- PSR DI контейнер c автовайрингом
- PSR Логгер
- PSR обертка над curl
- Генератор контракта
- Движок для тестирования
- Query builder
- Cli
- Поддержка коммандов
- Поддержка очередей на redis
- Поддержка GrafQL
- Настоенный контейнер для локальной разработки
- настроенные квалити-тулз
- мидлвары


Движок запрещает использование метода GET, так как этот метод запрещает передачу тела запроса.
Для получения данных сервера нужно использовать неиденпотентный метод POST.
Иденпотентные методы получения данных обозначаются в конктракте меткой "Idenpotent"

Пример ДТО 

```
class ContractMethodDto extends AbstractRequestDto
{
#[ObjectArrayType(Foo::class)]
public array $test;
public string $class;
}
```