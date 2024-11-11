@include('guest-header')
<main class="mt-6">
    <div class="brand-name">
        <hr>
        <b style="font-size: 32px; color:black; margin: 5% 0;">{{ $tour->title }} - {{ $tour->countries }}</b>
        <hr>
        <div>
            <img width="60%"
                src="https://photos.smugmug.com/Galleries/Motorcycles/i-jX3tNwR/0/K2H4fw8P5MqPD8SRLWSrRZm4479d3ZvH8HL773j2D/L/cj.photos-_CJ09043-L.jpg"
                alt="Tour photo">
        </div>
    </div>
    <div class="tour-details mt-5">
        <hr>
        <ul>
            <li>We will be touring in: <b>{{ $tour->countries }}</b></li>
            <li>This tour is open to <b>{{ $tour->rider_capability }}</b> riders. Please let us know if you have
                specific requirements.
            </li>
            <li>This tour is an <b>{{ $tour->riding_style }}</b> ride. Almost all of the trip is off road. (note:
                60% of the ride is technical and 40% east dirt roads)
            </li>
            <li>Tour duration is: <b>{{ $tour->duration_days }} days with {{ $tour->rest_days }} rest day.</b></li>
            <li>Maximum number of riders is <b>{{ $tour->max_riders }}</b> and will include <b>{{ $tour->guides }}
                    or more guides.</b>
            </li>
            <li><b>{{ $tour->bike_option }}</b>.
                {{ $tour->bike_specification != '' ? 'Note: ' . $tour->bike_specification : '' }}
            </li>
            <li>{{ $tour->two_up_riding ? 'The tour is for 2-up riding.' : 'The tour is not for 2-up riding. Only the rider on the bike.' }}
            </li>
            <li>We will covering: <b>{{ $tour->tour_distance }}Kms</b></li>
        </ul>
    </div>
    <div class="features p-6 inline-flex justify-center">
        <div class="included w-1/2">
            <hr>
            <div class="header inline-flex justify-center items-center">
                <svg height="60px" version="1.1" viewBox="0 0 60 60" width="60px" xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink">
                    <title></title>
                    <desc></desc>
                    <defs></defs>
                    <g fill="none" fill-rule="evenodd" id="People" stroke="none" stroke-width="1">
                        <g fill="#000000" id="Icon-41">
                            <path
                                d="M6,52 C6,53.103 6.897,54 8,54 C9.103,54 10,53.103 10,52 C10,50.897 9.103,50 8,50 C6.897,50 6,50.897 6,52 M59.706,30.261 L54.218,52.247 C53.345,55.742 50.904,58 48,58 L33,58 C30.234,58 28.338,56.916 26.504,55.868 C24.823,54.907 23.234,54 21,54 L19,54 C18.448,54 18,53.553 18,53 C18,52.447 18.448,52 19,52 L21,52 C23.766,52 25.662,53.084 27.496,54.132 C29.177,55.093 30.766,56 33,56 L48,56 C50.376,56 51.79,53.717 52.278,51.763 L57.77,29.758 C58.128,28.429 58.08,27.468 57.631,26.882 C57.073,26.153 55.892,26 55,26 L41,26 C39.86,26 38.832,25.624 38,25.005 L38,29 C38,34.047 34.047,38 29,38 C28.448,38 28,37.553 28,37 C28,36.447 28.448,36 29,36 C32.925,36 36,32.925 36,29 L36,9 C36,4.552 33.449,2 29,2 C27.374,2 26,3.374 26,5 L26,15 C26,20.83 21.682,25.467 16,25.957 L16,59 C16,59.553 15.552,60 15,60 L1,60 C0.448,60 0,59.553 0,59 L0,21 C0,20.447 0.448,20 1,20 L15,20 C15.552,20 16,20.447 16,21 C16,21.553 15.552,22 15,22 L2,22 L2,58 L14,58 L14,25 C14,24.447 14.448,24 15,24 C20.047,24 24,20.047 24,15 L24,5 C24,2.243 26.243,0 29,0 C34.551,0 38,3.448 38,9 L38,21 C38,22.683 39.318,24 41,24 L55,24 C56.925,24 58.384,24.576 59.218,25.665 C60.065,26.771 60.229,28.317 59.706,30.261"
                                id="thumb-up"></path>
                        </g>
                    </g>
                </svg>
                <span class="ml-3 text-xl">Included</span>
            </div>
            <div class="include-details">
                {!! $tour->included !!}
            </div>
        </div>
        <div class="not-included w-1/2">
            <hr>
            <div class="header inline-flex justify-center items-center">
                <svg height="60px" version="1.1" viewBox="0 0 60 60" width="60px" xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink">
                    <title></title>
                    <desc></desc>
                    <defs></defs>
                    <g fill="none" fill-rule="evenodd" id="People" stroke="none" stroke-width="1">
                        <g fill="#000000" id="Icon-41">
                            <path
                                d="M6,52 C6,53.103 6.897,54 8,54 C9.103,54 10,53.103 10,52 C10,50.897 9.103,50 8,50 C6.897,50 6,50.897 6,52 M59.706,30.261 L54.218,52.247 C53.345,55.742 50.904,58 48,58 L33,58 C30.234,58 28.338,56.916 26.504,55.868 C24.823,54.907 23.234,54 21,54 L19,54 C18.448,54 18,53.553 18,53 C18,52.447 18.448,52 19,52 L21,52 C23.766,52 25.662,53.084 27.496,54.132 C29.177,55.093 30.766,56 33,56 L48,56 C50.376,56 51.79,53.717 52.278,51.763 L57.77,29.758 C58.128,28.429 58.08,27.468 57.631,26.882 C57.073,26.153 55.892,26 55,26 L41,26 C39.86,26 38.832,25.624 38,25.005 L38,29 C38,34.047 34.047,38 29,38 C28.448,38 28,37.553 28,37 C28,36.447 28.448,36 29,36 C32.925,36 36,32.925 36,29 L36,9 C36,4.552 33.449,2 29,2 C27.374,2 26,3.374 26,5 L26,15 C26,20.83 21.682,25.467 16,25.957 L16,59 C16,59.553 15.552,60 15,60 L1,60 C0.448,60 0,59.553 0,59 L0,21 C0,20.447 0.448,20 1,20 L15,20 C15.552,20 16,20.447 16,21 C16,21.553 15.552,22 15,22 L2,22 L2,58 L14,58 L14,25 C14,24.447 14.448,24 15,24 C20.047,24 24,20.047 24,15 L24,5 C24,2.243 26.243,0 29,0 C34.551,0 38,3.448 38,9 L38,21 C38,22.683 39.318,24 41,24 L55,24 C56.925,24 58.384,24.576 59.218,25.665 C60.065,26.771 60.229,28.317 59.706,30.261"
                                id="thumb-up"></path>
                        </g>
                    </g>
                </svg>
                <span class="ml-3 text-xl">Not Included</span>
            </div>
            <div class="include-details">
                {!! $tour->not_included !!}
            </div>
        </div>
    </div>
    <div class="description p-6">
        <hr>
        <div class="header">Description</div>
        After meeting in Folkestone and travelling by train to the continent we’ll ride to the Belgium region of
        Wallonia for our first night on tour and welcome dinner. The following morning we’ll continue east to ride
        some of the most beautiful and least-visited regions of Europe. Initially you head to Prague, a day off here
        allows time to explore ‘the city of a thousand spires’, before moving north to the German Polish border town
        of Gorlitz. Where once this town was on the fortified line between East Germany and Poland it is now
        thriving, benefitting from an annual secret donation to help restore the stunning architecture to its former
        medieval glory. Visit the Landskron Brewery Germany’s eastern most Brauhaus, or for the WWII buffs you can
        take a short ride to Zagan the scene of The Great Escape and visit the camp and museum commemorating those
        who lost their lives as a result of this audacious escape attempt.
        <br><br>
        You ride south through the Sudetic Mountains and into the Carpathians, heading for Krakow stopping en route
        in the small Polish town of Ladek-Zdroj. A free day in the UNESCO listed historic centre of Krakow can be
        spent entirely in the Main Square, the largest Medieval Town Square in Europe, or you can visit the Royal
        Wawel Castle overlooking the city. Or there is always the option to take a ride to Auschwitz, visit the
        museum and pay your respects.
        From Poland you head south with an overnight stop in a lovely Boutique hotel in Slovakia, on your way
        winding through the Matra Mountains to Budapest. Ranked as the second best city in the world by Conde Nast
        Traveller Magazine. With so much to see you will have to choose between seeing the Buda Castle, visiting
        Trinity square in the shadow of the charismatic Mathias church, the Kaltenburg Brewery, or just sit on the
        banks of the Danube drinking coffee. But don’t think that sitting on the banks of the Danube is wasting the
        day. This stretch of the river, in the heart of Budapest, is a UNESCO listed site as it is so beautiful.
        <br><br>
        You then have a short ride along the banks of the Danube to Bratislava where you have a day off the bike and
        another enchanting city to explore. Small by modern standards, the skyline of this capital is dominated by
        Bratislava Castle, jealously guarding the Danube. Stroll, narrow pedestrian streets of pastel 18th-century
        buildings or sample the myriad sidewalk cafes under the watchful gaze of the city castle.
        Follow the twists and turns of the Danube and you will arrive in Vienna Austria, with enough time to take a
        horse and carriage tour of the city and enjoy the capital. Vienna was home to Mozart, Beethoven and Sigmund
        Freud but is best known for
        <br><br>
        its Imperial palaces, including Schönbrunn, the Habsburgs’ summer residence.
        The Unesco World Heritage site of Salzburg is next, divided by the Salzach River, with medieval and baroque
        buildings of the pedestrian Altstadt (Old City) on its left bank, facing the 19th-century Neustadt (New
        City) on its right. The Altstadt is the birthplace of famed composer Mozart. Ulm allows you the chance to
        visit the huge Gothic Ulm Minster, a centuries-old church. Its steeple has views of the city and, in clear
        weather, the Alps. A 16th-century astronomical clock and the Half-timbered houses line the narrow alleys of
        the Fischerviertel.
        <br><br>
        A relaxed ride sees you back in France and Obernai. Nestled on the eastern slopes of the Vosges mountains
        with its charming medieval and Renaissance houses, its historic centre is surrounded by ramparts. Spend time
        wandering its side streets, discovering historic treasures. Our final night is spent in the capital of the
        Champagne wine-growing region, Reims. For more than 1,000 years, French kings were crowned at its Cathédrale
        Notre-Dame de Reims. There’ll be time to visit the Cathedral before settling down to our farewell dinner.
        The following morning it’s time for home, but before that, the winding roads and French countryside awaits.
        This part of the world is still crammed with ancient architecture and unspoilt roads, populated by wonderful
        people and is waiting to be explored by bike. For the first few days of the tour we have some fairly big
        mileages to get to our destinations, but the routes are packed with picturesque countryside and more regular
        mileages will return after the opening stint.
    </div>
    <div class="tour-prices p-6 text-2xl text-center">
        <b>
            <div class="header">Tour Prices</div>
        </b>
        <div>
            <div class="inline-flex justify-center items-center price">
                <div>September 25, 2025</div>
                <div class="ml-16">€ 1500</div>
                <div class="ml-16"><x-button outline positive label="Book" /></div>
            </div>
        </div>
        <div>
            <div class="inline-flex justify-center items-center price">
                <div>September 25, 2025</div>
                <div class="ml-16">€ 1500</div>
                <div class="ml-16"><x-button outline positive label="Book" /></div>
            </div>
        </div>
        <div>
            <div class="inline-flex justify-center items-center price">
                <div>September 25, 2025</div>
                <div class="ml-16">€ 1500</div>
                <div class="ml-16"><x-button outline positive label="Book" /></div>
            </div>
        </div>
    </div>
    @include('footer')
