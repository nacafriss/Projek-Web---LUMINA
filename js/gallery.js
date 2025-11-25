document.addEventListener("DOMContentLoaded", () => {

    const imgs = document.querySelectorAll(".img");
    if (imgs.length === 0) return;

    // Set background dari DB
    imgs.forEach((elem) => {
        elem.style.backgroundImage = `url('${elem.dataset.img}')`;
    });

    let total = imgs.length;
    let angle = 360 / total;

    // AUTO radius: makin sedikit gambar makin rapat
    let radius = 120; 
    if (total >= 5) radius = 250;
    if (total >= 8) radius = 400;

    let xPos = 0;

    // Start normal, bukan 180
    gsap.set(".ring", { rotationY: 0 });

    // Setiap gambar di posisi lingkaran
    gsap.set(".img", {
        rotateY: i => i * -angle,
        transformOrigin: `50% 50% ${radius}px`,
        z: -radius,
    });

    // DRAG
    const ring = document.querySelector(".ring");

    function dragStart(e) {
        xPos = (e.clientX || e.touches[0].clientX);
        ring.style.cursor = "grabbing";
        window.addEventListener("mousemove", drag);
        window.addEventListener("touchmove", drag);
    }

    function drag(e) {
        let x = (e.clientX || e.touches[0].clientX);
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
