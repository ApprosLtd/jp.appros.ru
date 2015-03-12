Ext.define('App.view.seller.Products.TopToolbarPanel', {
    extend: 'Ext.toolbar.Toolbar',
    defaults: {
        scale: 'medium'
    },
    getProductsListGridPanelView: function(){
        var me = this;

        if (!me.productsListGridPanelView) {
            me.productsListGridPanelView = Ext.getCmp('productsListGridPanelView');
        }

        return me.productsListGridPanelView;
    },
    constructor: function(config) {
        var me = this;

        me.items = [
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

                        var productsListGridPanelView = me.getProductsListGridPanelView();

                        var columns = [{
                            text: 'Наименование',
                            dataIndex: 'name',
                            locked: true,
                            width: 400,
                            //flex: 1,
                            renderer: function(value, metaData, rec){
                                return value + ' (<a href="' + rec.get('cn_link') + '" target="_blank">ссылка</a>)';
                            }
                        }];

                        Ext.Array.each(record.getColumns(), function(itemRecord) {
                            columns.push({
                                text: itemRecord.get('column_title'),
                                dataIndex: 'col_' + itemRecord.get('id'),
                                locked: false,
                                width: 120,
                                field: {
                                    xtype: 'numberfield'
                                }
                            });
                        });

                        productsListGridPanelView.getStore().currentPricingGridId = record.getId();

                        productsListGridPanelView.reconfigure(productsListGridPanelView.getStore(), columns);
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
        ];

        this.callParent([config]);
    }

});