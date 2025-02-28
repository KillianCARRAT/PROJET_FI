function updateValueFromSlider() {
    let slider = document.getElementById('slider');
    let sliderInput = document.getElementById('sliderInput');

    sliderInput.value = slider.value;
}

function updateValueFromInput() {
    let slider = document.getElementById('slider');
    let sliderInput = document.getElementById('sliderInput');

    let newValue = parseInt(sliderInput.value);
    
    if (!isNaN(newValue) && newValue >= slider.min && newValue <= slider.max) {
        slider.value = newValue;
    }
}

const slider = document.querySelector('input[type="range"]');

slider.addEventListener('input', function () {
  const value = (slider.value - slider.min) / (slider.max - slider.min) * 100;
  slider.style.setProperty('--slider-value', value);
});

document.getElementById('slider').addEventListener('input', updateValueFromSlider);
document.getElementById('sliderInput').addEventListener('input', updateValueFromInput);