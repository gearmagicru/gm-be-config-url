<?php
/**
 * Этот файл является частью расширения модуля веб-приложения GearMagic.
 * 
 * Пакет русской локализации.
 * 
 * @link https://gearmagic.ru
 * @copyright Copyright (c) 2015 Веб-студия GearMagic
 * @license https://gearmagic.ru/license/
 */

return [
    '{name}'        => 'Маршрутизация',
    '{description}' => 'Правила формирования URL-адреса',
    '{permissions}' => [
        'any'  => ['Полный доступ', 'Настройка маршрутизации']
    ],

    // Form: поля
    'Post' => 'Статья',
    'Category' => 'Категория',
    '{boxLabelRule}' => '<div class="g-setting__rule"><em>Статья:</em> {0}</div><div class="g-setting__rule"><em>Категория:</em> {1}</div>',
    'General URL generation rules' => 'Общие правила формирования URL-адреса',
    'SEF to get beautiful URLs' => 'ЧПУ для получения красивых URL-адресов',
    'Slash at the end of the URL' => 'Cлеш в конце URL-адреса',
    'Main script ({0}) in url' => 'Имя скрипта ({0}) в URL-адресе',
    'URL types' => 'Варианты URL-адреса',
    'Rules for generating permalinks of categories and articles' => 'Правила формирования постоянных ссылок категорий и статей',
    '{rules}' => [
        'ArticleNameExt' => 'Название статьи (.html)',
        'CategoryAndArticleNameExt' => 'Название категории и статьи (.html)',
        'CategoryAndArticleName' => 'Название категории и статьи',
        'DirectArticleNameExt' => 'Название статьи (.html) с указателем',
        'DirectArticleName' => 'Название статьи с указателем',
        'DirectArticleId' => 'Идентификатор статьи с указателем',
        'DateArticleName' => 'Дата с названием статьи',
        'MonthArticleName' => 'Дата (месяц) с названием статьи',
        'Plain' => 'Простые',
    ],
    'Save the transition history between modules in the control panel' => 'Вести историю переходов между модулями панели управления',
    'If the application is not in the root directory but in the specified' => 'Если приложение находится не в корневой директории, а в указанной',
    'Application URL' => 'URL-адрес приложения',
    'Directory Name / base URL-path' => 'Имя директории / базовый URL-путь',
    'Base URL-path (BASE_URL) is changed only manually in the script &laquo;bootstrap&raquo;' 
        => 'Базовый URL-путь (BASE_URL) изменяются только &laquo;вручную&raquo; в сценарии &laquo;bootstrap&raquo; загрузчика',
    'Application Base URL' => 'Базовый URL-путь приложения',
    'Base URL of module resources' => 'Базовый URL-путь ресурсов модулей',
    'Global configuration settings are changed only manually in the bootloader script' 
        => 'Глобальные параметры конфигурации изменяются только &laquo;вручную&raquo; в сценарии &laquo;bootstrap&raquo; загрузчика',
    'reset settings' => 'сбросить настройки',
    // Form: сообщения / заголовки
    'Save settings' => 'Сохранение настроек',
    'Reset settings' => 'Сброс настроек',
    // Form: сообщения / текст
    'settings saved {0} successfully' => 'успешное сохранение настроек "<b>{0}</b>"',
    'settings reseted {0} successfully' => 'успешный сброс настроек "<b>{0}</b>"'
];
