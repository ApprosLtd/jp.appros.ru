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
            queryMode: 'local',
            displayField: 'name',
            valueField: 'id',
            store: Ext.create('App.store.seller.PricingGrids.PricingGridsStore'),
            listeners: {
                select: function(combo, record, eOpts){
                    var store = Ext.data.StoreManager.lookup('pricingGridsStore');
                    console.log(store);
                }
            }
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