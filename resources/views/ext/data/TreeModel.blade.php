//<script>
Ext.define('App.treemodel.{{ $model_name }}', {
    extend: 'Ext.data.TreeModel',
    entityName: 'model{{ $model_name }}',
    fields: {!! $fields !!},
    proxy: Ext.create('App.common.proxies.RestProxy', {url: '/rest/{{ strtolower($model_name) }}'})
});