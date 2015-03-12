/**
 * Окно редактирования продукта
 */
Ext.define('App.view.seller.Products.ProductEditWindow', {
    extend: 'Ext.window.Window',
    title: 'Редактирование продукта',
    height: 400,
    width: 600,
    autoShow: true,
    constrain: true,
    modal: true,
    layout: 'fit',
    constructor: function() {
        var me = this;

        me.attributesStore = Ext.create('Ext.data.Store', {
            fields: ['id', 'name', 'value', 'group', 'title', 'group_id'],
            autoLoad: true,
            groupField: 'group',
            proxy: Ext.create('App.common.proxies.RestProxy', {url: '/rest/attribute'})
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
                        height: 200,
                        allowBlank: true
                    }]
                }
            },{
                title: 'Атрибуты',
                items: {
                    xtype: 'grid',
                    border: false,
                    features: [{
                        id: 'group',
                        ftype: 'groupingsummary',
                        groupHeaderTpl: '{name}',
                        hideGroupedHeader: true,
                        enableGroupingMenu: false
                    }],
                    plugins: [
                        Ext.create('Ext.grid.plugin.CellEditing', {
                            clicksToEdit: 1
                        })
                    ],
                    columns: [{
                        text: 'Атрибут',
                        flex: 1,
                        tdCls: 'task',
                        sortable: true,
                        dataIndex: 'title',
                        hideable: false
                    }, {
                        header: 'Значение',
                        width: 240,
                        sortable: true,
                        dataIndex: 'value',
                        field: {
                            xtype: 'textfield'
                        }
                    }],
                    store: me.attributesStore
                }
            },{
                title: 'Каталог',
                items: {
                    xtype: 'treepanel',
                    rootVisible: true,
                    border: false,
                    store: Ext.create('App.store.seller.Catalog.CatalogListStore')
                }
            },{
                title: 'Фотогалерея',
                items: [{
                    xtype: 'form',
                    padding: 5,
                    border: false,
                    items: [{
                        xtype: 'filefield',
                        name: 'photo',
                        fieldLabel: 'Файл',
                        labelWidth: 50,
                        msgTarget: 'side',
                        allowBlank: false,
                        anchor: '100%',
                        buttonText: 'Выбрать фото',
                        listeners: {
                            //
                        }
                    }]
                }/*,{
                    xtype: 'dataview',
                    tpl: [
                        '<tpl for=".">',
                        '<div class="dataview-multisort-item">',
                        '<img src="resources/images/touch-icons/{thumb}" />',
                        '<h3>{name}</h3>',
                        '</div>',
                        '</tpl>'
                    ],
                    store: Ext.create('Ext.data.Store', {
                        autoLoad: true,
                        sortOnLoad: true,
                        fields: ['name', 'thumb', 'url', 'type'],
                        proxy: Ext.create('App.common.proxies.RestProxy', {url: '/rest/media'})
                    })
                }*/]
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

        this.callParent(arguments);
    }
})