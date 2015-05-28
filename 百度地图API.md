## 百度地图API

首页:
<http://developer.baidu.com/map/index.php>

开发demo:
<http://developer.baidu.com/map/jsdemo.htm#a1_2>

示例代码：

```
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no"/>
    <style type="text/css">
        body, html,#allmap {width: 100%;height: 100%;overflow: hidden;margin:0;font-family:"微软雅黑";}
    </style>
    <script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=您的密钥"></script>
    <title>地址解析</title>
</head>
<body>
<div id="allmap"></div>
</body>
</html>
<script type="text/javascript">
    // 实例化百度地图
    var map = new BMap.Map("allmap");
    var point = new BMap.Point(116.331398, 39.897445);
    // 允许缩放
    map.enableScrollWheelZoom(true);
    // 定义显示等级
    map.centerAndZoom(point, 14);
    // 添加标记
    map.addOverlay(new BMap.Marker(point));
    // 显示坐标
    function showInfo(e) {
        alert(e.point.lng + ", " + e.point.lat);
    }
    // 监听单击事件
    map.addEventListener("click", showInfo);
</script>
```
