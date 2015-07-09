<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    {{ javascript_include("js/jquery/jquery-1.10.2.min.js") }}
    <title></title>
</head>
<body>

<div id="a">
    {{ model_a|default('第一模块默认显示') }}
</div>
<p></p>
<div id="b">
    {{ model_b|default('第二模块默认显示') }}
</div>
<p></p>
<div id="c">
    {{ model_c|default('第三模块默认显示') }}
</div>
<p></p>
<div id="d">
    {{ model_d|default('第四模块默认显示') }}
</div>

</body>
</html>

<script type="text/javascript">
    $(document).ready(function () {
        //第一模块异步请求
        $.ajax({
            url:'list/ajax_a',
            type:'get',
            success:function (data) {
                $('#a').html(data);
            }
        });
        //第二模块异步请求
        $.ajax({
            url:'list/ajax_b',
            type:'get',
            success:function (data) {
                $('#b').html(data);
            }
        });
        //第三模块异步请求
        $.ajax({
            url:'list/ajax_c',
            type:'get',
            success:function (data) {
                $('#c').html(data);
            }
        });
        //第四模块异步请求
        $.ajax({
            url:'list/ajax_d',
            type:'get',
            success:function (data) {
                $('#d').html(data);
            }
        });
    })
</script>