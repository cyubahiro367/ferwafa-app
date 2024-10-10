@include('mainMenuBar', ['name' => 'Additional Game Rules'])

<div class="container-fulid no-padding contactus">
    <div class="section-padding"><center><h2>Additional Rules</h2></center></div>
    <div class="container">
        <div class="row">
            <div class="report-container" style="display: flex; gap: 12px">
                @foreach ($additionalGameRules as $additionalGameRule)
                    <div class="report">
                        <div class="report-image">
                            <a><img alt="" src="/static/img/icons/document.png" /></a>
                            <a><img alt="" class="click-report" src="/static/img/icons/click.png" /></a>
                        </div>
                        <div class="report-title">
                            <a href="{{ route('report.doc', $additionalGameRule['url']) }}" target="_blank">
                                <p>{{ $additionalGameRule['title'] }}</p>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

</div>

@include('footer')
