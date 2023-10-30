let autocomplete = "";
let lat, lng;

function initMap() {
  const input = document.getElementById("e_location");
  const options = {
    componentRestricitons: { country: "ro" },
    fields: ["geometry", "name", "place_id"],
    language: "ro",
  };

  autocomplete = new google.maps.places.Autocomplete(input, options);

  autocomplete.addListener("place_changed", onPlaceChanged);
}

function onPlaceChanged() {
  var place = autocomplete.getPlace();
  if (place.geometry) {
    lat = place.geometry.location.lat();
    lng = place.geometry.location.lng();
    document.getElementById("e_lat").value = lat;
    document.getElementById("e_lng").value = lng;
  }
}
