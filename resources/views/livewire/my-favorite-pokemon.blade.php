<div>
    <h2 class="text-2xl text-center font-bold my-8">Mijn Pokemons</h2>
    <div class="grid gap-6 lg:grid-cols-4 lg:gap-8">

        @forelse ($myPokemons as $pokemon)
            <div class="bg-white dark:bg-zinc-900 rounded-lg shadow-[0px 4px 34px rgba(0,0,0,0.06)]">
                <img
                    class="object-cover object-top w-full h-40 rounded-t-lg"
                    src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/{{ $pokemon->pokeapi_id }}.png"
                    alt="{{ $pokemon->name }}"
                />
                <div class="p-6 text-center">
                    <h2 class="text-xl font-semibold">{{ $pokemon->name }}</h2>
                    <p class="text-sm mt-3">{{ $pokemon->description }}</p>

                    <button
                        wire:click="deletePokemon({{ $pokemon->id }})"
                        class="mt-4 bg-gray-500 text-white rounded-lg px-4 py-2"
                    >
                        <svg class="w-8 h-8" data-slot="icon" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"></path>
                        </svg>
                    </button>
                </div>
            </div>
        @empty
            <div class="text-center col-span-4">
                Je hebt nog geen Pokemons.
            </div>
        @endforelse
    </div>

    <h2 class="text-2xl text-center font-bold my-8">Alle Pokemons</h2>

    @if ($pokemons->hasPages())
        <div class="mb-8">
            {{ $pokemons->links() }}
        </div>
    @endif

    <div class="grid gap-6 lg:grid-cols-4 lg:gap-8">
        @foreach ($pokemons as $pokemon)
            <div class="bg-white dark:bg-zinc-900 rounded-lg shadow-[0px 4px 34px rgba(0,0,0,0.06)]">
                <img
                    class="object-cover object-top w-full h-40 rounded-t-lg"
                    src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/{{ $pokemon->pokeapi_id }}.png"
                    alt="{{ $pokemon->name }}"
                />
                <div class="p-6 text-center">
                    <h2 class="text-xl font-semibold">{{ $pokemon->name }}</h2>
                    <p class="text-sm mt-3">{{ $pokemon->description }}</p>

                    <button
                        wire:click="addPokemon({{ $pokemon->id }})"
                        class="mt-4 bg-red-400 text-white rounded-lg px-4 py-2"
                    >
                        <svg class="w-8 h-8 mx-auto text-white" data-slot="icon" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z"></path>
                        </svg>
                    </button>
                </div>
            </div>
        @endforeach
    </div>

    @if ($pokemons->hasPages())
        <div class="mt-8">
            {{ $pokemons->links() }}
        </div>
    @endif
</div>
