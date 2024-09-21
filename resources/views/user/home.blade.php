<x-layout>
    <section class="text-gray-600 body-font h-screen flex bg-gray-900 bg-svg-constellation-gray-100 relative">
        <div class="container mx-auto flex px-5 py-12 items-center justify-center flex-col">
            <div class="lg:w-2/3 w-full animate-fade-in-down">
                <h1 class="md:text-6xl text-3xl mb-2 font-bold text-white tracking-tight leading-tight">
                    Aplikasi untuk Mengklasifikasikan Obesitas
                </h1>
                <h1 class="md:text-6xl text-3xl mb-4 font-bold text-white tracking-tight leading-tight">
                    Tentukan Tingkat Obesitas Anda <span class="border-b-4 border-green-400 -mb-20">Sekarang!</span>
                </h1>
                <p class="mt-8 mb-16 md:leading-relaxed leading-normal text-white tracking-tight text-xl">
                    Dengan memasukkan informasi kesehatan Anda, Anda akan mengetahui tingkat obesitas Anda secara cepat
                    dan mudah.
                </p>
                @auth
                    <button id="openContactForm"
                        class="uppercase rounded-md bg-red-500 hover:bg-red-600 font-bold text-white px-8 py-4 mx-auto mr-4 hidden md:inline">
                        Mulai Klasifikasi Sekarang
                    </button>
                @else
                    <a href="{{ route('login') }}"
                        class="uppercase rounded-md bg-red-500 hover:bg-red-600 font-bold text-white px-8 py-4 mx-auto mr-4 hidden md:inline">
                        Mulai Klasifikasi Sekarang
                    </a>
                @endauth
                <a class="uppercase rounded-md bg-green-500  hover:bg-green-600 font-bold text-white px-8 py-4 mx-auto hidden md:inline"
                    href="/about">About Me</a>
            </div>
        </div>
    </section>
    <!-- Input Form -->
    <div id="contactFormModal"
        class="fixed z-10 inset-0 overflow-y-auto hidden opacity-0 scale-95 transition-opacity duration-300 ease-out">
        <div class="flex items-center justify-center min-h-screen">
            <div class="bg-white w-1/2 p-6 rounded shadow-md transform transition-all duration-300 ease-out scale-95">
                <div class="flex justify-end">
                    <button id="closeContactForm" class="text-gray-700 hover:text-red-500">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <div class="border rounded-md p-4 w-full mx-auto max-w-2xl">
                    <h4 class="text-xl lg:text-2xl font-semibold">
                        Masukkan Data Anda
                    </h4>
                    <form id="classificationForm" action="{{ route('user-input.store') }}" method="POST">
                        @csrf
                        <!-- Gender -->
                        <div class="mt-4">
                            <label for="gender" class="block text-sm font-medium text-gray-700">Apa jenis kelamin
                                Anda?</label>
                            <div class="mt-2">
                                <label for="male"
                                    class="flex items-center bg-gray-100 text-gray-700 rounded-md px-3 py-2 my-3 hover:bg-indigo-300 cursor-pointer radio-label">
                                    <input type="radio" id="male" name="gender" value="Male" required>
                                    <span class="pl-3">Laki-laki</span>
                                </label>
                                <label for="female"
                                    class="flex items-center bg-gray-100 text-gray-700 rounded-md px-3 py-2 my-3 hover:bg-indigo-300 cursor-pointer radio-label">
                                    <input type="radio" id="female" name="gender" value="Female" required>
                                    <span class="pl-3">Perempuan</span>
                                </label>
                            </div>
                        </div>

                        <!-- Age -->
                        <div class="mt-4">
                            <label for="age" class="block text-sm font-medium text-gray-700">Berapa usia
                                Anda?</label>
                            <input type="number" id="age" name="age"
                                class="w-full p-2 border rounded-md focus:outline-none focus:border-blue-500" required
                                max="120" oninput="this.value = this.value.slice(0, 3)">
                        </div>

                        <!-- Height -->
                        <div class="mt-4">
                            <label for="height" class="block text-sm font-medium text-gray-700">Berapa tinggi
                                badan Anda (cm)?</label>
                            <input type="number" step="1" id="height" name="height"
                                class="w-full p-2 border rounded-md focus:outline-none focus:border-blue-500" required
                                max="300" oninput="this.value = this.value.slice(0, 3)">
                        </div>

                        <!-- Weight -->
                        <div class="mt-4">
                            <label for="weight" class="block text-sm font-medium text-gray-700">Berapa berat badan
                                Anda (kilogram)?</label>
                            <input type="number" id="weight" name="weight"
                                class="w-full p-2 border rounded-md focus:outline-none focus:border-blue-500" required
                                max="999" oninput="this.value = this.value.slice(0, 3)">
                        </div>

                        <!-- Family History -->
                        <div class="mt-4">
                            <label for="family-history" class="block text-sm font-medium text-gray-700">Apakah ada
                                anggota keluarga Anda yang pernah atau sedang mengalami kelebihan berat
                                badan?</label>
                            <div class="mt-2">
                                <label for="family-history-yes"
                                    class="flex items-center bg-gray-100 text-gray-700 rounded-md px-3 py-2 my-3 hover:bg-indigo-300 cursor-pointer radio-label">
                                    <input type="radio" id="family-history-yes" name="family_history_with_overweight"
                                        value="yes" required>
                                    <span class="pl-3">Ya</span>
                                </label>
                                <label for="family-history-no"
                                    class="flex items-center bg-gray-100 text-gray-700 rounded-md px-3 py-2 my-3 hover:bg-indigo-300 cursor-pointer radio-label">
                                    <input type="radio" id="family-history-no" name="family_history_with_overweight"
                                        value="no" required>
                                    <span class="pl-3">Tidak</span>
                                </label>
                            </div>
                        </div>

                        <!-- Frequent consumption of high caloric food (FAVC) -->
                        <div class="mt-4">
                            <label for="favc" class="block text-sm font-medium text-gray-700">Apakah Anda
                                sering
                                makan makanan tinggi kalori?</label>
                            <div class="mt-2">
                                <label for="favc-yes"
                                    class="flex items-center bg-gray-100 text-gray-700 rounded-md px-3 py-2 my-3 hover:bg-indigo-300 cursor-pointer radio-label">
                                    <input type="radio" id="favc-yes" name="favc" value="yes" required>
                                    <span class="pl-3">Ya</span>
                                </label>
                                <label for="favc-no"
                                    class="flex items-center bg-gray-100 text-gray-700 rounded-md px-3 py-2 my-3 hover:bg-indigo-300 cursor-pointer radio-label">
                                    <input type="radio" id="favc-no" name="favc" value="no" required>
                                    <span class="pl-3">Tidak</span>
                                </label>
                            </div>
                        </div>

                        <!-- Frequency of consumption of vegetables (FCVC) -->
                        <div class="mt-4">
                            <label for="fcvc" class="block text-sm font-medium text-gray-700">Apakah Anda
                                biasanya makan sayuran dalam makanan Anda?</label>
                            <div class="mt-2">
                                <label for="fcvc-never"
                                    class="flex items-center bg-gray-100 text-gray-700 rounded-md px-3 py-2 my-3 hover:bg-indigo-300 cursor-pointer radio-label">
                                    <input type="radio" id="fcvc-never" name="fcvc" value="1" required>
                                    <span class="pl-3">Tidak Pernah</span>
                                </label>
                                <label for="fcvc-sometimes"
                                    class="flex items-center bg-gray-100 text-gray-700 rounded-md px-3 py-2 my-3 hover:bg-indigo-300 cursor-pointer radio-label">
                                    <input type="radio" id="fcvc-sometimes" name="fcvc" value="2"
                                        required>
                                    <span class="pl-3">Kadang-kadang</span>
                                </label>
                                <label for="fcvc-always"
                                    class="flex items-center bg-gray-100 text-gray-700 rounded-md px-3 py-2 my-3 hover:bg-indigo-300 cursor-pointer radio-label">
                                    <input type="radio" id="fcvc-always" name="fcvc" value="3" required>
                                    <span class="pl-3">Selalu</span>
                                </label>
                            </div>
                        </div>

                        <!-- Number of main meals (NCP) -->
                        <div class="mt-4">
                            <label for="ncp" class="block text-sm font-medium text-gray-700">Berapa banyak
                                makanan utama yang Anda konsumsi setiap hari?</label>
                            <div class="mt-2">
                                <label for="ncp-1"
                                    class="flex items-center bg-gray-100 text-gray-700 rounded-md px-3 py-2 my-3 hover:bg-indigo-300 cursor-pointer radio-label">
                                    <input type="radio" id="ncp-1" name="ncp" value="1" required>
                                    <span class="pl-3">Sekali sehari</span>
                                </label>
                                <label for="ncp-2"
                                    class="flex items-center bg-gray-100 text-gray-700 rounded-md px-3 py-2 my-3 hover:bg-indigo-300 cursor-pointer radio-label">
                                    <input type="radio" id="ncp-2" name="ncp" value="2" required>
                                    <span class="pl-3">Dua kali sehari</span>
                                </label>
                                <label for="ncp-3"
                                    class="flex items-center bg-gray-100 text-gray-700 rounded-md px-3 py-2 my-3 hover:bg-indigo-300 cursor-pointer radio-label">
                                    <input type="radio" id="ncp-3" name="ncp" value="3" required>
                                    <span class="pl-3">Tiga kali sehari</span>
                                </label>
                                <label for="ncp-more"
                                    class="flex items-center bg-gray-100 text-gray-700 rounded-md px-3 py-2 my-3 hover:bg-indigo-300 cursor-pointer radio-label">
                                    <input type="radio" id="ncp-more" name="ncp" value="4" required>
                                    <span class="pl-3">Lebih dari tiga kali sehari</span>
                                </label>
                            </div>
                        </div>

                        <!-- Consumption of food between meals (CAEC) -->
                        <div class="mt-4">
                            <label for="caec" class="block text-sm font-medium text-gray-700">Apakah Anda
                                makan makanan antara waktu makan?</label>
                            <div class="mt-2">
                                <label for="caec-no"
                                    class="flex items-center bg-gray-100 text-gray-700 rounded-md px-3 py-2 my-3 hover:bg-indigo-300 cursor-pointer radio-label">
                                    <input type="radio" id="caec-no" name="caec" value="no" required>
                                    <span class="pl-3">Tidak</span>
                                </label>
                                <label for="caec-sometimes"
                                    class="flex items-center bg-gray-100 text-gray-700 rounded-md px-3 py-2 my-3 hover:bg-indigo-300 cursor-pointer radio-label">
                                    <input type="radio" id="caec-sometimes" name="caec" value="Sometimes"
                                        required>
                                    <span class="pl-3">Kadang-kadang</span>
                                </label>
                                <label for="caec-frequently"
                                    class="flex items-center bg-gray-100 text-gray-700 rounded-md px-3 py-2 my-3 hover:bg-indigo-300 cursor-pointer radio-label">
                                    <input type="radio" id="caec-frequently" name="caec" value="Frequently"
                                        required>
                                    <span class="pl-3">Sering</span>
                                </label>
                                <label for="caec-always"
                                    class="flex items-center bg-gray-100 text-gray-700 rounded-md px-3 py-2 my-3 hover:bg-indigo-300 cursor-pointer radio-label">
                                    <input type="radio" id="caec-always" name="caec" value="Always" required>
                                    <span class="pl-3">Selalu</span>
                                </label>
                            </div>
                        </div>

                        <!-- Do you smoke? -->
                        <div class="mt-4">
                            <label for="smoke" class="block text-sm font-medium text-gray-700">Apakah Anda
                                merokok?</label>
                            <div class="mt-2">
                                <label for="smoke-yes"
                                    class="flex items-center bg-gray-100 text-gray-700 rounded-md px-3 py-2 my-3 hover:bg-indigo-300 cursor-pointer radio-label">
                                    <input type="radio" id="smoke-yes" name="smoke" value="yes" required>
                                    <span class="pl-3">Ya</span>
                                </label>
                                <label for="smoke-no"
                                    class="flex items-center bg-gray-100 text-gray-700 rounded-md px-3 py-2 my-3 hover:bg-indigo-300 cursor-pointer radio-label">
                                    <input type="radio" id="smoke-no" name="smoke" value="no" required>
                                    <span class="pl-3">Tidak</span>
                                </label>
                            </div>
                        </div>

                        <!-- Consumption of water daily (CH2O) -->
                        <div class="mt-4">
                            <label for="ch2o" class="block text-sm font-medium text-gray-700">Berapa banyak
                                air yang Anda minum setiap hari (dalam liter)?</label>
                            <div class="mt-2">
                                <label for="ch2o-never"
                                    class="flex items-center bg-gray-100 text-gray-700 rounded-md px-3 py-2 my-3 hover:bg-indigo-300 cursor-pointer radio-label">
                                    <input type="radio" id="ch2o-never" name="ch2o" value="1" required>
                                    <span class="pl-3">Kurang dari satu liter</span>
                                </label>
                                <label for="ch2o-sometimes"
                                    class="flex items-center bg-gray-100 text-gray-700 rounded-md px-3 py-2 my-3 hover:bg-indigo-300 cursor-pointer radio-label">
                                    <input type="radio" id="ch2o-sometimes" name="ch2o" value="2"
                                        required>
                                    <span class="pl-3">Antara 1 dan 2 liter</span>
                                </label>
                                <label for="ch2o-often"
                                    class="flex items-center bg-gray-100 text-gray-700 rounded-md px-3 py-2 my-3 hover:bg-indigo-300 cursor-pointer radio-label">
                                    <input type="radio" id="ch2o-often" name="ch2o" value="3" required>
                                    <span class="pl-3">Lebih dari 2 liter</span>
                                </label>
                            </div>
                        </div>

                        <!-- Calories consumption monitoring (SCC) -->
                        <div class="mt-4">
                            <label class="block text-sm font-medium text-gray-700">Apakah Anda memantau kalori yang
                                Anda konsumsi setiap hari?</label>
                            <div class="mt-2">
                                <label
                                    class="flex item-center bg-gray-100 text-gray-700 rounded-md px-3 py-2 my-3 hover:bg-indigo-300 cursor-pointer radio-label">
                                    <input type="radio" name="scc" value="yes" required>
                                    <span class="pl-2">Ya</span>
                                </label>
                                <label
                                    class="flex bg-gray-100 text-gray-700 rounded-md px-3 py-2 my-3 hover:bg-indigo-300 cursor-pointer">
                                    <input type="radio" name="scc" value="no" required>
                                    <span class="pl-2">Tidak</span>
                                </label>
                            </div>
                        </div>

                        <!-- Physical activity frequency (FAF) -->
                        <div class="mt-4">
                            <label for="faf" class="block text-sm font-medium text-gray-700">Seberapa sering
                                Anda melakukan olahraga fisik dalam seminggu?</label>
                            <div class="mt-2">
                                <label for="faf-never"
                                    class="flex items-center bg-gray-100 text-gray-700 rounded-md px-3 py-2 my-3 hover:bg-indigo-300 cursor-pointer radio-label">
                                    <input type="radio" id="faf-never" name="faf" value="0" required>
                                    <span class="pl-3">Tidak Pernah</span>
                                </label>
                                <label for="faf-sometimes"
                                    class="flex items-center bg-gray-100 text-gray-700 rounded-md px-3 py-2 my-3 hover:bg-indigo-300 cursor-pointer radio-label">
                                    <input type="radio" id="faf-sometimes" name="faf" value="1" required>
                                    <span class="pl-3">1 sampai 2 hari</span>
                                </label>
                                <label for="faf-often"
                                    class="flex items-center bg-gray-100 text-gray-700 rounded-md px-3 py-2 my-3 hover:bg-indigo-300 cursor-pointer radio-label">
                                    <input type="radio" id="faf-often" name="faf" value="2" required>
                                    <span class="pl-3">2 sampai 4 hari</span>
                                </label>
                                <label for="faf-daily"
                                    class="flex items-center bg-gray-100 text-gray-700 rounded-md px-3 py-2 my-3 hover:bg-indigo-300 cursor-pointer radio-label">
                                    <input type="radio" id="faf-daily" name="faf" value="3" required>
                                    <span class="pl-3">4 sampai 5 hari</span>
                                </label>
                            </div>
                        </div>

                        <!-- Time using technology devices (TUE) -->
                        <div class="mt-4">
                            <label for="tue" class="block text-sm font-medium text-gray-700">Berapa jam
                                sehari Anda menggunakan perangkat teknologi (komputer, smartphone, dll)?</label>
                            <div class="mt-2">
                                <label for="tue-1"
                                    class="flex items-center bg-gray-100 text-gray-700 rounded-md px-3 py-2 my-3 hover:bg-indigo-300 cursor-pointer radio-label">
                                    <input type="radio" id="tue-1" name="tue" value="0" required>
                                    <span class="pl-3">0-2 jam sehari</span>
                                </label>
                                <label for="tue-2"
                                    class="flex items-center bg-gray-100 text-gray-700 rounded-md px-3 py-2 my-3 hover:bg-indigo-300 cursor-pointer radio-label">
                                    <input type="radio" id="tue-2" name="tue" value="1" required>
                                    <span class="pl-3">3-5 jam sehari</span>
                                </label>
                                <label for="tue-4"
                                    class="flex items-center bg-gray-100 text-gray-700 rounded-md px-3 py-2 my-3 hover:bg-indigo-300 cursor-pointer radio-label">
                                    <input type="radio" id="tue-4" name="tue" value="2" required>
                                    <span class="pl-3">Lebih dari 5 jam</span>
                                </label>
                            </div>
                        </div>

                        <!-- Consumption of alcohol (CALC) -->
                        <div class="mt-4">
                            <label for="calc" class="block text-sm font-medium text-gray-700">Seberapa sering
                                Anda mengonsumsi alkohol?</label>
                            <div class="mt-2">
                                <label for="calc-never"
                                    class="flex items-center bg-gray-100 text-gray-700 rounded-md px-3 py-2 my-3 hover:bg-indigo-300 cursor-pointer radio-label">
                                    <input type="radio" id="calc-never" name="calc" value="no" required>
                                    <span class="pl-3">Tidak Pernah</span>
                                </label>
                                <label for="calc-sometimes"
                                    class="flex items-center bg-gray-100 text-gray-700 rounded-md px-3 py-2 my-3 hover:bg-indigo-300 cursor-pointer radio-label">
                                    <input type="radio" id="calc-sometimes" name="calc" value="Sometimes"
                                        required>
                                    <span class="pl-3">Kadang-kadang</span>
                                </label>
                                <label for="calc-frequently"
                                    class="flex items-center bg-gray-100 text-gray-700 rounded-md px-3 py-2 my-3 hover:bg-indigo-300 cursor-pointer radio-label">
                                    <input type="radio" id="calc-frequently" name="calc" value="Frequently"
                                        required>
                                    <span class="pl-3">Sering</span>
                                </label>
                                <label for="calc-always"
                                    class="flex items-center bg-gray-100 text-gray-700 rounded-md px-3 py-2 my-3 hover:bg-indigo-300 cursor-pointer radio-label">
                                    <input type="radio" id="calc-always" name="calc" value="Always" required>
                                    <span class="pl-3">Selalu</span>
                                </label>
                            </div>
                        </div>

                        <!-- Transportation used (MTRANS) -->
                        <div class="mt-4">
                            <label for="mtrans" class="block text-sm font-medium text-gray-700">Transportasi apa
                                yang biasanya Anda gunakan untuk bepergian?</label>
                            <div class="mt-2">
                                <label for="mtrans-automobile"
                                    class="flex items-center bg-gray-100 text-gray-700 rounded-md px-3 py-2 my-3 hover:bg-indigo-300 cursor-pointer radio-label">
                                    <input type="radio" id="mtrans-automobile" name="mtrans" value="Automobile"
                                        required>
                                    <span class="pl-3">Mobil</span>
                                </label>
                                <label for="mtrans-motorbike"
                                    class="flex items-center bg-gray-100 text-gray-700 rounded-md px-3 py-2 my-3 hover:bg-indigo-300 cursor-pointer radio-label">
                                    <input type="radio" id="mtrans-motorbike" name="mtrans" value="Motorbike"
                                        required>
                                    <span class="pl-3">Sepeda Motor</span>
                                </label>
                                <label for="mtrans-bike"
                                    class="flex items-center bg-gray-100 text-gray-700 rounded-md px-3 py-2 my-3 hover:bg-indigo-300 cursor-pointer radio-label">
                                    <input type="radio" id="mtrans-bike" name="mtrans" value="Bike" required>
                                    <span class="pl-3">Sepeda</span>
                                </label>
                                <label for="mtrans-bus"
                                    class="flex items-center bg-gray-100 text-gray-700 rounded-md px-3 py-2 my-3 hover:bg-indigo-300 cursor-pointer radio-label">
                                    <input type="radio" id="mtrans-bus" name="mtrans"
                                        value="Public Transportation" required>
                                    <span class="pl-3">Transportasi Publik</span>
                                </label>
                                <label for="mtrans-walking"
                                    class="flex items-center bg-gray-100 text-gray-700 rounded-md px-3 py-2 my-3 hover:bg-indigo-300 cursor-pointer radio-label">
                                    <input type="radio" id="mtrans-walking" name="mtrans" value="Walking"
                                        required>
                                    <span class="pl-3">Berjalan kaki</span>
                                </label>
                            </div>
                        </div>
                        <button type="submit"
                            class="mt-4 w-full px-4 py-2 bg-indigo-600 text-white font-semibold rounded-md hover:bg-indigo-700">Klasifikasikan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Result Display -->
    <div id="resultModal"
        class="fixed z-10 inset-0 overflow-y-auto hidden opacity-0 scale-95 transition-opacity duration-300 ease-out">
        <div class="flex items-center justify-center min-h-screen">
            <div class="bg-white w-1/2 p-6 rounded shadow-md transform transition-all duration-300 ease-out scale-95">
                <div class="flex justify-end">
                    <button id="closeResultModal" class="text-gray-700 hover:text-red-500">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <div id="resultContent" class="border rounded-md p-4 w-full mx-auto max-w-2xl">
                    <!-- Results will be dynamically inserted here -->
                </div>
            </div>
        </div>
    </div>
    </section>
    <script>
        // Open the input form modal
        document.getElementById('openContactForm').addEventListener('click', function() {
            const modal = document.getElementById('contactFormModal');
            modal.classList.remove('hidden');
            setTimeout(() => {
                modal.classList.remove('opacity-0', 'scale-95');
                modal.classList.add('opacity-100', 'scale-100');
            }, 10);
        });

        // Close the input form modal
        document.getElementById('closeContactForm').addEventListener('click', function() {
            const modal = document.getElementById('contactFormModal');
            modal.classList.remove('opacity-100', 'scale-100');
            modal.classList.add('opacity-0', 'scale-95');
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 300);
        });

        // Close the result modal
        document.getElementById('closeResultModal').addEventListener('click', function() {
            const modal = document.getElementById('resultModal');
            modal.classList.remove('opacity-100', 'scale-100');
            modal.classList.add('opacity-0', 'scale-95');
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 300);
        });

        // Handle form submission
        document.getElementById('classificationForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent default form submission

            const formData = new FormData(this);

            const modal = document.getElementById('contactFormModal');
            modal.classList.remove('opacity-100', 'scale-100');
            modal.classList.add('opacity-0', 'scale-95');
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 300);

            fetch('{{ route('user-input.store') }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                    },
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    // Display the results in the results modal
                    const resultContent = document.getElementById('resultContent');
                    resultContent.innerHTML = `
        <h4 class="text-xl lg:text-2xl font-semibold mb-4">Hasil Klasifikasi</h4>
        <p><strong>Metode:</strong> ${data.method}</p>
        <p><strong>Hasil:</strong> ${data.prediction}</p>
        <p><strong>Akurasi ${data.method} sebelum tuning:</strong> ${data.accuracy_before}</p>
        <p><strong>Akurasi ${data.method} setelah tuning:</strong> ${data.accuracy_after}</p>
        <p><strong>BMI:</strong> ${data.bmi}</p>
    `;

                    const resultModal = document.getElementById('resultModal');
                    resultModal.classList.remove('hidden');
                    setTimeout(() => {
                        resultModal.classList.remove('opacity-0', 'scale-95');
                        resultModal.classList.add('opacity-100', 'scale-100');
                    }, 10);

                    document.getElementById('classificationForm').reset();
                })
                .catch(error => {
                    console.error('Error:', error);
                });

        });
    </script>
</x-layout>
