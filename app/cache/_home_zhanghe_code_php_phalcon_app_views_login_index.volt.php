<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <script type="text/javascript" src="../../../public/js/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="../../../public/js/js_encrypt.js"></script>
    <title>加密解密-登录测试</title>
</head>
<body>

<script type="text/javascript">
    $(function () {
        var public_key = '-----BEGIN PUBLIC KEY-----\
            MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQDKTouc1nODkSyksshf3sTDl2E7\
            enj7CsDwdPpJX6bIbteraXV9gd99xSa62o9l7W+0t8SPJE4A5CGdSU7LZE7yxQbP\
            +tmGU4SkrvoIfJo3wEU5jDLRvgGUCLRAbJTOI7E4WvBwCX69WjQ4Y8xXh7J2F6Bu\
            klsL31XBW+8gTHiv9QIDAQAB\
            -----END PUBLIC KEY-----';
        var crypt = new JSEncrypt();
        var email = $('#email').val();
        var password = $('#password').val();
        crypt.setPublicKey(public_key);
        $('#email_hidden').val(crypt.encrypt(email));
        $('#password_hidden').val(crypt.encrypt(password));
    });
</script>
</body>
</html>

