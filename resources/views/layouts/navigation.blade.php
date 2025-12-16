<nav x-data="{ open: false }" class="bg-slate-800 border-b border-slate-700">
    <!-- Primary Navigation Menu -->
    <div class="max-w-screen-xl mx-auto px-8 lg:px-12">
        <div class="flex justify-between h-16">

            <!-- Left -->
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center mr-6">
                    <span class="text-white font-bold text-xl tracking-wide">
                        FinTrack
                    </span>
                </div>

                <!-- Navigation Links -->
                <div class="hidden sm:flex sm:ms-16 space-x-12">
                    <a href="{{ route('dashboard') }}"
                    class="inline-flex items-center px-1 pt-1 text-sm font-medium
                    {{ request()->routeIs('dashboard')
                            ? 'text-white border-b-2 border-white'
                            : 'text-slate-300 hover:text-white' }}">
                        Home
                    </a>

                    <a href="{{ route('pengeluaran.index') }}"
                    class="inline-flex items-center px-1 pt-1 text-sm font-medium
                    {{ request()->routeIs('pengeluaran.*')
                            ? 'text-white border-b-2 border-white'
                            : 'text-slate-300 hover:text-white' }}">
                        Pengeluaran
                    </a>

                    <!-- Tabungan -->
                    <span
                        class="inline-flex items-center px-1 pt-1 text-sm font-medium
                        text-slate-400 cursor-not-allowed">
                        Tabungan
                    </span>
                </div>
            </div>


            <!-- Right -->
            <div class="flex items-center ml-auto space-x-4">

                <!-- User Dropdown -->
                <div class="hidden sm:flex sm:items-center">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="flex items-center bg-white px-4 py-2 rounded-lg text-slate-800 font-semibold">
                                <div>{{ Auth::user()->name }}</div>

                                <svg class="ms-2 h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"/>
                                </svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                Profile
                            </x-dropdown-link>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                    Log Out
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>

                <!-- Hamburger -->
                <div class="flex items-center sm:hidden">
                    <button @click="open = ! open"
                            class="text-slate-300 hover:text-white focus:outline-none">
                        ☰
                    </button>
                </div>

            </div>


    <!-- Responsive Menu -->
    <div x-show="open" class="sm:hidden bg-slate-800">
        <div class="pt-2 pb-3 space-y-1">
            <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-white">
                Dashboard
            </a>
            <a href="{{ route('pengeluaran.index') }}" class="block px-4 py-2 text-white">
                Pengeluaran
            </a>
            <a href="" class="block px-4 py-2 text-white">
                Tabungan
            </a>
        </div>
    </div>
</nav>
