@include('new-header')
<style>
@media (min-width: 1080px) {
    .limited-margin {
        margin-top: 42px;
    }
}
  </style>
<main class="mt-2 px-4 womsm:px-6 wommd:px-8">
    <div class="text-center mt-4 text-green text-lg womsm:text-xl wommd:text-2xl font-bold">
        Calling All Motorcycle Tour Operators:
    </div>
    <div class="text-center mt-4 text-green text-lg womsm:text-xl wommd:text-2xl font-bold">
        Join the Adventure at WorldonMoto.com!
    </div>
    <div class="mt-5 text-[#0F172A] font-normal text-sm womsm:text-base wommd:text-lg text-center">
        We’re inviting motorcycle tour operators from across the globe to help riders of all ages and backgrounds explore the world on two wheels.
    </div>
    <div class="mt-2 text-[#0F172A] font-normal text-sm womsm:text-base wommd:text-lg text-center">
        Together, let’s inspire and connect adventurers everywhere.
    </div>
    <div class="w-full flex justify-center">
        <div class="bg-cover bg-center h-screen flex flex-col justify-center items-center text-white mt-6 rounded-lg"
        style="background-image: url('{{ asset('images/bg.jpg') }}'); width: 95%;">
            <div class="text-center max-w-2xl h-full">
                <!-- Main Heading -->
                <div class="p-5 limited-margin"
                    style="border: 1px solid gray;background: #4c4c4cb3;border-radius: 10px;box-shadow: gray 0px 0px 30px 10px;">
                    <h1 class="text-base womsm:text-xl wommd:text-2xl font-bold mb-4">Your Passion Meets Our Vision</h1>

                    <!-- Subtext -->
                    <p class="text-sm womsm:text-base wommd:text-lg mb-6 leading-relaxed">
                        We understand that your love for motorcycles and adventure drives everything you do. It’s your expertise, local insights, and the unforgettable experiences you craft that leave a lasting impression on every rider who joins your tours. These memories are cherished for a lifetime—shared over campfires, in conversations, and in the hearts of riders from all walks of life.
                    </p>
                    <p class="text-sm womsm:text-base wommd:text-lg mb-6 leading-relaxed">
                        But here’s the challenge: while the best way to explore the world is on a motorcycle, many aspiring adventurers struggle to find trusted, reliable tour operators online. At the same time, operators like you often find it hard to consistently reach the right audience.
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="w-full text-center mt-10 font-semibold text-lg womsm:text-xl wommd:text-2xl text-black">
        <div>Say Hello to WorldonMoto.com: Your Gateway to </div>
        <div>Adventure-Ready Riders</div>
    </div>
    
    <div class="grid grid-cols-1 wommd:grid-cols-2 gap-8 mt-5 w-full wommd:w-3/4 justify-self-center">
        <div>
            <img class="w-full rounded-xl max-h-[600px]" src="{{ asset('images/operator1.png') }}" alt="" srcset="">
        </div>
        <div>
            <div class="w-5/6">
                <div class="text-[#0F172A] text-base womsm:text-lg wommd:text-xl font-semibold mt-5">
                    All Your Audience in One Place
                </div>
                <div class="text-[#0F172A] text-sm womsm:text-base wommd:text-lg font-normal mt-5">
                    We’re bringing adventure-seeking riders together on one unified platform. At WoM, our mission is to be THE go-to destination for motorcycling enthusiasts to research and book tours worldwide.
                </div>
                <div class="text-[#0F172A] text-sm womsm:text-base wommd:text-lg font-normal mt-5">
                    No distractions. No gimmicks. Just a beautifully designed, efficient platform that connects riders with the experiences they crave. With us, you can reach an audience passionate about exploring the world on two wheels—whether they’re seasoned travelers or first-time adventurers.
                </div>
            </div>
        </div>
    </div>
    <div class="grid grid-cols-1 wommd:grid-cols-2 gap-8 mt-8 w-full wommd:w-3/4 justify-self-center items-center">
        <div>
            <div class="w-5/6">
                <div class="text-[#0F172A] text-base womsm:text-lg wommd:text-xl font-semibold mt-5">
                    Let Riders Come to You
                </div>
                <div class="text-[#0F172A] text-sm womsm:text-base wommd:text-lg font-normal mt-5">
                    Imagine riders finding you—not the other way around. All you need to do is showcase your tour’s unique story, and we’ll help you connect with adventurers ready to embark on their next great ride.
                </div>
                <div class="text-[#0F172A] text-sm womsm:text-base wommd:text-lg font-normal mt-2">
                    Need assistance making your tours shine? We’ve got your back.
                </div>
                <div class="text-[#0F172A] text-base womsm:text-lg wommd:text-xl font-semibold mt-5">
                    Run Full Tours, Every Time
                </div>
                <div class="text-[#0F172A] text-sm womsm:text-base wommd:text-lg font-normal mt-5">
                    Say goodbye to empty slots and endless marketing efforts. With WoM, you can focus on delivering world-class tours while we ensure the seats are filled. Your riders will have the trip of a lifetime, and you’ll have the satisfaction of running unforgettable tours without the worry of “getting the numbers.”
                </div>
            </div>
        </div>
        <div>
            <img class="w-full rounded-xl max-h-[600px]" src="{{ asset('images/operator2.png') }}" alt="" srcset="">
        </div>
    </div>
    <div class="grid grid-cols-1 wommd:grid-cols-2 gap-8 mt-8 w-full wommd:w-3/4 justify-self-center items-center">
        <div>
            <img class="w-full rounded-xl max-h-[600px]" src="{{ asset('images/operator3.png') }}" alt="" srcset="">
        </div>
        <div>
            <div class="w-5/6">
                <div class="text-[#0F172A] text-base womsm:text-lg wommd:text-xl font-semibold mt-5">
                    Tools to Streamline Your Journey
                </div>
                <div class="text-[#0F172A] text-sm womsm:text-base wommd:text-lg font-normal mt-5">
                    WoM’s innovative tools and automated processes are designed to make your life easier. Over time, they’ll help reduce your workload, giving you more time to do what you love—ride.
                </div>
                <div class="text-[#0F172A] text-base womsm:text-lg wommd:text-xl font-semibold mt-5">
                    Lower Your Costs, Amplify Your Impact
                </div>
                <div class="text-[#0F172A] text-sm womsm:text-base wommd:text-lg font-normal mt-2">
                    Tired of advertising on platforms that don’t cater to motorcyclists? With WoM, your tours will be showcased directly to riders actively seeking their next biking adventure.
                </div>
                <div class="text-[#0F172A] text-sm womsm:text-base wommd:text-lg font-normal mt-5">
                    Join us, and you’ll enjoy a steady flow of eager riders without the hassle of constant promotion. Focus on creating incredible tours—we’ll handle the rest.
                </div>
                <div class="text-[#0F172A] text-sm womsm:text-base wommd:text-lg font-normal mt-5">
                    Our technology is crafted to not only support you but also help riders seamlessly discover the perfect tour.
                </div>
            </div>
        </div>
    </div>
    <div class="grid grid-cols-1 w-full wommd:w-3/4 justify-self-center text-black">
        <div class="mt-8 font-semibold text-base womsm:text-lg wommd:text-xl">
            And Finally…
        </div>
        <div class="mt-5 text-sm womsm:text-base wommd:text-lg">
            At WoM, we’re driven by a genuine passion for creating a platform that’s trustworthy, secure, affordable, and effortless for motorcyclists and tour operators alike.
        </div>
        <div class="mt-5 text-sm womsm:text-base wommd:text-lg">
            We’re committed to delivering the best experience for our riders and partners because, like you, we’re riders at heart.
        </div>
        <div class="mt-5 text-sm womsm:text-base wommd:text-lg">
            Ready to ride with us? Let’s talk! Email us at partners@worldonmoto.com and let’s start the adventure together.
        </div>
    </div>
</main>
@include('footer')