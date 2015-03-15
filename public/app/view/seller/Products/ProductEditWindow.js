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
    productId: 0,
    fieldsData: null,
    getProductId: function(){
        return this.productId;
    },
    setFieldsData: function(record){
        if (!record) {
            return;
        }
        var me = this;
        me.productId = record.getId();

        me.attributesStore.on('load', function(){
            Ext.Ajax.request({
                url: '/rest/product/' + me.productId,
                success: function(response){
                    var json = Ext.JSON.decode(response.responseText);

                    me.baseForm.getForm().setValues({
                        id: json.id,
                        name: json.name,
                        description: json.description
                    });

                    if (json.attributes.length > 0) {
                        Ext.Array.each(json.attributes, function(mix) {
                            var attrRecord = me.attributesStore.findRecord('id', mix.attribute_id);
                            if (attrRecord) {
                                attrRecord.set('value', mix.value);
                            }
                        });
                        me.attributesStore.commitChanges();
                    }

                    if (json.media.length > 0) {
                        Ext.Array.each(json.media, function(mix) {
                            me.mediaStore.add(mix);
                        });
                    }
                }
            });
        });
    },
    constructor: function(config) {
        var me = this;

        me.attributesStore = Ext.create('Ext.data.Store', {
            fields: ['id', 'name', 'value', 'group', 'title', 'group_id'],
            autoLoad: true,
            groupField: 'group',
            proxy: Ext.create('App.common.proxies.RestProxy', {url: '/rest/attribute'})
        });

        me.mediaStore = Ext.create('Ext.data.Store', {
            fields: ['id', 'file_name', 'position', 'type']
        });

        me.setFieldsData(config.record);

        me.baseForm = Ext.create('Ext.form.Panel', {
            id: 'productEditWindowBaseForm',
            layout: 'anchor',
            bodyPadding: 5,
            border: false,
            defaults: {
                anchor: '100%'
            },
            items: [{
                xtype: 'hidden',
                name: 'id'
            },{
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
        });

        me.contextmenu = Ext.create('Ext.menu.Menu', {
            items: [{
                text: 'Удалить',
                handler: function(item, e){
                    //me.store.remove(this.up('menu').record);
                }
            }]
        });

        me.mediaViewPanel = Ext.create('Ext.panel.Panel', {
            region: 'east',
            width: 200
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
                items: me.baseForm
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
            },/*{
                title: 'Каталог',
                items: {
                    xtype: 'treepanel',
                    rootVisible: true,
                    border: false,
                    store: Ext.create('App.store.seller.Catalog.CatalogListStore')
                }
            },*/{
                title: 'Фотогалерея',
                layout: 'border',
                items: [{
                    xtype: 'form',
                    region: 'north',
                    //padding: 5,
                    border: false,
                    items: [{
                        layout: 'hbox',
                        items: [{
                            xtype: 'filefield',
                            name: 'files',
                            fieldLabel: 'Файл',
                            labelWidth: 50,
                            msgTarget: 'side',
                            allowBlank: false,
                            anchor: '100%',
                            buttonText: 'Выбрать',
                            listeners: {
                                //
                            }
                        },{
                            xtype: 'button',
                            text: 'Загрузить',
                            handler: function(){
                                var form = this.up('form').getForm();
                                form.submit({
                                    url: '/seller/media/upload',
                                    params: {
                                        _token: __TOKEN__,
                                        product_id: me.getProductId()
                                    },
                                    waitMsg: 'Загрузка изображения...',
                                    success: function(fp, o) {
                                        //console.log(fp, o.result); return;
                                        me.mediaStore.add(o.result);
                                    }
                                });
                            }
                        }]
                    }]
                },{
                    xtype: 'grid',
                    region: 'center',
                    store: me.mediaStore,
                    columns: [{
                        text: 'Имя файла',
                        dataIndex: 'file_name',
                        flex: 1
                    }],
                    listeners: {
                        itemclick: function(el, record, item, index, e, eOpts){
                            me.mediaViewPanel.update('<img alt="" src="/media/images/200x255/'+record.getData().file_name+'">');
                        },
                        cellcontextmenu: function(el, td, cellIndex, record, tr, rowIndex, e, eOpts){
                            me.contextmenu.record = record;
                            me.contextmenu.showAt(e.getXY());
                            e.stopEvent();
                        }
                    }
                },
                    me.mediaViewPanel
                ]
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
                        product_id: fields.id,
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