<div class="bg-white mx-auto max-w-7xl overflow-hidden ">
  <h2 class="sr-only">Products</h2>
  <div class="-mx-px grid grid-cols-2 border-l border-t border-gray-200 sm:mx-0 md:grid-cols-3 lg:grid-cols-3">
    @foreach ($foods as $food)
    <div class="group relative border-b border-r border-gray-200 p-4 sm:p-6">
      <div class="aspect-h-1 aspect-w-1 overflow-hidden rounded-lg bg-gray-200 group-hover:opacity-75">
        <img src="{{ asset('imgFood/' . $food->image) }}" alt="TODO" class="h-full w-full object-cover object-center">
      </div>
      <div class="pb-4 pt-10 text-center">
        <p class="mt-4 text-base font-medium text-gray-900">
          <a href="{{ $food->name_slug }}">
            {{ $food->name }}
          </a>
        </p>
        <div class="mt-3 flex flex-col items-center">
          <p class="mt-1 text-sm text-gray-500">Vote Rasa Makanan</p>
          <div class="flex items-center">
            @for ($i = 1; $i <= 3; $i++) <svg wire:click="reviewTaste({{ $food }}, {{ $i }})"
              class="{{ isset($reviews[$food->id]->taste) && $reviews[$food->id]->taste >= $i ? 'text-yellow-400' : 'text-gray-300 hover:text-gray-300' }} h-5 w-5 flex-shrink-0"
              viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
              <path fill-rule="evenodd"
                d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401z"
                clip-rule="evenodd"></path>
              </svg>
              @endfor
          </div>
        </div>

        <div class="mt-3 flex flex-col items-center">
          <p class="mt-1 text-sm text-gray-500">Vote Porsi Makanan</p>
          <div class="flex items-center">
            @for ($i = 1; $i <= 3; $i++) <svg wire:click="reviewPortion({{ $food }}, {{ $i }})"
              class="{{ isset($reviews[$food->id]->portion) && $reviews[$food->id]->portion >= $i ? 'text-yellow-400' : 'text-gray-300 hover:text-gray-300' }} h-5 w-5 flex-shrink-0"
              viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
              <path fill-rule="evenodd"
                d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401z"
                clip-rule="evenodd"></path>
              </svg>
              @endfor
          </div>
        </div>
      </div>
    </div>
    @endforeach
  </div>
</div>