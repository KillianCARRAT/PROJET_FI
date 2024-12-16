function updateVisibility() {
    const checkboxVehicule = document.getElementById('checkbox-vehicule');
    const vehicule = document.getElementById('vehicule');

    if (checkboxVehicule.checked) {
        vehicule.style.visibility = "visible";
    } else {
        vehicule.style.visibility = "hidden";
    }

    const checkboxHotel = document.getElementById('checkbox-hotel');
    const hotel = document.getElementById('hotel');

    if (checkboxHotel.checked) {
        hotel.style.visibility = "visible";
    } else {
        hotel.style.visibility = "hidden";
    }
}


document.addEventListener('DOMContentLoaded', () => {
    updateVisibility();


    document.getElementById('checkbox-vehicule').addEventListener('change', updateVisibility);
    document.getElementById('checkbox-hotel').addEventListener('change', updateVisibility);
});