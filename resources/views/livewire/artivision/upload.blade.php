<div class="grid grid-cols-6 p-6 text-gray-900 bg-white rounded-lg shadow-lg dark:text-white dark:bg-gray-800 offset-3">
    <div class="col-span-4 col-start-2">
        <h2 class="mb-4 text-xl font-bold">Image Info</h2>
        <form wire:submit.prevent="submit">
            
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Image
                    name</label>
                <input type="text" name="name" id="name" wire:model="name"
                    class="block mt-1 w-full text-gray-800 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                    placeholder="Enter image name">
                @error('name')
                    <span class="mt-2 font-bold text-red-600">{{ $message }}</span>
                @enderror
            </div>
            

            <div class="mb-4">
                <label for="positivePrompt" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Positive
                    Prompt</label>
                <input type="text" name="positivePrompt" id="positivePrompt" wire:model="positivePrompt"
                    class="block mt-1 w-full text-gray-800 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                    placeholder="Enter positive prompt">
                @error('positivePrompt')
                    <span class="mt-2 font-bold text-red-600">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="mb-4">
                <label for="negativePrompt" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Negative
                    Prompt</label>
                <input type="text" name="negativePrompt" id="negativePrompt" wire:model="negativePrompt"
                    class="block mt-1 w-full text-gray-800 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                    placeholder="Enter negative prompt">
                @error('negativePrompt')
                    <span class="mt-2 font-bold text-red-600">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="seed" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Seed</label>
                <input type="number" name="seed" id="seed" wire:model="seed"
                    class="block mt-1 w-full text-gray-800 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                    placeholder="Enter seed">
                @error('seed')
                    <span class="mt-2 font-bold text-red-600">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label for="style" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Style</label>
                <select name="style" id="style" wire:model="style"
                    class="block mt-1 w-full text-gray-700 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <option value="realistic" selected>Realistic</option>
                    <option value="cartoon">Cartoon</option>
                    <option value="painting">Painting </option>
                </select>
                @error('style')
                    <span class="mt-2 font-bold text-red-600">{{ $message }}</span>
                @enderror

            

            <!-- toggle public or private -->
            <div class="flex mb-4 mt-4">
                <label for="public" class="block font-medium text-gray-700 dark:text-gray-300">Public</label>
                <input type="checkbox" name="public" id="public" wire:model="public"
                    class="block mt-1 ml-2 text-gray-800 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                @error('public')
                    <span class="mt-2 font-bold text-red-600">{{ $message }}</span>
                @enderror
            </div>
            <h1 class="mb-4 text-2xl font-bold">Image Upload</h1>
            @if ($image)
                <img class="object-cover mb-4 w-full h-64 rounded-lg" src="{{ $image->temporaryUrl() }}"
                    alt="Uploaded Image">
            @endif
            <div class="mb-3">
                <input type="file" id="upload{{ $id }}" wire:model="image"
                    class="block py-2 px-3 w-full placeholder-gray-500 text-gray-900 rounded-lg sm:text-sm focus:border-indigo-500 focus:ring-indigo-500 focus:outline-none form-control">
                @error('image')
                    <span class="mt-2 font-bold text-red-600">{{ $message }}</span>
                @enderror
            </div>
            @if ($image)
                <button wire:click="resetImage" class="btn btn-secondary">Reset</button>
            @endif
            <div class="flex justify-end">
                <button type="submit"
                    class="py-2 px-4 font-bold text-white bg-blue-500 rounded hover:bg-blue-700 focus:outline-none focus:shadow-outline">
                    Submit
                </button>
            </div>
        </form>

    </div>

</div>
