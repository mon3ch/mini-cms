<x-layout>
    <x-slot:title>Catégorie introuvable - Mini-CMS</x-slot:title>

    <x-page-header title="Catégorie introuvable" subtitle="Cette catégorie n'existe pas ou a été supprimée." />

    @if ($categories->isNotEmpty())
        <section class="mt-8">
            <h2 class="mb-4 text-2xl font-bold">Catégories disponibles</h2>
            <ul class="flex flex-wrap gap-3">
                @foreach ($categories as $category)
                    <li>
                        <a href="{{ route('posts.category', $category) }}" class="rounded-md border border-indigo-600 px-4 py-2 text-sm font-medium text-indigo-600 hover:bg-indigo-50">
                            {{ $category->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </section>
    @endif
</x-layout>
