// Call the dataTables jQuery plugin
$(document).ready(function() {
  $('#dataTable').DataTable();
  $('#dataTable1').DataTable();
  $('#dataTable2').DataTable();
  $('#dataTable3').DataTable();
  $('#dataTable4').DataTable();
  $('#dataTable5').DataTable();

  function getBaseURL () {
    return location.protocol + "//" + location.hostname + (location.port && ":" + location.port) + "/";
  }

  function changeContent(){
    $('#queue_admin').load(getBaseURL() + "administrator/load-queues");
    console.log('load');
  }
  setInterval(changeContent, 30000);

  $('body').on('DOMSubtreeModified', '#queue_admin', function() {
    // code here
    $('#dataTable').DataTable();
    $('#dataTable1').DataTable();
    $('#dataTable2').DataTable();
    $('#dataTable3').DataTable();
    $('#dataTable4').DataTable();
    $('#dataTable5').DataTable();
  });
  
});


