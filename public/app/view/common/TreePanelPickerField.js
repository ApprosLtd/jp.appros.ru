Ext.define('App.view.common.TreePanelPickerField', {
    extend: 'Ext.form.field.Picker',
    getPickerStore: function(){
        return Ext.create('Ext.data.TreeStore', {
            root: {
                expanded: true,
                children: [
                    { text: "detention", leaf: true },
                    { text: "homework", expanded: true, children: [
                        { text: "book report", leaf: true },
                        { text: "algebra", leaf: true}
                    ] },
                    { text: "buy lottery tickets", leaf: true }
                ]
            }
        })
    },
    createPicker: function(){
        var me = this;

        var pickerCfg = Ext.apply({
            xtype: 'treepanel',
            pickerField: me,
            //selectionModel: me.pickerSelectionModel,
            //floating: true,
            //hidden: true,
            store: me.getPickerStore(),
            //displayField: me.displayField,
            //preserveScrollOnRefresh: true,
            //pageSize: me.pageSize,
            tpl: me.tpl
        }, me.listConfig, me.defaultListConfig);

        var picker = me.picker = Ext.widget(pickerCfg);

        return picker;

       /* return Ext.create('Ext.tree.Panel', {
            title: 'Simple Tree',
            width: 200,
            height: 150,
            rootVisible: false,
        });*/
    }
});