<x-dashboard>
    <div class="flex flex-col flex-grow overflow-y-auto">
        <div class="p-8">
            <h1 class="text-2xl font-bold">Klasifikasi Obesitas</h1>
            <p class="mt-2 text-gray-600">Tingkat Akurasi dari 3 Metode :</p>
        </div>

        <div class="grid gap-4 lg:gap-8 md:grid-cols-3 p-8 pt-1">
            <!-- Random Forest -->
            <div class="relative p-6 rounded-2xl bg-white shadow">
                <div class="space-y-2">
                    <div
                        class="flex items-center space-x-2 rtl:space-x-reverse text-sm font-medium text-gray-500">
                        <span>Random Forest</span>
                    </div>
                    <div class="text-3xl">
                        85.3%
                    </div>
                    <div class="flex items-center space-x-1 rtl:space-x-reverse text-sm font-medium text-green-600">
                        <span>0.5% increase</span>
                        {{-- Increase Symbol --}}
                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                            aria-hidden="true">
                            <path fill-rule="evenodd"
                                d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Decision Tree -->
            <div class="relative p-6 rounded-2xl bg-white shadow">
                <div class="space-y-2">
                    <div
                        class="flex items-center space-x-2 rtl:space-x-reverse text-sm font-medium text-gray-500">
                        <span>Decision Tree</span>
                    </div>
                    <div class="text-3xl">
                        82.7%
                    </div>
                    <div class="flex items-center space-x-1 rtl:space-x-reverse text-sm font-medium text-red-600">
                        <span>1.2% decrease</span>
                        {{-- Decrease Symbol --}}
                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                            aria-hidden="true">
                            <path fill-rule="evenodd"
                                d="M12 13a1 1 0 100 2h5a1 1 0 001-1V9a1 1 0 10-2 0v2.586l-4.293-4.293a1 1 0 00-1.414 0L8 9.586 3.707 5.293a1 1 0 00-1.414 1.414l5 5a1 1 0 001.414 0L11 9.414 14.586 13H12z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Support Vector Machine (SVM) -->
            <div class="relative p-6 rounded-2xl bg-white shadow">
                <div class="space-y-2">
                    <div
                        class="flex items-center space-x-2 rtl:space-x-reverse text-sm font-medium text-gray-500">
                        <span>Support Vector Machine</span>
                    </div>
                    <div class="text-3xl">
                        79.2%
                    </div>
                    <div class="flex items-center space-x-1 rtl:space-x-reverse text-sm font-medium text-green-600">
                        <span>0.8% increase</span>
                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                            aria-hidden="true">
                            <path fill-rule="evenodd"
                                d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-dashboard>
