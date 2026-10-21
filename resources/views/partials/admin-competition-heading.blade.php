@php
    $divisionID = $divisionID ?? request()->route('divisionID');
    $categoryID = $categoryID ?? request()->route('categoryID');
    $label = \App\Support\CompetitionLabel::for(
        $divisionID !== null ? (int) $divisionID : null,
        $categoryID !== null ? (int) $categoryID : null
    );
@endphp
<h1>{{ $heading }}@if($label) — {{ $label }}@endif</h1>
