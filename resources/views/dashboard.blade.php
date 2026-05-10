<x-layouts::app :title="__('Dashboard')">

    <div class="flex flex-col gap-6">

        {{-- Header --}}
        <div>
            <flux:heading size="xl" class="text-black dark:text-white">
                Dashboard - RT 6 RW 1
            </flux:heading>

            <flux:text class="mt-2 text-zinc-600 dark:text-zinc-400">
                Community Donation Management System
            </flux:text>
        </div>

        {{-- Statistics --}}
        <div class="grid gap-4 md:grid-cols-3">

            {{-- Total Donation --}}
            <flux:card class="space-y-3">

                <flux:text class="text-zinc-600 dark:text-zinc-400">
                    Total Donations
                </flux:text>

                <flux:heading size="xl" class="text-black dark:text-white">

                    Rp {{ number_format(\App\Models\Tarikan::sum('nominal'), 0, ',', '.') }}

                </flux:heading>

                <flux:badge color="green" size="sm">
                    Donations collected
                </flux:badge>

            </flux:card>

            {{-- Total Members --}}
            <flux:card class="space-y-3">

                <flux:text class="text-zinc-600 dark:text-zinc-400">
                    Total Members
                </flux:text>

                <flux:heading size="xl" class="text-black dark:text-white">

                    {{ \App\Models\Member::count() }}

                </flux:heading>

                <flux:badge color="blue" size="sm">
                    Registered members
                </flux:badge>

            </flux:card>

            {{-- Logged User --}}
            <flux:card class="space-y-3">

                <flux:text class="text-zinc-600 dark:text-zinc-400">
                    Logged In As
                </flux:text>

                <flux:heading size="lg" class="text-black dark:text-white">

                    {{ auth()->user()->name }}

                </flux:heading>

                <flux:text class="text-zinc-600 dark:text-zinc-400">

                    {{ auth()->user()->email }}

                </flux:text>

            </flux:card>

        </div>

        {{-- RT Information --}}
        <flux:card class="space-y-4">

            <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">

                <div>

                    <flux:heading size="lg" class="text-black dark:text-white">
                        RT 6 RW 1 Information
                    </flux:heading>

                    <flux:text class="mt-2 leading-relaxed text-zinc-600 dark:text-zinc-400">

                        RT 6 RW 1, Sampang Village, Cilacap Regency is an active community
                        engaged in social activities, donations, and mutual cooperation.

                        This system helps manage member data, donations, and financial reports
                        digitally for better transparency and accessibility.

                    </flux:text>

                </div>

                <flux:badge color="zinc" size="lg">
                    Sampang, Cilacap
                </flux:badge>

            </div>

        </flux:card>

    </div>

</x-layouts::app>
