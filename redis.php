<?php
use Workerman\Worker;
require_once __DIR__ . '/Workerman/Autoloader.php';

// ����һ��Worker����2347�˿ڣ���ʹ���κ�Ӧ�ò�Э��
$tcp_worker = new Worker("tcp://172.17.22.139:3456");

// ����4�����̶����ṩ����
$tcp_worker->count = 4;

// ���ͻ��˷�������ʱ
$tcp_worker->onMessage = function($connection, $data)
{
    //���ӱ��ص� Redis ����
    $redis = new Redis();
    $redis->connect('0.0.0.0', 6379);
    $redis->set('ionoresi',$data);
    $connection->send($data);
};

// ����worker
Worker::runAll();

?>