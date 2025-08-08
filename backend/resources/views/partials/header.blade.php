<header>
    <nav class="container flex justify-between items-center py-4">
        <a href="/" class="text-xl font-semibold">Stack Verse</a>

        <ul class="flex space-x-4 items-center font-medium">
            <li><a href="/">Home</a></li>
            <li><a href="/politics">Politics</a></li>
            <li><a href="/tech">Tech</a></li>
            <li><a href="/travel">Travel</a></li>
            <li><a href="/sport">Sport</a></li>
        </ul>

        <form action="/search" method="get">
            <fieldset class="flex items-center">
                <input type="text" name="query" placeholder="Search..."
                    class="border border-r-0 px-2 py-1 focus:outline-none">
                <button type="submit" class=" text-black py-1 cursor-pointer h-full border px-3"><svg
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="lucide lucide-search-icon lucide-search">
                        <path d="m21 21-4.34-4.34" />
                        <circle cx="11" cy="11" r="8" />
                    </svg></button>
            </fieldset>
        </form>
    </nav>
</header>
