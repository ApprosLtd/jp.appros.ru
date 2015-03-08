Ext.define('App.view.seller.Products.TopToolbarPanel', {
    extend: 'Ext.toolbar.Toolbar',
    defaults: {
        scale: 'medium'
    },
    items: [
        {
            text: 'Добавить продукт',
            handler: function(){
                Ext.create('App.view.seller.Products.ProductEditWindow', {
                    title: 'Новый продукт'
                });
            }
        },
        '->',
        {
            xtype: 'textfield',
            name: 'field1',
            width: 300,
            emptyText: 'введите фразу для поиска товара'
        },
        {
            text: 'Поиск',
            scale: 'small'
        }
    ]
});