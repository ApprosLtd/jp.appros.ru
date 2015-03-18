/**
 * Окно редактирования
 */
Ext.define('App.view.seller.Purchases.PurchasesEditWindow', {
    extend: 'Ext.window.Window',
    height: 700,
    width: 1200,
    autoShow: true,
    constrain: true,
    modal: true,
    layout: 'fit',
    store: null,
    record: null,
    setFieldsData: function(record){
        if (!record) {
            return;
        }
        var me = this;
        me.productId = record.getId();
    },
    constructor: function(config) {
        var me = this;

        me.catalogTree = Ext.create('App.tree.Catalog', {
            region: 'west',
            title: 'Каталог',
            width: 200,
            split: true,
            collapsed: false,
            collapsible: true
        });

        me.productsGrid = Ext.create('App.grid.Product', {
            region: 'center',
            title: 'Товары',
            setToolBar: false
        });

        me.productInPurchaseGrid = Ext.create('App.grid.ProductInPurchase', {
            region: 'east',
            width: 500,
            title: 'Товары в закупке',
            split: true,
            setToolBar: false
        });

        me.baseForm = Ext.create('Ext.form.Panel', {
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
                allowBlank: true
            }]
        });

        if (me.record) {
            me.baseForm.getForm().loadRecord(me.record);
        }

        me.items = {
            xtype: 'tabpanel',
            items: [{
                title: 'Главная',
                items: me.baseForm
            },{
                title: 'Товары',
                layout: 'border',
                items: [
                    me.catalogTree,
                    me.productsGrid,
                    me.productInPurchaseGrid
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
                    var fields = me.baseForm.getValues();
                    var upWindow = this.up('window');

                    if (!me.baseForm.isValid()) {
                        return;
                    }
                    if (!me.store) {
                        return;
                    }

                    if (fields.id > 0) {
                        var rec = me.store.findRecord('id', fields.id);
                        rec.beginEdit();
                        rec.set('name', fields.name);
                        rec.set('description', fields.description);
                        rec.set('display_name', fields.display_name);
                        rec.endEdit();
                    } else {
                        var rec = Ext.create('App.treemodel.Role', fields);
                        me.store.getRoot().appendChild(rec);
                    }
                    upWindow.destroy();
                }
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