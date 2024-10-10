@include('mainMenuBar', ['name' => 'Fixtures'])
<div class="section-padding"></div>
<section class="section">
    <div class="container-fluid eventlist blog blogpost upcoming-event latest-blog no-padding">
        <div class="container mt-5">
            <div class="row" style=" display: flex; justify-contents: center; align-item: center; gap">
                @foreach ($groups as $group)
                <div style=" background-color: #133e8d; color: white; margin-left: 10px" class="col-6 col-md-6 offset-md-1 col-lg-6 offset-lg-1">
                  <div>
                      <a style="color:white" href="{{ route('fixtures.show', [$seasonID, request()->route('divisionID'), request()->route('categoryID'), 1, $group->id]) }}"><h1>{{$group->name}}</h1></a>
                  </div>
              </div> 
                @endforeach
            </div>
        </div>
    </div>
    </div>
</section>
<div class="section-padding"></div>
@include('footer')
