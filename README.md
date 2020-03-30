liunx系统装宝塔，php7.0 mysql5.6需要开启ss1和伪静态

ningx 伪静态：

location/
if（-e $request filename）{
rewrite"/（La-zA-20-9]（6））$"/user/install/index/$1/last.
rewrite（.*）/index.php？s=$1 last；break；
}

1：自录指向public关防跨站

2：修改数据库地址：data/conf/database.php

3：导入数据库文件 shujuku.sql

4：后台地址：/admin/public/login.html

 管理：admin 密码123456