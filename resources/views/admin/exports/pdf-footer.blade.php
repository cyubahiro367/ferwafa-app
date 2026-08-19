<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        html, body {
            margin: 0;
            padding: 0;
        }
        body {
            font-family: Arial, Helvetica, sans-serif;
        }
        .line {
            height: 2px;
            background: #F0A83C;
            font-size: 1px;
            line-height: 2px;
            margin: 0 0 6px;
        }
        .txt {
            color: #6B7280;
            font-size: 9px;
            font-style: italic;
            padding: 0 12px 4px;
        }
    </style>
</head>
<body>
    <div class="line">&nbsp;</div>
    <div class="txt">{{ $footer }} {{ $generatedAt }}</div>
</body>
</html>
