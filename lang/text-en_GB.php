<?php
/**
 * Этот файл является частью расширения модуля веб-приложения GearMagic.
 * 
 * Пакет английской (британской) локализации.
 * 
 * @link https://gearmagic.ru
 * @copyright Copyright (c) 2015 Веб-студия GearMagic
 * @license https://gearmagic.ru/license/
 */

return [
    '{name}'        => 'Routing',
    '{description}' => 'Setting URL generation rules',
    '{permissions}' => [
        'any'  => ['Full access', 'Configuring routing']
    ],

    // Form: поля
    'Post' => 'Post',
    'Category' => 'Category',
    '{boxLabelRule}' => '<div class="g-setting__rule"><em>Post:</em> {0}</div><div class="g-setting__rule"><em>Category:</em> {1}</div>',
    'General URL generation rules' => 'General URL Generation Rules',
    'SEF to get beautiful URLs' => 'SEF to get beautiful URLs',
    'Slash at the end of the URL' => 'Slash at the end of the URL',
    'Main script ({0}) in url' => 'Script name ({0}) in the URL',
    'URL types' => 'URL types',
    'Rules for generating permalinks of categories and articles' => 'Rules for generating permalinks of categories and articles',
    '{rules}' => [
        'ArticleNameExt' => 'Post name (.html)',
        'CategoryAndArticleNameExt' => 'Post and category name (.html)',
        'CategoryAndArticleName' => 'Post and category name',
        'DirectArticleNameExt' => 'Direct post name (.html)',
        'DirectArticleName' => 'Direct post name',
        'DirectArticleId' => 'ID of the direcot post',
        'DateArticleName' => 'Date with post name',
        'MonthArticleName' => 'Date (month) with post name',
        'Plain' => 'Plain',
    ],
    'Save the transition history between modules in the control panel' => 'Save the transition history between modules in the control panel',
    'If the application is not in the root directory but in the specified' => 'If the application is not in the root directory but in the specified',
    'Application URL' => 'Application URL',
    'Directory Name / base URL-path' => 'Directory Name / base URL-path',
    'Base URL-path (BASE_URL) is changed only manually in the script &laquo;bootstrap&raquo;' 
        => 'Base URL-path (BASE_URL) is changed only manually in the script &laquo;bootstrap&raquo;',
    'Application Base URL' => 'Application Base URL',
    'Base URL of module resources' => 'Base URL of module resources',
    'Global configuration settings are changed only manually in the bootloader script' 
        => 'Global configuration settings are changed only manually in the bootloader script',
    'reset settings' => 'сбросить настройки',
    // Form: сообщения / заголовки
    'Save settings' => 'Сохранение настроек',
    'Reset settings' => 'Сброс настроек',
    // Form: сообщения / текст
    'settings saved {0} successfully' => 'успешное сохранение настроек "<b>{0}</b>"',
    'settings reseted {0} successfully' => 'успешный сброс настроек "<b>{0}</b>"'
];
