(win => {
    const {"document": doc,} = win;
    const form = doc.getElementById("form");
    const resultsTable = doc.querySelector(".table");
    const results = resultsTable.querySelector(".table_results");
    const resultsTpl = results.querySelector(".template");
    const errorMessage = doc.querySelector(".message");
    const url = new URL(form.getAttribute("action"), win.location.origin);
    const rxKey = new RegExp("^\\w+$");

    form.addEventListener("submit", evt => {
        evt.preventDefault();
        [resultsTable, errorMessage,].forEach(node => node.classList.add("hidden"));
        results.querySelectorAll("tr:not(.template)").forEach(node => node.remove());

        const search = new URLSearchParams();
        (new FormData(form)).entries().forEach(([key, value,]) => search.append(key, value));
        url.search = search;

        fetch(url)
            .then(response => response.json())
            .then(data => {
                if (!data.length) {
                    throw "ничего не найдено";
                }

                data.forEach(item => {
                    const resultCurrent = resultsTpl.cloneNode(true);

                    resultCurrent.classList.remove("template");
                    results.appendChild(resultCurrent);

                    Object
                        .entries(item)
                        .filter(([key,]) => String(key).match(rxKey))
                        .forEach(
                            ([key, value,]) => resultCurrent
                                .querySelectorAll(`[data-text="${key}"]`)
                                .forEach(node => node.textContent = value)
                        );
                });

                resultsTable.classList.remove("hidden");
            })
            .catch(error => {
                errorMessage.textContent = error;
                errorMessage.classList.remove("hidden");
            });
    });
})(window);