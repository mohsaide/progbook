function downloadTableAsCSV( event ) {
  event.preventDefault();
  var table = document.getElementById('dataTable');
  var csvContent = '';

  // Iterate through each row of the table
  for (var i = 0; i < table.rows.length - 1; i++) {
    var rowData = [];
    var row = table.rows[i];

    // Iterate through each cell of the row
    for (var j = 0; j < row.cells.length; j++) {
      var cellData = row.cells[j].textContent;
      rowData.push(cellData);
    }

    // Join the cell data with commas and add a new line
    var rowCSV = rowData.join(',');
    csvContent += rowCSV + '\n';
  }

  // Create a Blob containing the CSV content
  var blob = new Blob([csvContent], { type: 'text/csv' });

  // Create a downloadable link for the Blob
  var link = document.createElement('a');
  link.href = URL.createObjectURL(blob);
  link.download = 'ClsReport.csv'; // Name of the downloaded file

  // Trigger the file download
  link.click();
}