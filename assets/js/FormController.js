/*!
 * Контроллер формы.
 * Расширение "Маршрутизация".
 * Модуль "Конфигурация".
 * Copyright 2015 Вeб-студия GearMagic. Anton Tivonenko <anton.tivonenko@gmail.com>
 * https://gearmagic.ru/license/
 */

Ext.define('Gm.be.config.url.FormController', {
    extend: 'Gm.view.form.PanelController',
    alias: 'controller.gm-be-config-url-form',

    /**
     * Вызывается при изменении состояния флажка общих правил формирования URL-адреса.
     * @param {Ext.form.field.Checkbox} me Компонент "Checkbox".
     * @param {object} newValue Новое значение.
     * @param {object} oldValue Старое значение.
     * @param {object} eOpts
     */
    onSetCommonRuleUrl: function (me, newValue, oldValue, eOpts) {
        let cssRule = 'gm-config-url__rule--active',
            epu = this.getViewCmp('enablePrettyUrl').value,
            ets = this.getViewCmp('enableTrailingSlash').value,
            ssn =   this.getViewCmp('showScriptName').value;
        // варианты URL-адреса
        for (let i = 1; i <= 8; i++) {
            this.getViewCmp('viewRule' + i).removeCls(cssRule);
        }
        if (!epu && !ets && !ssn)
            this.getViewCmp('viewRule1').addCls(cssRule);
        else
        if (!epu && ets && !ssn)
            this.getViewCmp('viewRule2').addCls(cssRule);
        else
        if (!epu && !ets && ssn)
            this.getViewCmp('viewRule3').addCls(cssRule);
        else
        if (!epu && ets && ssn)
            this.getViewCmp('viewRule4').addCls(cssRule);
        else
        if (epu && !ets && !ssn)
            this.getViewCmp('viewRule5').addCls(cssRule);
        else
        if (epu && ets && !ssn)
            this.getViewCmp('viewRule6').addCls(cssRule);
        else
        if (epu && !ets && ssn)
            this.getViewCmp('viewRule7').addCls(cssRule);
        else
        if (epu && ets && ssn)
            this.getViewCmp('viewRule8').addCls(cssRule);

        // правила формирования постоянных ссылок категорий и статей
        let params,
            options = { enablePrettyUrl: epu, showScriptName: ssn, enableTrailingSlash: ets };
        this.getViewCmp('rules').items.each(function (item) {
            if (!Ext.isDefined(item.config.tplParams)) return;
            params = item.config.tplParams;
            if (!Ext.isDefined(item.template)) {
                item.template = new Ext.Template(params.tpl);
            }
            item.setBoxLabel(item.template.apply([
                Gm.url.build(params.article, options),
                Gm.url.build(params.category, options)
            ]));
        });
    }
});
