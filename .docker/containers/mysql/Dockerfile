FROM mysql:latest

ARG USER_ID='1000'
ARG USER_ID=${USER_ID}
ENV USER_ID ${USER_ID}

ARG GROUP_ID='1000'
ARG GROUP_ID=${GROUP_ID}
ENV GROUP_ID ${GROUP_ID}

ADD my.cnf /etc/mysql/conf.d/my.cnf

RUN groupmod -g $USER_ID mysql
RUN usermod -u $USER_ID mysql

CMD ["--character-set-server=utf8mb4", "--collation-server=utf8mb4_general_ci", "--skip-character-set-client-handshake"]

EXPOSE 3306
