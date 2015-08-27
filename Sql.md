## SQL语句的高级用法

拼接两个字段
（SQL Server 连接字符串是用“+”，mysql里的“+”是数字相加的操作，连接字符串是CONCAT函数）
```
SELECT trim(BOTH ';' FROM concat(phone,';',mobile)) FROM user_info;
```

查询独立用户的个数
```
SELECT COUNT(DISTINCT uid) as num FROM user_info;
```

按照年龄和性别组合分组统计，并排序
```
SELECT COUNT(*), sex FROM student GROUP BY sex, age ORDER BY age;
```

日程安排提前五分钟提醒
```
SELECT * FROM 日程安排 WHERE DATEDIFF('minute', f开始时间, GETDATE())>5;
```

显示每天日期所对应的名称和价格（日期的显示格式是 "YYYY-MM-DD"）
```
SELECT ProductName, UnitPrice, FORMAT(Now(),'YYYY-MM-DD') as PerDate FROM Products;
```

查找订单总金额少于 2000 的客户
（在 SQL 中增加 HAVING 子句原因是，WHERE 关键字无法与合计函数一起使用）
```
SELECT Customer,SUM(OrderPrice) FROM Orders GROUP BY Customer HAVING SUM(OrderPrice)<2000
```

查询用户的详细地址，并将null转为空串
```
SELECT TRIM(IF(address is null,'',address)) FROM user_detail;
```

查询列表中某字段最大的一条记录
```
SELECT A.* FROM user_info A,
(SELECT id, MAX(day) max_day FROM user_info GROUP BY id) B
WHERE A.id = B.id AND A.day = B.max_day;
```
