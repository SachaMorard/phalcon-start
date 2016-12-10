#!/bin/bash

#############################
# Test environment creation #
#############################
CASSANDRA_KEYSPACE_NAME=d

MYSQL_DB_NAME=d
MYSQL_USER=d
MYSQL_PASSWORD=d95

ES_HOST=localhost
ES_PORT=9200

REDIS_HOST=localhost
REDIS_PORT=6379

function mysqlcmd {
     docker exec -t d_mysql_1 sh -c "/usr/bin/mysql --user=\"$MYSQL_USER\" --password=\"$MYSQL_PASSWORD\" --execute=\"$1\" 2>&1 | grep -v \"Warning: Using a password\""
}

function dcmd {
    docker exec -t d_php_1 sh -c "/home/www/d/d $1"
}

# Cassandra
#echo 'Creating Cassandra DB'
#docker exec -t d_cassandra_1 sh -c "echo \"DROP KEYSPACE IF EXISTS $CASSANDRA_KEYSPACE_NAME; CREATE KEYSPACE $CASSANDRA_KEYSPACE_NAME WITH REPLICATION = { 'class' : 'SimpleStrategy', 'replication_factor' : 1 }; exit\" | cqlsh"

# MySQL
echo 'Creating MySQL DB'
mysqlcmd "DROP DATABASE IF EXISTS $MYSQL_DB_NAME; CREATE DATABASE $MYSQL_DB_NAME CHARACTER SET utf8 COLLATE utf8_general_ci;"

# ES
echo 'Cleaning ES indices'
docker exec -t d_elasticsearch_1 sh -c "/usr/bin/curl -XDELETE \"http://$ES_HOST:$ES_PORT/*\""

# Redis
echo 'Flushing Redis data'
docker exec -t d_redis_1 sh -c "/usr/local/bin/redis-cli -h $REDIS_HOST -p $REDIS_PORT FLUSHALL"

# Populating data
#dcmd "mig run"
