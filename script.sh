#!/bin/bash

if ! [[ -e "public/$1" ]]
then
    echo "$1 - файла не существует";
    exit;
fi

sail="/srv/fw/alfa/back/vendor/laravel/sail/bin/sail";
mysql="docker exec laravel_913-mysql-1 mysql -u root -pkeys test";

echo "start";

if ( $mysql --execute="SELECT IS_USED_LOCK('contacts');" ) then
    echo "import is still running";
    exit;
fi

if ( $mysql --execute="SELECT IS_FREE_LOCK('contacts');" ) then
    ${mysql} --execute="SELECT GET_LOCK('contacts', 10000);";
    ${sail} artisan import:xls $1;
    ${mysql} --execute="RELEASE_LOCK('contacts');";
    echo "import finished";
fi
echo "end";
exit;
