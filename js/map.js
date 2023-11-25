let map;

async function initMap() {
  const { Map } = await google.maps.importLibrary('maps');

  map = new Map(document.getElementById('map'), {
    center: { lat: 45.562714, lng: 24.730261 },
    zoom: 7,
    streetViewControl: false,
    mapTypeControl: false,
    disableDefaultUI: true,
  });

  const response = await fetch('data/markers.json');
  const marker_data = await response.json();
  console.log(marker_data);
  marker_data.forEach((element) => {
    const contentString = '<p>' + element.event_name + '     </p>';
    // '<div id="infowindow-content" style="margin:0; padding:0; display:flex; flex-direction: column;">' +
    // '<div id="infowindow-title" style="font-size: 1.7rem; margin:0; padding:0;">' +
    // '<p>' +
    // element.event_name +
    // '</p>' +
    // '</div>' + // close infowindow-title
    // '<div id="infowindow-bottom" style="display: flex; flex-direction:row; margin:0; padding:0;">' +
    // '<div id="infowindow-eventinfo" style="margin:0; padding:0;">' +
    // '<ul style="list-style:none;, font-size:1.2rem; margin:0; padding:0;">' +
    // '<li>' +
    // 'Organizat de: ' +
    // element.team_name +
    // '</li>' +
    // '<br>' +
    // '<li>' +
    // element.event_location +
    // '</li>' +
    // '<li>' +
    // element.event_time +
    // '</li>' +
    // '</ul>' +
    // '</div>' + //close infowindow-eventinfo
    // '<div id="infowindow-img" style="width:150px; height:160px; margin:0; padding:0;">' +
    // '<img src="' +
    // element.event_img.substring(3) +
    // '" style="width:150px; height:150px; margin:0; padding:0;" />' +
    // '</div>' + //close infowindow-img
    // '</div>' + //close infowindow-bottom
    // '</div>';

    //alert('<img src="' + element.event_img + '" />');
    //todo add infowindow stuff
    const infowindow = new google.maps.InfoWindow({
      content: contentString,
      maxWidth: 500,
    });

    // const markerimg =

    const marker = new google.maps.Marker({
      position: {
        lat: Number(element.event_lat),
        lng: Number(element.event_lng),
      },
      map,
      url: 'pages/eventshowcase.php?id=' + element.eventid,
      // icon: {
      //   url: "custom-marker.svg",
      //   scaledSize: new google.maps.Size(64, 64)
      // }
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

    marker.addListener('click', () => {
      window.location.href = marker.url;
    });
  });
}

initMap();
