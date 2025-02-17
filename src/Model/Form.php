<?php
/**
 * Этот файл является частью расширения модуля веб-приложения GearMagic.
 * 
 * @link https://gearmagic.ru
 * @copyright Copyright (c) 2015 Веб-студия GearMagic
 * @license https://gearmagic.ru/license/
 */

namespace Gm\Backend\Config\Url\Model;

use Gm;
use Gm\Backend\Config\Model\ServiceForm;

/**
 * Модель данных конфигурации службы "Маршрутизация".
 * 
 * Cлужба {@see \Gm\Url\UrlManager}, {@see \Gm\Url\UrlRules}.
 * 
 * @author Anton Tivonenko <anton.tivonenko@gmail.com>
 * @package Gm\Backend\Config\Url\Model
 * @since 1.0
 */
class Form extends ServiceForm
{
    /**
     * {@inheritdoc}
     */
    public function init(): void
    {
        parent::init();

        $this->unifiedName = Gm::$app->urlManager->getObjectName();
    }

    /**
     * {@inheritdoc}
     */
    public function maskedAttributes(): array
    {
        return [
            'browserHistory' => 'browserHistory', // история перехода между компонентами
            // Общие правила формирования URL-адреса
            'enablePrettyUrl'     => 'enablePrettyUrl', // ЧПУ для получения красивых URL-адресов
            'enableTrailingSlash' => 'enableTrailingSlash', // слеш в конце URL-адреса
            'showScriptName'      => 'showScriptName', // показывать имя скрипта в URL-адресе
            'routeParam'          => 'routeParam', // параметр запроса URL-адреса
            // Правила формирования постоянных ссылок категорий и статей
            'ruleName'  => 'rule', // имя правила

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function formatterRules(): array
    {
        return [
            [['routeParam'], 'safe'],
            [
                ['browserHistory', 'enablePrettyUrl', 'enableTrailingSlash', 'showScriptName'], 
                 'logic' => [true, false]
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function validationRules(): array
    {
        return [
            [
                ['routeParam', 'ruleName'], 
                'notEmpty'
            ]
        ];
    }

    public function resetConfig(): void
    {
        Gm::$app->unifiedConfig->remove('urlRules');

        parent::resetConfig();
    }

    /**
     * {@inheritdoc}
     */
    public function saveConfig(?array $parameters): static
    {
        $urlManager = $parameters;
        $urlRules   = [];

        if (isset($urlManager['rule'])) {
            $urlRules['rule'] = $urlManager['rule'];
            unset($urlManager['rule']);
        }
        // для службы: \Gm\Url\UrlManager
        Gm::$app->unifiedConfig->{$this->unifiedName} = $urlManager;
        // для службы: \Gm\Url\UrlRules
        if ($urlRules) {
            Gm::$app->unifiedConfig->{'urlRules'} = $urlRules;
        }
        Gm::$app->unifiedConfig->save();
        return $this;
    }
}
