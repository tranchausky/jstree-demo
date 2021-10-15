<?php
header("Content-Type: application/json; charset=UTF-8");



$draw = $_GET['draw'];
$start = $_GET['start'];

$records = [
    ['Image 1.jpg','Deleted','Cynthia','1/20/2021 2:14:27 AM','<a class="restore">Restore</a>'],
    ['Image 2.jpg','Deleted','Cynthia','1/20/2021 2:14:27 AM','<a class="restore">Restore</a>'],
    ['Image 3.jpg','Deleted','Cynthia','1/20/2021 2:14:27 AM','<a class="restore">Restore</a>'],
    ['Image 4.jpg','Deleted','Cynthia','1/20/2021 2:14:27 AM','<a class="restore">Restore</a>'],
    ['Image 5.jpg','Deleted','Cynthia','1/20/2021 2:14:27 AM','<a class="restore">Restore</a>'],
    ['Image 6.jpg','Deleted','Cynthia','1/20/2021 2:14:27 AM','<a class="restore">Restore</a>'],
    ['Image 7.jpg','Deleted','Cynthia','1/20/2021 2:14:27 AM','<a class="restore">Restore</a>'],
    ['Image 8.jpg','Deleted','Cynthia','1/20/2021 2:14:27 AM','<a class="restore">Restore</a>'],
    ['Image 9.jpg','Deleted','Cynthia','1/20/2021 2:14:27 AM','<a class="restore">Restore</a>'],
    ['Image 10.jpg','Deleted','Cynthia','1/20/2021 2:14:27 AM','<a class="restore">Restore</a>'],
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
        ['Image 11.jpg','Deleted','Cynthia','1/20/2021 2:14:27 AM','<a class="restore">Restore</a>'],
        ['Image 12.jpg','Deleted','Cynthia','1/20/2021 2:14:27 AM','<a class="restore">Restore</a>'],
        ['Image 13.jpg','Deleted','Cynthia','1/20/2021 2:14:27 AM','<a class="restore">Restore</a>'],
        ['Image 14.jpg','Deleted','Cynthia','1/20/2021 2:14:27 AM','<a class="restore">Restore</a>'],
        ['Image 15.jpg','Deleted','Cynthia','1/20/2021 2:14:27 AM','<a class="restore">Restore</a>'],
        ['Image 16.jpg','Deleted','Cynthia','1/20/2021 2:14:27 AM','<a class="restore">Restore</a>'],
        ['Image 17.jpg','Deleted','Cynthia','1/20/2021 2:14:27 AM','<a class="restore">Restore</a>'],
        ['Image 18.jpg','Deleted','Cynthia','1/20/2021 2:14:27 AM','<a class="restore">Restore</a>'],
        ['Image 19.jpg','Deleted','Cynthia','1/20/2021 2:14:27 AM','<a class="restore">Restore</a>'],
    ];
    $datas = [
        'data' =>$records,
        'draw' =>$draw,
        'recordsFiltered' =>19,
        'recordsTotal' =>19,
    ];
}



echo json_encode($datas);