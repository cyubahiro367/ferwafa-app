@include('mainMenuBar', ['name' => 'Documents'])

<div class="container-fulid no-padding contactus">
    <div class="section-padding"><center><h2>Documents</h2></center></div>
    <div class="container">
        <div class="row">
            <div class="report-container" style="display: flex; gap: 12px">
                @foreach ($documents as $document)
                    <div class="report">
                        <div class="report-image">
                            <a href="{{ route('report.doc', $document['id']) }}" target="_blank"><img alt="" src="/static/img/icons/document.png" /></a>
                            <a href="{{ route('report.doc', $document['id']) }}" target="_blank"><img alt="" class="click-report" src="/static/img/icons/click.png" /></a>
                        </div>
                        <div class="report-title">
                            <a href="{{ route('report.doc', $document['id']) }}" target="_blank">
                                <p>{{ $document['title'] }}</p>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="section-padding"></div>
</div>

@include('footer')
