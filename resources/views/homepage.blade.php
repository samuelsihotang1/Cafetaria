<div wire:poll.100ms x-data="{ openCreate: @entangle('openCreate') }" class="bg-white mx-auto max-w-7xl overflow-hidden ">
  <div @keydown.window.escape="openCreate = false" x-show="openCreate" class="relative z-10"
    aria-labelledby="modal-title" x-ref="dialog" aria-modal="true">
    <div x-show="openCreate" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
      x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
      x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
      x-description="Background backdrop, show/hide based on modal state."
      class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
    <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
      <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
        <div x-show="openCreate" x-transition:enter="ease-out duration-300"
          x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
          x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200"
          x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
          x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
          x-description="Modal panel, show/hide based on modal state."
          class="relative transform rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg sm:p-6"
          @click.away="openCreate = false">
          <div class="absolute right-0 top-0 hidden pr-4 pt-4 sm:block">
            <button type="button"
              class="rounded-md bg-white text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
              @click="openCreate = false" wire:loading.attr="disabled">
              <span class="sr-only">Close</span>
              <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
              </svg>
            </button>
          </div>
          <div class="text-center sm:text-left">
            <div class="mx-auto max-w-7xl">
              <div class="mx-auto max-w-2xl">
                <form enctype="multipart/form-data" wire:submit.prevent="createFood">
                  <div class="space-y-12">
                    <div class="pb-12">
                      <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <div class="col-span-full">
                          <label for="foodImage" class="block text-sm font-medium leading-6 text-gray-900">
                            Photo Product
                          </label>
                          <label for="foodImage"
                            class="relative cursor-pointer rounded-md bg-white font-semibold text-indigo-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-600 focus-within:ring-offset-2 hover:text-indigo-500">
                            <input required accept="image/*" wire:model="foodImage" id="foodImage" name="foodImage"
                              type="file" wire:click="deleteImage">
                            @error('foodImage')
                            <strong style="font-size: 15px">{{ $message }}</strong>
                            @enderror
                          </label>
                        </div>
                        <div class="col-span-full">
                          <label for="foodTitle" class="block text-sm font-medium leading-6 text-gray-900">
                            Food Title
                          </label>
                          <div class="mt-2">
                            <input required type="text" wire:model="foodTitle" name="foodTitle" id="foodTitle"
                              autocomplete="foodTitle"
                              class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            @error('foodTitle')
                            <strong style="font-size: 15px">{{ $message }}</strong>
                            @enderror
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
                    <button type="submit"
                      class="inline-flex w-full justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 sm:ml-3 sm:w-auto">Create</button>
                    <button type="button"
                      class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto"
                      @click="openCreate = false">Cancel</button>
                  </div>
                </form>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  {{-- --}}
  <div class="p-5 flex justify-center">
    <button @click="openCreate = true" type="button"
      class="rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
      Create Food
    </button>
  </div>
  <h2 class="sr-only">Products</h2>
  <div class="-mx-px grid grid-cols-2 border-l border-t border-gray-200 sm:mx-0 md:grid-cols-3 lg:grid-cols-3">
    @foreach ($foods as $food)
    <div class="group relative border-b border-r border-gray-200 p-4 sm:p-6">
      <div class="aspect-h-1 aspect-w-1 overflow-hidden rounded-lg bg-gray-200 group-hover:opacity-75">
        <img src="{{ asset('storage/imgFood/' . $food->image) }}" alt="TODO"
          class="h-full w-full object-cover object-center">
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
        <button wire:click="deleteFood({{ $food }})" type="button" class="mt-4 text-sm text-red-400">
          Hapus
        </button>
      </div>
    </div>
    @endforeach
  </div>
</div>