---
{{-- File: resources/views/admin/banners/edit.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        Edit Banner
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 md:p-8 bg-white border-b border-gray-200">
                    <form action="{{ route('admin.banners.update', $banner->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        @include('admin.banners._form', ['banner' => $banner])
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
