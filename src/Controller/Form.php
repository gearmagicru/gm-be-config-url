<?php
/**
 * Этот файл является частью расширения модуля веб-приложения GearMagic.
 * 
 * @link https://gearmagic.ru
 * @copyright Copyright (c) 2015 Веб-студия GearMagic
 * @license https://gearmagic.ru/license/
 */

namespace Gm\Backend\Config\Url\Controller;

use Gm;
use Gm\Helper\Url;
use Gm\Panel\Widget\EditWindow;
use Gm\Backend\Config\Controller\ServiceForm;

/**
 * Контроллер конфигурации службы "Маршрутизация".
 * 
 * Cлужба {@see \Gm\Url\UrlManager}, {@see \Gm\Url\UrlRules}.
 * 
 * @author Anton Tivonenko <anton.tivonenko@gmail.com>
 * @package Gm\Backend\Config\Url\Controller
 * @since 1.0
 */
class Form extends ServiceForm
{
    /**
     * Возвращает варианты URL-адреса.
     * 
     * @return array
     */
    protected function getUrlVariations(): array
    {
        $url  = Gm::$app->urlManager;
        $path = $url->backendRoute . '/workspace';
        return [
            [
                $url->buildUrl(['path' => $path], ['enablePrettyUrl' => false, 'enableTrailingSlash' => false, 'showScriptName' => false]),
                !$url->enablePrettyUrl && !$url->enableTrailingSlash && !$url->showScriptName
            ],
            [
                $url->buildUrl(['path' => $path], ['enablePrettyUrl' => false, 'enableTrailingSlash' => true, 'showScriptName' => false]),
                !$url->enablePrettyUrl && $url->enableTrailingSlash && !$url->showScriptName
            ],
            [
                $url->buildUrl(['path' => $path], ['enablePrettyUrl' => false, 'enableTrailingSlash' => false, 'showScriptName' => true]),
                !$url->enablePrettyUrl && !$url->enableTrailingSlash && $url->showScriptName
            ],
            [
                $url->buildUrl(['path' => $path], ['enablePrettyUrl' => false, 'enableTrailingSlash' => true, 'showScriptName' => true]),
                !$url->enablePrettyUrl && $url->enableTrailingSlash && $url->showScriptName
            ],
            [
                $url->buildUrl(['path' => $path], ['enablePrettyUrl' => true, 'enableTrailingSlash' => false, 'showScriptName' => false]),
                $url->enablePrettyUrl && !$url->enableTrailingSlash && !$url->showScriptName
            ],
            [
                $url->buildUrl(['path' => $path], ['enablePrettyUrl' => true, 'enableTrailingSlash' => true, 'showScriptName' => false]),
                $url->enablePrettyUrl && $url->enableTrailingSlash && !$url->showScriptName
            ],
            [
                $url->buildUrl(['path' => $path], ['enablePrettyUrl' => true, 'enableTrailingSlash' => false, 'showScriptName' => true]),
                $url->enablePrettyUrl && !$url->enableTrailingSlash && $url->showScriptName
            ],
            [
                $url->buildUrl(['path' => $path], ['enablePrettyUrl' => true, 'enableTrailingSlash' => true, 'showScriptName' => true]),
                $url->enablePrettyUrl && $url->enableTrailingSlash && $url->showScriptName
            ]
        ];
    }

    /**
     * Возвращает элементы панели формы (Gm.view.form.Panel GmJS).
     * 
     * @return array
     */
    protected function getFormItems($window): array
    {
        /** @var \Gm\Url\UrlManager $url */
        $url = Gm::$app->urlManager;

        /** @var string $fieldActiveCls Подсветка выбранного правила  */
        $fieldActiveCls = 'g-configuration__rule--active';
        /** @var string $fieldCls Стиль поля с правилом */
        $fieldCls = 'gm-config-url__rule';
        /** @var string $formId Идент. виджета формы */
        $formId = $window->form->id;

        /** @var array $urlVariations Варианты URL-адреса */
        $urlVariations = $this->getUrlVariations();
        /** @var array $translateRules Имена правио */
        $translateRules = $this->module->t('{rules}');
        return [
            [
                'xtype'       => 'fieldset',
                'title'       => '#General URL generation rules',
                'collapsible' => true,
                'defaults'    => [
                    'labelAlign' => 'right',
                    'labelWidth' => 240
                ],
                'items' => [
                    [
                        'xtype'      => 'checkbox',
                        'fieldLabel' => '#SEF to get beautiful URLs',
                        'labelWidth' => 280,
                        'id'         => $formId . '__enablePrettyUrl',
                        'name'       => 'enablePrettyUrl',
                        'ui'         => 'switch',
                        'checked'    => $url->enablePrettyUrl,
                        'listeners'  => ['change' => 'onSetCommonRuleUrl'],
                        'inputValue' => 1
                    ],
                    [
                        'xtype'      => 'checkbox',
                        'fieldLabel' => '#Slash at the end of the URL',
                        'labelWidth' => 280,
                        'id'         => $formId . '__enableTrailingSlash',
                        'name'       => 'enableTrailingSlash',
                        'ui'         => 'switch',
                        'checked'    => $url->enableTrailingSlash,
                        'listeners'  => ['change' => 'onSetCommonRuleUrl'],
                        'inputValue' => 1
                    ],
                    [
                        'xtype'      => 'checkbox',
                        'fieldLabel' => $this->module->t('Main script ({0}) in url', [Url::scriptName()]),
                        'labelWidth' => 280,
                        'id'         => $formId . '__showScriptName',
                        'name'       => 'showScriptName',
                        'ui'         => 'switch',
                        'checked'    => $url->showScriptName,
                        'listeners'  => ['change' => 'onSetCommonRuleUrl'],
                        'inputValue' => 1
                    ],
                    [
                        'xtype'      => 'textfield',
                        'fieldLabel' => 'Параметр запроса URL-адреса',
                        'name'       => 'routeParam',
                        'labelWidth' => 280,
                        'width'      => 330,
                        'value'      => $url->routeParam,
                        'allowBlank' => false
                    ],
                    [
                        'xtype' => 'label',
                        'ui'    => 'header-line',
                        'text'  => '#URL types',
                    ],
                    [
                        'xtype'    => 'displayfield',
                        'id'       => $formId . '__viewRule1',
                        'cls'      => $urlVariations[0][1] ? $fieldActiveCls : '',
                        'fieldCls' => $fieldCls,
                        'width'    => '100%',
                        'value'    => '<span>1</span> ' . $urlVariations[0][0] 
                    ],
                    [
                        'xtype'    => 'displayfield',
                        'id'       => $formId . '__viewRule2',
                        'cls'      => $urlVariations[1][1] ? $fieldActiveCls : '',
                        'fieldCls' => $fieldCls,
                        'value'    => '<span>2</span> ' . $urlVariations[1][0]
                    ],
                    [
                        'xtype'    => 'displayfield',
                        'id'       => $formId . '__viewRule3',
                        'cls'      => $urlVariations[2][1] ? $fieldActiveCls : '',
                        'fieldCls' => $fieldCls,
                        'value'    => '<span>3</span> ' . $urlVariations[2][0]
                    ],
                    [
                        'xtype'    => 'displayfield',
                        'id'       => $formId . '__viewRule4',
                        'cls'      => $urlVariations[3][1] ? $fieldActiveCls : '',
                        'fieldCls' => $fieldCls,
                        'value'    => '<span>4</span> ' . $urlVariations[3][0]
                    ],
                    [
                        'xtype'    => 'displayfield',
                        'id'       => $formId . '__viewRule5',
                        'cls'      => $urlVariations[4][1] ? $fieldActiveCls : '',
                        'fieldCls' => $fieldCls,
                        'value'    => '<span>5</span> ' . $urlVariations[4][0]
                    ],
                    [
                        'xtype'    => 'displayfield',
                        'id'       => $formId . '__viewRule6',
                        'cls'      => $urlVariations[5][1] ? $fieldActiveCls : '',
                        'fieldCls' => $fieldCls,
                        'value'    => '<span>6</span> ' . $urlVariations[5][0]
                    ],
                    [
                        'xtype'    => 'displayfield',
                        'id'       => $formId . '__viewRule7',
                        'cls'      => $urlVariations[6][1] ? $fieldActiveCls : '',
                        'fieldCls' => $fieldCls,
                        'value'    => '<span>7</span> ' . $urlVariations[6][0]
                    ],
                    [
                        'xtype'    => 'displayfield',
                        'id'       => $formId . '__viewRule8',
                        'cls'      => $urlVariations[7][1] ? $fieldActiveCls : '',
                        'fieldCls' => $fieldCls,
                        'value'    => '<span>8</span> ' . $urlVariations[7][0]
                    ],
                    [
                        'xtype' => 'label',
                        'ui'    => 'header-line',
                        'text'  => '#If the application is not in the root directory but in the specified',
                    ],
                    [
                        'xtype'      => 'displayfield',
                        'ui'         => 'parameter',
                        'fieldLabel' => '#Directory Name / base URL-path',
                        'value'      => sprintf('"%s" <i class="fas fa-long-arrow-alt-right"></i> "%s"', BASE_URL, $url->buildUrl())
                    ],
                    [
                        'xtype' => 'label',
                        'ui'    => 'comment',
                        'html'  => '#Base URL-path (BASE_URL) is changed only manually in the script &laquo;bootstrap&raquo;'
                    ]
                ]
            ],
            [
                'xtype'       => 'fieldset',
                'title'       => '#Rules for generating permalinks of categories and articles',
                'id'          => $formId . '__rules',
                'collapsible' => true,
                'defaults'    => [
                    'xtype'      => 'radio',
                    'labelAlign' => 'right',
                    'labelWidth' => 200
                ],
                'items' => [
                    [
                        'boxLabel'   => $this->module->t(
                            '{boxLabelRule}',
                            [
                                '@incut',
                                $url->buildUrl(['query' => ['a' => 1]]),
                                $url->buildUrl(['query' => ['с' => 2]]),
                            ]
                        ),
                        'fieldLabel' => $translateRules['Plain'],
                        'name'       => 'ruleName',
                        'inputValue' => 'Plain',
                        'checked'    => Gm::$app->urlRules->isRule('Plain'),
                        'disabled'   => !Gm::$app->urlRules->hasRule('Plain'),
                        'tplParams'  => [
                            'article'  => '/?a=1',
                            'category' => '/?c=2',
                            'tpl'      => $this->module->t('{boxLabelRule}')
                        ]
                    ],
                    [
                        'boxLabel'   => $this->module->t(
                            '{boxLabelRule}',
                            [
                                '@incut',
                                $url->buildUrl(['path' => '/' . date('Y/m') . '/my-article']),
                                $url->buildUrl(['path' => '/news'])
                            ]
                        ),
                        'fieldLabel' => $translateRules['MonthArticleName'],
                        'name'       => 'ruleName',
                        'inputValue' => 'MonthArticleName',
                        'checked'    => Gm::$app->urlRules->isRule('MonthArticleName'),
                        'disabled'   => !Gm::$app->urlRules->hasRule('MonthArticleName'),
                        'tplParams'  => [
                            'article'  => '/' . date('Y/m') . '/my-article',
                            'category' => '/news',
                            'tpl'      => $this->module->t('{boxLabelRule}')
                        ]
                    ],
                    [
                        'boxLabel'   => $this->module->t(
                            '{boxLabelRule}',
                            [
                                '@incut',
                                $url->buildUrl(['path' => '/' . date('Y/m/d') . '/my-article']),
                                $url->buildUrl(['path' => '/news'])
                            ]
                        ),
                        'fieldLabel' => $translateRules['DateArticleName'],
                        'name'       => 'ruleName',
                        'inputValue' => 'DateArticleName',
                        'checked'    => Gm::$app->urlRules->isRule('DateArticleName'),
                        'disabled'   => !Gm::$app->urlRules->hasRule('DateArticleName'),
                        'tplParams'  => [
                            'article'  => '/' . date('Y/m/d') . '/my-article',
                            'category' => '/news',
                            'tpl'      => $this->module->t('{boxLabelRule}')
                        ]
                    ],
                    [
                        'boxLabel'   => $this->module->t(
                            '{boxLabelRule}',
                            [
                                '@incut',
                                $url->buildUrl(['path' => '/article/1']),
                                $url->buildUrl(['path' => '/category/2'])
                            ]
                        ),
                        'fieldLabel' => $translateRules['DirectArticleId'],
                        'name'       => 'ruleName',
                        'inputValue' => 'DirectArticleId',
                        'checked'    => Gm::$app->urlRules->isRule('DirectArticleId'),
                        'disabled'   => !Gm::$app->urlRules->hasRule('DirectArticleId'),
                        'tplParams'  => [
                            'article'  => '/article/1',
                            'category' => '/category/2',
                            'tpl'      => $this->module->t('{boxLabelRule}')
                        ]
                    ],
                    [
                        'boxLabel'   => $this->module->t(
                            '{boxLabelRule}', 
                            [
                                '@incut',
                                $url->buildUrl(['path' => '/article/my-article']),
                                $url->buildUrl(['path' => '/category/news'])
                            ]
                        ),
                        'fieldLabel' => $translateRules['DirectArticleName'],
                        'name'       => 'ruleName',
                        'inputValue' => 'DirectArticleName',
                        'checked'    => Gm::$app->urlRules->isRule('DirectArticleName'),
                        'disabled'   => !Gm::$app->urlRules->hasRule('DirectArticleName'),
                        'tplParams'  => [
                            'article'  => '/article/my-article',
                            'category' => '/category/news',
                            'tpl'      => $this->module->t('{boxLabelRule}')
                        ]
                    ],
                    [
                        'boxLabel'   => $this->module->t(
                            '{boxLabelRule}',
                            [
                                '@incut',
                                $url->buildUrl(['path' => '/article/my-article.html']),
                                $url->buildUrl(['path' => '/category/news'])
                            ]
                        ),
                        'fieldLabel' => $translateRules['DirectArticleNameExt'],
                        'name'       => 'ruleName',
                        'inputValue' => 'DirectArticleNameExt',
                        'checked'    => Gm::$app->urlRules->isRule('DirectArticleNameExt'),
                        'disabled'   => !Gm::$app->urlRules->hasRule('DirectArticleNameExt'),
                        'tplParams'  => [
                            'article'  => '/article/my-article.html',
                            'category' => '/category/news',
                            'tpl'      => $this->module->t('{boxLabelRule}')
                        ]
                    ],
                    [
                        'boxLabel'   => $this->module->t(
                            '{boxLabelRule}',
                            [
                                '@incut',
                                $url->buildUrl(['path' => '/news/my-article']),
                                $url->buildUrl(['path' => '/news'])
                            ]
                        ),
                        'fieldLabel' => $translateRules['CategoryAndArticleName'],
                        'name'       => 'ruleName',
                        'inputValue' => 'CategoryAndArticleName',
                        'checked'    => Gm::$app->urlRules->isRule('CategoryAndArticleName'),
                        'disabled'   => !Gm::$app->urlRules->hasRule('CategoryAndArticleName'),
                        'tplParams'  => [
                            'article'  => '/news/my-article.html',
                            'category' => '/news',
                            'tpl'      => $this->module->t('{boxLabelRule}')
                        ]
                    ],
                    [
                        'boxLabel'   => $this->module->t(
                            '{boxLabelRule}',
                            [
                                '@incut',
                                $url->buildUrl(['path' => '/news/my-article.html']),
                                $url->buildUrl(['path' => '/news'])
                            ]
                        ),
                        'fieldLabel' => $translateRules['CategoryAndArticleNameExt'],
                        'name'       => 'ruleName',
                        'inputValue' => 'CategoryAndArticleNameExt',
                        'checked'    => Gm::$app->urlRules->isRule('CategoryAndArticleNameExt'),
                        'disabled'   => !Gm::$app->urlRules->hasRule('CategoryAndArticleNameExt'),
                        'tplParams'  => [
                            'article'  => '/news/my-article.html',
                            'category' => '/news',
                            'tpl'      => $this->module->t('{boxLabelRule}')
                        ]
                    ],
                    [
                        'boxLabel'   => $this->module->t(
                            '{boxLabelRule}',
                            [
                                '@incut',
                                $url->buildUrl(['path' => 'my-post.html']),
                                $url->buildUrl(['path' => '/news'])
                            ]
                        ),
                        'fieldLabel' => $translateRules['ArticleNameExt'],
                        'name'       => 'ruleName',
                        'inputValue' => 'ArticleNameExt',
                        'checked'    => Gm::$app->urlRules->isRule('ArticleNameExt'),
                        'disabled'   => !Gm::$app->urlRules->hasRule('ArticleNameExt'),
                        'tplParams'  => [
                            'article'  => '/my-article.html',
                            'category' => '/news',
                            'tpl'      => $this->module->t('{boxLabelRule}')
                        ]
                    ]
                ]
            ],
            [
                'xtype'      => 'checkbox',
                'fieldLabel' => $this->module->t('Save the transition history between modules in the control panel'),
                'labelWidth' => 390,
                'name'       => 'browserHistory',
                'ui'         => 'switch',
                'checked'    => $url->browserHistory,
                'inputValue' => 1
            ],
            [
                'xtype'  => 'toolbar',
                'dock'   => 'bottom',
                'border' => 0,
                'style'  => ['borderStyle' => 'none'],
                'items'  => [
                    [
                        'xtype'      => 'checkbox',
                        'boxLabel'   => $this->module->t('reset settings'),
                        'name'       => 'reset',
                        'ui'         => 'switch',
                        'inputValue' => 1
                    ]
                 ]
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function createWidget(): EditWindow
    {
        /** @var EditWindow $window */
        $window = parent::createWidget();

        // окно компонента (Ext.window.Window Sencha ExtJS)
        $window->width = 700;
        $window->height = 700;
        $window->responsiveConfig = [
            'height < 700' => ['height' => '99%'],
        ];

        // панель формы (Gm.view.form.Panel GmJS)
        $window->form->makeViewID();
        $window->form->items = $this->getFormItems($window);
        $window->form->autoScroll = true;
        $window->form->controller = 'gm-be-config-url-form';
        $window
            ->setNamespaceJS('Gm.be.config.url')
            ->addRequire('Gm.be.config.url.FormController')
            ->addCss('/form.css');
        return $window;
    }
}
