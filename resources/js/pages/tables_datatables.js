/*
 *  Document   : tables_datatables.js
 *  Author     : pixelcave
 *  Description: Custom JS code used in Plugin Init Example Page
 */

// DataTables, for more examples you can check out https://www.datatables.net/
class pageTablesDatatables {
    /*
     * Init DataTables functionality
     *
     */
    static initDataTables() {
        // Override a few DataTable defaults
        jQuery.extend(jQuery.fn.dataTable.ext.classes, {
            sWrapper: "dataTables_wrapper dt-bootstrap4",
        });

        // Init full DataTable
        jQuery('.js-dataTable-full').dataTable({
            pageLength: 20,  // Affiche 20 enregistrements par défaut
            lengthMenu: [[5, 10, 20, 50, 100, -1], [5, 10, 20, 50, 100, "Tous"]], // Options de pagination
            autoWidth: false
        });
        
    }

    /*
     * Init functionality
     *
     */
    static init() {
        this.initDataTables();
    }
}

// Initialize when page loads
jQuery(() => {
    pageTablesDatatables.init();
});
