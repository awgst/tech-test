<div>

    <form wire:submit.prevent="process" class="space-y-6">
        <div class="bg-white px-4 py-5 shadow sm:rounded-lg sm:p-6">
            <div class="md:grid md:grid-cols-3 md:gap-6">
                <div class="mt-5 md:col-span-2 md:mt-0">
                    <div class="grid grid-cols-6 gap-6">
                        <div class="col-span-6 sm:col-span-4">
                            <label for="input1" class="block text-sm font-medium text-gray-700">Input 1</label>
                            <input type="text" wire:model="input1" id="input1" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" style="color: black">
                        </div>
                        <div class="col-span-6 sm:col-span-4">
                            <label for="input2" class="block text-sm font-medium text-gray-700">Input 2</label>
                            <input type="text" wire:model="input2" id="input2" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" style="color: black">
                        </div>
                    </div>
                    @if(session()->has('message'))
                        <div class="text-sm text-green-600">
                            {{ session('message') }}
                        </div>   
                    @endif
                </div>
            </div>
        </div>

        <div class="flex justify-end gap-3">
            <button type="submit" class="inline-flex justify-center rounded-md bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Count</button>
        </div>
    </form>
</div>