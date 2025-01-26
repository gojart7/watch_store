const slider = document.querySelector(".slider");
const slides = document.querySelectorAll(".slide");
const prevButton = document.querySelector(".prev");
const nextButton = document.querySelector(".next");

let currentIndex = 0;

function updateSlider() {
  slider.style.transform = `translateX(-${currentIndex * 100}%)`;
}

nextButton.addEventListener("click", () => {
  currentIndex = (currentIndex + 1) % slides.length;
  updateSlider();
});
prevButton.addEventListener("click", () => {
  currentIndex = (currentIndex - 1 + slides.length) % slides.length;
  updateSlider();
});
