@extends('app')

@section('content')
    <div class="grid grid-cols-4 gap-4 w-full">
        @foreach ($data as $item)
            <div
                class="w-full max-w-md bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 px-5">
                <div class="flex flex-col items-center py-10">
                    <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white">{{ $item->name }}</h5>
                    <h5 class="text-lg text-gray-500 dark:text-gray-400">{{ $item->username }} @if (isset($item->role))
                            - {{ $item->role }}
                        @endif
                    </h5>
                    <div class="flex my-4 space-x-3 md:my-6">
                        <span class="text-md text-gray-700 dark:text-gray-500">{{ $item->website }}</span>
                        <span class="text-md text-gray-700 dark:text-gray-500">{{ $item->email }}</span>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer toggle-additional-info"
                        data-toggle="additional-info-{{ $loop->index }}">
                        <input type="checkbox" value="" class="sr-only peer">
                        <div
                            class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                        </div>
                        <span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">Additional Info</span>
                    </label>
                    <div class="hidden" id="additional-info-{{ $loop->index }}">
                        <div class="w-full grid grid-cols-2 gap-0 mt-2">
                            <div
                                class="w-full border  text-gray-700 dark:text-gray-500 border-gray-500 rounded-t col-span-2">
                                Address
                            </div>
                            <div
                                class="w-full text-gray-700 dark:text-gray-500 flex flex-col border border-gray-500 rounded-es-md">
                                <span>Zip Code</span>
                                <span>City</span>
                                <span>Street</span>
                                <span>Siut</span>
                            </div>
                            <div
                                class="w-full text-gray-700 dark:text-gray-500 flex flex-col border border-gray-500 rounded-ee-md">
                                <span>{{ $item->address->zipcode }}</span>
                                <span>{{ $item->address->city }}</span>
                                <span>{{ $item->address->street }}</span>
                                <span>{{ $item->address->suite }}</span>
                            </div>
                        </div>
                        <div class="w-full grid grid-cols-2 gap-0 mt-2">
                            <div
                                class="w-full border  text-gray-700 dark:text-gray-500 border-gray-500 rounded-t col-span-2">
                                Company
                            </div>
                            <div
                                class="w-full text-gray-700 dark:text-gray-500 flex flex-col border border-gray-500 rounded-es-md">
                                <span>Name</span>
                                <span>Catch Phrase</span>
                                <span>Business Suite</span>
                            </div>
                            <div
                                class="w-full text-gray-700 dark:text-gray-500 flex flex-col border border-gray-500 rounded-ee-md">
                                <span>{{ $item->company->name }}</span>
                                <span>{{ $item->company->catchPhrase }}</span>
                                <span>{{ $item->company->bs }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
