@include('mainMenuBar', ['name' => 'Standing'])

<div class="container-fluid eventlist blog blogpost upcoming-event latest-blog no-padding">
    <div class="container">
        <div class="row " style="display: flex; justify-content: center">
            <div class="col-md-10 col-sm-10 col-xs-6 blog-box">
                <article class="type-post">
                    
                    <div class="container mt-5">
                        <div class="row">
                            <div style="margin-bottom: 10px" class="col-md-6 col-sm-12 offset-md-1 col-lg-6 offset-lg-1">
                                <div class="card card-primary">
                                            <div style="background-color: #133E8D;" class="col-12 col-md-12 card-header text-center">
                                                <ul class="menus">
                                                    <li><a style="color: white" href="{{ route('fixtures.show', [request()->route('divisionID'), $categoryID, $days->dayID]) }}">Results
                                                            &
                                                            Fixtures /</a>
                                                    </li>
                                                    <li><a style="color: white"
                                                            href="{{ route('men.first-division-table', [request()->route('divisionID'), $categoryID, request()->route('groupID')]) }}">Standing</a>
                                                    </li>
                                                </ul>
                                            </div>
                                                <table  class="table table-responsive table-bordered main-table">
                                                    <thead>
                                                        <tr>
                                                            <th style="width: 5%" scope="col">#</th>
                                                            <th style="width: 50%" scope="col">Team</th>
                                                            <th style="width: 10%" scope="col">P</th>
                                                            <th style="width: 10%" scope="col">GF</th>
                                                            <th style="width: 10%" scope="col">GL</th>
                                                            <th style="width: 10%" scope="col">GD</th>
                                                            <th style="width: 10%" scope="col">Pts</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($teamStatistics as $key => $teamStatistic)
                                                            @if ($key + 1 === count($teamStatistics) || $key + 1 === count($teamStatistics) - 1)
                                                                <tr class="last-teams main">
                                                                @else
                                                                <tr>
                                                            @endif
        
                                                            @if ($key + 1 == 1)
                                                                <tr class="first-team">
                                                            @endif
                                                            <th scope="row">{{ $key + 1 }} </th>
                                                            <td>{{ $teamStatistic->name }}</td>
                                                            <td>{{ $teamStatistic->matchPlayed }}</td>
                                                            <td>{{ $teamStatistic->goalWin }}</td>
                                                            <td>{{ $teamStatistic->goalLoss }}</td>
                                                            <td>{{ $teamStatistic->goalDifference }}</td>
                                                            <td>{{ $teamStatistic->score }}</td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12 offset-md-1 col-lg-3 offset-lg-1">
                                <div class="card card-primary">
                                        <div class="col-12 col-md-12 col-lg-12 p-0">
                                            <div class="col-12 col-md-12 card-header text-center">
                                                <ul class="menus">
                                                    <li><a>{{ $categoryName }} Top Scores</a></li>
                                                </ul>
                                            </div>
                                            <div class="row m-0">
                                                <table class="table table-responsive table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th style="width: 5%" scope="col">#</th>
                                                            <th style="width: 50%" scope="col">Name</th>
                                                            <th style="width: 10%" scope="col">Team</th>
                                                            <th style="width: 10%; background-color: #133E8D; color: white"
                                                                scope="col">Goals</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($topScores as $key => $topScore)
                                                            <tr>
                                                                <th scope="row">{{ $key + 1 }}</th>
                                                                <td>{{ $topScore['name'] }}</td>
                                                                <td>{{ $topScore['teamName'] }}</td>
                                                                <td style="background-color: #133E8D; color: white">
                                                                    {{ $topScore['goals'] }}</td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            </article>
        </div>

    </div>
</div>
        
@include('footer')
