let map;

async function initMap() {
  const { Map } = await google.maps.importLibrary("maps");

  map = new Map(document.getElementById("map"), {
    center: { lat: 44.4268, lng: 26.1025 },
    zoom: 7,
    streetViewControl: false,
    mapTypeControl: false,
    disableDefaultUI: true,
  });

  const contentString = "<p>demo brae boots :)</p>";

  const infowindow = new google.maps.InfoWindow({
    content: contentString,
    ariaLabel: "bravebot",
  });

  const marker = new google.maps.Marker({
    position: { lat: 44.4268, lng: 26.1025 },
    map,
    //title: "Hello World!",
  });

  marker.addListener("mouseover", () => {
    infowindow.open({
      anchor: marker,
      map,
    });
  });

  marker.addListener("mouseout", () => {
    infowindow.close();
  });
}

initMap();
