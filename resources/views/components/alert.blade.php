@props(['type' => 'info'])

@php
    $classes = match ($type) {
        'success' => 'bg-green-100 border-green-500 text-green-700',
        'error'   => 'bg-red-100 border-red-500 text-red-700',
        'warning' => 'bg-yellow-100 border-yellow-500 text-yellow-700',
        default   => 'bg-blue-100 border-blue-500 text-blue-700',
    };
@endphp

<div x-data="{ show: true }" x-show="show" x-transition:leave="transition ease-in duration-300"
     x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
     {{ $attributes->merge(['class' => 'relative border-l-4 p-4 rounded-md shadow-md ' . $classes, 'role' => 'alert']) }}>

    <div class="flex">
        <div>
            {{ $slot }}
        </div>
        <button @click="show = false" class="absolute top-0 right-0 mt-4 mr-4 text-current hover:opacity-75">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
            </svg>
        </button>
    </div>
</div>
