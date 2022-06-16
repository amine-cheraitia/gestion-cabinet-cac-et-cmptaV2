window.addEventListener("DOMContentLoaded", (event) => {
    // Simple-DataTables
    // https://github.com/fiduswriter/Simple-DataTables/wiki

    const datatablesSimple = document.getElementById("datatablesSimple");
    if (datatablesSimple) {
        new simpleDatatables.DataTable(datatablesSimple, {
            labels: {
                placeholder: "Recherche...",
                perPage: "{select} ligne par page",
                noRows: "Recherche non trouver",
                info: "Affichage de {start} à {end} sur {rows} lignes",
            },
        });
    }
});
