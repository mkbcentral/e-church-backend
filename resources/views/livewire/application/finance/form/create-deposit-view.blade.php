<div>
    <x-app-modal headerLabel='CREATION CAUTISATION' idModal="deposit-modal">
        <form class="p-3 md:p-2" wire:submit="save">
            <div class="grid grid-cols-1">
                <!-- Category -->
                @if ($memberDeposit != null)
                    <h1 class="font-semibold text-slate-800">Membre: {{ $memberDeposit->name }}</h1>
                @endif
                <div class="mt-2">
                    <x-input-label for="name" :value="__('Category')" />
                    <select id="countries" wire:model="form.category_deposit_id"
                        class="bg-gray-50 border border-gray-300
                         text-gray-900 text-sm rounded-lg focus:ring-blue-500
                          focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700
                           dark:border-gray-600 dark:placeholder-gray-400
                            dark:text-white dark:focus:ring-blue-500
                             dark:focus:border-blue-500">
                        <option>Choisir...</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('form.category_deposit_id')" class="mt-2" />
                </div>
                <!-- Amount -->
                <div>
                    <x-input-label for="amount" :value="__('Montant')" />
                    <x-text-input wire:model="form.amount" id="amount" class="block w-full mt-1" type="text"
                        name="amount" autofocus autocomplete="amount" />
                    <x-input-error :messages="$errors->get('form.amount')" class="mt-2" />
                </div>
                <!-- Date deposit -->
                <div>
                    <x-input-label for="created_at" :value="__('Montant')" />
                    <x-text-input wire:model="form.created_at" id="created_at" class="block w-full mt-1" type="date"
                        name="created_at" autofocus autocomplete="created_at" />
                    <x-input-error :messages="$errors->get('form.created_at')" class="mt-2" />
                </div>
                <!-- Currency id -->
                <fieldset class="mt-2">
                    <x-input-label for="currency_id" :value="__('Devise')" />
                    <legend class="sr-only">Countries</legend>
                    @foreach ($currencies as $currency)
                        <div class="flex items-center mb-4">
                            <input id="{{ $currency->name }}" type="radio" name="countries"
                                wire:model="form.currency_id" value="{{ $currency->id }}"
                                class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300 dark:focus:ring-blue-600 dark:focus:bg-blue-600 dark:bg-gray-700 dark:border-gray-600"
                                checked>
                            <label for="{{ $currency->name }}"
                                class="text-sm font-medium text-gray-900 ms-2 dark:text-gray-300">
                                {{ $currency->name }}
                            </label>
                        </div>
                    @endforeach
                </fieldset>
            </div>
            <x-primary-button class="ms-3">
                {{ __('Sauvegarder') }}
            </x-primary-button>
        </form>
    </x-app-modal>
</div>
