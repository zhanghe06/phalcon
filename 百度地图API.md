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

根据地址获取坐标：
```
<script type="text/javascript">
	// 实例化百度地图
	var map = new BMap.Map("allmap");
	// 创建地址解析器实例
	var myGeo = new BMap.Geocoder();
	// 将地址解析结果显示在地图上,并调整地图视野
	myGeo.getPoint("上海市黄浦区延安东路700号", function(point){
		if (point) {
			map.centerAndZoom(point, 16);
			map.addOverlay(new BMap.Marker(point));
			alert(point.lng + ", " + point.lat);
		}else{
			alert("您选择地址没有解析到结果!");
		}
	});
</script>
```
添加带检索功能的信息窗口
```
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
	<style type="text/css">
	body, html{width: 100%;height: 100%;margin:0;font-family:"微软雅黑";}
	#allmap {height: 500px;width:100%;overflow: hidden;}
	dl,dt,dd,ul,li{
		margin:0;
		padding:0;
		list-style:none;
	}
	dt{
		font-size:14px;
		font-family:"微软雅黑";
		font-weight:bold;
		border-bottom:1px dotted #000;
		padding:5px 0 5px 5px;
		margin:5px 0;
	}
	dd{
		padding:5px 0 0 5px;
	}
	li{
		line-height:28px;
	}
	</style>
	<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=您的密钥"></script>
	<script type="text/javascript" src="http://api.map.baidu.com/library/SearchInfoWindow/1.5/src/SearchInfoWindow_min.js"></script>
	<link rel="stylesheet" href="http://api.map.baidu.com/library/SearchInfoWindow/1.5/src/SearchInfoWindow_min.css" />
	<title>带检索功能的信息窗口</title>
</head>
<body>
	<div id="allmap">	
	</div>
<script type="text/javascript">
	// 百度地图API功能
    var map = new BMap.Map('allmap');
    var poi = new BMap.Point(116.307852,40.057031);
    map.centerAndZoom(poi, 16);
    map.enableScrollWheelZoom();

    var content = '<div style="margin:0;line-height:20px;padding:2px;">' +
                    '<img src="../img/baidu.jpg" alt="" style="float:right;zoom:1;overflow:hidden;width:100px;height:100px;margin-left:3px;"/>' +
                    '地址：北京市海淀区上地十街10号<br/>电话：(010)59928888<br/>简介：百度大厦位于北京市海淀区西二旗地铁站附近，为百度公司综合研发及办公总部。' +
                  '</div>';

    //创建检索信息窗口对象
    var searchInfoWindow = null;
	searchInfoWindow = new BMapLib.SearchInfoWindow(map, content, {
			title  : "百度大厦",      //标题
			width  : 290,             //宽度
			height : 105,             //高度
			panel  : "panel",         //检索结果面板
			enableAutoPan : true,     //自动平移
			searchTypes   :[
				BMAPLIB_TAB_SEARCH,   //周边检索
				BMAPLIB_TAB_TO_HERE,  //到这里去
				BMAPLIB_TAB_FROM_HERE //从这里出发
			]
		});
    var marker = new BMap.Marker(poi); //创建marker对象
    marker.enableDragging(); //marker可拖拽
    marker.addEventListener("click", function(e){
	    searchInfoWindow.open(marker);
    })
    map.addOverlay(marker); //在地图中添加marker
</script>
</body>
</html>
```
