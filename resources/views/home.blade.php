<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>RT 6 RW 1 Donation Information</title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- AOS CSS -->
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.4/dist/aos.css" />
</head>

<body class="bg-zinc-100 text-zinc-900">

    <!-- Hero Section -->
    <section class="relative overflow-hidden bg-gradient-to-br from-blue-700 via-indigo-700 to-violet-700">
        <div class="max-w-7xl mx-auto px-6 py-24">

            <div class="grid lg:grid-cols-2 gap-14 items-center">

                <!-- Left -->
                <div data-aos="fade-right">
                    <span class="inline-block px-4 py-2 rounded-full bg-white/10 text-white text-sm mb-6">
                        Community Donation System
                    </span>

                    <h1 class="text-5xl font-bold text-white leading-tight">
                        RT 6 RW 1 Donation Information System
                    </h1>

                    <p class="mt-6 text-lg text-white/80 leading-relaxed">
                        Transparent and real-time donation monitoring platform
                        for residents of RT 6 RW 1, Sampang Village,
                        Cilacap, Central Java.
                    </p>

                    <div class="mt-8 flex flex-wrap gap-4">
                        <a href="#donations" class="px-6 py-3 rounded-xl bg-white text-black font-semibold hover:bg-zinc-200 transition">
                            View Donations
                        </a>
                        @auth
                            <a href="/dashboard" class="px-6 py-3 rounded-xl border border-white/30 text-white font-semibold hover:bg-white/10 transition">
                                Dashboard
                            </a>
                        @else
                            <a href="/login" class="px-6 py-3 rounded-xl border border-white/30 text-white font-semibold hover:bg-white/10 transition">
                                Login Dashboard
                            </a>
                        @endauth

                    </div>
                </div>

                <!-- Right -->
                <div class="flex justify-center" data-aos="zoom-in">
                    <div class="bg-white/10 backdrop-blur-xl border border-white/20 rounded-3xl p-10 w-full max-w-md">

                        <div class="text-center">
                            <div class="text-6xl mb-5">🏡</div>

                            <h2 class="text-3xl font-bold text-white">
                                RT 6 RW 1
                            </h2>

                            <p class="mt-3 text-white/70">
                                Sampang Village<br>
                                Cilacap, Central Java
                            </p>
                        </div>

                        <div class="mt-10 space-y-5">

                            <div class="bg-white/10 rounded-2xl p-5">
                                <p class="text-sm text-white/70">
                                    Total Donation
                                </p>

                                <h3 class="mt-2 text-3xl font-bold text-white">
                                    Rp {{ number_format($totalDonation, 0, ',', '.') }}
                                </h3>
                            </div>

                            <div class="bg-white/10 rounded-2xl p-5">
                                <p class="text-sm text-white/70">
                                    Registered Members
                                </p>

                                <h3 class="mt-2 text-3xl font-bold text-white">
                                    {{ $totalMembers }} Members
                                </h3>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Village Information -->
    <section class="py-20">
        <div class="max-w-7xl mx-auto px-6" data-aos="fade-up">

            <div class="text-center mb-14">
                <h2 class="text-4xl font-bold">
                    Village Information
                </h2>

                <p class="mt-4 text-zinc-600 max-w-2xl mx-auto">
                    RT 6 RW 1 is part of Sampang Village located in Cilacap,
                    Central Java. This donation program supports community
                    social activities and environmental development.
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-6">

                <div class="bg-white rounded-3xl shadow-sm p-8 border border-zinc-200" data-aos="fade-up" data-aos-delay="100">
                    <div class="text-4xl mb-5">🤝</div>

                    <h3 class="text-xl font-semibold mb-3">
                        Community Togetherness
                    </h3>

                    <p class="text-zinc-600">
                        Encouraging mutual cooperation and community participation.
                    </p>
                </div>

                <div class="bg-white rounded-3xl shadow-sm p-8 border border-zinc-200" data-aos="fade-up" data-aos-delay="300">
                    <div class="text-4xl mb-5">📊</div>

                    <h3 class="text-xl font-semibold mb-3">
                        Transparent Reporting
                    </h3>

                    <p class="text-zinc-600">
                        Donation data can be monitored transparently in real time.
                    </p>
                </div>

                <div class="bg-white rounded-3xl shadow-sm p-8 border border-zinc-200" data-aos="fade-up" data-aos-delay="600">
                    <div class="text-4xl mb-5">💡</div>

                    <h3 class="text-xl font-semibold mb-3">
                        Social Programs
                    </h3>

                    <p class="text-zinc-600">
                        Donations are used for local social and environmental activities.
                    </p>
                </div>

            </div>
        </div>
    </section>

    <!-- Donation Table -->
    <section id="donations" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-6" data-aos="fade-up">

            <div class="flex items-center justify-between mb-10">
                <div>
                    <h2 class="text-4xl font-bold">
                        Latest Donations
                    </h2>

                    <p class="mt-3 text-zinc-600">
                        List of residents who contributed donations.
                    </p>
                </div>
            </div>

            <div class="overflow-x-auto rounded-3xl border border-zinc-200">

                <table class="w-full">

                    <thead class="bg-zinc-100">
                        <tr>
                            <th class="px-6 py-4 text-left">#</th>
                            <th class="px-6 py-4 text-left">Member</th>
                            <th class="px-6 py-4 text-left">Amount</th>
                            <th class="px-6 py-4 text-left">Update</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-zinc-200">
                        @foreach ($latestDonations as $item)
                            <tr class="hover:bg-zinc-50">
                                <td class="px-6 py-4">{{ $loop->iteration }}</td>
                                <td class="px-6 py-4 font-medium">{{ ucwords($item->member->nama) }}</td>
                                <td class="px-6 py-4">Rp {{ number_format($item->nominal, 0, ',', '.') }}</td>
                                <td class="px-6 py-4">{{ $item->created_at->format('d M Y') }}</td>
                            </tr>
                        @endforeach

                    </tbody>

                </table>

            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-zinc-900 py-10">
        <div class="max-w-7xl mx-auto px-6 text-center">

            <h3 class="text-xl font-semibold text-white">
                RT 6 RW 1 Donation System
            </h3>

            <p class="mt-3 text-zinc-400">
                Sampang Village, Cilacap, Central Java
            </p>

            <p class="mt-6 text-sm text-zinc-500">
                © 2026 Community Donation Information System
            </p>

        </div>
    </footer>

    <!-- AOS JS -->
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>

    <script>
        AOS.init({
            duration: 1000,
            once: true,
        });
    </script>
</body>

</html>
