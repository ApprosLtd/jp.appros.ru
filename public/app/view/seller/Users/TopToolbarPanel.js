Ext.define('App.view.seller.Users.TopToolbarPanel', {
    extend: 'Ext.toolbar.Toolbar',
    defaults: {
        scale: 'medium'
    },
    constructor: function(config) {
        var me = this;

        me.items = [
            {
                text: 'Добавить роль',
                iconCls: 'fa fa-users fa-lg',
                handler: function(){
                    //
                }
            },
            {
                text: 'Добавить пользователя',
                iconCls: 'fa fa-user-plus fa-lg',
                handler: function(){
                    //
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