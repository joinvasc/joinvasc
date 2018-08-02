FROM mysql:5.7

MAINTAINER Mahmoud Zalt <mahmoud@zalt.me>

ADD my.cnf /etc/mysql/conf.d/my.cnf

RUN deluser mysql
RUN useradd mysql
RUN mkdir -p /var/lib/mysql
RUN chmod -R 777 /var/lib/mysql

CMD ["mysqld"]

EXPOSE 3306
