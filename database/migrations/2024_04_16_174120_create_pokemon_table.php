<?php

use App\Models\Ability;
use App\Models\Pokemon;
use App\Models\Species;
use App\Models\Type;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
//        "species" => array:2 [
//        "name" => "bulbasaur"
//            "url" => "https://pokeapi.co/api/v2/pokemon-species/1/"
//        ]

//"types" => array:2 [
//    0 => array:2 [
//        "slot" => 1
//      "type" => array:2 [
//        "name" => "grass"
//        "url" => "https://pokeapi.co/api/v2/type/12/"
//      ]
//    ]
//    1 => array:2 [
//        "slot" => 2
//      "type" => array:2 [
//        "name" => "poison"
//        "url" => "https://pokeapi.co/api/v2/type/4/"
//      ]
//    ]
//  ]


//        "abilities" => array:2 [
//                0 => array:3 [
//                "ability" => array:2 [
//                "name" => "overgrow"
//                "url" => "https://pokeapi.co/api/v2/ability/65/"
//              ]
//              "is_hidden" => false
//              "slot" => 1
//            ]
//            1 => array:3 [
//                "ability" => array:2 [
//                "name" => "chlorophyll"
//                "url" => "https://pokeapi.co/api/v2/ability/34/"
//              ]
//              "is_hidden" => true
//              "slot" => 3
//            ]
//          ]

        Schema::create('species', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('pokemon', function (Blueprint $table) {
            $table->id();
            $table->integer('pokeapi_id');
            $table->string('name');
            $table->integer('base_experience')->nullable();
            $table->integer('height');
            $table->integer('weight');
            $table->foreignId('species_id')->constrained();
            $table->timestamps();
        });

        // Create types table
        Schema::create('types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        // Create abilities table
        Schema::create('abilities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        // Create pokemon_types table
        Schema::create('pokemon_type', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pokemon_id')->constrained();
            $table->foreignId('type_id')->constrained();
        });

        // Create pokemon_abilities table
        Schema::create('ability_pokemon', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ability_id')->constrained();
            $table->foreignId('pokemon_id')->constrained();
        });

        $result = Http::get('https://pokeapi.co/api/v2/pokemon?limit=100000&offset=0');

        $pokemons = $result->json()['results'];
        shuffle($pokemons);
        $pokemons = array_slice($pokemons, 0, 52);
        foreach ($pokemons as $result) {
            $pokemon = Http::get($result['url'])->json();

            // Create species if it doesn't exist
            $species = $pokemon['species']['name'];
            // Check if species exists
            $speciesModel = Species::firstOrCreate(['name' => $species]);

            /** @var Pokemon $model */
            $model = Pokemon::create([
                'pokeapi_id' => $pokemon['id'],
                'name' => $pokemon['name'],
                'base_experience' => $pokemon['base_experience'],
                'height' => $pokemon['height'],
                'weight' => $pokemon['weight'],
                'species_id' => $speciesModel->id,
            ]);

            foreach($pokemon['types'] as $type) {
                $typeModel = Type::firstOrCreate(['name' => $type['type']['name']]);
                $model->types()->attach($typeModel->id);
            }

            foreach($pokemon['abilities'] as $ability) {
                $abilityModel = Ability::firstOrCreate(['name' => $ability['ability']['name']]);
                $model->abilities()->attach($abilityModel->id);
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pokemon');
    }
};
