//<script>
Ext.define('App.grid.{{ $class_name }}', {
    extend: 'Ext.grid.Panel',
    editWindowClass: null,
    createEditWindow: function(title, record){
        if (!this.editWindowClass) {
            return;
        }
        Ext.create(this.editWindowClass, {
            title: title,
            record: record,
            store: this.store
        });
    },
    constructor: function(config) {
        var me = this;

        if (config.editWindowClass && config.editWindowClass != '') {
            me.editWindowClass = config.editWindowClass;
        }

        me.store = Ext.create('App.store.{{ $class_name }}');

        me.contextmenu = Ext.create('Ext.menu.Menu', {
            items: [{
                    text: 'Редактировать',
                    handler: function(item, e){
                        var record = this.up('menu').record;
                        me.createEditWindow('Редактирование', record);
                    }
                },{
                    text: 'Удалить',
                    handler: function(item, e){
                        var self = this;
                        Ext.MessageBox.confirm('Удаление', 'Будут удалены все связанные с записью данные. Продолжить?', function(btn, text){
                            if (btn == 'yes') {
                                me.store.remove(self.up('menu').record);
                            }
                        });
                    }
                }]
        });

        var addButtonText = 'Добавить';
        if (config.addButtonText && config.addButtonText != '') {
            addButtonText = config.addButtonText;
        }

        me.dockedItems = [
            Ext.create('Ext.toolbar.Toolbar', {
                dock: 'top',
                items: [{
                    text: addButtonText,
                    handler: function(){
                        me.createEditWindow('Создание');
                    }
                }]
            }),
            Ext.create('Ext.toolbar.Paging', {
                store: me.store,
                dock: 'bottom',
                displayInfo: true
            })
        ];

        this.callParent([config]);
    },
    plugins: [
        Ext.create('Ext.grid.plugin.CellEditing', {
            clicksToEdit: 1
        })
    ],
    columns: {!! json_encode($columns) !!},
    listeners: {
        itemdblclick: function(el, record, item, index, e, eOpts){
            this.createEditWindow('Редактирование', record);
        },
        cellcontextmenu: function(el, td, cellIndex, record, tr, rowIndex, e, eOpts){
            this.contextmenu.record = record;
            this.contextmenu.showAt(e.getXY());
            e.stopEvent();
        }
    }
});
