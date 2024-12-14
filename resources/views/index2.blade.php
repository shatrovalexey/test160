<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Поиск</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>
        <link href="/css/style.css" rel="stylesheet"/>

		@routes
		@vite(["resources/js/Pages/Search.js"])
		@inertiaHead
    </head>
    <body class="font-sans antialiased">
        <div class="overlay">
            <form action="/search" method="get" id="form">
                <label>
                    <span>адрес</span>
                    <input name="q" required>
                </label>
                <label>
                    <span>найти</span>
                    <input type="submit" value="&rarr;">
                </label>
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