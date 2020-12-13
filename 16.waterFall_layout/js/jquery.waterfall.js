/*
  可以写一点软件的信息
  jQuery的插件的核心方法 一般跟 插件的js名字一样
  调用jQuery 提供的插件语法 来添加
  
*/
$.fn.extend({
  /*
      瀑布流布局的子元素 必须使用 .item 类名
      调用的方式是 $(布局容器).waterfall();
          必须为父元素 添加相对定位 必须为子元素 添加 绝对定位时
          如果不想给用户提那么多的需求,我们也能够在代码中 为他添加
    $(布局容器).waterfall();
  */
  waterfall: function () {
    // 获取 布局容器
    var $this = this;

    // 一.计算必须知道的值
    // 容器中的 item
    var itemWidth = $this.children('.item').width();

    // 每行的个数 总宽度 / 元素宽度 向下取整 
    var colNum = Math.floor($this.width() / itemWidth);
    // 间隙 	(总宽度 - 一行个数*元素宽度)/(一行个数+1)
    var margin = ($this.width() - colNum * itemWidth) / (colNum + 1);

    // 高度数组
    var heightArr = [];
    // 切记不要.length
    for (var i = 0; i < colNum; i++) {
      heightArr[i] = margin;
    }

    // 二.循环设置元素的位置
    var $items = $this.children('.item');

    for (var i = 0; i < $items.length; i++) {
      // 找到 最矮的位置
      // 最小索引
      var minIndex = 0;
      // 最小的高度
      var minHeight = heightArr[minIndex];
      for (var j = 0; j < heightArr.length; j++) {
        // 如果有更小的
        if (minHeight > heightArr[j]) {
          minIndex = j;
          minHeight = heightArr[j];
        }
      }
      // 设置元素去最矮的位置
      $items.eq(i).css({
        // (间隙+ 元素宽度) * 索引值 +间隙
        left: (margin + itemWidth) * minIndex + margin,
        top: minHeight
      });

      // 更改高度数组的内容
      heightArr[minIndex] += margin;
      heightArr[minIndex] += $this.children('.item').eq(i).height();
    }

    // 三.设置父容器的高度
    var maxHeight = heightArr[0];
    for (var i = 0; i < heightArr.length; i++) {
      // 如果有更大的 那么重新赋值即可
      if (maxHeight < heightArr[i]) {
        maxHeight = heightArr[i]
      }
    }
    // 设置容器的高度
    $this.height(maxHeight);

    // 为了链式编程 return this
    return $this;
  }
})