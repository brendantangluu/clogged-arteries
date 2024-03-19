function initMap(el) {
    // Find marker elements within map.
    var markers = el.querySelectorAll('.marker');

    // Create generic map.
    var mapArgs = {
        zoom: el.dataset.zoom || 16,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    var map = new google.maps.Map(el, mapArgs);

    // Add markers.
    map.markers = [];
    markers.forEach(function(marker) {
        initMarker(marker, map);
    });

    // Center map based on markers.
    centerMap(map);

    // Return map instance.
    return map;
}

/**
 * initMarker
 *
 * Creates a marker for the given element and map.
 *
 * @param {HTMLElement} marker The marker element.
 * @param {google.maps.Map} map The map instance.
 * @return {google.maps.Marker} The marker instance.
 */
function initMarker(marker, map) {
    // Get position from marker.
    var lat = marker.dataset.lat;
    var lng = marker.dataset.lng;
    var latLng = {
        lat: parseFloat(lat),
        lng: parseFloat(lng)
    };

    // Create marker instance.
    var gMarker = new google.maps.Marker({
        position: latLng,
        map: map
    });

    // Append to reference for later use.
    map.markers.push(gMarker);

    // If marker contains HTML, add it to an infoWindow.
    if (marker.innerHTML) {
        // Create info window.
        var infowindow = new google.maps.InfoWindow({
            content: marker.innerHTML
        });

        // Show info window when marker is clicked.
        google.maps.event.addListener(gMarker, 'click', function() {
            infowindow.open(map, gMarker);
        });
    }
}

/**
 * centerMap
 *
 * Centers the map showing all markers in view.
 *
 * @param {google.maps.Map} map The map instance.
 */
function centerMap(map) {
    // Create map boundaries from all map markers.
    var bounds = new google.maps.LatLngBounds();
    map.markers.forEach(function(marker) {
        bounds.extend({
            lat: marker.position.lat(),
            lng: marker.position.lng()
        });
    });

    // Case: Single marker.
    if (map.markers.length == 1) {
        map.setCenter(bounds.getCenter());

    // Case: Multiple markers.
    } else {
        map.fitBounds(bounds);
    }
}

// Render maps on page load.
document.addEventListener('DOMContentLoaded', function() {
    var maps = document.querySelectorAll('.acf-map');
    maps.forEach(function(mapEl) {
        var map = initMap(mapEl);
    });
});
