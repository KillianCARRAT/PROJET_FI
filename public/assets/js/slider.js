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

document.getElementById('slider').addEventListener('input', updateValueFromSlider);
document.getElementById('sliderInput').addEventListener('input', updateValueFromInput);