<?php
header("Content-Type: application/json; charset=UTF-8");



$draw = $_GET['draw'];
$start = $_GET['start'];

$records = [
    ['', 'New Image','Created','Cynthia','1/20/2021 2:14:27 AM'],
    ['Image 2.jpg', '','Deleted','Cynthia','1/20/2021 2:14:27 AM'],
    ['Image 3.jpg', 'New Image','Rename','Cynthia','1/20/2021 2:14:27 AM'],
    ['', 'New Image','Created','Cynthia','1/20/2021 2:14:27 AM'],
    ['Image 5.jpg', '','Deleted','Cynthia','1/20/2021 2:14:27 AM'],
    ['Image 6.jpg', 'New Image','Rename','Cynthia','1/20/2021 2:14:27 AM'],
    ['', 'New Image','Created','Cynthia','1/20/2021 2:14:27 AM'],
    ['Image 8.jpg', '','Deleted','Cynthia','1/20/2021 2:14:27 AM'],
    ['Image 9.jpg', 'New Image','Rename','Cynthia','1/20/2021 2:14:27 AM'],
    ['', 'New Image','Created','Cynthia','1/20/2021 2:14:27 AM'],
];
$datas = [
    'data' =>$records,
    'draw' =>$draw,
    'recordsFiltered' =>19,
    'recordsTotal' =>19,
];

// var_dump($_GET['length']);die;


if($start > 0){
    // echo '2222';die;
    $records = [
        ['Image 11.jpg', 'New Image','Deleted','Cynthia','1/20/2021 2:14:27 AM'],
        ['Image 12.jpg', 'New Image','Deleted','Cynthia','1/20/2021 2:14:27 AM'],
        ['Image 13.jpg', 'New Image','Deleted','Cynthia','1/20/2021 2:14:27 AM'],
        ['Image 14.jpg', 'New Image','Deleted','Cynthia','1/20/2021 2:14:27 AM'],
        ['Image 15.jpg', 'New Image','Deleted','Cynthia','1/20/2021 2:14:27 AM'],
        ['Image 16.jpg', 'New Image','Deleted','Cynthia','1/20/2021 2:14:27 AM'],
        ['Image 17.jpg', 'New Image','Deleted','Cynthia','1/20/2021 2:14:27 AM'],
        ['Image 18.jpg', 'New Image','Deleted','Cynthia','1/20/2021 2:14:27 AM'],
        ['Image 19.jpg', 'New Image','Deleted','Cynthia','1/20/2021 2:14:27 AM'],
    ];
    $datas = [
        'data' =>$records,
        'draw' =>$draw,
        'recordsFiltered' =>19,
        'recordsTotal' =>19,
    ];
}



echo json_encode($datas);