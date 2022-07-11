#!/bin/bash

if ! [[ -e "public/$1" ]]
then
    echo "$1 - файла не существует";
    exit;
fi

sail="/srv/fw/alfa/back/vendor/laravel/sail/bin/sail";
#mysql="/srv/fw/alfa/back/vendor/laravel/sail/bin/sail mysql";
mysql="docker exec laravel_913-mysql-1 mysql -u root -pkeys test";

echo "start";

#docker exec "laravel_913-mysql-1" mysql -u root -pkeys test --execute="SELECT * FROM contacts LIMIT 1";

#$sail;

${mysql} --execute="\
SET GLOBAL TRANSACTION ISOLATION LEVEL SERIALIZABLE; \
SELECT count(*) FROM contacts FOR UPDATE; \
UNLOCK TABLES;
";
${mysql} --execute="SHOW PROCESSLIST;";
${mysql} --execute="SELECT count(*) FROM contacts FOR UPDATE;";
${mysql} --execute="UNLOCK TABLES; \
COMMIT;";

#${sail} artisan import:xls $1;

echo "end";
