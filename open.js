// document.getElementById("openModal").onclick = function() {
//     document.getElementById("myModal").style.display = "block";
//     showPreloader();
// };

// document.getElementById("closeModal").onclick = function() {
//     document.getElementById("myModal").style.display = "none";
// };

// window.onclick = function(event) {
//     if (event.target == document.getElementById("myModal")) {
//         document.getElementById("myModal").style.display = "none";
//     }
// };

// function showPreloader() {
//     const preloader = document.getElementById("preloader");
//     const modalBody = document.getElementById("modalBody");

//     // Show preloader for 2 seconds
//     preloader.style.display = "block";
//     modalBody.style.display = "none";

//     setTimeout(() => {
//         preloader.style.display = "none";
//         modalBody.style.display = "block";
//     }, 4000);
// }

document.getElementById("openModal").onclick = function() {
    document.getElementById("myModal").style.display = "block";
    showPreloader();
};

document.getElementById("closeModal").onclick = function() {
    document.getElementById("myModal").style.display = "none";
};

window.onclick = function(event) {
    if (event.target == document.getElementById("myModal")) {
        document.getElementById("myModal").style.display = "none";
    }
};

function showPreloader() {
    const preloader = document.getElementById("preloader");
    const modalBody = document.getElementById("modalBody");

    // Show preloader for 2 seconds
    preloader.style.display = "block";
    modalBody.style.display = "none";

    setTimeout(() => {
        preloader.style.display = "none";
        modalBody.style.display = "block";
    }, 2000);
}
