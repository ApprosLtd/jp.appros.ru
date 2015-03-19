/**
 * Окно редактирования
 */
Ext.define('App.view.seller.Purchases.PurchasesEditWindow', {
    extend: 'Ext.window.Window',
    height: 300,
    width: 500,
    autoShow: true,
    constrain: true,
    modal: true,
    layout: 'fit',
    store: null,
    getStore: function(){
        if (!this.storeName) {
            return null;
        }
        if (!this.store) {
            this.store = Ext.StoreManager.lookup(this.storeName);
        }
        return this.store;
    },
    setFieldsData: function(record){
        if (!record) {
            return;
        }
        var me = this;
        me.productId = record.getId();
    },
    constructor: function(config) {
        var me = this;

        Ext.apply(me, config, {
            storeName: null,
            record: null
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
            },{
                fieldLabel: 'Завершения',
                xtype: 'datefield',
                name: 'expiration_time',
                anchor: '70%',
                allowBlank: false,
                format: 'Y-m-d H:i:s',
                value: (new Date()) + (3600 * 24 * 7)
            }]
        });

        if (me.record) {
            me.baseForm.getForm().loadRecord(me.record);
        }

        me.items = me.baseForm;

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

                    var store = me.getStore();

                    if (!store) {
                        return;
                    }

                    if (fields.id > 0) {
                        var rec = store.findRecord('id', fields.id);
                        rec.beginEdit();
                        rec.set('name', fields.name);
                        rec.set('description', fields.description);
                        rec.endEdit();
                    } else {
                        var rec = Ext.create('App.treemodel.Purchase', fields);
                        console.log( store.getNodeById(0).appendChild(rec) );
                        //store.getRoot().appendChild(rec);
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

        this.callParent(arguments);
    }
})