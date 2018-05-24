/**
 * Created by Khalil on 8/3/2016.
 */

function popup(title, msg) {
    w2popup.open({
        title     : title,
        body      : '<div class="w2ui-centered">'+msg+'</div>',
        buttons   : '<button class="btn" onclick="w2popup.close();window.location.reload();" style="margin: 0px">إغلاق</button>' ,
        width     : 500,
        height    : 300,
        overflow  : 'hidden',
        color     : '#333',
        speed     : '0.3',
        opacity   : '0.8',
        modal     : true,
        showClose : true,
        showMax   : false,
        onOpen    : function (event) { console.log('open'); },
        onClose   : function (event) { console.log('close'); },
        onMax     : function (event) { console.log('max'); },
        onMin     : function (event) { console.log('min'); },
        onKeydown : function (event) { console.log('keydown'); }
    });
}



    function push1 (arr, item) {
        if (arr.indexOf(item) == -1) {

            arr.push(item);
            return true;
        }
        return false;
    };



jQuery.extend({
    postJSON: function( url, data, callback) {
        return jQuery.post(url, data, callback, "json");
    }
});
