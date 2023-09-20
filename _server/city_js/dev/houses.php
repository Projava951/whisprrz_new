<?php
/**$data = [];
$data[1] = [
    'ext' => [ //эксиерьер дома
        'enterDist' => 50, //дистанция входа
        'enterPoint' => [84, 417, 150], //токачка входа, если задана - дистанция входа не работает [x,y, radius]
        'startPoint' => [-87, 825, 150, 0], //точка появления при выходе из дома [x,y, radius]
        'loc' => 23, //ид локации
        'fov' => 67,
        'objs' => [ //конфигурация объектов дома
            ["geo" => "house_ext_01_pt1.obj",  "map" => 'house_ext_01_pt1_2048_001.jpg'],
            ["geo" => "house_ext_01_pt2.obj",  "map" => 'house_ext_01_pt2_1024_002_E1.jpg'],
            ["geo" => "house_ext_01_col.obj", "collider" => true]

]
    ],
    'int1' => [ //первый этаж
        'exitDist' => 150, //дистанция выхода(до стены)
        'exitPoint' => [106, 235, 100], //точка выхода, если задана - дистанция выхода не работает
        'exitPoint2' => [-300, -200, 100], //точка выхода, если задана - дистанция выхода не работает
        'exitPoint3' => null,
        'toFloor2' => [250, 0, 50], // переход на второй этаж [x, y, radius] либо null если второго этажа нет
        'z' => 97, //высота пола
        'loc' => 24, //ид локации
        'startPoint' => [90, 120, 30, 0], //точка входа с улицы
        'fromFloor2' => [320, 0, 140, 90], //точка входа со втрого этажа
        'panoShift' => 0, //смещение панорамы по z
        'fov' => 67,
        'objs' => [ //конфигурация объектов дома
            ["geo" => "house_int_01_f1_pt1.obj", "map" => "house_int_01_f1_pt1_2048_006_E3.jpg"],
            ["geo" => "house_int_01_f1_pt2.obj", "map" => "house_int_01_f1_pt2_1024_003_E1.jpg"],
            ["geo" => "house_int_01_f1_collider.obj", "collider" => true ],
            ["geo" => "house_int_01_f1_floor1.obj", "map"=>"house_int_01_f1_pt1_2048_006_E3.jpg", "floor" => true],
            ["geo" => "house_int_01_f1_floor2.obj", "map" => "house_int_01_f1_pt2_1024_003_E1.jpg", "floor" => true]
            ]

],
    'int2' => [ //второй этаж
        'toFloor3' => null,
        'toFloor1' => [325, -96, 100],
        'fromFloor1' => [164, -43, 50, 90],
        'loc' => 25,
        'z' => 376,
        'panoShift' => 0,
        'fov' => 67,
        'objs' => [
            ["geo" => "house_int_01_f2_floor.obj", "map" => "house_int_01_f2_2048_013_E3.jpg", "floor" => true],
            ["geo" => "house_int_01_f2_.obj", "map" => "house_int_01_f2_2048_013_E3.jpg"],
            ["geo" => "house_int_01_f2_collider.obj", "collider" => true ],
            ]

],
    'int3' => [ //третий этаж
        'toFloor2' => null,
        'objs' => [

]

]
];


$data[2] = [
    'ext' => [ //эксиерьер дома
        'enterDist' => 50, //дистанция входа
        'enterPoint' => [76, 617, 150], //токачка входа, если задана - дистанция входа не работает [x,y, radius]
        'startPoint' => [-87, 825, 150, 0], //точка появления при выходе из дома [x,y, radius]
        'loc' => 27, //ид локации
        'fov' => 65,
        'snow' => 40,
        'ice' => true,
        'objs' => [ //конфигурация объектов дома
            ["geo" => "house_ext_01_pt1.obj",  "map" => 'house_ext_01_pt1_2048_001.jpg'],
            ["geo" => "house_ext_01_pt2.obj",  "map" => 'house_ext_01_pt2_1024_002_E1.jpg'],
            ["geo" => "house_ext_01_col.obj", "collider" => true]

]
    ],
    'int1' => [ //первый этаж
        'exitDist' => 150, //дистанция выхода(до стены)
        'exitPoint' => [95, 195, 50], //точка выхода, если задана - дистанция выхода не работает
        'toFloor2' => [250, 0, 50], // переход на второй этаж [x, y, radius] либо null если второго этажа нет
        'z' => 97, //высота пола
        'loc' => 28, //ид локации
        'startPoint' => [90, 120, 30, 0], //точка входа с улицы
        'fromFloor2' => [74, -21, 50, 90], //точка входа со втрого этажа
        'panoShift' => 0, //смещение панорамы по z
        'fov' => 65,
        'objs' => [ //конфигурация объектов дома
            ["geo" => "house_int_01_f1_pt1.obj", "map" => "house_int_01_f1_pt1_2048_006_E3.jpg"],
            ["geo" => "house_int_01_f1_pt2.obj", "map" => "house_int_01_f1_pt2_1024_003_E1.jpg"],
            ["geo" => "house_int_01_f1_collider.obj", "collider" => true ],
            ["geo" => "house_int_01_f1_floor1.obj", "map"=>"house_int_01_f1_pt1_2048_006_E3.jpg", "floor" => true],
            ["geo" => "house_int_01_f1_floor2.obj", "map" => "house_int_01_f1_pt2_1024_003_E1.jpg", "floor" => true]
            ]

],
    'int2' => [ //второй этаж
        'toFloor3' => null,
        'toFloor1' => [247, -96, 10],
        'fromFloor1' => [164, -43, 50, 90],
        'loc' => 29,
        'z' => 376,
        'panoShift' => 0,
        'fov' => 65,
        'objs' => [
            ["geo" => "house_int_01_f2_floor.obj", "map" => "house_int_01_f2_2048_013_E3.jpg", "floor" => true],
            ["geo" => "house_int_01_f2_.obj", "map" => "house_int_01_f2_2048_013_E3.jpg"],
            ["geo" => "house_int_01_f2_collider.obj", "collider" => true ],
            ]

],
    'int3' => [ //третий этаж
        'toFloor2' => null,
        'objs' => [

]

]
];

$data[3] = [
    'ext' => [ //эксиерьер дома
        'enterDist' => 50, //дистанция входа
        'enterPoint' => [84, 417, 150], //токачка входа, если задана - дистанция входа не работает [x,y, radius]
        'iconPoint' => null, //точка отображения иконки входа, если не задана отображается на координатах точки входа
        'startPoint' => [-87, 825, 150, 0], //точка появления при выходе из дома [x,y, radius]
        'loc' => 31, //ид локации
        'fov' => 67,
        'objs' => [ //конфигурация объектов дома
            ["geo" => "house_ext_01_pt1.obj",  "map" => 'house_ext_01_pt1_2048_001.jpg'],
            ["geo" => "house_ext_01_pt2.obj",  "map" => 'house_ext_01_pt2_1024_002_E1.jpg'],
            ["geo" => "house_ext_01_col.obj", "collider" => true]

]
    ],
    'int1' => [ //первый этаж
        'exitDist' => 150, //дистанция выхода(до стены)
        'exitPoint' => [106, 235, 100], //точка выхода, если задана - дистанция выхода не работает
        'exitPoint2' => [-300, -200, 100], //точка выхода, если задана - дистанция выхода не работает
        'exitPoint3' => null,
        'toFloor2' => [250, 0, 50], // переход на второй этаж [x, y, radius] либо null если второго этажа нет
        'z' => 97, //высота пола
        'loc' => 32, //ид локации
        'startPoint' => [90, 120, 30, 0], //точка входа с улицы
        'fromFloor2' => [320, 0, 140, 90], //точка входа со втрого этажа
        'panoShift' => 0, //смещение панорамы по z
        'fov' => 67,
        'objs' => [ //конфигурация объектов дома
            ["geo" => "house_int_01_f1_pt1.obj", "map" => "house_int_01_f1_pt1_2048_006_E3.jpg"],
            ["geo" => "house_int_01_f1_pt2.obj", "map" => "house_int_01_f1_pt2_1024_003_E1.jpg"],
            ["geo" => "house_int_01_f1_collider.obj", "collider" => true ],
            ["geo" => "house_int_01_f1_floor1.obj", "map"=>"house_int_01_f1_pt1_2048_006_E3.jpg", "floor" => true],
            ["geo" => "house_int_01_f1_floor2.obj", "map" => "house_int_01_f1_pt2_1024_003_E1.jpg", "floor" => true]
            ]

],
    'int2' => [ //второй этаж
        'toFloor3' => null,
        'toFloor1' => [325, -96, 100],
        'fromFloor1' => [164, -43, 50, 90],
        'loc' => 33,
        'z' => 376,
        'panoShift' => 0,
        'fov' => 67,
        'objs' => [
            ["geo" => "house_int_01_f2_floor.obj", "map" => "house_int_01_f2_2048_013_E3.jpg", "floor" => true],
            ["geo" => "house_int_01_f2_.obj", "map" => "house_int_01_f2_2048_013_E3.jpg"],
            ["geo" => "house_int_01_f2_collider.obj", "collider" => true ],
            ]

],
    'int3' => [ //третий этаж
        'toFloor2' => null,
        'objs' => [

]

]
];


$data[4] = [
    'ext' => [ //эксиерьер дома
        'enterDist' => 50, //дистанция входа
        'enterPoint' => [84, 417, 150], //токачка входа, если задана - дистанция входа не работает [x,y, radius]
        'startPoint' => [-87, 825, 150, 0], //точка появления при выходе из дома [x,y, radius]
        'loc' => 35, //ид локации
        'fov' => 67,
        'objs' => [ //конфигурация объектов дома
            ["geo" => "house_ext_01_pt1.obj",  "map" => 'house_ext_01_pt1_2048_001.jpg'],
            ["geo" => "house_ext_01_pt2.obj",  "map" => 'house_ext_01_pt2_1024_002_E1.jpg'],
            ["geo" => "house_ext_01_col.obj", "collider" => true]

]
    ],
    'int1' => [ //первый этаж
        'exitDist' => 150, //дистанция выхода(до стены)
        'exitPoint' => [106, 235, 100], //точка выхода, если задана - дистанция выхода не работает
        'exitPoint2' => [-300, -200, 100], //точка выхода, если задана - дистанция выхода не работает
        'exitPoint3' => null,
        'toFloor2' => [250, 0, 50], // переход на второй этаж [x, y, radius] либо null если второго этажа нет
        'z' => 97, //высота пола
        'loc' => 36, //ид локации
        'startPoint' => [90, 120, 30, 0], //точка входа с улицы
        'fromFloor2' => [320, 0, 140, 90], //точка входа со втрого этажа
        'panoShift' => 0, //смещение панорамы по z
        'fov' => 67,
        'objs' => [ //конфигурация объектов дома
            ["geo" => "house_int_01_f1_pt1.obj", "map" => "house_int_01_f1_pt1_2048_006_E3.jpg"],
            ["geo" => "house_int_01_f1_pt2.obj", "map" => "house_int_01_f1_pt2_1024_003_E1.jpg"],
            ["geo" => "house_int_01_f1_collider.obj", "collider" => true ],
            ["geo" => "house_int_01_f1_floor1.obj", "map"=>"house_int_01_f1_pt1_2048_006_E3.jpg", "floor" => true],
            ["geo" => "house_int_01_f1_floor2.obj", "map" => "house_int_01_f1_pt2_1024_003_E1.jpg", "floor" => true]
            ]

],
    'int2' => [ //второй этаж
        'toFloor3' => null,
        'toFloor1' => [325, -96, 100],
        'fromFloor1' => [164, -43, 50, 90],
        'loc' => 37,
        'z' => 376,
        'panoShift' => 0,
        'fov' => 67,
        'objs' => [
            ["geo" => "house_int_01_f2_floor.obj", "map" => "house_int_01_f2_2048_013_E3.jpg", "floor" => true],
            ["geo" => "house_int_01_f2_.obj", "map" => "house_int_01_f2_2048_013_E3.jpg"],
            ["geo" => "house_int_01_f2_collider.obj", "collider" => true ],
            ]

],
    'int3' => [ //третий этаж
        'toFloor2' => null,
        'objs' => [

]

]
];

$data[5] = [
    'ext' => [ //эксиерьер дома
        'enterDist' => 50, //дистанция входа
        'enterPoint' => [84, 417, 150], //токачка входа, если задана - дистанция входа не работает [x,y, radius]
        'startPoint' => [67, 758, 100, 0], //точка появления при выходе из дома [x,y, radius]
        'loc' => 39, //ид локации
        'fov' => 67,
        'objs' => [ //конфигурация объектов дома
            ["geo" => "house_ext_01_pt1.obj",  "map" => 'house_ext_01_pt1_2048_001.jpg'],
            ["geo" => "house_ext_01_pt2.obj",  "map" => 'house_ext_01_pt2_1024_002_E1.jpg'],
            ["geo" => "house_ext_01_col.obj", "collider" => true]

]
    ],
    'int1' => [ //первый этаж
        'exitDist' => 150, //дистанция выхода(до стены)
        'exitPoint' => [106, 235, 100], //точка выхода, если задана - дистанция выхода не работает
        'exitPoint2' => [-300, -200, 100], //точка выхода, если задана - дистанция выхода не работает
        'exitPoint3' => null,
        'toFloor2' => [250, 0, 50], // переход на второй этаж [x, y, radius] либо null если второго этажа нет
        'z' => 97, //высота пола
        'loc' => 40, //ид локации
        'startPoint' => [90, 120, 30, 0], //точка входа с улицы
        'fromFloor2' => [320, 0, 140, 90], //точка входа со втрого этажа
        'panoShift' => 0, //смещение панорамы по z
        'fov' => 67,
        'objs' => [ //конфигурация объектов дома
            ["geo" => "house_int_01_f1_pt1.obj", "map" => "house_int_01_f1_pt1_2048_006_E3.jpg"],
            ["geo" => "house_int_01_f1_pt2.obj", "map" => "house_int_01_f1_pt2_1024_003_E1.jpg"],
            ["geo" => "house_int_01_f1_collider.obj", "collider" => true ],
            ["geo" => "house_int_01_f1_floor1.obj", "map"=>"house_int_01_f1_pt1_2048_006_E3.jpg", "floor" => true],
            ["geo" => "house_int_01_f1_floor2.obj", "map" => "house_int_01_f1_pt2_1024_003_E1.jpg", "floor" => true]
            ]

],
    'int2' => [ //второй этаж
        'toFloor3' => null,
        'toFloor1' => [325, -96, 100],
        'fromFloor1' => [164, -43, 50, 90],
        'loc' => 41,
        'z' => 376,
        'panoShift' => 0,
        'fov' => 67,
        'objs' => [
            ["geo" => "house_int_01_f2_floor.obj", "map" => "house_int_01_f2_2048_013_E3.jpg", "floor" => true],
            ["geo" => "house_int_01_f2_.obj", "map" => "house_int_01_f2_2048_013_E3.jpg"],
            ["geo" => "house_int_01_f2_collider.obj", "collider" => true ],
            ]

],
    'int3' => [ //третий этаж
        'toFloor2' => null,
        'objs' => [

]

]
];



$data[6] = [
    'ext' => [ //эксиерьер дома
        'enterDist' => 50, //дистанция входа
        'enterPoint' => [248, 459, 150], //токачка входа, если задана - дистанция входа не работает [x,y, radius]
        'startPoint' => [67, 758, 100, 0], //точка появления при выходе из дома [x,y, radius]
        'iconPoint' => [245, 280, 150],
        'loc' => 31, //ид локации
        'shadowCutDist' => 1, //0-1 0-полное обрезаниеб 1-ничего не обрезаем 0.8 - по умолчанию
        'fov' => 67,
        'objs' => [ //конфигурация объектов дома
            ["geo" => "house_03_ext.obj",  "map" => ['house_03_ext_pt1_2048_002.jpg', 'house_03_ext_pt2_1024_001.jpg']],
            ["geo" => "house_03_glass.obj",  "map" => 'lj-BopBg.png', "glass"=>true],





]
    ],
    'int0' => [ //первый этаж

'exitPoint' => [245, 210, 100], //точка выхода, если задана - дистанция выхода не работает
        'exitPoint2' => null, //точка выхода, если задана - дистанция выхода не работает
        'exitPoint3' => null,
        'toFloor1' => [428, -51, 50],
        'z' => 27, //высота пола
        'loc' => 46, //ид локации
        'startPoint' => [200, 115, 30, 0], //точка входа с улицы
        'fromFloor1' => [593, -530,  90, 180], //точка входа со втрого этажа
        'panoShift' => 0, //смещение панорамы по z
        'fov' => 67,
        'objs' => [ //конфигурация объектов дома

["geo" => "house_03_f0.obj", "map" => 'house_03_f0_2048_002.jpg'],


]

],
    'int1' => [ //первый этаж
        'exitDist' => 150, //дистанция выхода(до стены)
        'exitPoint' => [245, 210, 100], //точка выхода, если задана - дистанция выхода не работает
        'exitPoint2' => null, //точка выхода, если задана - дистанция выхода не работает
        'exitPoint3' => null,
        'toFloor0' => [289, -64, 50],
        'toFloor2' => [-217, -126, 50], // переход на второй этаж [x, y, radius] либо null если второго этажа нет
        'z' => 97, //высота пола
        'loc' => 32, //ид локации
        'startPoint' => [200, 115, 30, 0], //точка входа с улицы
        'fromFloor0' => [125, -48,  90, 180], 
        'fromFloor2' => [-143, -20,  90, 180], //точка входа со втрого этажа
        'panoShift' => 0, //смещение панорамы по z
        'fov' => 67,
        'objs' => [ //конфигурация объектов дома

["geo" => "house_03_f1.obj", "map" => ["house_03_f1_pt2_2048_002.jpg", "house_03_f1_pt1_1024_002.jpg",]],


]

],
    'int2' => [ //второй этаж
        'toFloor3' =>  [-220, -169, 50],
        'toFloor1' => [-97, -144, 50],
        'fromFloor1' => [-157, -55, 50, 0],
        'fromFloor3' => [-157, -55, 50, 0],
        'loc' => 33,
        'z' => 430,
        'panoShift' => 0,
        'fov' => 67,
        'objs' => [
            ["geo" => "house_03_f2.obj", "map" => ["house_03_f2_pt1_1024_002.jpg", "house_03_f2_pt2_2048_003.jpg"] ],
            ]

],
    'int3' => [ //третий этаж
        'toFloor2' => [-93, -178, 50],
        'fromFloor2' => [-157, -55, 50, 0],
        'loc' => 34,
        'z' => 757,
        'objs' => [
            ["geo" => "house_03_f3.obj", "map"=>"house_03_f3_2048_003.jpg"]
        ]

]
];

$data[7] = [
    'ext' => [ //эксиерьер дома
        'enterDist' => 50, //дистанция входа
        'enterPoint' => [-435, 340, 150], //токачка входа, если задана - дистанция входа не работает [x,y, radius]
        'startPoint' => [-435, 762, 100, 0], //точка появления при выходе из дома [x,y, radius]
        'iconPoint' => [-435, 300, 150],
        'loc' => 23, //ид локации
        'shadowCutDist' => 1, //0-1 0-полное обрезаниеб 1-ничего не обрезаем 0.8 - по умолчанию
        'fov' => 67,
        'objs' => [ //конфигурация объектов дома
            ["geo" => "house_02_ext.obj",  "map" => ['house_02_ext_pt2_008_E2.jpg', 'house_02_ext_pt1_003.jpg']]

]
    ],
    'int1' => [ //первый этаж

'exitPoint' => [-432, 103, 100], //точка выхода, если задана - дистанция выхода не работает
        'exitPoint2' => null, //точка выхода, если задана - дистанция выхода не работает
        'exitPoint3' => null,
        'toFloor1' => null,
        'z' => 27, //высота пола
        'loc' => 24, //ид локации
        'startPoint' => [-300, 90, 10, 270], //точка входа с улицы
        'fromFloor1' =>null, //точка входа со втрого этажа
        'panoShift' => 0, //смещение панорамы по z
        'fov' => 67,
        'objs' => [ //конфигурация объектов дома
            ["geo" => "house_02.obj", "map" => ['house_02_pt1_002_2048_E11.jpg', 'house_02_pt2_002_1024_E3.jpg']]


]

],
        'int2' => [ 
            'toFloor2' => null,
            'objs' => [ ]

],
        'int3' => [ 
            'toFloor2' => null,
            'objs' => []

]
];
**/

$data = [];
$data[1] = [
    'platform' =>1, //ид платформы (1-5) ид локации подберется автоматически
    'ext' => [ //эксиерьер дома
        // [90, 120, 30, 0],
        'transitions' => [['x'=>84, 'y'=>417, 'radius'=>150, 'place'=>1, 'x2'=>90, 'y2'=>120, 'angle'=> 0]], 
        'startPoints' => [['x'=>-87, 'y'=>725, 'angle'=> 0, 'v_angle'=>45], ['x'=>400, 'y'=>725, 'angle'=> 0, 'v_angle'=>45], ['x'=>-487, 'y'=>725, 'angle'=> 0, 'v_angle'=>45]], 
       
        
        'fov' => 67, //ширина угла обзора камеры
        'objs' => [ //конфигурация объектов дома
            ["geo" => "houses/geo/house_ext_01_pt1.obj",  "map" => 'houses/textures/normal/house_ext_01_pt1_2048_001.jpg'],
            ["geo" => "houses/geo/house_ext_01_pt2.obj",  "map" => 'houses/textures/normal/house_ext_01_pt2_1024_002_E1.jpg'],
            ["geo" => "houses/geo/house_ext_01_col.obj", "collider" => true],
            ["geo" => "houses/geo/house_01_glass.obj",  "map" => 'houses/textures/normal/lj-BopBg.png', "glass"=>true],

        ],
        'snow'=>0
    ],

    'int' => [ //интерьеры
        [ //первый этаж
            'transitions' => [ //переходы
                ['x'=>106, 'y'=>235, 'radius'=>100, 'place'=>0, 'x2'=>84, 'y2'=>800, 'angle'=> 180],
                ['x'=>-300, 'y'=>-200, 'radius'=>100, 'place'=>0, 'x2'=>-73, 'y2'=>800, 'angle'=> 180],
                ['x'=>250, 'y'=>0, 'radius'=>50, 'place'=>2, 'x2'=>164, 'y2'=>-43, 'angle'=> 90],
            ],
            'areas' => [
                ['x'=>0, 'y'=>-350, 'z'=>81, 'value'=>'123', 'color'=>'010101' ]
            ],


            'z' => 97, //высота пола
           

            'panoShift' => 0, //смещение панорамы по z (эмулирует высоту, если все этажи замоделены на одном уровне)
            'fov' => 67, //угол обзора для помещения
            'objs' => [ //конфигурация объектов дома
                ["geo" => "houses/geo/house_int_01_f1_pt1.obj", "map" => "houses/textures/normal/house_int_01_f1_pt1_2048_006_E3.jpg"],
                ["geo" => "houses/geo/house_int_01_f1_pt2.obj", "map" => "houses/textures/normal/house_int_01_f1_pt2_1024_003_E1.jpg"],
                ["geo" => "houses/geo/house_int_01_f1_collider.obj", "collider" => true ],
                ["geo" => "houses/geo/house_int_01_f1_floor1.obj", "map"=>"houses/textures/normal/house_int_01_f1_pt1_2048_006_E3.jpg", "floor" => true],
                ["geo" => "houses/geo/house_int_01_f1_floor2.obj", "map" => "houses/textures/normal/house_int_01_f1_pt2_1024_003_E1.jpg", "floor" => true]
            ]

        ],

        [ //второй этаж
            'transitions' => [ 
                ['x'=>325, 'y'=>-96, 'radius'=>100, 'place'=>1, 'x2'=>110, 'y2'=>0, 'angle'=> 90],
            ],
            
            'z' => 376,
            'panoShift' => 0,
            'fov' => 67,
            'objs' => [
                ["geo" => "houses/geo/house_int_01_f2_floor.obj", "map" => "houses/textures/normal/house_int_01_f2_2048_013_E3.jpg", "floor" => true],
                ["geo" => "houses/geo/house_int_01_f2_.obj", "map" => "houses/textures/normal/house_int_01_f2_2048_013_E3.jpg"],
                ["geo" => "houses/geo/house_int_01_f2_collider.obj", "collider" => true ],
                ]
    
        ]



    ]

];


$data[2] = [
    'platform' =>2, //ид платформы (1-5) ид локации подберется автоматически
    'ext' => [ //эксиерьер дома
        // [90, 120, 30, 0],
        'transitions' => [['x'=>84, 'y'=>417, 'radius'=>150, 'place'=>1, 'x2'=>90, 'y2'=>120, 'angle'=> 0]], 
        'startPoints' => [['x'=>-87, 'y'=>825, 'angle'=> 0], ['x'=>400, 'y'=>825, 'angle'=> 0], ['x'=>-487, 'y'=>825, 'angle'=> 0]], 
        
        'fov' => 67, //ширина угла обзора камеры
        'objs' => [ //конфигурация объектов дома
            ["geo" => "houses/geo/house_ext_01_pt1.obj",  "map" => 'houses/textures/normal/house_ext_01_pt1_2048_001.jpg'],
            ["geo" => "houses/geo/house_ext_01_pt2.obj",  "map" => 'houses/textures/normal/house_ext_01_pt2_1024_002_E1.jpg'],
            ["geo" => "houses/geo/house_ext_01_col.obj", "collider" => true],
            ["geo" => "houses/geo/house_01_glass.obj",  "map" => 'houses/textures/normal/lj-BopBg.png', "glass"=>true],

        ],
        'snow'=>40
    ],

    'int' => [ //интерьеры
        [ 
            'transitions' => [ //переходы
                ['x'=>106, 'y'=>235, 'radius'=>100, 'place'=>0, 'x2'=>84, 'y2'=>800, 'angle'=> 180],
                ['x'=>-300, 'y'=>-200, 'radius'=>100, 'place'=>0, 'x2'=>-73, 'y2'=>800, 'angle'=> 180],
                ['x'=>250, 'y'=>0, 'radius'=>50, 'place'=>2, 'x2'=>164, 'y2'=>-43, 'angle'=> 90],
            ],


            'z' => 97, //высота пола
           

            'panoShift' => 0, //смещение панорамы по z (эмулирует высоту, если все этажи замоделены на одном уровне)
            'fov' => 67, //угол обзора для помещения
            'objs' => [ //конфигурация объектов дома
                ["geo" => "houses/geo/house_int_01_f1_pt1.obj", "map" => "houses/textures/normal/house_int_01_f1_pt1_2048_006_E3.jpg"],
                ["geo" => "houses/geo/house_int_01_f1_pt2.obj", "map" => "houses/textures/normal/house_int_01_f1_pt2_1024_003_E1.jpg"],
                ["geo" => "houses/geo/house_int_01_f1_collider.obj", "collider" => true ],
                ["geo" => "houses/geo/house_int_01_f1_floor1.obj", "map"=>"houses/textures/normal/house_int_01_f1_pt1_2048_006_E3.jpg", "floor" => true],
                ["geo" => "houses/geo/house_int_01_f1_floor2.obj", "map" => "houses/textures/normal/house_int_01_f1_pt2_1024_003_E1.jpg", "floor" => true]
            ]

        ],

        [ 
            'transitions' => [ 
                ['x'=>325, 'y'=>-96, 'radius'=>100, 'place'=>1, 'x2'=>110, 'y2'=>0, 'angle'=> 90],
            ],
            
            'z' => 376,
            'panoShift' => 0,
            'fov' => 67,
            'objs' => [
                ["geo" => "houses/geo/house_int_01_f2_floor.obj", "map" => "houses/textures/normal/house_int_01_f2_2048_013_E3.jpg", "floor" => true],
                ["geo" => "houses/geo/house_int_01_f2_.obj", "map" => "houses/textures/normal/house_int_01_f2_2048_013_E3.jpg"],
                ["geo" => "houses/geo/house_int_01_f2_collider.obj", "collider" => true ],
                ]
    
        ]



    ]

];



$data[3] = [
    'platform' =>3, //ид платформы (1-5) ид локации подберется автоматически
    'ext' => [ //эксиерьер дома
        // [90, 120, 30, 0],
        'transitions' => [['x'=>248, 'y'=>459, 'radius'=>150, 'place'=>2, 'x2'=>200, 'y2'=>115, 'angle'=> 0]], 
        'startPoints' => [['x'=>-87, 'y'=>825, 'angle'=> 0], ['x'=>400, 'y'=>825, 'angle'=> 0], ['x'=>-487, 'y'=>825, 'angle'=> 0]], 
        
        'fov' => 67, //ширина угла обзора камеры
        'objs' => [ //конфигурация объектов дома
            ["geo" => "houses/geo/house_03_ext.obj",  "map" => ['houses/textures/normal/house_03_ext_pt1_2048_002.jpg', 'houses/textures/normal/house_03_ext_pt2_1024_001.jpg']],
            ["geo" => "houses/geo/house_03_glass.obj",  "map" => 'houses/textures/normal/lj-BopBg.png', "glass"=>true],


        ],
        'snow'=>0,
        'colgen'=>1
    ],

    'int' => [ //интерьеры
        [ //1 подвал
            'transitions' => [ //переходы
                ['x'=>245, 'y'=>210, 'radius'=>100, 'place'=>0, 'x2'=>67, 'y2'=>758, 'angle'=> 180],
                ['x'=>428, 'y'=>-51, 'radius'=>100, 'place'=>2, 'x2'=>289, 'y2'=>-64, 'angle'=> 180],
               
            ],


            'z' => 27, //высота пола
           

            'panoShift' => 0, //смещение панорамы по z (эмулирует высоту, если все этажи замоделены на одном уровне)
            'fov' => 67, //угол обзора для помещения
            'objs' => [ //конфигурация объектов дома
                ["geo" => "houses/geo/house_03_f0.obj", "map" => 'houses/textures/normal/house_03_f0_2048_002.jpg'],

            ],
            'colgen'=>1

        ],

        [ //2
            'transitions' => [ 
                ['x'=>245, 'y'=>210, 'radius'=>100, 'place'=>0, 'x2'=>226, 'y2'=>757, 'angle'=> 90],
                ['x'=>289, 'y'=>-64, 'radius'=>50, 'place'=>1, 'x2'=>593, 'y2'=>-530, 'angle'=> 90],
                ['x'=>-217, 'y'=>-126, 'radius'=>50, 'place'=>3, 'x2'=>-157, 'y2'=>-55, 'angle'=> 0],
            ],
            
            'z' => 97,
            'panoShift' => 0,
            'fov' => 67,
            'colgen' => true,
            'objs' => [
                ["geo" => "houses/geo/house_03_E2.obj", "floor" =>1, "map" => [ "houses/textures/normal/house_03_f1_pt2_2048_002.jpg", "houses/textures/normal/house_03_f1_pt1_1024_002.jpg", ]],
                ["geo" => "houses/geo/house_03_mirror.obj", "mirror" => true]
            ]
    
        ],
        
        [ //3
                'transitions' => [ 
                    ['x'=>-220, 'y'=>-169, 'radius'=>50, 'place'=>4, 'x2'=>-157, 'y2'=>-55, 'angle'=> 90],
                    ['x'=>-97, 'y'=>-144, 'radius'=>50, 'place'=>2, 'x2'=>-143, 'y2'=>-20, 'angle'=> 180],
                ],
                'colgen' => true,
                
                'z' => 430,
                'panoShift' => 0,
                'fov' => 67,
                'objs' => [
                    ["geo" => "houses/geo/house_03_f2.obj", "map" => ["houses/textures/normal/house_03_f2_pt1_1024_002.jpg", "houses/textures/normal/house_03_f2_pt2_2048_003.jpg"] ],
                ]
        
        ],

        [ //4
            'transitions' => [ 
                ['x'=>-93, 'y'=>-178, 'radius'=>50, 'place'=>3, 'x2'=>-157, 'y2'=>-55, 'angle'=> 0],
            ],
            'colgen' => true,
            'z' => 757,
            'panoShift' => 0,
            'fov' => 67,
            'objs' => [
                ["geo" => "houses/geo/house_03_f3.obj", "map"=>"houses/textures/normal/house_03_f3_2048_003.jpg"]
            ]
    
    ]




    ]

];


$data[4] = [
    'platform' =>7, //ид платформы (1-5) ид локации подберется автоматически
    'ext' => [ //эксиерьер дома
        // [90, 120, 30, 0],
        'transitions' => [['x'=>84, 'y'=>417, 'radius'=>150, 'place'=>1, 'x2'=>90, 'y2'=>120, 'angle'=> 0]], 
        'startPoints' => [['x'=>-87, 'y'=>725, 'angle'=> 0, 'v_angle'=>45], ['x'=>400, 'y'=>725, 'angle'=> 0, 'v_angle'=>45], ['x'=>-487, 'y'=>725, 'angle'=> 0, 'v_angle'=>45]], 
       
        
        'fov' => 67, //ширина угла обзора камеры
        'objs' => [ //конфигурация объектов дома
            ["geo" => "houses/geo/house_ext_01_pt1.obj",  "map" => 'houses/textures/normal/house_ext_01_pt1_2048_001.jpg'],
            ["geo" => "houses/geo/house_ext_01_pt2.obj",  "map" => 'houses/textures/normal/house_ext_01_pt2_1024_002_E1.jpg'],
            ["geo" => "houses/geo/house_ext_01_col.obj", "collider" => true],
            ["geo" => "houses/geo/house_01_glass.obj",  "map" => 'houses/textures/normal/lj-BopBg.png', "glass"=>true],

        ],
        'snow'=>40
    ],

    'int' => [ //интерьеры
        [ //первый этаж
            'transitions' => [ //переходы
                ['x'=>106, 'y'=>235, 'radius'=>100, 'place'=>0, 'x2'=>84, 'y2'=>800, 'angle'=> 180],
                ['x'=>-300, 'y'=>-200, 'radius'=>100, 'place'=>0, 'x2'=>-73, 'y2'=>800, 'angle'=> 180],
                ['x'=>250, 'y'=>0, 'radius'=>50, 'place'=>2, 'x2'=>164, 'y2'=>-43, 'angle'=> 90],
            ],
            'areas' => [
                ['x'=>0, 'y'=>-350, 'z'=>81, 'value'=>'123', 'color'=>'010101' ]
            ],


            'z' => 97, //высота пола
           

            'panoShift' => 0, //смещение панорамы по z (эмулирует высоту, если все этажи замоделены на одном уровне)
            'fov' => 67, //угол обзора для помещения
            'objs' => [ //конфигурация объектов дома
                ["geo" => "houses/geo/house_int_01_f1_pt1.obj", "map" => "houses/textures/normal/house_int_01_f1_pt1_2048_006_E3.jpg"],
                ["geo" => "houses/geo/house_int_01_f1_pt2.obj", "map" => "houses/textures/normal/house_int_01_f1_pt2_1024_003_E1.jpg"],
                ["geo" => "houses/geo/house_int_01_f1_collider.obj", "collider" => true ],
                ["geo" => "houses/geo/house_int_01_f1_floor1.obj", "map"=>"houses/textures/normal/house_int_01_f1_pt1_2048_006_E3.jpg", "floor" => true],
                ["geo" => "houses/geo/house_int_01_f1_floor2.obj", "map" => "houses/textures/normal/house_int_01_f1_pt2_1024_003_E1.jpg", "floor" => true]
            ]

        ],

        [ //второй этаж
            'transitions' => [ 
                ['x'=>325, 'y'=>-96, 'radius'=>100, 'place'=>1, 'x2'=>110, 'y2'=>0, 'angle'=> 90],
            ],
            
            'z' => 376,
            'panoShift' => 0,
            'fov' => 67,
            'objs' => [
                ["geo" => "houses/geo/house_int_01_f2_floor.obj", "map" => "houses/textures/normal/house_int_01_f2_2048_013_E3.jpg", "floor" => true],
                ["geo" => "houses/geo/house_int_01_f2_.obj", "map" => "houses/textures/normal/house_int_01_f2_2048_013_E3.jpg"],
                ["geo" => "houses/geo/house_int_01_f2_collider.obj", "collider" => true ],
                ]
    
        ]



    ]

];

$data[5] = [
    'platform' =>8, //ид платформы (1-5) ид локации подберется автоматически
    'ext' => [ //эксиерьер дома
        // [90, 120, 30, 0],
        'transitions' => [['x'=>84, 'y'=>417, 'radius'=>150, 'place'=>1, 'x2'=>90, 'y2'=>120, 'angle'=> 0]], 
        'startPoints' => [['x'=>-87, 'y'=>725, 'angle'=> 0, 'v_angle'=>45], ['x'=>400, 'y'=>725, 'angle'=> 0, 'v_angle'=>45], ['x'=>-487, 'y'=>725, 'angle'=> 0, 'v_angle'=>45]], 
       
        
        'fov' => 67, //ширина угла обзора камеры
        'objs' => [ //конфигурация объектов дома
            ["geo" => "houses/geo/house_ext_01_pt1.obj",  "map" => 'houses/textures/normal/house_ext_01_pt1_2048_001.jpg'],
            ["geo" => "houses/geo/house_ext_01_pt2.obj",  "map" => 'houses/textures/normal/house_ext_01_pt2_1024_002_E1.jpg'],
            ["geo" => "houses/geo/house_ext_01_col.obj", "collider" => true],
            ["geo" => "houses/geo/house_01_glass.obj",  "map" => 'houses/textures/normal/lj-BopBg.png', "glass"=>true],

        ],
        'snow'=>0
    ],

    'int' => [ //интерьеры
        [ //первый этаж
            'transitions' => [ //переходы
                ['x'=>106, 'y'=>235, 'radius'=>100, 'place'=>0, 'x2'=>84, 'y2'=>800, 'angle'=> 180],
                ['x'=>-300, 'y'=>-200, 'radius'=>100, 'place'=>0, 'x2'=>-73, 'y2'=>800, 'angle'=> 180],
                ['x'=>250, 'y'=>0, 'radius'=>50, 'place'=>2, 'x2'=>164, 'y2'=>-43, 'angle'=> 90],
            ],
            'areas' => [
                ['x'=>0, 'y'=>-350, 'z'=>81, 'value'=>'123', 'color'=>'010101' ]
            ],


            'z' => 97, //высота пола
           

            'panoShift' => 0, //смещение панорамы по z (эмулирует высоту, если все этажи замоделены на одном уровне)
            'fov' => 67, //угол обзора для помещения
            'objs' => [ //конфигурация объектов дома
                ["geo" => "houses/geo/house_int_01_f1_pt1.obj", "map" => "houses/textures/normal/house_int_01_f1_pt1_2048_006_E3.jpg"],
                ["geo" => "houses/geo/house_int_01_f1_pt2.obj", "map" => "houses/textures/normal/house_int_01_f1_pt2_1024_003_E1.jpg"],
                ["geo" => "houses/geo/house_int_01_f1_collider.obj", "collider" => true ],
                ["geo" => "houses/geo/house_int_01_f1_floor1.obj", "map"=>"houses/textures/normal/house_int_01_f1_pt1_2048_006_E3.jpg", "floor" => true],
                ["geo" => "houses/geo/house_int_01_f1_floor2.obj", "map" => "houses/textures/normal/house_int_01_f1_pt2_1024_003_E1.jpg", "floor" => true]
            ]

        ],

        [ //второй этаж
            'transitions' => [ 
                ['x'=>325, 'y'=>-96, 'radius'=>100, 'place'=>1, 'x2'=>110, 'y2'=>0, 'angle'=> 90],
            ],
            
            'z' => 376,
            'panoShift' => 0,
            'fov' => 67,
            'objs' => [
                ["geo" => "houses/geo/house_int_01_f2_floor.obj", "map" => "houses/textures/normal/house_int_01_f2_2048_013_E3.jpg", "floor" => true],
                ["geo" => "houses/geo/house_int_01_f2_.obj", "map" => "houses/textures/normal/house_int_01_f2_2048_013_E3.jpg"],
                ["geo" => "houses/geo/house_int_01_f2_collider.obj", "collider" => true ],
                ]
    
        ]



    ]

];


$data[6] = [
    'platform' =>1, //ид платформы (1-5) ид локации подберется автоматически
    'ext' => [ //эксиерьер дома
        // [90, 120, 30, 0],
        'transitions' => [['x'=>-50, 'y'=>460, 'radius'=>150, 'place'=>1, 'x2'=>-50, 'y2'=>220, 'angle'=> 0]], 
        'startPoints' => [['x'=>-87, 'y'=>725, 'angle'=> 0, 'v_angle'=>45], ['x'=>400, 'y'=>725, 'angle'=> 0, 'v_angle'=>45], ['x'=>-487, 'y'=>725, 'angle'=> 0, 'v_angle'=>45]], 
       
        
        'fov' => 67, //ширина угла обзора камеры
        'objs' => [ //конфигурация объектов дома
            ["geo" => "houses/geo/house_04_main.obj",  "map" => 'houses/textures/normal/house_04.jpg'],
            ["geo" => "houses/geo/house_04_glass.obj",  "map" => 'houses/textures/normal/lj-BopBg.png', "glass"=>[1,1]],
          

        ],
        'colgen' => 1,
        'snow'=>0
    ],

    'int' => [ //интерьеры
        [ //первый этаж
            'transitions' => [ //переходы
                ['x'=>-50, 'y'=>320, 'radius'=>100, 'place'=>0, 'x2'=>84, 'y2'=>800, 'angle'=> 180],
                
            ],
            'areas' => [
                
            ],


            'z' => 20, //высота пола
            'autoZ' => 1,
            'colgen' => 1,
           

            'panoShift' => 400, //смещение панорамы по z (эмулирует высоту, если все этажи замоделены на одном уровне)
            'fov' => 67, //угол обзора для помещения
            'objs' => [ //конфигурация объектов дома
                ["geo" => "houses/geo/house_04_int_.obj", "map" => "houses/textures/normal/house_04_int_2048_001_comp.jpg", "floor"=>true],
                
            ]

        ]



    ]

];


$data[7] = [
    'platform' =>9, //ид платформы (1-5) ид локации подберется автоматически
    'ext' => [ //эксиерьер дома
        // [90, 120, 30, 0],
        'transitions' => [['x'=>-50, 'y'=>460, 'radius'=>150, 'place'=>1, 'x2'=>-50, 'y2'=>220, 'angle'=> 0]], 
        'startPoints' => [['x'=>-87, 'y'=>725, 'angle'=> 0, 'v_angle'=>45], ['x'=>400, 'y'=>725, 'angle'=> 0, 'v_angle'=>45], ['x'=>-487, 'y'=>725, 'angle'=> 0, 'v_angle'=>45]], 
       
        
        'fov' => 67, //ширина угла обзора камеры
        'objs' => [ //конфигурация объектов дома
            ["geo" => "houses/geo/house_04_main.obj",  "map" => 'houses/textures/normal/house_04.jpg'],
            ["geo" => "houses/geo/house_04_glass.obj",  "map" => 'houses/textures/normal/lj-BopBg.png', "glass"=>[1,1]],
          

        ],
        'colgen' => 1,
        'snow'=>0
    ],

    'int' => [ //интерьеры
        [ //первый этаж
            'transitions' => [ //переходы
                ['x'=>-50, 'y'=>320, 'radius'=>100, 'place'=>0, 'x2'=>84, 'y2'=>800, 'angle'=> 180],
                
            ],
            'areas' => [
                
            ],


            'z' => 20, //высота пола
            'autoZ' => 1,
            'colgen' => 1,
           

            'panoShift' => 400, //смещение панорамы по z (эмулирует высоту, если все этажи замоделены на одном уровне)
            'fov' => 67, //угол обзора для помещения
            'objs' => [ //конфигурация объектов дома
                ["geo" => "houses/geo/house_04_int_.obj", "map" => "houses/textures/normal/house_04_int_2048_001_comp.jpg", "floor"=>true],
                
            ]

        ]



    ]

];


$data[8] = [
    'platform' =>10, //ид платформы (1-5) ид локации подберется автоматически
    'ext' => [ //эксиерьер дома
        // [90, 120, 30, 0],
        'transitions' => [['x'=>-50, 'y'=>460, 'radius'=>150, 'place'=>1, 'x2'=>-50, 'y2'=>220, 'angle'=> 0]], 
        'startPoints' => [['x'=>-87, 'y'=>725, 'angle'=> 0, 'v_angle'=>45], ['x'=>400, 'y'=>725, 'angle'=> 0, 'v_angle'=>45], ['x'=>-487, 'y'=>725, 'angle'=> 0, 'v_angle'=>45]], 
       
        
        'fov' => 67, //ширина угла обзора камеры
        'objs' => [ //конфигурация объектов дома
            ["geo" => "houses/geo/house_04_main.obj",  "map" => 'houses/textures/normal/house_04.jpg'],
            ["geo" => "houses/geo/house_04_glass.obj",  "map" => 'houses/textures/normal/lj-BopBg.png', "glass"=>[1,1]],
          

        ],
        'colgen' => 1,
        'snow'=>0
    ],

    'int' => [ //интерьеры
        [ //первый этаж
            'transitions' => [ //переходы
                ['x'=>-50, 'y'=>320, 'radius'=>100, 'place'=>0, 'x2'=>84, 'y2'=>800, 'angle'=> 180],
                
            ],
            'areas' => [
                
            ],


            'z' => 20, //высота пола
            'autoZ' => 1,
            'colgen' => 1,
           

            'panoShift' => 400, //смещение панорамы по z (эмулирует высоту, если все этажи замоделены на одном уровне)
            'fov' => 67, //угол обзора для помещения
            'objs' => [ //конфигурация объектов дома
                ["geo" => "houses/geo/house_04_int_.obj", "map" => "houses/textures/normal/house_04_int_2048_001_comp.jpg", "floor"=>true],
                
            ]

        ]



    ]

];

$data[9] = [
    'platform' =>11, //ид платформы (1-5) ид локации подберется автоматически
    'ext' => [ //эксиерьер дома
        // [90, 120, 30, 0],
        'transitions' => [['x'=>-50, 'y'=>460, 'radius'=>150, 'place'=>1, 'x2'=>-50, 'y2'=>220, 'angle'=> 0]], 
        'startPoints' => [['x'=>-87, 'y'=>725, 'angle'=> 0, 'v_angle'=>45], ['x'=>400, 'y'=>725, 'angle'=> 0, 'v_angle'=>45], ['x'=>-487, 'y'=>725, 'angle'=> 0, 'v_angle'=>45]], 
       
        
        'fov' => 67, //ширина угла обзора камеры
        'objs' => [ //конфигурация объектов дома
            ["geo" => "houses/geo/house_04_main.obj",  "map" => 'houses/textures/normal/house_04.jpg'],
            ["geo" => "houses/geo/house_04_glass.obj",  "map" => 'houses/textures/normal/lj-BopBg.png', "glass"=>[1,1]],
          

        ],
        'colgen' => 1,
        'snow'=>0
    ],

    'int' => [ //интерьеры
        [ //первый этаж
            'transitions' => [ //переходы
                ['x'=>-50, 'y'=>320, 'radius'=>100, 'place'=>0, 'x2'=>84, 'y2'=>800, 'angle'=> 180],
                
            ],
            'areas' => [
                
            ],


            'z' => 20, //высота пола
            'autoZ' => 1,
            'colgen' => 1,
           

            'panoShift' => 400, //смещение панорамы по z (эмулирует высоту, если все этажи замоделены на одном уровне)
            'fov' => 67, //угол обзора для помещения
            'objs' => [ //конфигурация объектов дома
                ["geo" => "houses/geo/house_04_int_.obj", "map" => "houses/textures/normal/house_04_int_2048_001_comp.jpg", "floor"=>true],
                
            ]

        ]



    ]

];
echo json_encode($data);
?>
