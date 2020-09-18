Object.size = function(obj) {
    var size = 0, key;
    for (key in obj) {
        if (obj.hasOwnProperty(key)) size++;
    }
    return size;
};

function _ajax(url, params, succFunc, doneFunc, errFunc){
    try{
        $.ajax({
            url : url,
            type: 'POST',
            dataType : 'json',
            data : {
                params : params
            },
            success : function(result){
                succFunc(result);
            },
            error :  function(error){
                console.log(error.responseText);
                if(typeof errFunc != 'undefined'){
                    errFunc(error);
                }
            },
            complete : function(){
                if(typeof doneFunc != 'undefined'){
                    doneFunc();
                }
            }
        });
    }catch (e) {
        console.log(e);
        alert('has error ajax');
    }
}

var Storage = {
    key : '_quality',
    setItem : (value) => {
        var datas = Storage.getItems(true);
        datas.push(value);
        localStorage.setItem(Storage.key, JSON.stringify(datas));
    },
    setItems : (datas) => {
        Storage.clear();
        localStorage.setItem(Storage.key, JSON.stringify(datas));
    },
    getItems : (jsonDecode) => {
        if(typeof jsonDecode == 'undefined'){
            jsonDecode = false;
        }
        var value = localStorage.getItem(Storage.key);
        if(value == null){
            value = '{}';
        }
        return jsonDecode ? JSON.parse(value) : value;
    },
    getItem : (key) => {
        var datas = Storage.getItems(true);
        if(typeof datas[key] != 'undefined'){
            return datas[key];
        }
        return {};
    },
    count : () => {
        return Object.size(Storage.getItems(true));
    },
    clear : () => {
        return localStorage.removeItem(Storage.key)
    }
}

function showMenu(){
    $("#menu").addClass('show');
    $(".bg-menu").show(300);
}

function hideMenu(){
    $("#menu").removeClass('show');
    $(".bg-menu").hide(300);
}