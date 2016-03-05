<?php

return array(

    'connections' => array(

        'mysql' => array(
            'driver'    => 'mysql',
            'host'      => getenv('OPENSHIFT_MYSQL_DB_HOST'),
            'port'      => getenv('OPENSHIFT_MYSQL_DB_PORT'),
            'database'  => 'jayainstitute_dash',
            'username'  => getenv('OPENSHIFT_MYSQL_DB_USERNAME'),
            'password'  => getenv('OPENSHIFT_MYSQL_DB_PASSWORD'),
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        ),
    )
);