const revealDivLeft = document.getElementById('generatordiv2d');
const revealDivRight = document.getElementById('generatordiv3d');

function checkScroll() {
    // Para el div que se mueve de izquierda a derecha
    const triggerPoint = window.innerHeight / 2; // Punto de activación al 50% de la altura de la ventana
    const boxTop = revealDivLeft.getBoundingClientRect().top;
    const windowHeight = window.innerHeight;

    const startReveal = windowHeight;
    const endReveal = triggerPoint;

    if (boxTop < startReveal && boxTop > endReveal) {
        const scrollPercentage = (startReveal - boxTop) / (startReveal - endReveal);
        const translateX = Math.min(0, -100 + scrollPercentage * 100); // Ajuste para llegar a la posición final al 50% de la ventana
        revealDivLeft.style.transform = `translateX(${translateX}%)`;
        revealDivLeft.classList.add('visible');
        revealDivLeft.classList.remove('hidden');
    } else if (boxTop <= endReveal) {
        revealDivLeft.style.transform = `translateX(0%)`;
        revealDivLeft.classList.add('visible');
        revealDivLeft.classList.remove('hidden');
    } else {
        revealDivLeft.classList.add('hidden');
        revealDivLeft.classList.remove('visible');
        revealDivLeft.style.transform = `translateX(-100%)`;
    }

    // Para el div que se mueve de derecha a izquierda
    const triggerPointRight = window.innerHeight / 2; // Punto de activación al 50% de la altura de la ventana
    const boxTopRight = revealDivRight.getBoundingClientRect().top;

    if (boxTopRight < startReveal && boxTopRight > endReveal) {
        const scrollPercentageRight = (startReveal - boxTopRight) / (startReveal - endReveal);
        const translateXRight = Math.max(0, 100 - scrollPercentageRight * 100); // Ajuste para llegar a la posición final al 50% de la ventana
        revealDivRight.style.transform = `translateX(${translateXRight}%)`;
        revealDivRight.classList.add('visible');
        revealDivRight.classList.remove('hidden');
    } else if (boxTopRight <= endReveal) {
        revealDivRight.style.transform = `translateX(0%)`;
        revealDivRight.classList.add('visible');
        revealDivRight.classList.remove('hidden');
    } else {
        revealDivRight.classList.add('hidden');
        revealDivRight.classList.remove('visible');
        revealDivRight.style.transform = `translateX(100%)`;
    }
}

window.addEventListener('scroll', checkScroll);
checkScroll(); // Realizar una verificación inicial por si el elemento ya está en vista
