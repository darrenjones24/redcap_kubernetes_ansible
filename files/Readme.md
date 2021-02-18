
To create the Redcap initial database:

CREATE DATABASE IF NOT EXISTS redcap_psychology;
CREATE USER 'redcap_psychology'@'x.x.x.x' IDENTIFIED BY 'see vault';
GRANT CREATE, SELECT, INSERT, UPDATE, DELETE ON redcap.* TO 'redcap'@'x.x.x.x';

-- Example for creating the database (in either MariaDB or MySQL)
CREATE DATABASE IF NOT EXISTS `redcap`;

-- (MARIADB ONLY) Example for creating the MariaDB user (replace the user and password with your own values)
CREATE USER 'redcap_user'@'%' IDENTIFIED BY 'password_for_redcap_user';
GRANT SELECT, INSERT, UPDATE, DELETE ON `redcap`.* TO 'redcap_user'@'%';

-- (MYSQL ONLY - DO NOT USE WITH MARIADB) 
-- Example for creating the MySQL user (replace the user and password with your own values)
CREATE USER 'redcap_user'@'%' IDENTIFIED WITH mysql_native_password BY 'password_for_redcap_user';
GRANT SELECT, INSERT, UPDATE, DELETE ON `redcap`.* TO 'redcap_user'@'%';

## Image build 

$ docker login uostechops.azurecr.io
$ docker build . -t redcap:x.x.x
$ docker tag <imagename> uostechops.azurecr.io/:x.x.x-buildumber
$ docker login uostechops.azurecr.io 
$ docker push uostechops.azurecr.io/mysqlbackup:x.x.x-buildumber


