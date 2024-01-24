# PHP developer Test Task

Welcome to the PHP test task!

## Task Description

Тестовое задание:
Задание Разработка RESTful API на основе Laravel или Lumen
Описание Вашей задачей является создание простого RESTful API для управления списком задач (To-Do list). API должно предоставлять функционал добавления, просмотра, обновления и удаления задач.
Требования:
- Использование Laravel или Lumen для разработки;
- Реализовать следующие эндпоинты:
- Получения списка всех задач;
- Добавления новой задачи;
- Получения информации о конкретной задаче;
- Обновления данных задачи;
- Удаления задачи.
- Использовать базу данных для хранения данных о задачах;
- Реализуйте базовую аутентификацию для доступа к API;
- Документируйте API с использованием Swagger. В проекте должен быть файл на yaml или json с документацией;
- Обеспечьте обработку ошибок и возврат соответствующих HTTP статусов;
- Предоставьте инструкции по развертыванию и запуску приложения.
Опционально (выделит вас среди других), на выбор:
- Реализовать возможность масштабирование системы при помощи плагинов. Реализовать 1 плагин для демонстрации работоспособности решения. Как пример, плагин будет отвечать за логирование запросов;
- Реализовать возможность реализации событий. Создать эндпоинт(ы) для регистрации/удаления события.


## Instructions

**Requirements:**
 - "php": "^8.1"
 - "composer": "^2.0"

**Clone the Repository:**
Clone this repository to your local machine using the following command:
```bash
git clone https://github.com/Gohar13/todo-list.git
```
**Setup:**
1. Install all the dependencies using composer
   ```
   composer install
   ```

2. Copy the example env file and make the required configuration changes in the .env file
   ```
   cp .env.example .env
   ```
3. Add API_KEY in .env file

4. Generate a new application key
   ```
   php artisan key:generate
   ```
   
5. Run the database migrations (**Set the database connection in .env before migrating**)
   ```
   php artisan migrate
   ```

6. Run seeders
   ```
   php artisan db:seed
   ```
   
7. Generate swagger
   ```
   php artisan l5-swagger:generate
   ```
8. Generated api doc located in storage/api-docs/api-docs.json

9. Start the local development server
   ```
   php artisan serve
   ```
