// Toggle Switch Location
const locationForm = document.getElementById('location-switch-form');
document.getElementById('switch-location-btn').addEventListener('click', showLocationForm);

function showLocationForm(){
    locationForm.classList.toggle('location-switch');
}