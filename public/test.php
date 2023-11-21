<?php
$redis = new Redis();
$redis->connect('127.0.0.1',6379);
 $redis->set('name','klc');
echo $redis->get('name');
