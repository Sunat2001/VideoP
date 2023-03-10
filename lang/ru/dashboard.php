<?php

return [
    /**
     * Dashboard
     */
    'home' => 'Главная',
    'more_info' => 'Подробнее',
    'serials' => 'Сериалы',
    'users' => 'Пользователи',
    'attributes' => 'Атрибуты',
    'attribute_values' => 'Значения атрибутов',
    'avg_rates' => 'Средний рейтинг сериалов',
    'reviews' => 'Отзывы',
    'actions' => 'Действия',
    'close' => 'Закрыть',
    'save' => 'Сохранить',
    'delete' => 'Удалить',
    'edit' => 'Редактировать',
    'browse' => 'Выбрать',
    'profile' => 'Профиль',
    'yes' => 'Да',
    'no' => 'Нет',
    'rate' => 'Рейтинг',
    'description' => 'Описание',
    'id' => 'ID',
    'files' => 'Файлы',
    'file_name' => 'Имя файла',
    'file_size' => 'Размер файла',
    'file_type' => 'Тип файла',
    'select' => 'Выберите',

    /**
     * Dashboard/Language
     */
    'en' => 'Английский',
    'ru' => 'Русский',

    /**
     * Dashboard/Delete Dialog
     */
    'delete_dialog_title' => 'Удаление',
    'delete_dialog_message' => 'Вы уверены, что хотите удалить этот элемент?',
    'delete_dialog_cancel' => 'Отмена',
    'delete_dialog_confirm' => 'Удалить',

    'user' => [
        'id' => 'ID',
        'name' => 'Имя',
        'email' => 'Email',
        'password' => 'Пароль',
        'image' => 'Изображение',
        'email_verified_at' => 'Время верификации Email',
        'is_admin' => 'Администратор',
        'language' => 'Язык',
        'created_at' => 'Время создания',
        'updated_at' => 'Время обновления',
        'add' => 'Добавить пользователя',

        'placeholder' => [
            'name' => 'Введите имя',
            'email' => 'Введите email',
            'password' => 'Введите пароль',
            'image' => 'Выберите изображение',
            'is_admin' => 'Является ли пользователь администратором',
            'language' => 'Выберите язык',
        ],

        'message' => [
            'created' => 'Пользователь успешно создан',
            'updated' => 'Пользователь успешно обновлен',
            'deleted' => 'Пользователь успешно удален',
        ],
    ],

    'serial' => [
        'id' => 'ID',
        'name' => 'Название',
        'image' => 'Изображение',
        'created_at' => 'Время создания',
        'updated_at' => 'Время обновления',
        'add' => 'Добавить сериал',
        'edit' => 'Редактировать сериал',
        'delete' => 'Удалить сериал',
        'episode_count' => 'Количество эпизодов',
        'season_count' => 'Количество сезонов',
        'best_review' => 'Лучший отзыв',
        'serial_info' => 'Информация о сериале',
        'episodes' => 'Эпизоды',
        'seasons' => 'Сезоны',

        'message' => [
            'created' => 'Сериал успешно создан',
            'updated' => 'Сериал успешно обновлен',
            'deleted' => 'Сериал успешно удален',
        ],

        'placeholder' => [
            'name' => 'Введите название сериала',
            'image' => 'Выберите изображение',
            'attribute_value' => 'Выберите значение атрибута',
        ],
    ],

    'season' => [
        'season_number' => 'Номер сезона',
        'created_at' => 'Время создания',
        'updated_at' => 'Время обновления',
        'add' => 'Добавить сезон',
        'edit' => 'Редактировать сезон',
        'delete' => 'Удалить сезон',
        'episode_count' => 'Количество эпизодов',
        'season_info' => 'Информация о сезоне',
        'episodes' => 'Эпизоды',
        'is_final' => 'Финальный сезон',
        'year' => 'Год',
    ],

    'episode' => [
        'episode_number' => 'Номер эпизода',
        'created_at' => 'Время создания',
        'updated_at' => 'Время обновления',
        'add' => 'Добавить эпизод',
        'edit' => 'Редактировать эпизод',
        'delete' => 'Удалить эпизод',
        'episode_info' => 'Информация об эпизоде',
    ],

    'review' => [
        'text' => 'Текст отзыва',
        'is_best' => 'Лучший отзыв',
        'status' => 'Статус',
        'user' => 'Пользователь',
        'serial' => 'Сериал',
        'all' => 'Все',
        'on_moderation' => 'На модерации',
        'pass_moderation' => 'Модерация пройдена',
        'rejected' => 'Отклоненные отзывы',
        'created_at' => 'Время создания',
        'updated_at' => 'Время обновления',

        'message' => [
            'deleted' => 'Отзыв успешно удален',
            'approved' => 'Отзыв успешно одобрен',
            'rejected' => 'Отзыв успешно отклонен',
            'error_review_must_be_approved' => 'Отзыв должен быть одобрен',
            'error_best_review_already_exist' => 'У сериала лучший отзыв уже существует',
            'best_review_changed' => 'Лучший отзыв успешно изменен',
        ],
    ],
];
