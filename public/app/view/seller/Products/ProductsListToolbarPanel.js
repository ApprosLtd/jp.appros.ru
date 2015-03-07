Ext.define('App.view.seller.Products.ProductsListToolbarPanel', {
    extend: 'Ext.toolbar.Toolbar',
    defaults: {
        scale: 'medium'
    },
    items: [
        {
            text: 'Создать категорию',
            handler: function(){
                alert('Создать категорию');
            }
        },
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
            emptyText: 'введите фразу для поиска'
        },
        {
            text: 'Поиск',
            scale: 'small'
        }
    ]
});