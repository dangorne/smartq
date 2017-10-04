<script>

$(document).ajaxStart(function() {
    $(document.body).css({'cursor' : 'pointer'});
  }).ajaxStop(function() {
    $(document.body).css({'cursor' : 'pointer'});
  });

$(document).ready(function(){

  //ok
  function fetchwindow(){

    $.ajax({
      url: "<?php echo site_url('fetchwindow'); ?>",
      method: "GET",
      dataType: "text",
      success:function(data){
          $('.window-table').html(data);
      },
      error:function(data){
       alert("table fetch ajax error");
      },
    });
  }

  fetchwindow();

  var interval = 1000;
  function dbUpdate() {

    fetchwindow();
    setTimeout(dbUpdate, interval);
  }

  setTimeout(dbUpdate, interval);


});

</script>
