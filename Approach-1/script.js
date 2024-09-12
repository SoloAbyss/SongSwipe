let slider = document.querySelector('.slider');
let innerSlider = document.querySelector('slider-inner');

let pressed = false;
let startx;
let x;

slider.addEventListener('mousedown', (e)=>{
    pressed = true;
    startx = e.offsetX - innerSlider.offsetLeft;
    console.log(innerSlider.offsetLeft)
})