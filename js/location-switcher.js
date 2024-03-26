console.log('location-switcher.js loaded successfully.');

// Toggle Switch Location
const locationForm = document.getElementById('location-switch-form');
const locationArrow = document.getElementById('location-arrow');
document.getElementById('switch-location-btn').addEventListener('click', showLocationForm);


function showLocationForm(){
    locationForm.classList.toggle('hidden');
    locationArrow.classList.toggle('clicked');
}

// Assuming all labels have the class 'city-label'
const labels = document.querySelectorAll('.city-label');

let lastClickedLabel = null; // To keep track of the last clicked label

labels.forEach(label => {
    label.addEventListener('click', function() {
        // If there's a last clicked label, remove the active class
        if (lastClickedLabel) {
            lastClickedLabel.classList.remove('active-label');
        }
        // Add the active class to the currently clicked label
        this.classList.add('active-label');
        // Update the lastClickedLabel to the current label
        lastClickedLabel = this;
    });
});
