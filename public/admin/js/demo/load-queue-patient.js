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

  function getIdByURL()
  {
    return (window.location.href).split("/").pop();
  }

  function changeContent(){
    $('#queue_patient').load(getBaseURL() + "patient/load-queue/" + getIdByURL());
    console.log('load');
  }

  setInterval(changeContent, 30000);

  $('body').on('DOMSubtreeModified', '#queue_patient', function() {
    // code here
    $('#dataTable').DataTable();
    $('#dataTable1').DataTable();
    $('#dataTable2').DataTable();
    $('#dataTable3').DataTable();
    $('#dataTable4').DataTable();
    $('#dataTable5').DataTable();
  });
  
});


