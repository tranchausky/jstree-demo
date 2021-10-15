<?php
header("Content-Type: application/json; charset=UTF-8");



$draw = $_GET['draw'];
$start = $_GET['start'];

$records = [
    ['','Image 1.jpg','1000Kb','JPG File','1/20/2021 2:14:27 AM','Cynthia','<a class="btn">Copy URL</a>&nbsp;&nbsp;<a class="btn">View</a>'],
    ['','Image 2.jpg','1000Kb','JPG File','1/20/2021 2:14:27 AM','Cynthia','<a class="btn">Copy URL</a>&nbsp;&nbsp;<a class="btn">View</a>'],
    ['','Image 3.jpg','1000Kb','JPG File','1/20/2021 2:14:27 AM','Cynthia','<a class="btn">Copy URL</a>&nbsp;&nbsp;<a class="btn">View</a>'],
    ['','Image 4.jpg','1000Kb','JPG File','1/20/2021 2:14:27 AM','Cynthia','<a class="btn">Copy URL</a>&nbsp;&nbsp;<a class="btn">View</a>'],
    ['','Image 5.jpg','1000Kb','JPG File','1/20/2021 2:14:27 AM','Cynthia','<a class="btn">Copy URL</a>&nbsp;&nbsp;<a class="btn">View</a>'],
    ['','Image 6.jpg','1000Kb','JPG File','1/20/2021 2:14:27 AM','Cynthia','<a class="btn">Copy URL</a>&nbsp;&nbsp;<a class="btn">View</a>'],
    ['','Image 7.jpg','1000Kb','JPG File','1/20/2021 2:14:27 AM','Cynthia','<a class="btn">Copy URL</a>&nbsp;&nbsp;<a class="btn">View</a>'],
    ['','Image 8.jpg','1000Kb','JPG File','1/20/2021 2:14:27 AM','Cynthia','<a class="btn">Copy URL</a>&nbsp;&nbsp;<a class="btn">View</a>'],
    ['','Image 9.jpg','1000Kb','JPG File','1/20/2021 2:14:27 AM','Cynthia','<a class="btn">Copy URL</a>&nbsp;&nbsp;<a class="btn">View</a>'],
    ['','Image 10.jpg','1000Kb','JPG File','1/20/2021 2:14:27 AM','Cynthia','<a class="btn">Copy URL</a>&nbsp;&nbsp;<a class="btn">View</a>'],
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
        ['','Image 11.jpg','1000Kb','JPG File','1/20/2021 2:14:27 AM','Cynthia','<a class="btn">Copy URL</a>&nbsp;&nbsp;<a class="btn">View</a>'],
        ['','Image 12.jpg','1000Kb','JPG File','1/20/2021 2:14:27 AM','Cynthia','<a class="btn">Copy URL</a>&nbsp;&nbsp;<a class="btn">View</a>'],
        ['','Image 13.jpg','1000Kb','JPG File','1/20/2021 2:14:27 AM','Cynthia','<a class="btn">Copy URL</a>&nbsp;&nbsp;<a class="btn">View</a>'],
        ['','Image 14.jpg','1000Kb','JPG File','1/20/2021 2:14:27 AM','Cynthia','<a class="btn">Copy URL</a>&nbsp;&nbsp;<a class="btn">View</a>'],
        ['','Image 15.jpg','1000Kb','JPG File','1/20/2021 2:14:27 AM','Cynthia','<a class="btn">Copy URL</a>&nbsp;&nbsp;<a class="btn">View</a>'],
        ['','Image 16.jpg','1000Kb','JPG File','1/20/2021 2:14:27 AM','Cynthia','<a class="btn">Copy URL</a>&nbsp;&nbsp;<a class="btn">View</a>'],
        ['','Image 17.jpg','1000Kb','JPG File','1/20/2021 2:14:27 AM','Cynthia','<a class="btn">Copy URL</a>&nbsp;&nbsp;<a class="btn">View</a>'],
        ['','Image 18.jpg','1000Kb','JPG File','1/20/2021 2:14:27 AM','Cynthia','<a class="btn">Copy URL</a>&nbsp;&nbsp;<a class="btn">View</a>'],
        ['','Image 19.jpg','1000Kb','JPG File','1/20/2021 2:14:27 AM','Cynthia','<a class="btn">Copy URL</a>&nbsp;&nbsp;<a class="btn">View</a>'],
    ];
    $datas = [
        'data' =>$records,
        'draw' =>$draw,
        'recordsFiltered' =>19,
        'recordsTotal' =>19,
    ];
}



echo json_encode($datas);