<?php
$id = (int)$_GET['id'];

 if(file_exists("house_snow/") && file_exists("house_snow/{$id}.js")) {
    echo file_get_contents("house_snow/{$id}.js");
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
