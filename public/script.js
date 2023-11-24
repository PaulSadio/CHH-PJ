$(document).ready(function () {
    $('#searchInput').on('keyup', function () {
        var searchText = $(this).val().toLowerCase();

        // Iterate through each table row
        $('table tbody tr').each(function () {
            var rowData = $(this).text().toLowerCase();

            // Show or hide the row based on whether the search text is found
            $(this).toggle(rowData.indexOf(searchText) > -1);
        });
    });
});
try {
    $(document).ready(function () {
      // Your FullCalendar initialization code here
    });
  } catch (error) {
    console.error("FullCalendar initialization error:", error);
  }