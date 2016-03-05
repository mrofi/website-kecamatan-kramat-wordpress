#!/bin/bash

cd $OPENSHIFT_REPO_DIR/public

if [ -d all.sql ];
    then rm all.sql
fi

mysqldump -h $OPENSHIFT_MYSQL_DB_HOST -P ${OPENSHIFT_MYSQL_DB_PORT:-3306} -u ${OPENSHIFT_MYSQL_DB_USERNAME:-'admin'} --password="$OPENSHIFT_MYSQL_DB_PASSWORD" tegalweb  > all.sql