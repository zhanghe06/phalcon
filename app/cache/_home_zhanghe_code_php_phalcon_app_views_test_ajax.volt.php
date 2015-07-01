<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <?php echo $this->tag->javascriptInclude('js/jquery/jquery.min.js'); ?>
    <script type="text/javascript">
        $(document).ready(function () {
            $("#b01").click(function () {
                var html_obj = $.ajax({
                    //提交数据的类型 POST GET
                    type: "POST",
                    //提交的网址
                    url: "/test/ajax",
                    //提交的数据
                    data: {name: "mike", password: "123456"},
                    //返回数据的格式 "xml", "html", "script", "json", "jsonp", "text".
                    dataType: "html",
                    //超时时间设置，单位毫秒
                    //timeout: 1000,
                    //在请求之前调用的函数
                    beforeSend: function () {
                        $("#myDiv").html("正在获取数据。。。");
                    },
                    //请求类型true/false 默认true异步/false为同步
                    async: true,
                    //成功返回之后调用的函数
                    success: function (data) {
                        $("#myDiv").html(data);
                    },
                    //调用执行后调用的函数
                    complete: function (XMLHttpRequest, textStatus) {
                        if (textStatus == 'timeout') {
                            $("#tip").html('请求超时');
                        }
                        if (textStatus == 'success') {
                            $("#tip").html('请求成功');
                        }
                        if (textStatus == 'error') {
                            $("#tip").html('请求失败');
                        }
                    }
                });
                //简化版的ajax请求，不需要上面的 success 和 complete
                //$("#myDiv").html(html_obj.responseText);
            });
        });
    </script>
    <title></title>
</head>
<body>
<div id="myDiv">通过 AJAX 改变文本</div>
<button id="b01" type="button">改变内容</button>
<div id="tip"></div>
<div>
    <pre>
    XMLHttpRequest.readyState:

    状态码

    0 － （未初始化）还没有调用send()方法

    1 － （载入）已调用send()方法，正在发送请求

    2 － （载入完成）send()方法执行完成，已经接收到全部响应内容

    3 － （交互）正在解析响应内容

    4 － （完成）响应内容解析完成，可以在客户端调用了
    </pre>
</div>
</body>
</html>