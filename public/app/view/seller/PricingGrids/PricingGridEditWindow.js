/**
 * Окно редактирования ценовой сетки
 */
Ext.define('App.view.seller.PricingGrids.PricingGridEditWindow', {
    extend: 'Ext.window.Window',
    title: 'Редактирование ценовой сетки',
    height: 400,
    width: 600,
    autoShow: true,
    constrain: true,
    modal: true,
    layout: 'fit',
    constructor: function(config) {
        var me = this;

        me.columnsStore = Ext.create('Ext.data.Store', {
            autoLoad: true,
            model: 'pricingGridColumnModel'
        });

        me.items = {
            xtype: 'tabpanel',
            border: false,
            defaults: {
                border: false,
                layout: 'fit'
            },
            items: [{
                title: 'Главная',
                xtype: 'panel',
                items: {
                    xtype: 'form',
                    id: 'productEditWindowBaseForm',
                    layout: 'anchor',
                    bodyPadding: 5,
                    border: false,
                    defaults: {
                        anchor: '100%'
                    },
                    items: [{
                        fieldLabel: 'Наименование',
                        xtype: 'textfield',
                        name: 'name',
                        allowBlank: false
                    },{
                        fieldLabel: 'Описание',
                        xtype: 'textarea',
                        name: 'description',
                        allowBlank: true
                    }]
                }
            },{
                title: 'Колонки',
                items: {
                    xtype: 'grid',
                    border: false,
                    plugins: [
                        Ext.create('Ext.grid.plugin.CellEditing', {
                            clicksToEdit: 1
                        })
                    ],
                    store: me.columnsStore,
                    columns: [{
                        text: 'Наименование колонки',
                        flex: 1,
                        tdCls: 'task',
                        sortable: false,
                        hideable: false,
                        dataIndex: 'column_title',
                        field: {
                            xtype: 'textfield'
                        }
                    },{
                        header: 'Цена ОТ',
                        width: 90,
                        sortable: false,
                        hideable: false,
                        dataIndex: 'min_sum',
                        field: {
                            xtype: 'numberfield'
                        }
                    },{
                        xtype: 'checkcolumn',
                        header: 'Вкл.',
                        width: 50,
                        sortable: false,
                        hideable: false,
                        dataIndex: 'min_sum_inclusive',
                        editor: {
                            xtype: 'checkbox',
                            cls: 'x-grid-checkheader-editor'
                        }
                    },{
                        header: 'Цена ДО',
                        width: 90,
                        sortable: false,
                        hideable: false,
                        dataIndex: 'max_sum',
                        field: {
                            xtype: 'numberfield'
                        }
                    },{
                        xtype: 'checkcolumn',
                        header: 'Вкл.',
                        dataIndex: 'max_sum_inclusive',
                        width: 50,
                        sortable: false,
                        hideable: false,
                        editor: {
                            xtype: 'checkbox',
                            cls: 'x-grid-checkheader-editor'
                        }
                    }]
                },
                dockedItems: [{
                    dock: 'top',
                    xtype: 'toolbar',
                    items: [{
                        text: 'Добавить колонку',
                        handler: function(){
                            me.columnsStore.add({column_title: 'Новая колонка'});
                        }
                    }]
                }]
            }]
        };

        me.dockedItems = [{
            dock: 'bottom',
            xtype: 'toolbar',
            items: ['->', {
                xtype: 'button',
                text: 'Сохранить',
                handler: function(){
                    var baseForm = Ext.getCmp('productEditWindowBaseForm');
                    var fields = baseForm.getValues();
                    var upWindow = this.up('window');

                    var attributes = [];

                    me.attributesStore.getData().each(function(item){
                        attributes.push({
                            id: item.get('id'),
                            name: item.get('name'),
                            value: item.get('value')
                        });
                    });

                    var product = Ext.create('App.model.seller.Products.ProductModel', {
                        name: fields.name,
                        description: fields.description,
                        catalog_ids: [],
                        attributes: attributes

                    });

                    product.save({
                        params: {
                            _token: __TOKEN__
                        },
                        success: function(){
                            upWindow.destroy();
                            Ext.data.StoreManager.lookup('sellerProductsListStore').load();
                        }
                    });
                }
                /*  },{
                 xtype: 'button',
                 text: 'Сохранить и создать новый'*/
            },{
                xtype: 'button',
                text: 'Отмена',
                handler: function(){
                    this.up('window').destroy();
                }
            }]
        }];

        this.callParent([config]);
    }
})