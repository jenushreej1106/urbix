import * as THREE from 'https://cdn.jsdelivr.net/npm/three@0.170.0/build/three.module.js';

const canvas = document.querySelector('#cityCanvas');

if (canvas) {

    const scene = new THREE.Scene();

    scene.background = new THREE.Color('#080B12');

    scene.fog = new THREE.Fog('#080B12', 15, 65);

    const camera = new THREE.PerspectiveCamera(
        45,
        canvas.clientWidth / canvas.clientHeight,
        0.1,
        1000
    );

    camera.position.set(13, 12, 19);

    camera.lookAt(0, 2, 0);


    const renderer = new THREE.WebGLRenderer({
        canvas: canvas,
        antialias: true,
        alpha: true
    });

    renderer.setPixelRatio(
        Math.min(window.devicePixelRatio, 2)
    );

    renderer.setSize(
        canvas.clientWidth,
        canvas.clientHeight
    );


    // LIGHTS

    scene.add(
        new THREE.AmbientLight(0xffffff, 1.8)
    );

    const blueLight = new THREE.PointLight(
        0x00d9ff,
        120,
        45
    );

    blueLight.position.set(5, 10, 5);

    scene.add(blueLight);


    const purpleLight = new THREE.PointLight(
        0x8b5cf6,
        100,
        45
    );

    purpleLight.position.set(-10, 5, -5);

    scene.add(purpleLight);


    // GROUND

    const ground = new THREE.Mesh(
        new THREE.PlaneGeometry(50, 50),
        new THREE.MeshStandardMaterial({
            color: 0x101a2a,
            metalness: 0.7,
            roughness: 0.5
        })
    );

    ground.rotation.x = -Math.PI / 2;

    ground.position.y = -0.2;

    scene.add(ground);


    // GRID

    const grid = new THREE.GridHelper(
        45,
        35,
        0x00d9ff,
        0x253b57
    );

    grid.position.y = -0.1;

    scene.add(grid);


    // BUILDINGS

    const buildings = [];

    const colors = [
        0x14263c,
        0x182b45,
        0x201c3c,
        0x112d3c
    ];


    for (let i = 0; i < 55; i++) {

        const width = 0.8 + Math.random() * 1.2;

        const height = 2 + Math.random() * 7;

        const depth = 0.8 + Math.random() * 1.2;


        const geometry = new THREE.BoxGeometry(
            width,
            height,
            depth
        );


        const material = new THREE.MeshStandardMaterial({
            color: colors[
                Math.floor(Math.random() * colors.length)
            ],
            metalness: 0.65,
            roughness: 0.3
        });


        const building = new THREE.Mesh(
            geometry,
            material
        );


        building.position.set(
            (Math.random() - 0.5) * 24,
            height / 2,
            (Math.random() - 0.5) * 24
        );


        if (
            Math.abs(building.position.x) < 3 &&
            Math.abs(building.position.z) < 3
        ) {
            building.position.x += 5;
        }


        scene.add(building);

        buildings.push(building);


        // BUILDING WINDOWS

        const windows = new THREE.BoxGeometry(
            width * 0.65,
            0.045,
            0.025
        );


        for (let y = 1; y < height - 0.3; y += 0.6) {

            const windowMaterial = new THREE.MeshBasicMaterial({
                color: Math.random() > 0.5
                    ? 0x00d9ff
                    : 0x8b5cf6
            });


            const windowMesh = new THREE.Mesh(
                windows,
                windowMaterial
            );


            windowMesh.position.set(
                building.position.x,
                y,
                building.position.z + depth / 2 + 0.02
            );

            scene.add(windowMesh);

        }

    }


    // CENTRAL SMART TOWER

    const tower = new THREE.Mesh(
        new THREE.BoxGeometry(2, 9, 2),
        new THREE.MeshStandardMaterial({
            color: 0x152b48,
            metalness: 0.8,
            roughness: 0.2
        })
    );

    tower.position.set(0, 4.5, 0);

    scene.add(tower);


    // TOWER LIGHT

    const topLight = new THREE.PointLight(
        0x00d9ff,
        80,
        15
    );

    topLight.position.set(0, 10, 0);

    scene.add(topLight);


    // PARTICLES

    const particleGeometry = new THREE.BufferGeometry();

    const particleCount = 500;

    const positions = new Float32Array(
        particleCount * 3
    );


    for (let i = 0; i < particleCount * 3; i++) {

        positions[i] = (Math.random() - 0.5) * 35;

    }


    particleGeometry.setAttribute(
        'position',
        new THREE.BufferAttribute(positions, 3)
    );


    const particleMaterial = new THREE.PointsMaterial({
        color: 0x00d9ff,
        size: 0.045,
        transparent: true,
        opacity: 0.8
    });


    const particles = new THREE.Points(
        particleGeometry,
        particleMaterial
    );

    scene.add(particles);


    // MOUSE MOVEMENT

    let mouseX = 0;

    let mouseY = 0;


    window.addEventListener('mousemove', (event) => {

        mouseX = (
            event.clientX / window.innerWidth - 0.5
        ) * 0.5;

        mouseY = (
            event.clientY / window.innerHeight - 0.5
        ) * 0.2;

    });


    // ANIMATION

    function animate() {

        requestAnimationFrame(animate);

        const time = performance.now() * 0.001;


        camera.position.x += (
            13 + mouseX * 3 - camera.position.x
        ) * 0.025;


        camera.position.y += (
            12 - mouseY * 3 - camera.position.y
        ) * 0.025;


        camera.lookAt(0, 2, 0);


        particles.rotation.y += 0.0008;


        buildings.forEach((building, index) => {

            building.position.y =
                building.geometry.parameters.height / 2 +
                Math.sin(time + index) * 0.025;

        });


        tower.scale.y = 1 + Math.sin(time * 1.5) * 0.015;


        renderer.render(scene, camera);

    }

    animate();


    // RESPONSIVE RESIZE

    window.addEventListener('resize', () => {

        const width = canvas.clientWidth;

        const height = canvas.clientHeight;

        camera.aspect = width / height;

        camera.updateProjectionMatrix();

        renderer.setSize(width, height);

    });

}


// GSAP ANIMATIONS

window.addEventListener('load', () => {

    if (!window.gsap) return;

    gsap.registerPlugin(ScrollTrigger);


    gsap.to('.loader', {

        opacity: 0,

        duration: 0.8,

        delay: 1.2,

        onComplete: () => {

            document.querySelector('.loader').style.display = 'none';

        }

    });


    gsap.from('.hero-content > *', {

        y: 45,

        opacity: 0,

        duration: 1,

        stagger: 0.15,

        delay: 1.5

    });


    gsap.from('.city-container', {

        x: 70,

        opacity: 0,

        duration: 1.3,

        delay: 1.5

    });


    gsap.utils.toArray('.info-card, .feature-card').forEach(card => {

        gsap.from(card, {

            y: 50,

            opacity: 0,

            duration: 0.8,

            scrollTrigger: {

                trigger: card,

                start: 'top 90%'

            }

        });

    });

});