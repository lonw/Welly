<div id="googleMap" style="width:100%;height:380px;"></div>
<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyCL5CAec3olrJr0k7ZnFYCBUYuTiNShNtw"></script>

<script>
var myCenter=new google.maps.LatLng(43.820506,-79.351305);

function initialize()
{
var mapProp = {
  center:myCenter,
  zoom:12,
  scrollwheel:false,
  mapTypeId:google.maps.MapTypeId.ROADMAP
  };

var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);

var marker=new google.maps.Marker({
  position:myCenter,
  });

marker.setMap(map);

var infowindow = new google.maps.InfoWindow({
  content:"<b>WELLY INTERNATIONAL MEDIA LTD</b> <br> 7270 Woodbine Ave, Suite 203. Markham, ON Canada, L3R 4B9 <br> Phone#: +1 905-604-5622"
  });

infowindow.open(map,marker);
}

google.maps.event.addDomListener(window, 'load', initialize);
</script>
