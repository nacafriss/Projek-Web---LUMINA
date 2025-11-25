document.addEventListener("DOMContentLoaded", () => {
    const imgs = document.querySelectorAll(".img");
    if (imgs.length === 0) return;

    imgs.forEach((elem) => {
        elem.style.backgroundImage = `url('${elem.dataset.img}')`;
    });

    const total = imgs.length;
    const imgWidth = 400;   
    const imgHeight = 300;

    let radius = Math.round(imgWidth / (2 * Math.sin(Math.PI / total)));

    if (total <= 3) radius += 80;

    let angle = 360 / total;
    let xPos = 0;

    gsap.set(".ring", { rotationY: 0 });

    // posisi tiap gambar
    gsap.set(".img", {
        transformOrigin: `50% 50% ${radius}px`,
        rotateY: i => i * -angle,
        z: -radius,
    });

    const stage = document.querySelector(".stage");
    stage.style.height = (imgHeight + 40) + "px";


    const ring = document.querySelector(".ring");

    function dragStart(e) {
        xPos = (e.clientX || e.touches[0].clientX);
        ring.style.cursor = "grabbing";
        window.addEventListener("mousemove", drag);
        window.addEventListener("touchmove", drag);
    }

    function drag(e) {
        const x = (e.clientX || e.touches[0].clientX);
        gsap.to(".ring", {
            rotationY: "-=" + ((x - xPos) * 0.5),
        });
        xPos = x;
    }

    function dragEnd() {
        ring.style.cursor = "grab";
        window.removeEventListener("mousemove", drag);
        window.removeEventListener("touchmove", drag);
    }

    window.addEventListener("mousedown", dragStart);
    window.addEventListener("touchstart", dragStart);
    window.addEventListener("mouseup", dragEnd);
    window.addEventListener("touchend", dragEnd);
});
