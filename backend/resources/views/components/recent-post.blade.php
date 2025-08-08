@props(['posts'])

<section class="py-12 bg-white">
    <h1 class="text-3xl font-bold text-center p-3 mb-3">Recent Posts</h1>
    <div class="container grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($posts as $post)
            <x-post-card :post="$post" />
        @endforeach
    </div>
</section>
