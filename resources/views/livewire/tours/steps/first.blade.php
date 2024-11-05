<div>
    <div class="my-10 sm:px-6 lg:px-8">
        <div class="flex items-center">
            <div class="w-1/6">
                Tour Title
            </div>
            <div class="w-5/6">
                <x-input placeholder="Thrilling road trip to Faro, Algarve" wire:model="title" />
            </div>
        </div>
    </div>
    <hr>
    <div class="my-10 sm:px-6 lg:px-8">
        <div class="flex items-center">
            <div class="w-1/6">
                Riding Style
            </div>
            <div class="w-5/6">
                <div class="mb-6">
                    <x-radio id="road_trip" lg label="Road Trip - Adventure on the road; its a road trip"
                        name="riding_style" />
                </div>
                <div class="mb-6">
                    <x-radio id="adventure" lg label="Adventure - Adventure ride on and off road" name="riding_style" />
                </div>
                <div class="mb-3">
                    <x-radio id="enduro" lg label="Enduro - Almost all of the trip is off road"
                        name="riding_style" />
                </div>
                <div class="text-sm text-gray-500">
                    <span>Select at least one option related to the tour</span>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="my-10 sm:px-6 lg:px-8">
        <div class="flex items-center">
            <div class="w-1/6">
                Riding style more info
            </div>
            <div class="w-5/6">
                <x-input placeholder="Mainly off road 90% fire roads 10% harder tracks" wire:model="title" />
                <div class="text-sm text-gray-500 mt-2">
                    <span>Anything else you want to say about the riding style</span>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="my-10 sm:px-6 lg:px-8">
        <div class="flex items-center">
            <div class="w-1/6">
                Rider Capability
            </div>
            <div class="w-5/6">
                <div class="mb-6">
                    <x-checkbox id="beginner" lg
                        label="Beginner - rider will need support/advice from other riders to get through"
                        name="riding_style" />
                </div>
                <div class="mb-6">
                    <x-checkbox id="intermediate" lg
                        label="Intermediate - Capable most of the time, but might need help when things are difficult"
                        name="riding_style" />
                </div>
                <div class="mb-3">
                    <x-checkbox id="expert" lg label="Expert - Can help other riders and always in control"
                        name="riding_style" />
                </div>
                <div class="text-sm text-gray-500">
                    <span>You can select multiple options. If you the tour for riders with any riding experience, select
                        all the options</span>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="my-10 sm:px-6 lg:px-8">
        <div class="flex items-center">
            <div class="w-1/6">
                Tour Duration
            </div>
            <div class="w-3/6">
                <div class="w-2/6 flex items-center">
                    <div><x-input /></div>
                    <div class="ml-2"><span>days</span></div>
                </div>
                <div class="text-sm text-gray-500 mt-2">
                    <span>Anything else you want to say about the riding style</span>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="my-10 sm:px-6 lg:px-8">
        <div class="flex items-center">
            <div class="w-1/6">
                Number of rest days
            </div>
            <div class="w-3/6">
                <div class="w-2/6 flex items-center">
                    <div><x-input /></div>
                    <div class="ml-2"><span>days</span></div>
                </div>
                <div class="text-sm text-gray-500 mt-2">
                    <span>If there are any rest days, please say how many here. You might not have any rest days, in
                        such cases type '0'.</span>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="my-10 sm:px-6 lg:px-8">
        <div class="flex items-center">
            <div class="w-1/6">
                Number of riders
            </div>
            <div class="w-3/6">
                <div class="w-2/6">
                    <x-input />
                </div>
                <div class="text-sm text-gray-500 mt-2">
                    <span>Maximum number of riders in the trip.</span>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="my-10 sm:px-6 lg:px-8">
        <div class="flex items-center">
            <div class="w-1/6">
                Number of guides
            </div>
            <div class="w-3/6">
                <div class="w-2/6">
                    <x-input />
                </div>
                <div class="text-sm text-gray-500 mt-2">
                    <span>Roughly how many guides or leads will be part of the tour? (put '0' is this is a self-guided
                        tour.)</span>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="my-10 sm:px-6 lg:px-8">
        <div class="flex items-center">
            <div class="w-1/6">
                Bike rental or own
            </div>
            <div class="w-5/6">
                <div class="mb-6">
                    <x-radio id="included" lg
                        label="Bike is included - You can provide the option for the rider to select the bike and it could be at an additional price"
                        name="bike_option" />
                </div>
                <div class="mb-6">
                    <x-radio id="own_bike" lg
                        label="Bring their own bike - It is mandatory to bring the bike, rental is not available"
                        name="bike_option" />
                </div>
                <div class="mb-3">
                    <x-radio id="both" lg
                        label="Bike can be rented or bring your own bike - The rider can rent or bring their own"
                        name="bike_option" />
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="my-10 sm:px-6 lg:px-8">
        <div class="flex items-center">
            <div class="w-1/6">
                Rent Gear?
            </div>
            <div class="w-5/6">
                <div class="mb-6">
                    <x-radio id="from-us" lg label="The rider can rent gear from us" name="rent_gear" />
                </div>
                <div class="mb-3">
                    <x-radio id="own-gear" lg label="Bring your own riding gear" name="rent_gear" />
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="my-10 sm:px-6 lg:px-8">
        <div class="flex items-center">
            <div class="w-1/6">
                2-up Riding?
            </div>
            <div class="w-5/6">
                <div class="mb-6">
                    <x-radio id="no" lg label="No - This tour is only for the rider. So one person on the bike"
                        name="two_up_riding" />
                </div>
                <div class="mb-3">
                    <x-radio id="yes" lg
                        label="Yes - This tour can be done with 2 people on the bike. The rider and a passenger"
                        name="two_up_riding" />
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="my-10 sm:px-6 lg:px-8">
        <div class="flex items-center">
            <div class="w-1/6">
                Bike Specification
            </div>
            <div class="w-5/6">
                <x-input placeholder="Any adventure bike over 600cc" wire:model="title" />
                <div class="text-sm text-gray-500 mt-2">
                    <span>Specify what type of bikes are allowed and which ones are not, if the rider can bring their
                        own bike.</span>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="my-10 sm:px-6 lg:px-8">
        <div class="flex items-center">
            <div class="w-1/6">
                Total Distance
            </div>
            <div class="w-3/6">
                <div class="w-2/6 flex items-center">
                    <div><x-input /></div>
                    <div class="ml-2"><span>KM</span></div>
                </div>
                <div class="text-sm text-gray-500 mt-2">
                    <span>If known, enter the distance of the tour</span>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="my-10 sm:px-6 lg:px-8">
        <div class="flex items-center">
            <div class="w-1/6">
                Countries
            </div>
            <div class="w-5/6">
                <div class="items-center">
                    <x-select multiselect :options="['Europe', 'Germany', 'Portugal', 'India']" />
                </div>
                <div class="text-sm text-gray-500 mt-2">
                    <span>Select all the countries that will part of the tour.</span>
                </div>
            </div>
        </div>
    </div>
</div>
