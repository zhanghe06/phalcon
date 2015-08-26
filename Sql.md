## 记录非常规的sql语句

拼接两个字段
```
SELECT trim(BOTH ';' FROM concat(phone,';',mobile)) FROM user_info;
```

查询独立用户的个数
```
SELECT COUNT(DISTINCT uid) as num FROM user_info;
```
