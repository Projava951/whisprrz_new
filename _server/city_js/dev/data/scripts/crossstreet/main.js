locations[84].onInit = function() {
    this.skybox = chat3d.world.obj[0];
    const fragmentShader = [
        //'uniform sampler2D u_DiffuseMap;',
        'uniform vec3 char_pos [15];',
        'varying vec3 v_FragmentPosition;',
        //'varying vec2 vUv;',
        'varying vec3 vNormal;',
        'uniform vec3 srccolor;',



        'const vec3  shadowColor = vec3( 0.1, 0.1, 0.1 );',
        'void main( void ) {',

        '	float distance = 65534.0;',
        '	for ( int i = 0; i < 15; i ++ ) {',
        '		vec3  L = char_pos[i] - v_FragmentPosition;',
        '		float cur_distance = length( L );',
        '		distance = min(distance, cur_distance);',

        '	}',
        '	float attenuation = 1.0 - smoothstep( 0.0, 55.0, distance );',
        '	vec3 color = mix( srccolor, shadowColor, attenuation );',

        '	gl_FragColor = vec4(color, 1.0);',
        '}'
    ].join('\n');

    let grass = [];
    this.grass = grass;

    const positionWidth = 42;
    const columns = 170;
    const boardWidth = positionWidth * columns;

    const stepTime = 200; // Miliseconds it takes for the chicken to take a step forward, backward, left or right

    let lanes;
    let currentLane;
    let currentColumn;

    let previousTimestamp;
    let startMoving;
    let moves;
    let stepStartTimestamp;



    const carFrontTexture = new Texture(40, 80, [{ x: 0, y: 10, w: 30, h: 60 }]);
    const carBackTexture = new Texture(40, 80, [{ x: 10, y: 10, w: 30, h: 60 }]);
    const carRightSideTexture = new Texture(110, 40, [{ x: 10, y: 0, w: 50, h: 30 }, { x: 70, y: 0, w: 30, h: 30 }]);
    const carLeftSideTexture = new Texture(110, 40, [{ x: 10, y: 10, w: 50, h: 30 }, { x: 70, y: 10, w: 30, h: 30 }]);

    const truckFrontTexture = new Texture(30, 30, [{ x: 15, y: 0, w: 10, h: 30 }]);
    const truckRightSideTexture = new Texture(25, 30, [{ x: 0, y: 15, w: 10, h: 10 }]);
    const truckLeftSideTexture = new Texture(25, 30, [{ x: 0, y: 5, w: 10, h: 10 }]);



    let scene = new BABYLON.Group();
    scene.scale.set(3, 3, 3);

    chat3d.world.scene.add(scene);
    chat3d.world.obj.push(scene);
    scene.rotation.x = -Math.PI / 2;

    const generateLanes = () => [-9, -8, -7, -6, -5, -4, -3, -2, -1, 0, 1, 2, 3, 4, 5, 6, 7, 8, 9].map((index) => {
        const lane = new Lane(index);
        lane.mesh.position.y = index * positionWidth * zoom;
        scene.add(lane.mesh);
        lane.mesh.updateMatrix();
        lane.mesh.updateMatrixWorld();
        lane.mesh.matrixAutoUpdate = false;
        if (lane.type !== 'car' && lane.type != 'truck') {
            for (let i in lane.mesh.children) {
                let c1 = lane.mesh.children[i];
                c1.updateMatrix();
                c1.updateMatrixWorld();
                c1.matrixAutoUpdate = false;
                for (let i2 in c1.children) {
                    let c2 = c1.children[i2];
                    c2.updateMatrix();
                    c2.updateMatrixWorld();
                    c2.matrixAutoUpdate = false;

                }
            }
        }

        return lane;
    }).filter((lane) => lane.index >= 0);

    const addLane = () => {
        const index = lanes.length;
        const lane = new Lane(index);
        lane.mesh.position.y = index * positionWidth * zoom;
        scene.add(lane.mesh);

        //let box = new BABYLON.Box3();
        //box.setFromObject(lane.mesh);
        //console.log(box);
        //let size = new BABYLON.Vector3();
        //box.getSize(size);
        //console.log(size);
        lanes.push(lane);
        //console.log(lane)

        lane.mesh.updateMatrix();
        lane.mesh.updateMatrixWorld();
        lane.mesh.matrixAutoUpdate = false;
        //console.log(lane.type);


        if (lane.type !== 'car' && lane.type != 'truck') {
            for (let i in lane.mesh.children) {
                let c1 = lane.mesh.children[i];
                c1.updateMatrix();
                c1.updateMatrixWorld();
                c1.matrixAutoUpdate = false;
                for (let i2 in c1.children) {
                    let c2 = c1.children[i2];
                    c2.updateMatrix();
                    c2.updateMatrixWorld();
                    c2.matrixAutoUpdate = false;

                }
            }
        }
    }

    hemiLight = new BABYLON.HemisphereLight(0xffffff, 0xffffff, 0.6);
    scene.add(hemiLight);

    const initialDirLightPositionX = -100;
    const initialDirLightPositionY = -100;
    dirLight = new BABYLON.DirectionalLight(0xffffff, 0.6);
    dirLight.position.set(initialDirLightPositionX, initialDirLightPositionY, 200);
    dirLight.castShadow = true;
    //dirLight.target = chicken;
    scene.add(dirLight);

    dirLight.shadow.mapSize.width = 2048;
    dirLight.shadow.mapSize.height = 2048;
    var d = 500;
    dirLight.shadow.camera.left = -d;
    dirLight.shadow.camera.right = d;
    dirLight.shadow.camera.top = d;
    dirLight.shadow.camera.bottom = -d;

    backLight = new BABYLON.DirectionalLight(0x000000, .4);
    backLight.position.set(200, 200, 50);
    backLight.castShadow = true;
    scene.add(backLight)

    const laneTypes = ['car', 'truck', 'forest'];
    const laneSpeeds = [2, 2.5, 3];
    const vechicleColors = [0xa52523, 0xbdb638, 0x78b14b];
    const babylonHeights = [20, 45, 60];
    const zoom = 2;

    const initaliseValues = () => {
        lanes = generateLanes()

        currentLane = 0;
        currentColumn = Math.floor(columns / 2);

        previousTimestamp = null;

        startMoving = false;
        moves = [];
        stepStartTimestamp;


        dirLight.position.x = initialDirLightPositionX;
        dirLight.position.y = initialDirLightPositionY;
    }

    initaliseValues();
    this.lanes = lanes;

    function Texture(width, height, rects) {
        const canvas = document.createElement("canvas");
        canvas.width = width;
        canvas.height = height;
        const context = canvas.getContext("2d");
        context.fillStyle = "#ffffff";
        context.fillRect(0, 0, width, height);
        context.fillStyle = "rgba(0,0,0,0.6)";
        rects.forEach(rect => {
            context.fillRect(rect.x, rect.y, rect.w, rect.h);
        });
        return new BABYLON.CanvasTexture(canvas);
    }

    function Wheel() {
        const wheel = new BABYLON.Mesh(
            new BABYLON.BoxBufferGeometry(12 * zoom, 33 * zoom, 12 * zoom),
            new BABYLON.MeshLambertMaterial({ color: 0x333333, flatShading: true })
        );
        wheel.position.z = 6 * zoom;
        return wheel;
    }

    function Truck() {
        const truck = new BABYLON.Group();
        const color = vechicleColors[Math.floor(Math.random() * vechicleColors.length)];


        const base = new BABYLON.Mesh(
            new BABYLON.BoxBufferGeometry(100 * zoom, 25 * zoom, 5 * zoom),
            new BABYLON.MeshLambertMaterial({ color: 0xb4c6fc, flatShading: true })
        );
        base.position.z = 10 * zoom;
        truck.add(base)

        const cargo = new BABYLON.Mesh(
            new BABYLON.BoxBufferGeometry(75 * zoom, 35 * zoom, 40 * zoom),
            new BABYLON.MeshPhongMaterial({ color: 0xb4c6fc, flatShading: true })
        );
        cargo.position.x = 15 * zoom;
        cargo.position.z = 30 * zoom;
        cargo.castShadow = true;
        cargo.receiveShadow = true;
        truck.add(cargo)

        const cabin = new BABYLON.Mesh(
            new BABYLON.BoxBufferGeometry(25 * zoom, 30 * zoom, 30 * zoom), [
                new BABYLON.MeshPhongMaterial({ color, flatShading: true }), // back
                new BABYLON.MeshPhongMaterial({ color, flatShading: true, map: truckFrontTexture }),
                new BABYLON.MeshPhongMaterial({ color, flatShading: true, map: truckRightSideTexture }),
                new BABYLON.MeshPhongMaterial({ color, flatShading: true, map: truckLeftSideTexture }),
                new BABYLON.MeshPhongMaterial({ color, flatShading: true }), // top
                new BABYLON.MeshPhongMaterial({ color, flatShading: true }) // bottom
            ]
        );
        cabin.position.x = -40 * zoom;
        cabin.position.z = 20 * zoom;
        cabin.castShadow = true;
        cabin.receiveShadow = true;
        truck.add(cabin);

        const frontWheel = new Wheel();
        frontWheel.position.x = -38 * zoom;
        truck.add(frontWheel);

        const middleWheel = new Wheel();
        middleWheel.position.x = -10 * zoom;
        truck.add(middleWheel);

        const backWheel = new Wheel();
        backWheel.position.x = 30 * zoom;
        truck.add(backWheel);

        return truck;
    }

    function Car() {
        const car = new BABYLON.Group();
        const color = vechicleColors[Math.floor(Math.random() * vechicleColors.length)];

        const main = new BABYLON.Mesh(
            new BABYLON.BoxBufferGeometry(60 * zoom, 30 * zoom, 15 * zoom),
            new BABYLON.MeshPhongMaterial({ color, flatShading: true })
        );
        main.position.z = 12 * zoom;
        main.castShadow = true;
        main.receiveShadow = true;
        car.add(main)

        const cabin = new BABYLON.Mesh(
            new BABYLON.BoxBufferGeometry(33 * zoom, 24 * zoom, 12 * zoom), [
                new BABYLON.MeshPhongMaterial({ color: 0xcccccc, flatShading: true, map: carBackTexture }),
                new BABYLON.MeshPhongMaterial({ color: 0xcccccc, flatShading: true, map: carFrontTexture }),
                new BABYLON.MeshPhongMaterial({ color: 0xcccccc, flatShading: true, map: carRightSideTexture }),
                new BABYLON.MeshPhongMaterial({ color: 0xcccccc, flatShading: true, map: carLeftSideTexture }),
                new BABYLON.MeshPhongMaterial({ color: 0xcccccc, flatShading: true }), // top
                new BABYLON.MeshPhongMaterial({ color: 0xcccccc, flatShading: true }) // bottom
            ]
        );
        cabin.position.x = 6 * zoom;
        cabin.position.z = 25.5 * zoom;
        cabin.castShadow = true;
        cabin.receiveShadow = true;
        car.add(cabin);

        const frontWheel = new Wheel();
        frontWheel.position.x = -18 * zoom;
        car.add(frontWheel);

        const backWheel = new Wheel();
        backWheel.position.x = 18 * zoom;
        car.add(backWheel);

        car.castShadow = true;
        car.receiveShadow = false;

        return car;
    }

    function Three() {
        const babylon = new BABYLON.Group();
        babylon.userData.type = 'babylon';

        const trunk = new BABYLON.Mesh(
            new BABYLON.BoxGeometry(15 * zoom, 15 * zoom, 20 * zoom),
            new BABYLON.MeshPhongMaterial({ color: 0x4d2926, flatShading: true })
        );
        trunk.position.z = 10 * zoom;
        trunk.castShadow = false;
        trunk.receiveShadow = false;
        babylon.add(trunk);
        trunk.updateMatrix();

        height = babylonHeights[Math.floor(Math.random() * babylonHeights.length)];

        const crown = new BABYLON.Mesh(
            new BABYLON.BoxGeometry(30 * zoom, 30 * zoom, height * zoom),
            new BABYLON.MeshLambertMaterial({ color: 0x7aa21d, flatShading: true })
        );
        crown.position.z = (height / 2 + 20) * zoom;
        crown.castShadow = false;
        crown.receiveShadow = false;
        crown.updateMatrix();
        babylon.add(crown);

        return babylon;
    }

    function Road() {
        const road = new BABYLON.Group();

        const createSection = function(color) {
            let uniforms = {
                char_pos: chat3d.world.shadow_uniforms.char_pos,
                srccolor: { value: new BABYLON.Color(color) }

            };
            let mat = new BABYLON.ShaderMaterial({
                vertexShader: BABYLON.ShaderLib['pointShadow'].vertexShader,
                fragmentShader: fragmentShader,
                uniforms: uniforms
            });
            return new BABYLON.Mesh(
                new BABYLON.PlaneBufferGeometry(boardWidth * zoom, positionWidth * zoom),
                mat
                //new BABYLON.MeshPhongMaterial({ color })
            );

        }

        const middle = createSection(0x454A59);
        middle.receiveShadow = true;
        road.add(middle);

        const left = createSection(0x393D49);
        left.position.x = -boardWidth * zoom;
        road.add(left);

        const right = createSection(0x393D49);
        right.position.x = boardWidth * zoom;
        road.add(right);

        return road;
    }



    function Grass() {
        const grass = new BABYLON.Group();


        const createSection = function(color) {
            let uniforms = {
                char_pos: chat3d.world.shadow_uniforms.char_pos,
                srccolor: { value: new BABYLON.Color(color) }

            };
            let mat = new BABYLON.ShaderMaterial({
                vertexShader: BABYLON.ShaderLib['pointShadow'].vertexShader,
                fragmentShader: fragmentShader,
                uniforms: uniforms
            });
            //console.log(uniforms)
            return new BABYLON.Mesh(
                new BABYLON.BoxBufferGeometry(boardWidth * zoom, positionWidth * zoom, 1),
                //new BABYLON.MeshBasicMaterial({ color })
                mat
            );
        };

        const middle = createSection(0xbaf455);
        middle.receiveShadow = true;
        grass.add(middle);

        const left = createSection(0x99C846);
        left.position.x = -boardWidth * zoom;
        grass.add(left);

        const right = createSection(0x99C846);
        right.position.x = boardWidth * zoom;
        grass.add(right);

        //grass.position.z = 1.5 * zoom;
        return grass;
    }



    function Lane(index) {
        this.index = index;
        this.type = index <= 0 ? 'field' : laneTypes[Math.floor(Math.random() * laneTypes.length)];

        switch (this.type) {
            case 'field':
                {
                    this.type = 'field';
                    this.mesh = new Grass();
                    grass.push(this.mesh);
                    break;
                }
            case 'forest':
                {
                    this.mesh = new Grass();
                    grass.push(this.mesh);

                    this.occupiedPositions = new Set();
                    let list = [];
                    for (let i = 0; i < 40; i++) {
                        list.push(i);
                    }
                    this.babylons = list.map(() => {
                        const babylon = new Three();
                        let position;
                        do {
                            position = Math.floor(Math.random() * columns);
                        } while (this.occupiedPositions.has(position))
                        this.occupiedPositions.add(position);
                        babylon.position.x = (position * positionWidth + positionWidth / 2) * zoom - boardWidth * zoom / 2;
                        //this.mesh.add(babylon);
                        return babylon;
                    })

                    let geo1 = new BABYLON.Geometry();
                    let geo2 = new BABYLON.Geometry();
                    //console.log(geo1);

                    for (let i in this.babylons) {
                        //console.log(this.babylons[i])
                        this.babylons[i].updateMatrix();
                        let matrix1 = new BABYLON.Matrix4()
                        matrix1.multiplyMatrices(this.babylons[i].matrix, this.babylons[i].children[0].matrix);
                        let matrix2 = new BABYLON.Matrix4();
                        matrix2.multiplyMatrices(this.babylons[i].matrix, this.babylons[i].children[1].matrix);
                        geo1.merge(this.babylons[i].children[0].geometry, matrix1);
                        geo2.merge(this.babylons[i].children[1].geometry, matrix2);

                    }

                    if (this.babylons[0]) {
                        let mesh1 = new BABYLON.Mesh(geo1, this.babylons[0].children[0].material);
                        this.mesh.add(mesh1);
                        mesh1.castShadow = false;
                        mesh1.receiveShadow = false;
                        let mesh2 = new BABYLON.Mesh(geo2, this.babylons[0].children[1].material);
                        this.mesh.add(mesh2);
                        mesh2.castShadow = false;
                        mesh2.receiveShadow = false;
                    }




                    break;
                }
            case 'car':
                {
                    this.mesh = new Road();
                    this.direction = Math.random() >= 0.5;

                    const occupiedPositions = new Set();
                    let list = [];
                    for (let i = 0; i < 10; i++) {
                        list.push(i);
                    }
                    this.vechicles = list.map(() => {
                        const vechicle = new Car();
                        let position;
                        do {
                            position = Math.floor(Math.random() * columns / 2);
                        } while (occupiedPositions.has(position))
                        occupiedPositions.add(position);
                        vechicle.position.x = (position * positionWidth * 2 + positionWidth / 2) * zoom - boardWidth * zoom / 2;
                        if (!this.direction) vechicle.rotation.z = Math.PI;
                        this.mesh.add(vechicle);
                        return vechicle;
                    })

                    this.speed = laneSpeeds[Math.floor(Math.random() * laneSpeeds.length)];
                    break;
                }
            case 'truck':
                {
                    this.mesh = new Road();
                    this.direction = Math.random() >= 0.5;

                    const occupiedPositions = new Set();
                    let list = [];
                    for (let i = 0; i < 4; i++) {
                        list.push(i);
                    }
                    this.vechicles = list.map(() => {
                        const vechicle = new Truck();
                        let position;
                        do {
                            position = Math.floor(Math.random() * columns / 3);
                        } while (occupiedPositions.has(position))
                        occupiedPositions.add(position);
                        vechicle.position.x = (position * positionWidth * 3 + positionWidth / 2) * zoom - boardWidth * zoom / 2;
                        if (!this.direction) vechicle.rotation.z = Math.PI;
                        this.mesh.add(vechicle);
                        return vechicle;
                    })

                    this.speed = laneSpeeds[Math.floor(Math.random() * laneSpeeds.length)];
                    break;
                }
        }
    }

    this.lanes = lanes;
    this.boardWidth = boardWidth;
    this.zoom = zoom;
    this.positionWidth = positionWidth;

    for (let i = 0; i < 20; i++) {
        addLane();
    }
    this.addLane = addLane;

    let mesh = new Grass();


    let occupiedPositions = new Set();
    let list = [];
    for (let i = 0; i < 150; i++) {
        list.push(i);
    }
    let babylons = list.map(() => {
        const babylon = new Three();
        let position;
        do {
            position = Math.floor(Math.random() * columns);
        } while (occupiedPositions.has(position))
        occupiedPositions.add(position);
        babylon.position.x = (position * positionWidth + positionWidth / 2) * zoom - boardWidth * zoom / 2;
        mesh.add(babylon);
        return babylon;
    })
    scene.add(mesh);
    mesh.position.y = -500;
    let plane = new BABYLON.Mesh(new BABYLON.PlaneBufferGeometry(boardWidth * zoom, 5000),
        new BABYLON.MeshBasicMaterial({ color: 0xbaf455 })
    );
    plane.position.y = -3000;
    scene.add(plane);

    let startCol = new BABYLON.Mesh(new BABYLON.BoxGeometry(boardWidth * zoom * 2, 200, 200), new BABYLON.MeshBasicMaterial({ wireframe: true, visible: false }));
    startCol.position.z = 1500;
    chat3d.world.colliders.push(startCol);
    chat3d.world.scene.add(startCol);


    //console.log(scene);
    scene.updateMatrixWorld();

    this.scene = scene;

    this.colliders = [];

    this.colgen = function() {
        let scene = this.scene;

        for (let i in scene.children) {
            //console.log(scene.children[i].userData.type);
            for (let ii in scene.children[i].children) {
                //console.log(scene.children[i].children[ii].userData.type);
                if (scene.children[i].children[ii].userData.type == 'babylon' && !scene.children[i].children[ii].userData.col) {
                    scene.children[i].children[ii].userData.col = true;
                    let box = new BABYLON.Box3();
                    box.setFromObject(scene.children[i].children[ii]);
                    //console.log(box);
                    let center = new BABYLON.Vector3();
                    box.getCenter(center);
                    let size = new BABYLON.Vector3();
                    box.getSize(size);
                    let col = new BABYLON.Mesh(
                        new BABYLON.BoxGeometry(size.x * 1.2, size.y, size.z * 1.2),
                        new BABYLON.MeshBasicMaterial({ wireframe: true, visible: false })
                    );
                    col.userData.type = 'babyloncol';
                    col.position.copy(center);
                    chat3d.world.scene.add(col);
                    chat3d.world.colliders.push(col);
                    this.colliders.push(col);
                    col.updateMatrix();
                    col.updateMatrixWorld();
                    col.matrixAutoUpdate = false;


                }
            }
        }
    };


    this.lastPos = new BABYLON.Vector3();

    //setInterval(function() { console.log(chat3d.world.eyes.position.z) }, 1000);
    this.maxdist = 0;
    chat3d.move.max_speed = 300;
    //this.hub = new p2phub();

};

locations[84].onRender = function(delta) {
    if (delta > 1) {
        delta = 0.001;
    }


    let lanes = this.lanes;
    let boardWidth = this.boardWidth;
    let zoom = this.zoom;
    let positionWidth = this.positionWidth;


    lanes.forEach(lane => {
        if (lane.type === 'car' || lane.type === 'truck') {
            const aBitBeforeTheBeginingOfLane = -boardWidth * zoom / 2 - positionWidth * 2 * zoom;
            const aBitAfterTheEndOFLane = boardWidth * zoom / 2 + positionWidth * 2 * zoom;
            lane.vechicles.forEach(vechicle => {
                if (lane.direction) {
                    vechicle.position.x = vechicle.position.x < aBitBeforeTheBeginingOfLane ? aBitAfterTheEndOFLane : vechicle.position.x -= lane.speed / 16 * delta * 1000;
                } else {
                    vechicle.position.x = vechicle.position.x > aBitAfterTheEndOFLane ? aBitBeforeTheBeginingOfLane : vechicle.position.x += lane.speed / 16 * delta * 1000;
                }
            });
        }
    });


    if (this.lastPos.distanceTo(chat3d.world.eyes.position) > 100) {
        this.lastPos.copy(chat3d.world.eyes.position);
        this.colgen();
        for (let i in this.scene.children) {
            if (this.scene.children[i].type == 'Group') {
                let pos = new BABYLON.Vector3().copy(this.scene.children[i].position).multiplyScalar(this.scene.scale.x);
                pos.applyAxisAngle(new BABYLON.Vector3(1, 0, 0), -Math.PI / 2);

                if (pos.distanceTo(chat3d.world.eyes.position) > 7000) {
                    this.scene.children[i].visible = false;
                } else {
                    this.scene.children[i].visible = true;
                }
            }
        }

        for (let i in this.colliders) {
            if (this.colliders[i].position.distanceTo(chat3d.world.eyes.position) > 2500) {
                this.colliders[i].visible = false;
            } else {
                this.colliders[i].visible = true;
            }
        }



    }




    if (chat3d.world.eyes.position.z * -1 - this.maxdist > 84 * 3) {
        this.maxdist = chat3d.world.eyes.position.z * -1;
        this.addLane();
        //console.log('addLane');
    }

    let currentLane = Math.floor((chat3d.world.eyes.position.z - 100) / (84 * -3));
    //console.log(currentLane);
    if (currentLane > 0 && !this.loose) {
        let lanes = this.lanes;
        if (lanes[currentLane].type === 'car' || lanes[currentLane].type === 'truck') {
            //const chickenMinX = chicken.position.x - chickenSize*zoom/2;
            //const chickenMaxX = chicken.position.x + chickenSize*zoom/2;
            const chickenMinX = chat3d.world.eyes.position.x - 20;
            const chickenMaxX = chat3d.world.eyes.position.x + 20;
            const vechicleLength = { car: 60, truck: 105 }[lanes[currentLane].type];
            lanes[currentLane].vechicles.forEach(vechicle => {
                const carMinX = vechicle.position.x * 3 - vechicleLength * this.zoom / 2;
                const carMaxX = vechicle.position.x * 3 + vechicleLength * this.zoom / 2;
                if (chickenMaxX > carMinX && chickenMinX < carMaxX) {
                    //endDOM.style.visibility = 'visible';
                    //console.log('loose');

                    setTimeout(function() {
                        chat3d.world.eyes.position.z = 0;
                        chat3d.move.cam_pos.z = 0;
                        this.loose = false;
                        chat3d.move.max_speed = 310;
                    }.bind(this), 1000);
                    chat3d.msg.send('alert', 'game_lose');
                    this.loose = true;
                    chat3d.move.max_speed = 0;
                }
            });

        }
    }

    this.skybox.position.copy(chat3d.world.eyes.position);
    //this.skybox.position.set(-10000, 0, -50000);





};

locations[84].onLoop = function(delta) {
    /*let lanes = this.lanes;
    let boardWidth = this.boardWidth;
    let zoom = this.zoom;
    let positionWidth = this.positionWidth;


    lanes.forEach(lane => {
        if (lane.type === 'car' || lane.type === 'truck') {
            const aBitBeforeTheBeginingOfLane = -boardWidth * zoom / 2 - positionWidth * 2 * zoom;
            const aBitAfterTheEndOFLane = boardWidth * zoom / 2 + positionWidth * 2 * zoom;
            lane.vechicles.forEach(vechicle => {
                if (lane.direction) {
                    vechicle.position.x = vechicle.position.x < aBitBeforeTheBeginingOfLane ? aBitAfterTheEndOFLane : vechicle.position.x -= lane.speed / 16 * delta * 1000;
                } else {
                    vechicle.position.x = vechicle.position.x > aBitAfterTheEndOFLane ? aBitBeforeTheBeginingOfLane : vechicle.position.x += lane.speed / 16 * delta * 1000;
                }
            });
        }
    });*/
};

locations[84].onClean = function() {
    chat3d.move.max_speed = 110;
};