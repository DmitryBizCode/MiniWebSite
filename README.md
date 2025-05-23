# MiniWebSite
Це простий PHP-проєкт для збору лідів із веб-форми.

## Особливості

- Валідація на клієнтській стороні для:
    - Імені
    - Прізвища
    - Телефону (з використанням `intl-tel-input`)
    - Email
- Відправка форми через `fetch` без перезавантаження сторінки
- Після успішної відправки:
    - Виводиться `alert` з ID та Email
    - Поля форми очищуються
- Перегляд статусів лідів на окремій сторінці `/statuses`
- Простий роутинг у файлі `index.php`
- Автоматичне форматування коду з допомогою PHP CS Fixer
- Docker-ready середовище за допомогою `phpdocker`

## Структура проєкту
    phpdocker/                # Docker конфігурація (nginx, php-fpm)
    ├── nginx/
    ├── php-fpm/
    src/                      # Код проєкту
    ├── Controllers/          # Контролери (LeadController.php, StatusController.php)
    ├── Services/
    │   └── Api/              # API сервіси (ApiService.php)
    └── Views/                # HTML-в'юхи
    vendor/                   # Composer залежності
    form.php                  # Форма додавання ліда
    statuses.php              # Сторінка статусів
    index.php                 # Головний роутер

## Вимоги

- PHP >= 8.1
- Composer
- Docker (опціонально для локального запуску)

## Встановлення

1. Клонувати репозиторій:
   ```bash
   git clone https://github.com/DmitryBizCode/MiniWebSite.git
   cd MiniWebSite
