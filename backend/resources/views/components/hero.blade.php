@props(['posts'])

{{-- Hero section with featured posts --}}
<section class="bg-[#F8F9FA]">
    <div class="container mx-auto py-20 grid grid-cols-3 grid-rows-[320px_320px] gap-6">
        @foreach ($posts as $index => $post)
            <a href="#" @class([
                'relative block bg-cover bg-center',
                'col-span-2' => $index === 0,
                'col-start-1 row-start-2' => $index === 1,
                'col-start-2 row-start-2' => $index === 2,
                'col-start-3 row-start-1 row-span-2' => $index === 3,
            ])
                style="background-image: url('{{ asset('storage/' . $post->featured_image) }}')">
                <span class="absolute uppercase top-0 left-0 py-1 px-2 text-xs font-bold text-white bg-blue-400">
                    {{ strtoupper($post->category->name ?? 'Uncategorized') }}
                </span>

                {{-- Text container --}}
                <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black to-transparent text-white p-4">
                    <h2 class="text-lg font-semibold leading-snug">
                        {{ $post->title }}
                    </h2>
                    <p class="text-sm opacity-80">{{ $post->created_at->format('F d, Y') }}</p>
                </div>
            </a>
        @endforeach
    </div>
</section>
