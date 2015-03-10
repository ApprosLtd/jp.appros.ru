Ext.define('App.view.seller.Products.TopToolbarPanel', {
    extend: 'Ext.toolbar.Toolbar',
    defaults: {
        scale: 'medium'
    },
    items: [
        {
            text: 'Добавить категорию',
            scale: 'medium',
            handler: function(){

                Ext.create('App.view.seller.Catalog.CatalogEditWindow', {
                    title: 'Новый элемент каталога'
                });

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
            xtype: 'combo',
            fieldLabel: 'Ценовая сетка',
            width: 350,
            store: {
                xtype: 'store',
                fields: ['abbr', 'name'],
                data : [
                    {"abbr":"0", "name":"---"},
                    {"abbr":"AL", "name":"Alabama"},
                    {"abbr":"AK", "name":"Alaska"},
                    {"abbr":"AZ", "name":"Arizona"}
                    //...
                ]
            },
            queryMode: 'local',
            displayField: 'name',
            valueField: 'abbr',
            renderTo: Ext.getBody()
        },
        {
            xtype: 'textfield',
            name: 'field1',
            width: 280,
            emptyText: 'введите фразу для поиска товара'
        },
        {
            text: 'Поиск',
            scale: 'small'
        }
    ]
});