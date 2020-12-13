function my_template(id,dat){
    var str = document.querySelector('#'+id).innerHTML;
    // 定义正则表达式
        var reg = /{{(\w+)}}/;
    // 循环替换
    var result = reg.exec(str);
        while(result){
            str = str.replace(result[0],data[result[1]]);
            result = reg.exec(str);
        }
    // 获取结果
         return str;
}