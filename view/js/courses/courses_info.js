
function toggleAprenderas(event) {
    event.preventDefault(); // Previene el comportamiento de salto del enlace

    const extras = document.querySelectorAll('.extra');
    const toggleLink = document.getElementById('verMas');

    extras.forEach(item => {
        item.style.display = (item.style.display === 'none' || item.style.display === '') ? 'list-item' : 'none';
    });

    if (toggleLink.innerText.includes("Ver más")) {
        toggleLink.innerHTML = 'Ver menos <span>▲</span>';
    } else {
        toggleLink.innerHTML = 'Ver más <span>▼</span>';
    }
}


function toggleSection(header) {
    const lessons = header.nextElementSibling;
    if (lessons.style.display === "none") {
        lessons.style.display = "block";
    } else {
        lessons.style.display = "none";
    }
}