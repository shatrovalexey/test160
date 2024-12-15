<!DOCTYPE html>

<html>
    <head>
        <title>Поиск</title>
        <meta charset="utf-8">
        <link href="/css/style.css" rel="stylesheet"/>
    </head>
    <body class="font-sans antialiased">
        <div class="overlay">
            <form action="/search" method="get" id="form">
                <input name="q" required autofocus autocomplete type="search" placeholder="адрес" class="form-query" title="адрес">
                <input type="submit" value="&rarr;" class="form-submit" title="найти">
            </form>
            <div class="message hidden"></div>
            <table class="table hidden">
                <thead>
                    <tr>
                        <th>Регион</th>
                        <th>Город</th>
                        <th>Улица</th>
                    </tr>
                </thead>
                <tbody class="table_results">
                    <tr class="template">
                        <td data-text="region_name"></td>
                        <td data-text="city_name"></td>
                        <td data-text="street_name"></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </body>
</html>
<script src="/js/script.js"></script>