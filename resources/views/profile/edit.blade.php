<x-app-layout>
    <div class="max-w-2xl mx-auto mt-10 bg-white rounded-xl p-8 shadow">

        <div class="flex items-center gap-3 mb-6 border-b pb-4">
            <div class="w-6 h-6 border-2 border-gray-700 rounded-full"></div>
            <h2 class="text-lg font-semibold">Edit Profile</h2>
        </div>

        @if(session('success'))
            <div class="mb-4 p-3 rounded bg-green-100 text-green-800 border border-green-200">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="mb-4 p-3 rounded bg-red-100 text-red-800 border border-red-200">
                <ul class="list-disc ml-5">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="flex gap-6 mb-6">
                <!-- FOTO -->
                <div>
                    <div
                        class="w-20 h-20 rounded-full bg-blue-200 overflow-hidden cursor-pointer"
                        onclick="document.getElementById('photo-upload').click()"
                    >
                        @if($user->profile_photo)
                            <img
                                src="{{ asset('storage/' . $user->profile_photo) }}"
                                class="w-full h-full object-cover"
                                id="preview-photo"
                            >
                        @else
                            <img id="preview-photo" class="hidden">
                        @endif
                    </div>

                    <input
                        type="file"
                        id="photo-upload"
                        name="profile_photo"
                        accept="image/*"
                        class="hidden"
                        onchange="previewImage(event)"
                    >
                </div>

                <!-- FORM -->
                <div class="flex-1 space-y-4">
                    <div>
                        <label class="block text-sm font-medium mb-1">Nama Lengkap *</label>
                        <input
                            type="text"
                            name="name"
                            value="{{ old('name', $user->name) }}"
                            required
                            class="w-full border rounded px-3 py-2 focus:ring focus:ring-blue-300"
                        >
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Email *</label>
                        <input
                            type="email"
                            name="email"
                            value="{{ old('email', $user->email) }}"
                            required
                            class="w-full border rounded px-3 py-2 focus:ring focus:ring-blue-300"
                        >
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Nomor Telepon *</label>
                        <input
                            type="text"
                            name="phone"
                            value="{{ old('phone', $user->phone) }}"
                            required
                            class="w-full border rounded px-3 py-2 focus:ring focus:ring-blue-300"
                        >
                    </div>
                </div>
            </div>

            <!-- ALAMAT -->
            <div class="mb-6">
                <h3 class="font-semibold mb-3">Alamat Domisili</h3>

                <div class="grid grid-cols-2 gap-4 mb-4">
                    <input
                        type="text"
                        name="negara"
                        placeholder="Negara"
                        value="{{ old('negara', $user->negara) }}"
                        class="border rounded px-3 py-2"
                    >
                    <input
                        type="text"
                        name="kota"
                        placeholder="Kota"
                        value="{{ old('kota', $user->kota) }}"
                        class="border rounded px-3 py-2"
                    >
                </div>

                <input
                    type="text"
                    name="alamat"
                    placeholder="Alamat lengkap"
                    value="{{ old('alamat', $user->alamat) }}"
                    class="w-full border rounded px-3 py-2"
                >
            </div>

            <!-- BUTTON -->
            <div class="flex justify-between">
                <a
                    href="{{ route('profile.index') }}"
                    class="px-6 py-2 rounded bg-gray-300 text-gray-800"
                >
                    ← Kembali
                </a>

                <button
                    type="submit"
                    class="px-6 py-2 rounded bg-blue-900 text-white"
                >
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>

    <script>
        function previewImage(event) {
            const preview = document.getElementById('preview-photo');
            const file = event.target.files[0];

            if (file) {
                const reader = new FileReader();
                reader.onload = e => {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            }
        }
    </script>
</x-app-layout>
