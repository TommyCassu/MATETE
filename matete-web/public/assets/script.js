// Initialize and add the map
var villes = {
	"Paris":{"lat": 48.852969,"lon": 2.349903},
	"Brest":{"lat": 48.383,"lon": -4.500},
	"Quimper":{"lat": 48.000,"lon": -4.100},
	"Bayonne":{"lat": 43.500,"lon": -1.467},
    "Lycee":{"lat": 42.69276266087135,"lon": 2.909845647650987 },

};

function initMap() {
    // The location of Uluru
    const lycée = { lat: 42.69276266087135, lng: 2.909845647650987 };
    // The map, centered at Uluru
    const map = new google.maps.Map(document.getElementById("map"), {
      zoom: 15,
      center: lycée,
    });
    // The marker, positioned at Uluru
    // const marker = new google.maps.Marker({
    //   position: lycée,
    //   map: map,
    // });
    for(ville in villes){
		var marker = new google.maps.Marker({
			// A chaque boucle, la latitude et la longitude sont lues dans le tableau
			position: {lat: villes[ville].lat, lng: villes[ville].lon},
			// On en profite pour ajouter une info-bulle contenant le nom de la ville
			title: ville,
			map: map
		});	
	}
    
  }

// Nous parcourons la liste des villes
    
