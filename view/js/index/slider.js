const slide1 = document.querySelector('#slide1');
const slide2 = document.querySelector('#slide2');

setInterval(function(){
  slide1.classList.toggle('visible');
  slide1.classList.toggle('invisible');
  slide2.classList.toggle('invisible');
  slide2.classList.toggle('visible');
}, 30000); // Change every 30 seconds (30000 milliseconds)

const titleslide1 = document.querySelector('#title-slide1');
const titleslide2 = document.querySelector('#title-slide2');

setInterval(function(){
  titleslide1.classList.toggle('visible');
  titleslide1.classList.toggle('invisible');
  titleslide2.classList.toggle('invisible');
  titleslide2.classList.toggle('visible');
}, 30000); // Change every 30 seconds (30000 milliseconds)
