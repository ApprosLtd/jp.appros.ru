/**
 * Вкладка "Пользователи и группы"
 */
Ext.define('App.view.seller.Users.MainTab', {
    extend: 'Ext.container.Container',
    title: 'Пользователи и роли',
    layout: 'border',
    defaults: {
        border: false
    },
    items: [
        Ext.create('App.view.seller.Users.TopToolbarPanel', {region: 'north'}),
        Ext.create('App.view.seller.Users.UsersListGridPanel', {region: 'center'}),
        Ext.create('App.view.seller.Users.RolesListTreePanel', {region: 'west'}), // west | east
    ]
});
