安装步骤（Ubuntu 18.04 LTS）

1. 安装软件

```
apt install nginx php-fpm php-mysql php-gd php-mbstring php-zip php-curl php-xml mysql-server git zip python-pip
```

2. 克隆代码

```
cd /var/www/
git clone https://github.com/tanghengzhi/isign-php.git
chown -R www-data:www-data isign-php
```

3. 配置 nginx

vi /etc/nginx/sites-available/isign-php
```
server {
        listen 80;
        listen [::]:80;

        server_name app.fvlrung.com;

        root /var/www/isign-php/public;
        index index.php;

        client_max_body_size 100M;

        location / {
                rewrite "^/([a-zA-Z0-9]{6})$" /user/install/index/$1 last;
                try_files $uri $uri/ /index.php?s=$uri&$args;
        }

        location ~ \.php$ {
                include snippets/fastcgi-php.conf;
                fastcgi_pass unix:/var/run/php/php7.2-fpm.sock;
        }
}
```
ln -s /etc/nginx/sites-available/isign-php /etc/nginx/sites-enabled/
nginx -s reload

4. 申请证书(Let's Encrypt)
```
sudo apt-get update
sudo apt-get install software-properties-common
sudo add-apt-repository universe
sudo add-apt-repository ppa:certbot/certbot
sudo apt-get update

sudo apt-get install certbot python-certbot-nginx
sudo certbot --nginx
```

5. 配置 php-fpm

vi /etc/php/7.2/fpm/php.ini
```
upload_max_filesize = 100M

post_max_size = 100M
```
systemctl restart php7.2-fpm

6. 配置 mysql

```
mysql -u root
ALTER USER 'root'@'localhost' IDENTIFIED WITH mysql_native_password BY '123456';
FLUSH PRIVILEGES;

mysql -u root -p
CREATE DATABASE `isign-php`;
mysql -u root -p isign-php < /var/www/isign-php/isign-php.sql

mysql -u root -p
set sql_mode = '';
```

7. 安装 isign
```
cd /var/www/
git clone https://github.com/apperian/isign.git
cd isign/
pip install .
```

8. 后台地址：/admin

 管理：admin 密码123456