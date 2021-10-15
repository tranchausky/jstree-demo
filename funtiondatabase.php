<?php

require_once 'Medoo.php';

use Medoo\Medoo;

$database = new Medoo([
    'database_type' => 'mysql',
    'database_name' => 'treeview',
    'server' => 'localhost',
    'username' => 'chau',
    'password' => '123456',
    'charset' => 'utf8'
]);


function getContent($database, $id = '')
{
    $data = $database->select('listtree', [
        'content',
    ], [
        'id' => $id
    ]);
    return $data[0];
}
function getWhere($database, $where=[])
{
    // var_dump($where);die;
    $data = $database->select('listtree', [
        'id','text','icon',
    ], $where);
    return $data;
}

function saveContent($database, $datain)
{
    $database->insert('listtree', $datain);
    $last_id = $database->id();
    return ["id" => (int)$last_id];
}

function updateWhere($database, $where = [], $datain = [])
{
    //var_dump( $datain, $where);
    $data = $database->update('listtree', $datain, $where);
    return true;
}
function deleteWhere($database, $where = [])
{
    $data = $database->delete('listtree', $where);
    return true;
}
