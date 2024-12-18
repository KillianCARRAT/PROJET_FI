function updateValue() {
    let slider = document.getElementById('slider');
    let sliderValue = document.getElementById('sliderValue');

    sliderValue.innerHTML = slider.value;

    let sliderWidth = slider.offsetWidth - slider.clientLeft * 2;
    let valuePosition = (slider.value - slider.min) / (slider.max - slider.min) * sliderWidth;
    sliderValue.style.left = `${valuePosition}px`;
}

updateValue();