@include('new-header')
<main class="mt-2 px-4 womsm:px-6 wommd:px-8">
    <div class="text-center mt-4 text-green text-lg womsm:text-xl wommd:text-2xl font-bold">
        Discover the World on Two Wheels with WorldonMoto.com!
    </div>
    <div class="mt-5 text-[#0F172A] font-normal text-sm womsm:text-base wommd:text-lg">
        As riders, we know there's no better way to experience the world than from the seat of a motorcycle. The freedom, the thrill of the open road, and the connection to every twist, turn, and breathtaking view—nothing else compares.
    </div>
    <div class="mt-5 text-[#0F172A] font-normal text-sm womsm:text-base wommd:text-lg">
        But let's be honest: finding reliable, trustworthy motorcycle tour operators to help you explore new destinations can feel like an uphill climb. Searching for genuine tours takes time and effort, and sometimes, you're left wondering if the adventure will live up to your expectations.
    </div>
    <div class="mt-5 text-[#0F172A] font-normal text-sm womsm:text-base wommd:text-lg">
        That's why we created <strong>WorldonMoto.com</strong>.
    </div>
    <div class="grid grid-cols-1 wommd:grid-cols-2 gap-8 mt-5">
        <div>
            <img class="w-full max-h-[600px]" src="{{ asset('images/about1.png') }}" alt="" srcset="">
            <div class="w-5/6">
                <div class="text-[#0F172A] text-base womsm:text-lg wommd:text-xl font-semibold mt-5">
                    Your Adventure Starts Here
                </div>
                <div class="text-[#0F172A] text-sm womsm:text-base wommd:text-lg font-normal mt-5">
                    WorldonMoto.com is a platform designed by riders, for riders. It's your ultimate resource to discover and book unforgettable motorcycle adventures with <b>genuine tour operators from around the world.</b>
                </div>
                <div class="text-[#0F172A] text-sm womsm:text-base wommd:text-lg font-normal mt-5">
                    Whether you're dreaming of cruising along the coastal roads of Vietnam, exploring the rugged trails of Patagonia, or riding through the Alps, we've made it easy for you to connect with tour operators who share your passion for adventure and authenticity.
                </div>
            </div>
        </div>
        <div>
            <img class="w-full max-h-[600px]" src="{{ asset('images/about2.png') }}" alt="" srcset="">
            <div class="w-5/6">
                <div class="text-[#0F172A] text-base womsm:text-lg wommd:text-xl font-semibold mt-5">
                    Why WorldonMoto.com?
                </div>
                <div class="text-[#0F172A] text-sm womsm:text-base wommd:text-lg font-bold mt-5">
                    Hassle-Free Exploration
                </div>
                <div class="text-[#0F172A] text-sm womsm:text-base wommd:text-lg font-normal mt-5">
                    Say goodbye to the endless searches and the guesswork. With WorldonMoto.com, you'll find a carefully curated list of trustworthy motorcycle tour operators, so you can focus on planning your next adventure, not worrying about the details.
                </div>
                <div class="text-[#0F172A] text-sm womsm:text-base wommd:text-lg font-bold mt-5">
                    Adventures Tailored for Riders
                </div>
                <div class="text-[#0F172A] text-sm womsm:text-base wommd:text-lg font-normal mt-5">
                    From leisurely scenic routes to adrenaline-pumping off-road trails, our platform connects you with tours that match your riding style, skill level, and thirst for discovery.
                </div>
                <div class="text-[#0F172A] text-sm womsm:text-base wommd:text-lg font-bold mt-5">
                    A Global Community of Riders
                </div>
                <div class="text-[#0F172A] text-sm womsm:text-base wommd:text-lg font-normal mt-5">
                    When you join WorldonMoto.com, you’re not just booking a tour—you’re becoming part of a global community of passionate riders who understand the magic of exploring the world on two wheels.
                </div>
            </div>
        </div>
    </div>
</main>
<div class="bg-[#556B2F26] p-5 my-8">
    <div class="text-center font-bold text-[#0F172A] text-base womsm:text-lg wommd:text-xl">How It Works</div>
    <div class="flex justify-center my-5">
        <ol class="w-full womsm:w-1/2 wommd:w-1/3 grid gap-4 text-[#0F172A]">
            <li>
                <strong>1. Search:</strong> Browse motorcycle tours by destination, style, or dates.
            </li>
            <li>
                <strong>2. Discover:</strong> Find genuine tour operators with proven track records and glowing reviews from fellow riders.
            </li>
            <li>
                <strong>3. Book:</strong> Reserve your spot and start counting down the days to your next great adventure.
            </li>
        </ol>
    </div>
</div>
<div class="bg-cover bg-center h-[553px] flex flex-col justify-center items-center text-white mb-[-20px]"
    style="background-image: url('{{ asset('images/about3.png') }}');">
    <div class="text-center max-w-2xl h-full flex items-center">
        <!-- Main Heading -->
        <div class="p-5 text-[#0F172A] bg-[#E2E8F0D4] rounded-xl"
            style="border: 1px solid gray;">
            <h1 class="text-xl md:text-2xl font-bold mb-4">Share the Journey</h1>
            <!-- Subtext -->
            <p class="text-lg md:text-xl mb-6 leading-relaxed">
                Motorcycling is as much about community as it is about the ride. So, when you find your dream adventure on WorldonMoto.com, don’t keep it to yourself—share it with your friends and fellow riders! The more, the merrier on the road to unforgettable experiences.
            </p>
        </div>
    </div>
</div>
@include('footer')