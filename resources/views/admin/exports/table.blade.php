<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $title }}</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 11px;
            color: #111827;
            margin: 0;
            padding: 0;
        }
        .filters {
            width: 100%;
            border-collapse: collapse;
            margin: 0 0 12px;
        }
        .filters td {
            padding: 4px 8px 4px 0;
            vertical-align: top;
        }
        .flabel {
            color: #0E1B3A;
            font-weight: bold;
            font-size: 10px;
            width: 12%;
            white-space: nowrap;
        }
        .fvalue {
            color: #1F2937;
            font-size: 10px;
            width: 21%;
        }
        table.data {
            width: 100%;
            border-collapse: collapse;
        }
        table.data thead {
            display: table-header-group;
        }
        table.data th {
            background: #16264D;
            color: #ffffff;
            font-weight: bold;
            font-size: 11px;
            text-align: left;
            padding: 8px 8px;
            border: 1px solid #16264D;
        }
        table.data td {
            padding: 7px 8px;
            border: 1px solid #D5D8E0;
            vertical-align: top;
        }
        table.data tbody tr:nth-child(even) td {
            background: #F5F6FA;
        }
        table.data tbody tr:nth-child(odd) td {
            background: #ffffff;
        }
        .badge {
            display: inline-block;
            padding: 2px 8px;
            font-weight: bold;
            font-size: 10px;
        }
        .badge-published {
            color: #125C36;
            background: #E7F5EC;
        }
        .badge-other {
            color: #9A2A22;
            background: #FCEBEA;
        }
        .empty {
            text-align: center;
            color: #6B7280;
            padding: 16px;
        }
    </style>
</head>
<body>
    <table class="filters">
        @foreach(array_chunk($filters, 3) as $chunk)
            <tr>
                @foreach($chunk as $filter)
                    <td class="flabel">{{ $filter['label'] }}</td>
                    <td class="fvalue">{{ $filter['value'] }}</td>
                @endforeach
            </tr>
        @endforeach
    </table>

    <table class="data">
        <thead>
            <tr>
                @foreach($headings as $heading)
                    <th>{{ $heading }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @forelse($rows as $row)
                <tr>
                    @foreach($row as $index => $cell)
                        <td>
                            @if($statusIndex !== null && (int) $index === (int) $statusIndex)
                                @php $published = strcasecmp((string) $cell, 'published') === 0; @endphp
                                <span class="badge {{ $published ? 'badge-published' : 'badge-other' }}">{{ $cell }}</span>
                            @else
                                {{ $cell }}
                            @endif
                        </td>
                    @endforeach
                </tr>
            @empty
                <tr>
                    <td class="empty" colspan="{{ max(count($headings), 1) }}">No records in this range.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
