document.addEventListener("DOMContentLoaded", function () {
  const audio = new Audio("./assets/sound-mp3.mp3");
  audio.loop = true;
  const playButton = document.getElementById("playButton");
  const playButtonIco = document.getElementById("play-ico");

  playButton.addEventListener("click", function () {
    if (audio.paused) {
      audio.play();
      playButtonIco.innerHTML = `<i class="text-white fa-solid fa-volume-high">`;
    } else {
      audio.pause();
      playButtonIco.innerHTML = `<i class="fa-solid fa-volume-xmark"></i>`;
    }
  });

  playButtonIco.addEventListener("click", function () {
    if (audio.paused) {
      audio.play();
      playButtonIco.innerHTML = `<i class="text-white fa-solid fa-volume-high">`;
    } else {
      audio.pause();
      playButtonIco.innerHTML = `<i class="fa-solid fa-volume-xmark"></i>`;
    }
  });
});
