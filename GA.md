##Google Analytics（谷歌分析）

<http://www.google.com/intl/zh-CN/analytics/>

目前最新的统计代码采用了异步算法
示例如下：
```
<script type="text/javascript">
    //统计元素定义
    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-xxxxxx-x']);
    _gaq.push(['_trackPageview']);
    //统计代码
    (function() {
        var ga = document.createElement('script');
        ga.type = 'text/javascript';
        ga.async = true;
        ga.src = 
        ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(ga, s);
    })();
</script>
```

新的代码具有以下优点：
1、网页能更快地加载跟踪代码，改善浏览器加载时间。
2、增强数据收集的准确性。
3、消除因JavaScript代码未完全加载而差生的错误。