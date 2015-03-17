/**
 * Вкладка "Виджеты"
 */
Ext.define('App.view.seller.Widgets.MainTab', {
    extend: 'Ext.container.Container',
    title: 'Виджеты',
    layout: 'border',
    defaults: {
        border: false
    },
    items: [
        Ext.create('App.grid.Widget', {
            region: 'center',
            editWindowClass: 'App.view.seller.Widgets.EditWindow'
        })
    ]
});
