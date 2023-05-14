##Тестовое задание PHP
    
   Необходимо разработать каталог товаров, корзину и заказы для интернет-
магазина с использованием фреймворка Laravel. Реализовать для него JSON API
с поддержкой авторизации через JWT токены.

##Требования к структуре каталога.
    
   Каталог состоит из дерева категорий (максимальная вложенность – 3) и товаров,
которые принадлежат к одной из категорий второго/третьего уровня. Товары
должны иметь название, описание, автогенерируемый slug, категорию второго/
третьего уровня, цену и несколько дополнительных характеристик (например
длину, ширину, вес).

##Требования к корзине и заказам.

   Взаимодействовать с корзиной и оформлять заказы могут как авторизованные, так
и неавторизованные пользователи. Заказы должны содержать контактную
информацию покупателя (например, email и телефон), а также список купленных
товаров. Для авторизированных пользователей контактная информация должна
подтягиваться из профиля автоматически.

##Рекомендуемый состав методов API.
    -Методы для регистрации/авторизации пользователей.
    -Метод для получения дерева категорий.
    -Метод для получения товаров с фильтрацией по категории/категориям любого
     уровня, а также по цене и дополнительным характеристикам. Значения
     фильтров должны валидироваться.
    -Метод для получения товара по slug.
    -Методы для работы с корзиной (добавление товара, редактирование
     количества товара/товаров, удаление товара).
    -Метод для оформления заказа.
    -Метод для получения списка заказов авторизованного пользователя.
