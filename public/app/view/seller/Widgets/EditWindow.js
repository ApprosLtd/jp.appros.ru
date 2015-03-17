/**
 * Окно редактирования
 */
Ext.define('App.view.seller.Widgets.EditWindow', {
    extend: 'Ext.window.Window',
    title: 'Редактирование виджета',
    height: 400,
    width: 600,
    autoShow: true,
    constrain: true,
    modal: true,
    layout: 'fit',
    store: null,
    record: null,
    constructor: function(config) {
        var me = this;

        if (config.record) {
            me.record = config.record;
        }

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
                fieldLabel: 'Регион',
                xtype: 'textfield',
                name: 'region',
                allowBlank: false
            },{
                fieldLabel: 'Позиция',
                xtype: 'numberfield',
                value: 0,
                minValue: 0,
                anchor: '40%',
                name: 'position',
                allowBlank: true
            },{
                fieldLabel: 'Обработчик',
                xtype: 'textfield',
                name: 'handler',
                allowBlank: false
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
                title: 'Роли',
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
                        rec.set('region', fields.region);
                        rec.set('position', fields.position);
                        rec.set('handler', fields.handler);
                        rec.endEdit();
                    } else {
                        //fields.id = 0;
                        me.store.add(fields);
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