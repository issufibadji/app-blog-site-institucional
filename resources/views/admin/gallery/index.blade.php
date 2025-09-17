<x-admin-layout>

    <div class="w-full h-screen overflow-x-hidden border-t flex flex-col">
        <main class="w-full flex-grow p-6">
            <h1 class="w-full text-3xl text-black pb-6">Gallery</h1>

            <div class="w-full mt-12">
                <p class="text-xl pb-3 flex items-center">
                    <i class="fas fa-list mr-3"></i> Gallery Records
                </p>
                @can('create', App\Models\Gallery::class)
                    <button class="px-4 py-1 text-white font-light tracking-wider bg-blue-600 rounded mb-2"
                        onclick="location.href='{{ route('admin.gallery.create') }}';">Add Image</button>
                @endcan
                <div class="bg-white overflow-auto">
                    <table class="text-left w-full border-collapse">
                        <thead>
                            <tr>
                                <th
                                    class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">
                                    ID</th>
                                <th
                                    class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">
                                    Title</th>
                                <th
                                    class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">
                                    Service</th>
                                <th
                                    class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">
                                    Image</th>
                                <th
                                    class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">
                                    Manage</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($galleries as $gallery)
                                <tr class="hover:bg-grey-lighter">
                                    <td class="py-4 px-6 border-b border-grey-light">{{ $gallery->id }}</td>
                                    <td class="py-4 px-6 border-b border-grey-light">{{ $gallery->title }}</td>
                                    <td class="py-4 px-6 border-b border-grey-light">{{ optional($gallery->service)->title ?? '—' }}</td>
                                    <td class="py-4 px-6 border-b border-grey-light">
                                        <img src="{{ $gallery->image_url }}" alt="{{ $gallery->title }}" class="h-16 rounded">
                                    </td>
                                    <td class="py-4 px-6 border-b border-grey-light">
                                        @can('update', $gallery)
                                            <button class="px-4 py-1 text-white font-light tracking-wider bg-green-600 rounded" type="button"
                                                onclick="location.href='{{ route('admin.gallery.edit', $gallery->id) }}';">Edit</button>
                                        @endcan
                                        @can('delete', $gallery)
                                            <form method="POST" style="display: inline"
                                                action="{{ route('admin.gallery.destroy', $gallery->id) }}"
                                                onsubmit="return confirm('Are you sure?')">
                                                @csrf
                                                @method('DELETE')
                                                <button class="px-4 py-1 text-white font-light tracking-wider bg-red-600 rounded"
                                                    type="submit">Delete</button>
                                            </form>
                                        @endcan
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="py-4 px-6 border-b border-grey-light text-center">No gallery images found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                {!! $galleries->links() !!}
            </div>
        </main>
    </div>
</x-admin-layout>
