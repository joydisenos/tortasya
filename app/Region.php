<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    public static function regiones()
    {
    	$regiones = [

    		"Tarapacá" =>  [
    			"Iquique",
				"Alto Hospicio",
				"Pozo Almonte",
				"Camiña",
				"Colchane",
				"Huara",
				"Pica",

    		] ,

    		"Antofagasta" => [
    			"Antofagasta",
				"Mejillones",
				"Sierra Gorda",
				"Taltal",
				"Calama",
				"Ollagüe",
				"San Pedro de Atacama",
				"Tocopilla",
				"María Elena",

    		],

    		"Atacama" =>  [
    			"Copiapó",
				"Caldera",
				"Tierra Amarilla",
				"Chañaral",
				"Diego de Almagro",
				"Vallenar",
				"Alto del Carmen",
				"Freirina",
				"Huasco",
    		],

    		"Coquimbo" => [
    			"La Serena",
				"Coquimbo",
				"Andacollo",
				"La Higuera",
				"Paiguano",
				"Vicuña",
				"Illapel",
				"Canela",
				"Los Vilos",
				"Salamanca",
				"Ovalle",
				"Combarbalá",
				"Monte Patria",
				"Punitaqui",
				"Río Hurtado",
    		],

    		"Valparaíso" => [
    			"Valparaíso",
				"Casablanca",
				"Concón",
				"Juan Fernández",
				"Puchuncaví",
				"Quilpué",
				"Quintero",
				"Villa Alemana",
				"Viña del Mar",
				"Isla de Pascua",
				"Los Andes",
				"Calle Larga",
				"Rinconada",
				"San Esteban",
				"La Ligua",
				"Cabildo",
				"Papudo",
				"Petorca",
				"Zapallar",
				"Quillota",
				"Calera",
				"Hijuelas",
				"La Cruz",
				"Limache",
				"Nogales",
				"Olmué",
				"San Antonio",
				"Algarrobo",
				"Cartagena",
				"El Quisco",
				"El Tabo",
				"Santo Domingo",
				"San Felipe",
				"Catemu",
				"Llaillay",
				"Panquehue",
				"Putaendo",
				"Santa María",

    		],

    		"Libertador General Bernardo O'Higgins" => [
    			"Rancagua",
				"Codegua",
				"Coinco",
				"Coltauco",
				"Doñihue",
				"Graneros",
				"Las Cabras",
				"Machalí",
				"Malloa",
				"Mostazal",
				"Olivar",
				"Peumo",
				"Pichidegua",
				"Quinta de Tilcoco",
				"Rengo",
				"Requínoa",
				"San Vicente",
				"Pichilemu",
				"La Estrella",
				"Litueche",
				"Marchihue",
				"Navidad",
				"Paredones",
				"San Fernando",
				"Chépica",
				"Chimbarongo",
				"Lolol",
				"Nancagua",
				"Palmilla",
				"Peralillo",
				"Placilla",
				"Pumanque",
				"Santa Cruz",

    		],

    		"Metropolitana de Santiago" => [
    			"Santiago",
				"Cerrillos",
				"Cerro Navia",
				"Conchalí",
				"El Bosque",
				"Estación Central", 
				"Huechuraba",
				"Independencia",
				"La Cisterna",
				"La Florida",
				"La Pintana",
				"La Granja",
				"La Reina",
				"Las Condes",
				"Lo Barnechea",
				"Lo Espejo",
				"Lo Prado",
				"Macul",
				"Maipú",
				"Ñuñoa",
				"Pedro Aguirre Cerda",
				"Peñalolén",
				"Providencia",
				"Pudahuel",
				"Quilicura",
				"Quinta Normal",
				"Recoleta",
				"Renca",
				"San Joaquín",
				"San Miguel",
				"San Ramón",
				"Vitacura",
				"Puente Alto",
				"Pirque",
				"San José de Maipo",
				"Colina",
				"Lampa",
				"Tiltil",
				"San Bernardo",
				"Buin",
				"Calera de Tango",
				"Paine",
				"Melipilla",
				"Alhué",
				"Curacaví",
				"María Pinto",
				"San Pedro",
				"Talagante",
				"El Monte",
				"Isla de Maipo",
				"Padre Hurtado",
				"Peñaflor",

    		]
    	];

    	return $regiones;
    }
}
