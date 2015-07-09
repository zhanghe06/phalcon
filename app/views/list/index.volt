<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    {{ javascript_include("js/jquery/jquery-1.10.2.min.js") }}
    <title></title>
</head>
<body>
{{ model_a|default('第一模块默认显示') }}
<p></p>
{{ model_b|default('第二模块默认显示') }}
<p></p>
{{ model_c|default('第三模块默认显示') }}
<p></p>
{{ model_d|default('第四模块默认显示') }}
</body>
</html>

<script>

</script>