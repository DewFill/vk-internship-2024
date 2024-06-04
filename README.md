# Описание прототипа API по оформлению заказа
## Интерфейсы
### DatabaseInterface - Определяет методы для работы с базой данных

* ```query(string $sql, array $params = [])``` - Выполнение SQL-запроса.
* ```beginTransaction()``` - Начало транзакции.
* ```commit()``` - Завершение транзакции.
* ```rollBack()``` - Откат транзакции.
___
### CustomerRepositoryInterface - Определяет методы для работы с клиентами

* ```getCustomerById($customerId)``` - Получение данных клиента по его ID.
___

### ProductRepositoryInterface - Определяет методы для работы с продуктами

* ```getProductById($productId)``` - Получение данных о продукте по его ID.
* ```getProductVersion($productId)``` - Получение версии продукта.
* ```updateProductQuantity($productId, $quantity)``` - Обновление количества продукта.
___

### OrderRepositoryInterface - Определяет методы для работы с заказами

* ```createOrder(int $customerId, array $products, int $city_id)``` - Создание нового заказа.
* ```getOrderById(int $orderId)``` - Получение данных о заказе по его ID.
___

### S3RepositoryInterface - Определяет методы для работы с S3-хранилищем

* ```uploadFile($filePath, $fileName, $mimeType)``` - Загрузка файла в S3.
* ```getFileUrl($fileId)``` - Получение URL файла из S3.


## Классы
### MySQLDatabase
Реализация интерфейса DatabaseInterface для работы с базой данных MySQL.
___
### CustomerRepository
Реализация интерфейса CustomerRepositoryInterface для управления данными клиентов.
___
### ProductRepository
Реализация интерфейса ProductRepositoryInterface для управления данными о продуктах.
___
### OrderRepository
Реализация интерфейса OrderRepositoryInterface для управления заказами.
___
### S3Repository
Реализация интерфейса S3RepositoryInterface для работы с S3-хранилищем.
___
### OrderService
Сервис для управления процессом оформления заказа, использует репозитории клиентов, продуктов и заказов, а также S3-хранилище.

## Процесс создания заказа
### Инициализация баз данных и репозиториев:
* Создаются экземпляры MySQLDatabase, CustomerRepository, ProductRepository и OrderRepository.
* Создается клиент S3 и экземпляр S3Repository.

### Создание сервиса заказов:
* Создается экземпляр OrderService, который принимает на вход все репозитории и S3-хранилище.

### Процесс оформления заказа:

#### Метод checkout в OrderService выполняет следующие шаги:
* Получает данные клиента по его ID через CustomerRepository.
* Проверяет, что клиент существует.
* Получает данные о продуктах, проверяет их наличие и доступное количество через ProductRepository.
* Создает новый заказ через OrderRepository.
* Обновляет количество продуктов на складе через ProductRepository.
* При необходимости, загружает файлы в S3-хранилище через S3Repository.

## Взаимодействие компонентов
* Сервис заказов (OrderService) координирует все взаимодействия между репозиториями и S3-хранилищем для выполнения процесса создания заказа.
* Репозитории (CustomerRepository, ProductRepository, OrderRepository) управляют доступом к данным и обеспечивают транзакционную целостность.
* S3-хранилище используется для загрузки и хранения файлов, связанных с заказами (например, фотографии товаров).