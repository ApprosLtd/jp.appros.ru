/**
 * Окно редактирования
 */
Ext.define('App.view.seller.Users.RoleEditWindow', {
    extend: 'Ext.window.Window',
    title: 'Редактирование роли',
    height: 400,
    width: 600,
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
                fieldLabel: 'Уник. имя',
                xtype: 'textfield',
                name: 'name',
                allowBlank: false
            },{
                fieldLabel: 'Видимое имя',
                xtype: 'textfield',
                name: 'display_name',
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
                title: 'Права',
                items: {
                    //
                }
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
                        //console.log(fields);
                        console.log(me.store.getRoot().appendChild(fields));
                        //appendChild(fields);
                        //me.store.add(fields);
                        //me.store.loadRecords([fields]);
                        //me.store.sync();

                        //fields.text = 'hello world';

                        //var rec = Ext.create('App.treemodel.Role', fields);
                        //me.store.add(rec);
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