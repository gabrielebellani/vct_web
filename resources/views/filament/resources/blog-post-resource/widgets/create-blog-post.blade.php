@php use App\Filament\Resources\BlogPostResource; @endphp
<x-filament-widgets::widget>
    <x-filament::section>
        <div class="flex justify-between items-center">
            <div>
                <h2 class="leading-6 font-semibold">Crea post</h2>
                <p class="text-sm text-gray-400">Aggiungi un nuovo post al blog</p>
            </div>
            <div>
                <x-filament::button
                        icon="heroicon-o-plus"
                        tag="a"
                        :href="BlogPostResource::getUrl('create')"
                >
                    Crea post
                </x-filament::button>
            </div>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
