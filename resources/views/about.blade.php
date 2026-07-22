    @include('mainMenuBar', ['name' => 'about'])

    <!-- Howwecan Section -->
    <div class="container-fluid no-padding howwecan-section howwecan-section2">
        <div class="section-padding"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <div class="howwecan-top">
                        <img src="{{ asset('../asset/images/file.png')}}" alt="howwecan3" width="300" height="200" />
                    </div>
                </div>
                <div class="col-md-8 col-sm-6 col-xs-12">
                    <div class="howwecan-right">
                        <div class="section-header">
                            <h3>About Us</h3>
                        </div>
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active">
                                <a href="#howwecan_1" aria-controls="howwecan_1" role="tab" data-toggle="tab">
                                    <span class="icon icon-WorldWide"></span>
                                </a>
                            </li>
                            <li role="presentation">
                                <a href="#howwecan_2" aria-controls="howwecan_2" role="tab" data-toggle="tab">
                                    <span class="icon icon-Briefcase"></span>
                                </a>
                            </li>
                            <li role="presentation">
                                <a href="#howwecan_3" aria-controls="howwecan_3" role="tab" data-toggle="tab">
                                    <span class="icon icon-Files"></span>
                                </a>
                            </li>
                            <li role="presentation">
                                <a href="#howwecan_4" aria-controls="howwecan_4" role="tab" data-toggle="tab">
                                    <span class="icon icon-Book"></span>
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane fade" id="howwecan_1">
                                <h3>Who we Are</h3>
                                <p>
                                    The Federation Rwandaise of Football Association – Ferwafa –
                                    a non -governmental and non-profit organization has the
                                    national mandate to develop and organize football
                                    competitions throughout out Rwanda.
                                </p>
                                <p>
                                    It is the sole institution governing the football in Rwanda
                                    and recognized as such by the Government of Rwanda on one
                                    hand and by both FIFA (Federation Internationale de Football
                                    Associations) and CAF (Confederation Africaine de Football)
                                    as their member on the other hand.
                                </p>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="howwecan_2">
                                <h3>Our Mission</h3>
                                <ul>
                                    <li>
                                        <p>
                                            To develop and improve the football game throughout the
                                            Rwanda territory and improve the country FIFA/CAF
                                            ranking.
                                        </p>
                                    </li>
                                    <li>
                                        <p>
                                            To contribute to physical and moral self-fulfillment of
                                            the population in general and the Youth in particular
                                            through football games.
                                        </p>
                                    </li>
                                    <li>
                                        <p>
                                            To organize friendly games and competitions through
                                            football associations for all age categories including
                                            for the women, veterans, students down to sector level.
                                        </p>
                                    </li>
                                    <li>
                                        <p>
                                            To enforce FIFA refereeing rules and practices to
                                            keeping the integrity of football tournament.
                                        </p>
                                    </li>
                                    <li>
                                        <p>
                                            To approve and foster the competitions between the
                                            affiliated leagues and or clubs’ members.
                                        </p>
                                    </li>
                                </ul>
                            </div>
                            <div role="tabpanel" class="tab-pane fade in active" id="howwecan_3">
                                <h3>Our Vision</h3>
                                <ul>
                                    <li>
                                        <p>
                                            To take part in the international competitions organised
                                            by FIFA, CAF and any other body organised at regional
                                            level,
                                        </p>
                                    </li>
                                    <li>
                                        <p>
                                            To organize and take part in training courses and
                                            seminars in various fields likely to promote the Rwandan
                                            football including its administration, the refereeing,
                                            coaching, sports medicine etc.
                                        </p>
                                    </li>
                                    <li>
                                        <p>
                                            To promote and organize the national football teams for
                                            all ages and gender categories.
                                        </p>
                                    </li>
                                    <li>
                                        <p>
                                            To carry out commercial activities likely to generate
                                            income that supports its vision and mission.
                                        </p>
                                    </li>
                                </ul>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="howwecan_4">
                                <h3>History</h3>
                                <p>
                                    Rwandese Federation of Association Football (FERWAFA) was
                                    founded in 1972 and became a FIFA and FIFA affiliate in
                                    1978.
                                </p>
                                <p>
                                    From the above setting, Ferwafa operates within the
                                    framework of the FIFA/CAF regulations; holding itself to
                                    respect them and its members to comply with its own statute
                                    and the directives/decisions from FIFA/CAF.
                                </p>
                                <p>FERWAFA’s motto is “Unity, Discipline and Victory”,</p>
                                <p>
                                    Due to their blue and yellow uniforms, the Rwandan national
                                    team is nicknamed The Wasps.
                                </p>
                                <p>
                                    Rwanda has never reached the World Cup finals and has only
                                    managed to make their maiden appearance in the Africa Cup of
                                    Nations in 2004. Rwanda met success only in the CECAFA Cup
                                    winning the tournament in 1998 and finishing a runner-up
                                    five times.
                                </p>
                                <p>
                                    With their U17 National team, Rwanda qualified to the 2011
                                    FIFA World Cup finals held in Mexico after finishing
                                    runner-up to Burkina Faso in the Africa U17 Championship
                                    held in Kigali, Rwanda.
                                </p>
                                <p>
                                    The Rwanda national team is proud of its top scorer Olivier
                                    Karekezi who netted 24 goals for the national team. The team
                                    is currently ranked 68th (World) and 19th (Africa) in FIFA
                                    World statistics.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="section-padding"></div>
    </div>
    <!-- Howwecan Section /- -->

    <div>
        <!-- Team Section -->
        <div class="container-fluid no-padding team-section">
            <div class="section-padding"></div>
            <div class="section-header">
                <h3>Meet our great Executive Committee Members</h3>
                <span>Executive Committee</span>
            </div>
            <ul id="team-carousel">
                @foreach ($committe as $value)
                    <li data-thumb="{{ route('comitte.doc', $value['url']) }}?v=1">
                        <div class="col-md-6 no-padding larg-thumb">
                            <img src="{{ route('comitte.doc', $value['url']) }}?v=1" style="width: 400px; height: auto;"
                                alt="team1" />
                        </div>
                        <div class="container">
                            <div class="col-md-6 no-padding">
                                <div class="team-content">
                                    <h3>{{ $value['name'] }}</h3>
                                    <a href="#" title="Public Speaker">{{ $value['position'] }}</a>
                                    <p>
                                        
                                    </p>
                                    <ul>
                                        <li class="fb">
                                            <a title="Facebook" href="#"><i class="fa fa-facebook"></i></a>
                                        </li>
                                        <li class="twt">
                                            <a title="Twitter" href="#"><i class="fa fa-twitter"></i></a>
                                        </li>
                                        <li class="gp">
                                            <a title="GooglePlus" href="#"><i class="fa fa-google-plus"></i></a>
                                        </li>
                                        <li class="lnk">
                                            <a title="LinkedIn" href="#"><i class="fa fa-linkedin"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
        <!-- Team Section /- -->

        <!-- Footer Main -->
    </div>

    @include('footer')
