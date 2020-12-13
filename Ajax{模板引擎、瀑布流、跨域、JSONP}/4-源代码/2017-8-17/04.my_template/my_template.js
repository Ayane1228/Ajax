// 抽取 公共的
// 不确定的 作为参数
// 结果 返回给用户
// 
function my_template(id,data){
  // 字符串
  var str = document.querySelector('#'+id).innerHTML;
  // 定义正则
  var reg = /{{(\w+)}}/;
  // 循环替换 直到 为null 结束
  var result = reg.exec(str);
  while(result){
    str = str.replace(result[0],data[result[1]]);
    result = reg.exec(str);
  }
  // 获取结果
  return str;
}
/*
  模板引擎封装总结
    让大伙了解模板引擎的 核心原理
      使用 正则表达式检索字符串 直到检索不到为止
  总结--面试官问到
     模板引擎==>用过
     给我说说呗==>所以说用法 说完用法 说原理,我自己试着实现过一次

  ajax
    用过ajax吗?
       用过,用在不刷新页面获取数据
       用法是 创建异步对象 请求行 请求头 回调函数 请求主体
       请求响应回来之后 会触发 回调函数 而我们渲染页面的操作就是写在回调函数中
        在我写的项目里面 结合ajax 基本是这么用的
           发送之前 修改页面结构 
           数据回来之后 修改页面结构
       我从后台拿到的数据一般是 JSON,曾经碰到过 用XML的不知道 贵公司 用的是 哪种方式交互数据
       每次都自己写 好烦,
          试着自己封装了ajax
          可以设置get post data url success
       后来发现 jQuery有ajax 开始使用 jQuery的ajax
          jQuery的ajax 中帮我们实现了 自动转化数据的操作
       试着 修改了一下 自己封装的 ajax工具函数也实现了 自动转化数据的功能
         原理就是 获取 返回的 content-type 做判断即可
       所以我在项目中 如果用了 jQ 直接使用Jq的ajax 如果不需要用jQ 那么我就用自己封装的 Ajax
       
       随着数据的复杂程度变高 我发现修改dom元素很讨厌
         找到了 模板引擎这个东西 对比了一下 用 art-template
         用了一段时间之后 感觉不错就去试着自己实现了以下
            原理是 正则 替换文本
*/ 