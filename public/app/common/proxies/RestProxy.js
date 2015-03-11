Ext.define('App.common.proxies.RestProxy', {
    extend: 'Ext.data.proxy.Rest',
    extraParams: {
        _token: __TOKEN__
    },
    reader: {
        type: 'json'
    //    ,rootProperty: 'rows'
    },
    writer: {
        type: 'json'
    }
});