<?php
require_once 'funtiondatabase.php';
header("Content-Type: application/json; charset=UTF-8");

$id = $_GET['id'];
$operation = $_GET['operation'];

switch ($operation) {
    case 'create_node':
        $position = $_GET['position'];
        $text = $_GET['text'];
        $datain = [
            'id_parent'=>$id,
            'text'=>$text,
        ];
        $data = saveContent($database,$datain);
        break;
    case 'get_content':
        
        //$data = getContent($database,$id);
        $str = file_get_contents('content_view.html');
        $data = [
            'content' =>$str
        ];
       
        break;
    case 'rename_node':
        $text = $_GET['text'];
        $datain = [
            'text'=>$text
        ];
        $where = [
            'id'=>$id
        ];
        $data = updateWhere($database,$where,$datain);
        break;
    case 'delete_node':
        $where = [
            'id'=>$id
        ];
        $data = deleteWhere($database,$where);
        break;
    case 'get_node':
        if($id =='#'){
            $id=1;
        }
        $where = [
            'id'=>$id
        ];
        $data = getWhere($database,$where);
        $where = [
            'id_parent'=>$id
        ];
        $childs = getWhere($database,$where);
        if(count($childs)>0){
            foreach ($childs as $key => $child) {
                $id_child = $child['id'];
                $where = [
                    'id_parent'=>$id_child
                ];
                $list_child = getWhere($database,$where);
                if(count($list_child)>0){
                    $childs[$key]['children']=true;
                }
            }
            $data[0]['children']=$childs;
        }
        break;
    default:
        # code...
        break;
}



echo json_encode($data);
die;