
(win => {
    const {"document": doc,} = win;
    const form = doc.getElementById("form");
    const table = doc.querySelector(".table");
    const results = table.querySelector(".table_results");
    const results_tpl = results.querySelector(".template");
    const queryInput = form.querySelector("[name='q']");
    const url = new URL(form.getAttribute("action"), win.location.origin);

    form.addEventListener("submit", evt => {
        evt.preventDefault();
        results.querySelectorAll("tr:not(.template)").forEach(node => node.remove());

        const search = new URLSearchParams();
        search.append("q", queryInput.value);
        url.search = search;

        fetch(url)
            .then(response => response.json())
            .then(data => {
                data.forEach(item => {
                    const resultCurrent = results_tpl.cloneNode(true);

                    resultCurrent.classList.remove("template");
                    results.appendChild(resultCurrent);

                    Object.entries(item).forEach(([key, value,]) => {
                        const node = resultCurrent.querySelector(`[data-text="${key}"]`);

                        if (!node) {
                            return;
                        }

                        node.textContent = value;
                    });
                });
            });
    });
})(window);