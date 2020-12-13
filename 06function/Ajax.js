// /*
//     Ajax工具函数：
//     参数 
//         url
//         key约定key1==name1&&key2==name2
//         success
// */ 
// function get(url,data,success){
//     var xhr = new XMLHttpRequest();
//     if(data){
//         url += '?';
//         url += data;
//     }
//     xhr.open('get',url);
//     xhr.onreadystatechange = function(){
//         if(xhr.readyState==4&&xhr.status==200){
//             success(xhr.responseText);
//         }
//     }
//     xhr.send(null);
// }
// function post(url,data,success){
//     var xhr = new XMLHttpRequest();
//     xhr.send('post',url);
//     if(data){
//         xhr.setRequestHeader('content-type','application/x-www-form-urlencoded');
//     }
//     xhr.onreadystatechange = function(){
//         if(xhr.readyState==4&&xhr.status==200){
//              success(xhr.responseText);
//         }
//     }
//     xhr.send(data);
// }
function ajax(option){
    var xhr = new XMLHttpRequest();
    if(option.type=='get'&&option.data){
        option.url += '?';
        option.url += option.data;
        option.data=null;
    }
    xhr.open(option.type,option.url);
    if(option.type=='post'&&option.data){
        xhr.setRequestHeader('content-type','application/x-www-form-urlencoded');
    }
    xhr.onreadystatechange = function(){
        if(xhr.readyState==4&&xhr.status==200){
            var type = xhr.getResponseHeader('Content-Type');
            // 是否为JSON
            if(type.indexOf('json'!=-1)){
                option.success(JSON.parse(xhr.responseText));
            }
            // 是否为XML
            else if(type.indexOf(xhr.responseText)){
                option.success(xhr.responseXML)
            }else{
            // 普通字符串
                option.success(xhr.responseText);
            }

        }
    }
    xhr.send(option.data);
}