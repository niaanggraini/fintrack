<x-app-layout>
    <div class="max-w-xl mx-auto mt-10 bg-white rounded-xl p-8 shadow">

        <div class="flex items-center gap-3 mb-6 border-b pb-4">
            <div class="w-6 h-6 border-2 border-gray-700 rounded-full"></div>
            <h2 class="text-lg font-semibold">Profile</h2>
        </div>

        <div class="flex flex-col items-center gap-6">
            <div class="w-32 h-32 rounded-full bg-blue-200 overflow-hidden">
                @if($user->profile_photo)
                    <img
                        src="{{ asset('storage/' . $user->profile_photo) }}"
                        class="w-full h-full object-cover"
                    >
                @endif
            </div>

            <div class="text-gray-800 font-medium">
                {{ $user->name }}
            </div>

            <div class="flex flex-col gap-4 w-56">
                <a href="{{ route('profile.edit') }}"
                   class="text-center py-3 rounded-lg bg-gray-300 text-gray-800 hover:opacity-90">
                    Edit Profile
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button
                        type="submit"
                        class="w-full py-3 rounded-lg bg-blue-900 text-white hover:opacity-90">
                        Log Out
                    </button>
                </form>
            </div>
        </div>

    </div>
</x-app-layout>
