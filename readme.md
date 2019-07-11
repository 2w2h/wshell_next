## Доменные компоненты

* social
* units

## Сервисы

* front - Весь фронтенд, php api (Laravel)
* router - организует одноранговую сеть для обмена сообщениями в реальном времени (Web Application Message Protocol)
  https://github.com/gammazero/nexus/wiki
* redis - кэш, очереди, сессии
* mongo - база данных
* core - вычислительный узел c контейнерами, может иметь роль - master/slave

## front

апи - https://habr.com/ru/post/441946/
фронт - своя система компонент


### Кейсы

Создать модель:

php artisan make:model Social/Message
