<x-admin-layout>

    <div class="w-full h-screen overflow-x-hidden border-t flex flex-col">
        <main class="w-full flex-grow p-6">
            <h1 class="w-full text-3xl text-black pb-6">Services</h1>

            <div class="w-full mt-12">
                <p class="text-xl pb-3 flex items-center">
                    <i class="fas fa-list mr-3"></i> Services Records
                </p>
                @can('create', App\Models\Service::class)
                    <button class="px-4 py-1 text-white font-light tracking-wider bg-blue-600 rounded mb-2"
                        onclick="location.href='{{ route('admin.service.create') }}';">Add Service</button>
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
                                    Slug</th>
                                <th
                                    class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">
                                    Order</th>
                                <th
                                    class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">
                                    Galleries</th>
                                <th
                                    class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">
                                    Manage</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($services as $service)
                                <tr class="hover:bg-grey-lighter">
                                    <td class="py-4 px-6 border-b border-grey-light">{{ $service->id }}</td>
                                    <td class="py-4 px-6 border-b border-grey-light">{{ $service->title }}</td>
                                    <td class="py-4 px-6 border-b border-grey-light">{{ $service->slug }}</td>
                                    <td class="py-4 px-6 border-b border-grey-light">{{ $service->order }}</td>
                                    <td class="py-4 px-6 border-b border-grey-light">{{ $service->galleries_count }}</td>
                                    <td class="py-4 px-6 border-b border-grey-light">
                                        @can('update', $service)
                                            <button class="px-4 py-1 text-white font-light tracking-wider bg-green-600 rounded" type="button"
                                                onclick="location.href='{{ route('admin.service.edit', $service->id) }}';">Edit</button>
                                        @endcan
                                        @can('delete', $service)
                                            <form method="POST" style="display: inline"
                                                action="{{ route('admin.service.destroy', $service->id) }}"
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
                                    <td colspan="6" class="py-4 px-6 border-b border-grey-light text-center">No services found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                {!! $services->links() !!}
            </div>
        </main>
    </div>
</x-admin-layout>
