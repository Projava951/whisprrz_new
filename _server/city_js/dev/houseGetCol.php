<?php
$id = (int)$_GET['id'];
$place = (int)$_GET['place'];

 if(file_exists("house_colliders/") && file_exists("house_colliders/{$id}_{$place}.js")) {
    echo file_get_contents("house_colliders/{$id}_{$place}.js");
 }
 else {
     echo '
     {
        "vertices": [],
        "metadata": {
            "generator": "php",
            "vertices": 0,
            "faces": 0,
            "uvs": 0,
            "version": 3,
            "normals": 0,
            "type": "Geometry"
        },
        "name": "dummy",
        "faces": [],
        "uvs": [],
        "normals": []
    }';
 }
