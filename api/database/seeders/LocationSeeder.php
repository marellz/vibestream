<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        $countries = [
            "Kenya" => [
                "Baragoi",
                "Bondo",
                "Bungoma",
                "Busia",
                "Butere",
                "Dadaab",
                "Diani Beach",
                "Eldoret",
                "Emali",
                "Embu",
                "Garissa",
                "Gede",
                "Gem",
                "Hola",
                "Homa Bay",
                "Isiolo",
                "Kitui",
                "Kibwezi",
                "Kajiado",
                "Kakamega",
                "Kakuma",
                "Kapenguria",
                "Kericho",
                "Keroka",
                "Kiambu",
                "Kilifi",
                "Kisii",
                "Kisumu",
                "Kitale",
                "Lamu",
                "Langata",
                "Litein",
                "Lodwar",
                "Lokichoggio",
                "Londiani",
                "Loyangalani",
                "Machakos",
                "Makindu",
                "Malindi",
                "Mandera",
                "Maralal",
                "Marsabit",
                "Meru",
                "Mombasa",
                "Moyale",
                "Mtwapa",
                "Mumias",
                "Muranga",
                "Mutomo",
                "Nairobi",
                "Naivasha",
                "Nakuru",
                "Namanga",
                "Nanyuki",
                "Naro Moru",
                "Narok",
                "Nyahururu",
                "Nyeri",
                "Ruiru",
                "Siaya",
                "Shimoni",
                "Takaungu",
                "Thika",
                "Ugunja",
                "Vihiga",
                "Voi",
                "Wajir",
                "Watamu",
                "Webuye",
                "Wote",
                "Wundanyi",
                "Other"
            ],
            "Uganda" => [
                "Kampala",
                "Nansana",
                "Kira",
                "Ssabagabo",
                "Mbarara",
                "Mukono",
                "Njeru",
                "Gulu",
                "Lugazi",
                "Masaka",
                "Kasese",
                "Hoima",
                "Lira",
                "Mityana",
                "Mubende",
                "Masindi",
                "Mbale",
                "Jinja",
                "Entebbe",
                "Kitgum",
                "Other"
                
            ],
            "Tanzania" => [
                "Dar es Salaam",
                "Mwanza",
                "Arusha",
                "Mbeya",
                "Morogoro",
                "Tanga",
                "Kahama",
                "Tabora",
                "Zanzibar City",
                "Kigoma",
                "Dodoma",
                "Sumbawanga",
                "Kasulu",
                "Songea",
                "Moshi",
                "Musoma",
                "Shinyanga",
                "Iringa",
                "Singida",
                "Njombe",
                "Bukoba",
                "Kibaha",
                "Mtwara",
                "Mpanda",
                "Tunduma",
                "Makambako",
                "Babati",
                "Handeni",
                "Lindi",
                "Korogwe",
                "Mafinga",
                "Nansio",
                "Other"
            ]
        ];


        foreach ($countries as $country => $cities) {
            foreach ($cities as $city) {

                Location::insert([
                    'country' => $country,
                    'city'  => $city,
                ]);
            }
        }
    }
}
