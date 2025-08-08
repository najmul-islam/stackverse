@props(['post'])

<article>
    <a href="#" class="relative bg-cover bg-center rounded-lg overflow-hidden max-h-[800px]">
        <img src="{{ asset('storage/' . $post->featured_image) }}" alt="">

    </a>
    <div class="py-3">
        <span class="uppercase text-xs font-bold px-2 py-1 text-white bg-blue-400">
            {{ strtoupper($post->category->name ?? 'Uncategorized') }}
        </span>
    </div>
    {{-- Text container --}}
    <div class="bottom-0 left-0 right-0 bg-opacity-60 text-black  py-4">
        <h2 class="text-lg font-semibold leading-snug hover:text-blue-800 transition-colors duration-200">
            <a href="">{{ $post->title }}</a>
        </h2>
        <p class="text-sm opacity-80"><img src="{{ $post->user->avatar }}" alt="">
            {{ $post->created_at->format('F d, Y') }}</p>
    </div>
</article>
