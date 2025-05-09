<div class="max-w-none flex-col">
    <label class="text-sm font-medium leading-6 text-gray-950 dark:text-white">Anteprima contenuto</label>
    <div
            style="padding: 20px; border-radius: 10px; border: 1px solid #717171"
            class="my-2"
    >
        {!! $getRecord()->body !!}
    </div>


    <label class="text-sm font-medium leading-6 text-gray-950 dark:text-white">Anteprima copertina</label>
    <img
            src="{{ asset('storage/' . $getRecord()->cover)}}"
            alt="Cover preview"
            class="blog-image-preview my-auto mt-2"
            style="aspect-ratio: 16 / 9;
    object-fit: cover;
    max-width: 90%;
    border-radius: 10px;"
    >
</div>
