// const popupOverlay = document.querySelector(".modal-overlay");
// const skipButton = document.querySelector(".popup-container .skip-button");
// const visitButton = document.querySelector(".popup-container .visit-button");

// let remainingTime = 5;
// let allowedToSkip = false;
// let popupTimer;

// const createPopupCookie = () => {
//   let expiresDays = 30;
//   let date = new Date();
//   date.setTime(date.getTime() + expiresDays * 24 * 60 * 60 * 1000);
//   let expires = "expires=" + date.toUTCString();
//   document.cookie = `popupCookie=true; ${expires}; path=/;`;
// };



// const skipAd = () => {
//   popupOverlay.classList.remove("active");
//   createPopupCookie();
// };

// skipButton.addEventListener("click", () => {
//   if (allowedToSkip) {
//     skipAd();
//   }
// });


const modal = document.querySelector(".modal-popup");
const modalOverlay = document.querySelector(".modal-overlay");
// const closeBtn = document.querySelector(".modal-popup .close-btn");
const discountBtn = document.querySelector(".modal-popup .discount-btn");

// const createCookie = () => {
//   let maxAge = ";max-age=10";
//   let path = ";path=/";
//   document.cookie = "live-blogger-popup=displayed" + maxAge + path;
// };

const createCookie = () => {
  let expiresDays = 30;
  let date = new Date();
  date.setTime(date.getTime() + expiresDays * 24 * 60 * 60 * 1000);
  let expires = "expires=" + date.toUTCString();
  document.cookie = `popupCookie=true; ${expires}; path=/;`;
};

// const displayModal = () => {
//   if (document.cookie.indexOf("live-blogger-popup") == -1) {
//     modal.classList.add("active");
//     modalOverlay.classList.add("active");
//     createCookie();
//   }
// };
const showAd = () => {
  modal.classList.add("active");
  modalOverlay.classList.add("active");
  popupTimer = setInterval(() => {
    // skipButton.innerHTML = `Skip in ${remainingTime}s`;
    // remainingTime--;

    if (remainingTime < 0) {
      allowedToSkip = true;
      skipButton.innerHTML = "Skip";
      clearInterval(popupTimer);
    }
  }, 1000);
};
// setTimeout(() => {
//   displayModal();
// }, 2000);

// closeBtn.addEventListener("click", () => {
//   modal.classList.remove("active");
//   modalOverlay.classList.remove("active");
// });

discountBtn.addEventListener("click", () => {
  modal.classList.remove("active");
  modalOverlay.classList.remove("active");
});

const startTimer = () => {
  if (window.scrollY > 100) {
    showAd();
    window.removeEventListener("scroll", startTimer);
  }
};

if (!document.cookie.match(/^(.*;)?\s*popupCookie\s*=\s*[^;]+(.*)?$/)) {
  window.addEventListener("scroll", startTimer);
}