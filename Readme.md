# AJAX

*AJAX* = Asynchronous JavaScript and XML(异步的 JavaScript 和 XML)。AJAX 不是新的编程语言，而是一种使用现有标准的新方法。

AJAX 是与服务器交换数据并**更新部分网页**的艺术，在**不重新加载**整个页面的情况下。

AJAX允许只更新一个 [HTML](https://developer.mozilla.org/zh-CN/docs/Glossary/HTML) 页面的部分 [DOM](https://developer.mozilla.org/zh-CN/docs/Glossary/DOM)，而无须重新加载整个页面。AJAX还允许异步工作，这意味着当网页的一部分正试图重新加载时，您的代码可以继续运行（相比之下，同步会阻止代码继续运行，直到这部分的网页完成重新加载）。

AJAX增加了B/S的体验性，使用AJAX用户可以创建接近本地桌面应用的直接、丰富、可靠的应用。

AJAX本质上是使用了XHR对象。在XHR诞生前，网页要获取客户端和服务器的任何状态更新，都需要刷新一次，在XHR诞生后就可以完全通过JS代码异步实现这一过程。XHR的诞生也使最初的网页制作转换为开发交互应用，拉开了WEB2.0的序幕。 

XHR是一种浏览器API，极大简化了异步通信的过程，开发者并不需要关注底层的实现，因为浏览器会为我们完成这些工作，如连接管理、协议协商、HTTP请求格式化等等。最初版本的XHR能力非常有限，只支持文本传输，处理上传能力也不足，对于跨域请求也不支持。为解决这些问题，W3C于2008年发布了“XMLHttpRequest Level2”草案，2011年，W3C将“XMLHttpRequest Level2”规范与最初的“XMLHttpRequest”规范合并，所有XHR2新增的功能也都并入了原来的XHR API中，接口不变，功能增强。

XMLHttpRequest（XHR）对象用于与服务器交互。通过 XMLHttpRequest 可以在不刷新页面的情况下请求特定 URL，获取数据。这允许网页在不影响用户操作的情况下，更新页面的局部内容。XMLHttpRequest在 [AJAX](https://developer.mozilla.org/zh-CN/docs/Glossary/AJAX) 编程中被大量使用。

XMLHttpRequest 对象提供了对 HTTP 协议的完全的访问，包括做出 POST 和 HEAD 请求以及普通的 GET 请求的能力。XMLHttpRequest 可以同步或异步地返回 Web 服务器的响应，并且能够以文本或者一个 DOM 文档的形式返回内容。XHR接口强制要求每个请求都具备严格的HTTP语义–应用提供数据和URL，浏览器格式化请求并管理每个连接的完整生命周期，所以XHR仅仅允许应用自定义一些HTTP首部，但更多的首部是不能自己设定的，如：

- Accept-Charset, Accept-Encoding, Access-Control-*
- Host, Upgrade, Connection, Referer, Origin
- Cookie, Sec-, Proxy-, 及其他首部

浏览器会拒绝绝对不安全的首部重写，以保证应用不能假扮用户代理、用户或请求来源，如Origin由浏览器自动设置，Access-Control-Allow-Origin由服务器设置，如果接受该请求，不包含该字段即可，浏览器发出的请求将作废。

封装AJAX请求

点击按钮触发ajax函数，并传递了一个对象类型的参数，对象中有参数请求地址，请求类型，请求数据，回调函数。

```html
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>测试Ajax函数</title>
</head>
<body>
    <input type="button" value="测试Ajax" class="ajax">
</body>
</html>
<script src="./Ajax.js"></script>
<script>
    // Ajax请求
    document.querySelector('.ajax').onclick = function(){
        // url type data success
        ajax({
            url:'./backs/backsend.php',
            type:'get',
            data:'name=胡图图&&skill=隔壁老王',
            success:function(data){
                document.body.innerHTML = data;
            }
    // post请求只需要该type为post即可
        });
    }
</script>
```

Ajax.js：服务器端接收到请求。

```javascript
// option：为接受的参数
function ajax(option){
    // 新建一个XHR请求
    var xhr = new XMLHttpRequest();
    // 判断请求类型且携带了请求数据
    if(option.type=='get'&&option.data)
    {
        //将数据拼接到option.url上，这次请求的option.url变为：http://127.0.0.1/backs/backsend.php?name=胡图图&&skill=隔壁老王，修改完成将data属性置空，防止多次点击。
        option.url += '?';
        option.url += option.data;
        option.data=null;
 		//如果是get请求传递真正的xhr请求到服务器端
    	xhr.open(option.type,option.url);
    }
    //判断请求类型且携带了请求数据
    if(option.type=='post'&&option.data)
    {
        // 设置请求头的MIME标准:https://developer.mozilla.org/zh-CN/docs/Web/HTTP/Basics_of_HTTP/MIME_types
        xhr.setRequestHeader('content-type','application/x-www-form-urlencoded');
    }
    //每当 readyState (状态值)改变时，就会触发 onreadystatechange 事件。readyState 属性存有 XMLHttpRequest 的状态信息。
    // readyState:网络状态码，：https://www.w3school.com.cn/ajax/ajax_xmlhttprequest_onreadystatechange.asp
    // readyState == 4 表示请求已完成，且响应已就绪
    // status(状态码)：status是XMLHttpRequest对象的一个属性，表示响应的HTTP状态码：https://www.cnblogs.com/liu-fei-fei/p/5618782.html
    
    //判断请求是否完成且响应成功
    xhr.onreadystatechange = function(){
        if(xhr.readyState==4&&xhr.status==200){
            // 定义相应头类型为type
            var type = xhr.getResponseHeader('Content-Type');
            // 判断响应数据类型是否为JSON类型
            //indexOf():如果要检索的字符串值没有出现，则该方法返回 -1。
            if(type.indexOf('json'!=-1)){
                // 执行回调函数
                option.success(JSON.parse(xhr.responseText));
            }
            // 判断响应数据类型是否为XML类型
            else if(type.indexOf(xhr.responseText)){
                option.success(xhr.responseXML)
            }else{
            // 判断响应数据类型是否为普通字符串类型
                option.success(xhr.responseText);
            }
        }
    }
    // 发送响应数据
    xhr.send(option.data);
}
```

