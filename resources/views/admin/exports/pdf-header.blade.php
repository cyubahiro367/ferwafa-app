<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <script>
        function subst() {
            var vars = {};
            var query = document.location.search.substring(1).split('&');
            for (var i = 0; i < query.length; i++) {
                var pair = query[i].split('=', 2);
                vars[pair[0]] = unescape(pair[1]);
            }
            var pages = document.getElementsByClassName('page-num');
            for (var j = 0; j < pages.length; j++) {
                pages[j].textContent = vars['page'] || '';
            }
        }
    </script>
    <style>
        html, body {
            margin: 0;
            padding: 0;
            background: #0E1B3A;
        }
        body {
            font-family: Arial, Helvetica, sans-serif;
            color: #ffffff;
        }
        .bar {
            background: #0E1B3A;
            padding: 8px 12px 6px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        .brand {
            color: #F0A83C;
            font-size: 11px;
            font-weight: bold;
            width: 38%;
        }
        .title {
            color: #ffffff;
            font-size: 15px;
            font-weight: bold;
            text-align: center;
            width: 24%;
        }
        .meta {
            color: #F0A83C;
            font-size: 10px;
            text-align: right;
            width: 38%;
        }
        .gold {
            height: 4px;
            background: #F0A83C;
            font-size: 1px;
            line-height: 4px;
        }
    </style>
</head>
<body onload="subst()">
    <div class="bar">
        <table>
            <tr>
                <td class="brand">{{ $brand }}</td>
                <td class="title">{{ $title }}</td>
                <td class="meta">Page <span class="page-num"></span> · {{ $generatedAt }}</td>
            </tr>
        </table>
    </div>
    <div class="gold">&nbsp;</div>
</body>
</html>
