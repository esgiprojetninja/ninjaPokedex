(() => {
    window.addEventListener("load", function load(event) {
        window.removeEventListener("load", "load");
        const paginationEl = document.getElementsByClassName("paginationControl")[0];

        const ul = document.createElement("ul");
        ul.className = "pagination pagination-lg";

        const filteredEls = Array.from(paginationEl.childNodes)
            .filter(el => (el.nodeType !== Node.COMMENT_NODE) )
            .filter(el => ((el.nodeType === Node.ELEMENT_NODE) || (el.nodeType === Node.TEXT_NODE && !isNaN(parseInt(el.textContent.trim().replace(/\|/g, '').trim())))))
            .map(el => {
                if ( el.nodeType === Node.TEXT_NODE )
                    return {className: "active", textContent: el.textContent.trim().replace(/\|/g, '')};
                return el;
            });
        filteredEls[0].textContent = "Précédent";
        filteredEls[filteredEls.length - 1].textContent = "Suivant";
        filteredEls.forEach(el => {
            const li = document.createElement("li");
            const a = document.createElement("a");
            a.href = el.href ? el.href : "#";
            li.className = el.className;
            a.appendChild(document.createTextNode((el.textContent.trim())));
            li.appendChild(a);
            ul.appendChild(li);
        });
        paginationEl.parentNode.replaceChild(ul, paginationEl);
    });
})();
