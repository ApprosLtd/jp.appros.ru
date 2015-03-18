//<script>
Ext.define('App.tree.{{ $class_name }}', {
    extend: 'Ext.tree.Panel',
    constructor: function(config) {

        var me = this;

        Ext.apply(me, {
            //
        }, config);

        me.store = Ext.create('App.treestore.{{ $class_name }}');

        this.callParent(arguments);
    }
});
