const revealCommunityDivLeft = document.getElementById('comunnityDiv1');
const revealCommunityDivRight = document.getElementById('comunnityDiv2');

function checkScroll() {
    // Para el div que se mueve de izquierda a derecha
    const triggerPoint = window.innerHeight / 2; // Punto de activación al 50% de la altura de la ventana
    const boxTop = revealCommunityDivLeft.getBoundingClientRect().top;
    const windowHeight = window.innerHeight;

    const startReveal = windowHeight;
    const endReveal = triggerPoint;

    if (boxTop < startReveal && boxTop > endReveal) {
        const scrollPercentage = (startReveal - boxTop) / (startReveal - endReveal);
        const translateX = Math.min(0, -100 + scrollPercentage * 100); // Ajuste para llegar a la posición final al 50% de la ventana
        revealCommunityDivLeft.style.transform = `translateX(${translateX}%)`;
        revealCommunityDivLeft.classList.add('visible');
        revealCommunityDivLeft.classList.remove('hidden');
    } else if (boxTop <= endReveal) {
        revealCommunityDivLeft.style.transform = `translateX(0%)`;
        revealCommunityDivLeft.classList.add('visible');
        revealCommunityDivLeft.classList.remove('hidden');
    } else {
        revealCommunityDivLeft.classList.add('hidden');
        revealCommunityDivLeft.classList.remove('visible');
        revealCommunityDivLeft.style.transform = `translateX(-100%)`;
    }

    // Para el div que se mueve de derecha a izquierda
    const triggerPointRight = window.innerHeight / 2; // Punto de activación al 50% de la altura de la ventana
    const boxTopRight = revealCommunityDivRight.getBoundingClientRect().top;

    if (boxTopRight < startReveal && boxTopRight > endReveal) {
        const scrollPercentageRight = (startReveal - boxTopRight) / (startReveal - endReveal);
        const translateXRight = Math.max(0, 100 - scrollPercentageRight * 100); // Ajuste para llegar a la posición final al 50% de la ventana
        revealCommunityDivRight.style.transform = `translateX(${translateXRight}%)`;
        revealCommunityDivRight.classList.add('visible');
        revealCommunityDivRight.classList.remove('hidden');
    } else if (boxTopRight <= endReveal) {
        revealCommunityDivRight.style.transform = `translateX(0%)`;
        revealCommunityDivRight.classList.add('visible');
        revealCommunityDivRight.classList.remove('hidden');
    } else {
        revealCommunityDivRight.classList.add('hidden');
        revealCommunityDivRight.classList.remove('visible');
        revealCommunityDivRight.style.transform = `translateX(100%)`;
    }
}

window.addEventListener('scroll', checkScroll);
checkScroll(); // Realizar una verificación inicial por si el elemento ya está en vista
