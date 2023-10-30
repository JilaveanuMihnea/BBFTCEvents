let map;

async function initMap() {
  const { Map } = await google.maps.importLibrary('maps');

  map = new Map(document.getElementById('map'), {
    center: { lat: 44.4268, lng: 26.1025 },
    zoom: 7,
    streetViewControl: false,
    mapTypeControl: false,
    disableDefaultUI: true,
  });

  const response = await fetch('../data/markers.json');
  const marker_data = await response.json();
  console.log(marker_data);
  marker_data.forEach((element) => {
    const contentString = '<p>' + element.event_name + '</p>';

    //todo add infowindow stuff
    const infowindow = new google.maps.InfoWindow({
      content: contentString,
      ariaLabel: 'bravebot',
    });

    const marker = new google.maps.Marker({
      position: {
        lat: Number(element.event_lat),
        lng: Number(element.event_lng),
      },
      map,
    });

    marker.addListener('mouseover', () => {
      infowindow.open({
        anchor: marker,
        map,
      });
    });

    marker.addListener('mouseout', () => {
      infowindow.close();
    });
  });
}

initMap();
