locations[69].onInit = function() {
    if (chat3d.mobile_mode) {
        $('.speedometer-container').remove();
    }

    this.hub = new p2phub();

    var list = $('<div/>').css('position', 'absolute').css('top', 0).css('left', 0).css('z-index', 10).attr('id', 'racelist');
    //$('body').append(list);


    this.updateList = function() {
        var positions = [];
        for (var i in this.positions) {
            positions.push({ id: i, time: this.positions[i].time, name: this.positions[i].name });
        }
        positions.sort(function(a, b) {
            if (a.time < b.time) {
                return -1;
            }
            if (a.time > b.time) {
                return 1;
            }

            return 0;
        });
        //console.log(positions);

        $('#racelist').html('');
        /*for (i in positions) {
            var name = '';
            if (positions[i].id == chat3d.selfid) {
                name = 'me';
            } else {
                console.log(positions[i].id);
                if (chat3d.world.chars[positions[i].id]) {
                    name = chat3d.world.chars[positions[i].id].name;
                }
            }
            if (name) {
                $('#racelist').prepend(name + '<br/>');
            }
        }*/

        for (i in positions) {
            var n = parseInt(i) + 1;
            if (i < 10) {
                var time = new Date(positions[i].time * 1000);
                var div = $('<div/>').text(n + '. ' + positions[i].name + ' ' + time.getMinutes() + ':' + time.getSeconds());
                if (positions[i].id == chat3d.selfid) {
                    $(div).css('color', '#FFD800');
                }
                $('#racelist').append(div);
            } else {
                if (positions[i].id == chat3d.selfid) {
                    var time = new Date(positions[i].time * 1000);
                    var div = $('<div/>').text(n + '. ' + ppositions[i].name + ' ' + time.getMinutes() + ':' + time.getSeconds());

                    $(div).css('color', '#FFD800');

                    $('#racelist').append(div);
                }
            }

        }
    };

    this.srcMSlip = chat3d.move.setSlip;

    chat3d.move.setSlip = function(step) {
        var left_slip = this.h_angle;
        var right_slip = this.h_angle;
        var slip_angle;
        for (var s = 1; s < 16; s++) {
            left_slip -= s * 1;
            slip_angle = (360 - left_slip - 90) * Math.PI / 180;

            if (this.can_move(step, slip_angle)) {

                this.cam_pos.x += Math.cos(slip_angle) * step;
                this.cam_pos.z += Math.sin(slip_angle) * step;
                this.slip = true;


                break;

            }

            right_slip += s * 1;
            slip_angle = (360 - right_slip - 90) * Math.PI / 180;


            if (this.can_move(step, slip_angle)) {

                this.cam_pos.x += Math.cos(slip_angle) * step;
                this.cam_pos.z += Math.sin(slip_angle) * step;
                this.slip = true;

                break;

            }

        }
    };

    this.srcCharacter = chat3d.character;
    chat3d.character = hoverboard_character;
    chat3d.move.max_speed = 300;
    chat3d.history.interval = 0.02;



    var ticks = $('.tick');
    var digits = $('.digit');
    var details = $('.details');
    var progress = $('.progress');
    this.details = details;
    this.progress = progress;

    var outerRingRadius = 60;
    var digitRingRadius = 40;

    ticks.each(function(i) {
        var angle = 210 - i * 5;
        var theta = deg2rad(angle);
        var radius = outerRingRadius + (i % 6 ? 0 : 4);
        var x = Math.cos(theta) * radius;
        var y = Math.sin(theta) * -radius;
        var transform = ['translate(' +
            x + 'px, ' + y + 'px)', 'rotate(' +
            -angle + 'deg)'
        ].
        join(' ');
        $(this).css({
            '-webkit-transform': transform,
            '-moz-transform': transform,
            'transform': transform
        });

    });

    digits.each(function(i) {
        var angle = 210 - i * 30;
        var theta = deg2rad(angle);
        var x = Math.cos(theta) * digitRingRadius;
        var y = Math.sin(theta) * -digitRingRadius;
        $(this).css({
            '-webkit-transform': 'translate(' + x + 'px, ' + y + 'px)',
            '-moz-transform': 'translate(' + x + 'px, ' + y + 'px)',
            'transform': 'translate(' + x + 'px, ' + y + 'px)'
        });

    });

    var frameCount = 100;
    var frameInterval = 0.3;
    var digitValueMax = 160;
    var statValueMax = 0;
    var statValueCurrent = 0;
    var statValueInterval = statValueMax / frameCount;

    var scope = this;
    this.cur_speed = 10;

    function updateDetails() {
        if (statValueCurrent.toFixed(1) > statValueMax) {
            return;
        }
        //statValueCurrent = scope.cur_speed;
        //console.log(scope);
        setStatValue(statValueCurrent.toFixed(1));
        statValueCurrent += statValueInterval;
        setTimeout(updateDetails, frameInterval);
    }


    function setStatValue(value) {
        var angle = -120 + 240 * (value / digitValueMax);
        progress.css({
            'transform': 'rotate(' + angle + 'deg)'
        });

        details.find('.speed').text(value);
    }


    function deg2rad(angle) {
        return angle * (Math.PI / 180);
    }


    function rad2deg(angle) {
        return angle * (180 / Math.PI);
    }

    this.srcCharacter = chat3d.character;
    chat3d.character = hoverboard_character;

    this.srcInterval = chat3d.history.interval;
    chat3d.history.interval = 0.02;

    function geomToBufferGeomWithCenters(geom) {
        const buffGeom = new BABYLON.BufferGeometry().fromGeometry(geom);
        const vectors = [new BABYLON.Vector3(1, 0, 0), new BABYLON.Vector3(0, 1, 0), new BABYLON.Vector3(0, 0, 1)];
        const { position } = buffGeom.attributes;
        const centers = new Float32Array(position.count * 3);
        for (let i = 0, l = position.count; i < l; i++) {
            vectors[i % 3].toArray(centers, i * 3);
        }
        buffGeom.addAttribute('center', new BABYLON.BufferAttribute(centers, 3));
        return buffGeom;
    }

    uTime = { type: 'f', value: 1.0 };
    uResolutionScale = { type: 'f', value: 1.0 };

    this.uTime = uTime;
    this.uResolutionScale = uResolutionScale;

    let canyon = function() {
        const SHOW_STATS = false;
        const CANYON_WIDTH = 400;
        const CANYON_LENGTH = 1200;
        const CANYON_SEGMENTS_W = 27;
        const CANYON_SEGMENTS_L = 100;
        const CLIFF_BASE = 60;
        const CLIFF_VARY = 15;
        const FLOOR_VARY = 10;


        const vertexShader = [
            'attribute vec3 center;',
            'uniform float uTime;',
            'varying float vDisp;',
            'varying vec3 vCenter;',
            'varying vec2 vSceneYZ;',

            '#define PULSE_TIME 1.16',

            'void main() {',
            'vCenter = center;',
            /*'vDisp = max(',
            'max(0., 1.-pow(3.*abs(uv.y-fract(-uTime*PULSE_TIME)+0.5),0.5)),',
            '1.-pow(3.*abs(uv.y-fract(-uTime*PULSE_TIME)-0.5),0.5)',
            ');',*/
            'vDisp =0.0;',
            // FIXME - magic numbers in displacement calculation
            'vec4 scenePosition = modelViewMatrix*vec4(position+vec3(0.,1.,0.)*2.5*vDisp,1.);',
            'vSceneYZ = scenePosition.yz;',
            'gl_Position = projectionMatrix*scenePosition;',
            '}',
        ].join('\n');

        const fragmentShader = [

            'uniform float uResolutionScale;',
            'varying float vDisp;',
            'varying vec3 vCenter;',
            'varying vec2 vSceneYZ;',

            '#define PI 3.14159265359',
            '#define WIREFRAME_WIDTH 2.5',


            'float edgeFactorTri() {',
            'vec3 a3 = smoothstep(vec3(0.), fwidth(vCenter.xyz)*WIREFRAME_WIDTH/uResolutionScale, vCenter.xyz);',
            'return min(min(a3.x, a3.y), a3.z);',
            '}',

            'void main( void ) {',
            'if (edgeFactorTri() > 0.98) discard;',
            'vec3 color = mix(',
            'mix(',
            'mix(',
            'vec3(1.,0.,0.6), // magenta base',
            'vec3(1., 0.9, .0), min(1.9,vDisp) // yellow pulse',
            '),',
            'vec3(1.), max(0., (vSceneYZ.s-20.) / 120.) // lighter on top; FIXME - magic numbers with Y position',
            '),',
            'vec3(0.), max(0., min(1., (-vSceneYZ.t - 280.) / 280.)) // fade to black; FIXME - magic numbers with Z position',
            ');',
            'gl_FragColor = vec4(color, color.r); ',

            '}',
        ].join('\n');


        // add objects
        const canyonGeometry = new BABYLON.PlaneGeometry(CANYON_WIDTH, CANYON_LENGTH, CANYON_SEGMENTS_W, CANYON_SEGMENTS_L);
        canyonGeometry.rotateX(-0.5 * Math.PI);
        const reverseGeometry = canyonGeometry.clone();
        const simplexA = new SimplexNoise(Math.floor(0xffff * Math.random()));
        const simplexB = new SimplexNoise(Math.floor(0xffff * Math.random()));
        for (let i = 0, l = canyonGeometry.vertices.length; i < l; i++) {
            const { x, z } = canyonGeometry.vertices[i];
            canyonGeometry.vertices[i].y =
                Math.min(1.0, Math.pow(x / 50, 4)) * Math.round(CLIFF_BASE + simplexA.noise2D(x, z) * CLIFF_VARY) + Math.round(simplexB.noise2D(x, z) * FLOOR_VARY);
            reverseGeometry.vertices[i].y =
                Math.min(1.0, Math.pow(x / 50, 4)) * Math.round(CLIFF_BASE + simplexA.noise2D(x, -z) * CLIFF_VARY) + Math.round(simplexB.noise2D(x, -z) * FLOOR_VARY);
        }
        const canyonMaterial = new BABYLON.ShaderMaterial({
            //transparent: true,
            side: BABYLON.DoubleSide,
            uniforms: { uTime, uResolutionScale },
            vertexShader,
            fragmentShader,
            //transparent: true
        });
        canyonMaterial.extensions.derivatives = true;
        return new BABYLON.Mesh(geomToBufferGeomWithCenters(canyonGeometry), canyonMaterial);

    };

    this.canyonA = canyon();
    this.canyonA.scale.set(4, 4, 2);

    this.canyonB = canyon();
    this.canyonB.position.z -= 2400;
    this.canyonB.scale.set(4, 4, 2);

    this.canyonC = canyon();
    this.canyonC.position.z -= 2400 * 2;
    this.canyonC.scale.set(4, 4, 2);

    this.canyonD = canyon();
    this.canyonD.position.z -= 2400 * 3;
    this.canyonD.scale.set(4, 4, 2);

    this.canyonE = canyon();
    this.canyonE.position.z -= 2400 * 4;
    this.canyonE.scale.set(4, 4, 2);

    this.canyonF = canyon();
    this.canyonF.position.z -= 2400 * 5;
    this.canyonF.scale.set(4, 4, 2);

    chat3d.world.scene.add(this.canyonA);
    chat3d.world.obj.push(this.canyonA);

    chat3d.world.scene.add(this.canyonB);
    chat3d.world.obj.push(this.canyonB);

    chat3d.world.scene.add(this.canyonC);
    chat3d.world.obj.push(this.canyonC);

    chat3d.world.scene.add(this.canyonD);
    chat3d.world.obj.push(this.canyonD);

    chat3d.world.scene.add(this.canyonE);
    chat3d.world.obj.push(this.canyonE);

    chat3d.world.scene.add(this.canyonF);
    chat3d.world.obj.push(this.canyonF);

    let col1 = new BABYLON.Mesh(new BABYLON.PlaneGeometry(2400 * 6, 200), new BABYLON.MeshBasicMaterial({ visible: false }));
    col1.rotation.y = -Math.PI / 2;
    col1.position.x = 120;
    col1.position.z = -2400 * 2.5;
    chat3d.world.scene.add(col1);
    chat3d.world.colliders.push(col1);

    let col2 = new BABYLON.Mesh(new BABYLON.PlaneGeometry(2400 * 6, 200), new BABYLON.MeshBasicMaterial({ visible: false }));
    col2.rotation.y = Math.PI / 2;
    col2.position.x = -120;
    col2.position.z = -2400 * 2.5;
    chat3d.world.scene.add(col2);
    chat3d.world.colliders.push(col2);
    chat3d.world.scene.fog = new BABYLON.Fog(0x000000, 300, 1000);

    let finish = new BABYLON.Mesh(new BABYLON.PlaneGeometry(70, 70),
        new BABYLON.MeshBasicMaterial({
            map: chat3d.loader.textures.get(chat3d.world.maps + 'loc/iconfinder_finish_flag_172465.png'),
            color: 0xFF0099,
            transparent: true,
            opacity: 0,
            side: 2,
            fog: true
        }));
    //finish.rotation.x = Math.PI;
    finish.scale.set(2, 2, 2);
    finish.position.y = 150;
    finish.position.z = -2400 * 5.4;
    this.finish = finish;
    this.fin_angle = 0;

    chat3d.world.scene.add(finish);
    chat3d.world.obj.push(finish);

    let start = finish.clone();
    start.position.z = 500;

    chat3d.world.scene.add(start);
    chat3d.world.obj.push(start);
    this.start = start;

    let endcol1 = new BABYLON.Mesh(new BABYLON.PlaneGeometry(400, 400),
        new BABYLON.MeshBasicMaterial({
            side: 2,
            visible: false
        }));
    endcol1.position.z = 1105;
    chat3d.world.scene.add(endcol1);
    chat3d.world.colliders.push(endcol1);

    let endcol2 = new BABYLON.Mesh(new BABYLON.PlaneGeometry(400, 400),
        new BABYLON.MeshBasicMaterial({
            side: 2,
            visible: false
        }));
    endcol2.position.z = -2400 * 5.5 + 25;
    chat3d.world.scene.add(endcol2);
    chat3d.world.colliders.push(endcol2);



    this.positions = {}

    /*this.canyonColA = canyon();
    this.canyonColB = canyon();
    this.canyonColC = canyon();
    this.canyonColB.position.z -= 1200;
    this.canyonColA.material.visible = false;
    chat3d.world.scene.add(this.canyonColA);
    chat3d.world.colliders.push(this.canyonColA);

    this.canyonColB.material.visible = false;
    chat3d.world.scene.add(this.canyonColB);
    chat3d.world.colliders.push(this.canyonColB);*/


};

locations[69].onRender = function(delta) {
    //console.log(chat3d.move.max_speed);
    const CANYON_SPEED = 70;
    const CANYON_LENGTH = 1200;
    this.uTime.value += delta;

    this.fin_angle += delta * 2;
    this.finish.material.opacity = 0.63 + Math.abs(Math.sin(this.fin_angle)) * 0.33;

    if (chat3d.move.slip) {
        chat3d.move.max_speed = 110;
    } else {
        chat3d.move.max_speed = 400;
    }
    // move canyons
    //this.canyonA.position.z += delta * CANYON_SPEED;
    //this.canyonB.position.z += delta * CANYON_SPEED;
    /*if (this.canyonA.position.z > CANYON_LENGTH) {
        this.canyonA.position.z -= 2 * CANYON_LENGTH;
    }
    if (this.canyonB.position.z > CANYON_LENGTH) {
        this.canyonB.position.z -= 2 * CANYON_LENGTH;
    }*/
    if (!this.speedTimer) {
        this.speedTimer = new BABYLON.Clock();
        this.speedTimer.getDelta();
        this.lastPos = new BABYLON.Vector3().copy(chat3d.world.eyes.position);
        this.speedTime = 0;
        this.cur_speed = 1;
        this.target_speed = 0;
        this.speedStack = [];

    }


    this.speedTime += this.speedTimer.getDelta();

    if (this.speedTime > 0.05) {

        var speeddist = this.lastPos.sub(chat3d.world.eyes.position).length();
        this.lastPos.copy(chat3d.world.eyes.position);
        var speed = (speeddist / this.speedTime) / 10;
        if (this.speedStack.length < 10) {
            this.speedStack.push(speed);
        } else {
            var speedStack = this.speedStack;
            this.speedStack = [];
            for (var i = 1; i < 10; i++) {
                this.speedStack.push(speedStack[i])
            }
            this.speedStack.push(speed);
        }
        var avrSpeed = 0;

        for (var i in this.speedStack) {
            avrSpeed += this.speedStack[i];
        }
        avrSpeed /= this.speedStack.length;

        this.target_speed = avrSpeed;

        //this.target_speed = speed;
        //speed = speed.toFixed(1);
        //console.log(this.speedTime, speeddist, speed);
        //chat3d.msg.send('charspeed', speed);



        this.speedTime = 0;
    }

    if (Math.abs(this.target_speed - this.cur_speed) > 0.2 || this.target_speed == 0) {
        if (this.cur_speed < this.target_speed) {
            this.cur_speed += delta * 30;
            this.cur_speed = Math.min(this.cur_speed, this.target_speed);
        } else {
            this.cur_speed -= delta * 30;
            this.cur_speed = Math.max(this.cur_speed, this.target_speed);
        }
        //var speed = (this.cur_speed * 3).toFixed(1);
        var speed = parseInt(this.cur_speed * 3);
        //speed *= 3;
        //var speed = this.cur_speed;
        var angle = -120 + 240 * (speed / 160);
        this.progress.css({
            'transform': 'rotate(' + angle + 'deg)'
        });

        this.details.find('.speed').text(Math.min(speed, 120));
    }

    if (chat3d.world.eyes.position.z > 500) {
        chat3d.move.max_speed = 120;
        if (this.started2) {
            console.log('finished2');
            let time = this.started2.getElapsedTime();
            if (!this.positions[chat3d.selfid] || this.positions[chat3d.selfid].time > time) {
                this.hub.broadcast('time|' + chat3d.selfid, {
                    time: time,
                    name: chat3d.self_name
                });
                //this.positions[chat3d.selfid] = parseInt(i);
                this.positions[chat3d.selfid] = { time: time, name: chat3d.self_name };
                this.updateList();
            } else {
                console.log('not best result', time);
            }
            this.started2 = null;


        }

        this.started1 = new BABYLON.Clock();
        this.started1.getDelta();
    }

    if (chat3d.world.eyes.position.z < -2400 * 5.4) {
        chat3d.move.max_speed = 90;
        if (this.started1) {
            console.log('finished1');
            let time = this.started1.getElapsedTime();
            if (!this.positions[chat3d.selfid] || this.positions[chat3d.selfid].time > time) {
                this.hub.broadcast('time|' + chat3d.selfid, {
                    time: time,
                    name: chat3d.self_name
                });
                //this.positions[chat3d.selfid] = parseInt(i);
                this.positions[chat3d.selfid] = { time: time, name: chat3d.self_name };
                this.updateList();
            } else {
                console.log('not best result', time);
            }
            this.started1 = null;


        }

        this.started2 = new BABYLON.Clock();
        this.started2.getDelta();
    }
};

locations[69].onClean = function() {

    console.log('on clean');
    chat3d.world.scene.fog = null;
    chat3d.character = this.srcCharacter;
    chat3d.history.interval = this.srcInterval;
    chat3d.move.max_speed = 110;
    $('#racetimer').remove();
    $('#racelist').remove();
    $('.speedometer-container').remove();
    chat3d.move.a_dv = 2;
    chat3d.move.setSlip = this.srcMSlip;

    if (this.recorder) {
        this.recorder.stop();
    }
};

locations[69].onMessage = function(data) {
    if (data) {
        //console.log(data);
        for (var i in data) {
            var msg = data[i];
            if (this.hub.pCounters[msg.type] && this.hub.pCounters[msg.type] > msg.counter) {
                console.log('%c old data!!', ' background: #FF2222');

            } else {
                if (msg.type.indexOf('time|') !== -1) {
                    var place = msg.type.split('|');
                    //console.log(place, msg.data);
                    this.positions[place[1]] = msg.data;
                    this.updateList();
                }
            }
        }
    }
};