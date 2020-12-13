/**
 * ajax工具函数-get
 * @param {*} url 
 * @param {*} data(key1=value1&key2=value2) 
 * @param {*} success 
 */
function get(url, data, success) {
  var xhr = new XMLHttpRequest();
  if (data) {
    url += '?';
    url += data;
  }
  xhr.open('get', url);
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      success(xhr.responseText);
    }
  }
  xhr.send(null);
}

/**
 * ajax工具函数-post
 * @param {*} url 
 * @param {*} data (key1=value1&key2=value2) 
 * @param {*} success 
 */
function post(url, data, success) {
  var xhr = new XMLHttpRequest();
  xhr.open('post', url);
  if (data) {
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
  }
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      console.log(xhr.responseText);
      success(xhr.responseText);
    }
  }
  xhr.send(data);
}

/**
 * 参数越来越多之后 用户如果要传递参数 必须遵循
 * @param {*} url 
 * @param {*} type 
 * @param {*} data 
 * @param {*} success 
 */
function ajax_test(url, type, data, success) {
  var xhr = new XMLHttpRequest();
  // 如果是get 并且有数据
  if (type == 'get' && data) {
    url += '?';
    url += data;
    data = null; // 这样最后直接send data即可 
  }
  xhr.open(type, url);
  // post请求 并且有数据
  if (type == 'post' && data) {
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
  }
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      success(xhr.responseText);
    }
  }
  xhr.send(data);
}

// 只传递一个参数
// 用户传入的是 对象
/*
  键名
    url
    type
    data
    success
  用户不需要记忆 参数的顺序 只需要记忆 参数的属性名即可
  大部分的框架 都是这么做的
*/
function ajax(option) {
  var xhr = new XMLHttpRequest();
  // 如果是get 并且有数据
  if (option.type == 'get' && option.data) {
    option.url += '?';
    option.url += option.data;
    option.data = null; // 这样最后直接send data即可 
  }
  xhr.open(option.type, option.url);
  // post请求 并且有数据
  if (option.type == 'post' && option.data) {
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
  }
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      // option.success(xhr.responseText);
      // console.log(xhr.getResponseHeader('Content-Type'));
      var type = xhr.getResponseHeader('Content-Type');
      // 是否为json
      if (type.indexOf('json') != -1) {
        option.success(JSON.parse(xhr.responseText));
      }
      // 是否为xml
      else if (type.indexOf('xml') != -1) {
        option.success(xhr.responseXML);
      }
      // 普通字符串
      else {
        option.success(xhr.responseText);
      }
    }
  }
  xhr.send(option.data);
}


/*
  总结
    封装的目的
    封装的步骤
    封装的好坏
*/