/**
 * Окно редактирования пользователя
 */
Ext.define('App.view.seller.Users.UserEditWindow', {
    extend: 'Ext.window.Window',
    title: 'Редактирование пользователя',
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

        var rolesListItems = [];

        var rolesStore = Ext.data.StoreManager.lookup('treestoreRole');

        Ext.Array.each(rolesStore.getRoot().childNodes, function(roleModel){
            rolesListItems.push({
                boxLabel  : roleModel.get('display_name'),
                name      : 'roles['+roleModel.get('id')+']',
                inputValue: 1,
                uncheckedValue: 0
            });
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
                fieldLabel: 'Имя',
                xtype: 'textfield',
                name: 'name',
                allowBlank: false
            },{
                fieldLabel: 'Email',
                xtype: 'textfield',
                name: 'email',
                allowBlank: false
            },{
                xtype: 'fieldcontainer',
                fieldLabel: 'Роли',
                defaultType: 'checkboxfield',
                items: rolesListItems
            }]
        });

        if (me.record) {
            me.record.load({
                success: function(record, operation){
                    record.set('roles', {
                        1:'on',
                        2:1,
                        3:1
                    });
                    me.baseForm.getForm().loadRecord(record);
                }
            });
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

                    me.baseForm.submit({
                        clientValidation: true,
                        url: '/rest/user',
                        params: {
                            _token: __TOKEN__
                        },
                        success: function(form, action) {
                            upWindow.destroy();
                            Ext.data.StoreManager.lookup('storeUser').load();
                        },
                        failure: function(form, action) {
                            switch (action.failureType) {
                                case Ext.form.action.Action.CLIENT_INVALID:
                                    Ext.Msg.alert('Failure', 'Form fields may not be submitted with invalid values');
                                    break;
                                case Ext.form.action.Action.CONNECT_FAILURE:
                                    Ext.Msg.alert('Failure', 'Ajax communication failed');
                                    break;
                                case Ext.form.action.Action.SERVER_INVALID:
                                    Ext.Msg.alert('Failure', action.result.msg);
                            }
                        }
                    });
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