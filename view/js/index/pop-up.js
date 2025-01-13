function enablePopUp() {
    var popUpMemoriesSummit2023 = document.getElementById("pop-up-memories-summit-2023");
    popUpMemoriesSummit2023.style.display = "block";
    popUpMemoriesSummit2023.style.zIndex = 3;
}

function hidePopUp() {
    var popUpMemoriesSummit2023 = document.getElementById("pop-up-memories-summit-2023");
    popUpMemoriesSummit2023.style.display = "none";
    popUpMemoriesSummit2023.style.zIndex = 2;
    window.onload();
}