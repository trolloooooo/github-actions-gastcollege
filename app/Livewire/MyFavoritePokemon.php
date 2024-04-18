<?php

namespace App\Livewire;

use App\Models\Pokemon;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class MyFavoritePokemon extends Component
{
    use WithPagination;

    public function addPokemon(int $pokemonId): void
    {
        $pokemon = Pokemon::find($pokemonId);
        $user = auth()->user();
        $user->pokemon()->attach($pokemon);

        $this->resetPage();
    }

    public function deletePokemon(int $pokemonId): void
    {
        $pokemon = Pokemon::find($pokemonId);
        $user = auth()->user();
        $user->pokemon()->detach($pokemon);

        $this->resetPage();
    }

    public function render()
    {
        $myPokemons = auth()->user()->pokemon()->get();
        $pokemons = Pokemon::whereNotIn('id', $myPokemons->pluck('id'))->paginate(12);

        return view('livewire.my-favorite-pokemon', [
            'pokemons' => $pokemons,
            'myPokemons' => $myPokemons,
        ]);
    }
}
