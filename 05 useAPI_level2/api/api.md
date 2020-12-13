随机获取英雄
    请求方式:get
    接口地址:
        http:'./api/HeroInfo_List_get.php'
    参数:
        num:随机英雄个数
    返回字段:
        status:请求状态
        info:中文提示
        data:返回的数据(请求失败这里没有内容)
            champion_icon：图片路径
            champion_name: 姓名
            champion_title：外号
            champion_info：个性签名
            champion_icon：标签

获取英雄详细信息 还有url
    请求方式:post
    接口地址:
        http:'./api/HeroInfo_details_post.php'
    参数:
        name:英雄名字
    返回字段:
        status:请求状态
        info:中文提示
        data:返回的数据(请求失败这里没有内容)
            champion_icon：图片路径
            champion_name: 姓名
            champion_title：外号
            champion_info：个性签名
            champion_icon：标签
            champion_url：详细攻略
            