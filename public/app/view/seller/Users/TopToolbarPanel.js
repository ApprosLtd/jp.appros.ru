Ext.define('App.view.seller.Users.TopToolbarPanel', {
    extend: 'Ext.toolbar.Toolbar',
    defaults: {
        scale: 'medium'
    },
    constructor: function(config) {
        var me = this;

        me.items = [
            {
                text: 'Создать роль',
                iconCls: 'fa fa-users fa-lg',
                handler: function(){
                    //
                }
            },
            {
                text: 'Создать пользователя',
                iconCls: 'fa fa-user-plus fa-lg',
                handler: function(){
                    Ext.create('App.view.seller.Users.UserEditWindow', {
                        title: 'Новый пользователь'
                    });
                }
            },
            '->',
            {
                xtype: 'textfield',
                name: 'field1',
                width: 280,
                emptyText: 'введите имя пользователя или email'
            },
            {
                text: 'Поиск',
                scale: 'small'
            }
        ];

        this.callParent([config]);
    }

});