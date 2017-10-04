<script type="text/javascript" language="javascript" >

  $(document).ajaxStart(function() {
    $(document.body).css({'cursor' : 'pointer'});
  }).ajaxStop(function() {
    $(document.body).css({'cursor' : 'pointer'});
  });

 $(document).ready(function(){

    var selected_list
    var selected_list_ref
    var selected_table
    var selected_table_ref
    var panel_toggle
    var fetchpanel

    //ok
    $('#editSubscriber').click(function(){

      $.ajax({
         url: "<?php echo site_url('fetchsubdetail'); ?>",
         method: "GET",
         dataType: "json",
         success:function(data){
           if(data.success){
             $('#edit-phonenum').val(data['phonenum']);
             $('#edit-college').val(data['college']);
           }
         },
         error:function(){
           alert("ajax error");
         },
       });
    });

    //ok
    $('#saveEdit').click(function(){

      $.ajax({
         url: "<?php echo site_url('savesubdetail'); ?>",
         method: "POST",
         data: {phonenum:$('#edit-phonenum').val(), college:$('#edit-college').val()},
         dataType:'json',
         success:function(data){
           if(data.Fail){
             alert('Failed to edit subscriber.');
           }
         },
         error:function(){
           alert("ajax error");
         },
       });
    });

    //ok
    function init(){
      $('.text-title').html("No Queue Selected");
      $('.text-status').html("");
      $('.text-current').html("#");
      $('.text-last').html("#");
      $('.text-self').html("#");
      $('.text-desc').html("");
      $('.text-rest').html("");
      $('.text-req').html("");
      $('.text-venue').html("");
    }

    init();

    //ok
    function fetchlist(){

     $.ajax({
      url: "<?php echo site_url('fetchlist'); ?>",
      method: "GET",
      dataType: "text",
      success:function(data){

        if(data != ''){
          $('.list-group-class').html(data);

          var listGroup = $(".list-group-class .list-qname").filter(function() {
              return $(this).text() == selected_list;
          }).closest(".list-group-item");

          if(listGroup.find('.list-qname').text() != ''){

            listGroup.addClass('list-group-item-success');
          }else{
            selected_list = null;
          }
        }
        $('.list-group-class').html(data);
      },
      error:function(){
        alert("ajax error");
      },
    });
    }

    fetchlist();

    //ok
    function fetchtable() {

     var txt = $('#q-search-txt').val();

     if(txt == ''){
       $.ajax({
         url: "<?php echo site_url('fetchtable'); ?>",
         method: "GET",
         dataType: "text",
         success:function(data){
           $('#q-tbl-body').html(data);
           var tableRow = $("#q-tbl-body td").filter(function() {
                return $(this).text() == selected_table;
            }).closest("tr");
           if(tableRow.find('td:first').text() != ''){
             tableRow.addClass('success');
           }else{
              selected_table = null;
           }
         },
         error:function(){
           alert("ajax error");
         },
       });
     }else{
       $.ajax({
         url: "<?php echo site_url('fetchtable'); ?>",
         method: "POST",
         data: {search:txt},
         dataType: "text",
         success:function(data){
           $('#q-tbl-body').html(data);

           var tableRow = $("#q-tbl-body td").filter(function() {
                return $(this).text() == selected_table;
            }).closest("tr");

           if(tableRow.find('td:first').text() != ''){
             tableRow.addClass('success');
           }else{
             selected_table = null;
           }
         },
         error:function(){
           alert("ajax error");
         },
       });
     }
    }

    fetchtable();

    $('#q-search-txt').keyup(function(){

       fetchtable();
    });

    //ok
    $('.btn-leave').click(function(){

      if(selected_list != null){

        $.ajax({
          type: "POST",
          url: "<?php echo site_url('leave'); ?>",
          data: {selected: selected_list},
          dataType: "json",
          success:function(data){

             if(data.res == 'NOTINQUEUE'){
               alert("You have not joined this queue!");
             }else if(data.res == 'LEFT'){
               fetchlist();
               init();
               $(".panel-body-toggle").hide();
               $(".footer").hide();
               alert("You have left the queue!");
             }else if(data.res == 'FAIL'){
               alert("An error occured.")
             }
          },
          error:function(){
            alert("ajax error");
          },
        });
      }
    });

    //ok
    $('.btn-join').click(function(){

      if(selected_table){
        $.ajax({
         type: "POST",
         url: "<?php echo site_url('join'); ?>",
         data: {selected: selected_table},
         dataType: "json",
         success:function(data){

            if(data.res == 'EXIST'){
              alert("You are already in the queue!");
            }else if(data.res == 'ONGOING'){
              fetchlist();
            }else if(data.res == 'PAUSED'){
              alert("You can't join. The queue is paused.")
            }else if(data.res == 'CLOSED'){
              alert("You can't join. The queue is closed.")
            }else if(data.res == 'UNDEFINED'){
              alert("An error occured. You can't join.")
            }
         },
         error:function(){
           alert("ajax error");
         },
       });
     }else{
        alert("You must choose a queue!");
     }
    });

    //ok
    $('#q-tbl-body').on('click', 'tr', function(){

      $(this).not(".head").addClass('success').siblings().removeClass('success');
      selected_table=$(this).find('td:first').text();
    });

    //ok
    function fetchpanel(){
      if(selected_list){
        $.ajax({
          type: "POST",
          url: "<?php echo site_url('fetchpanel'); ?>",
          data: {selected: selected_list},
          dataType: "json",
          success:function(data){

            //catch data when the user is not in the queue
            if(data.True){
              $('.text-title').html(data.queue_name);
              $('.text-status').html(data.status);
              $('.text-current').html(data.serving_atNo);
              $('.text-last').html(data.total_deployNo);
              $('.text-self').html(data.self);
              $('.text-desc').html(data.queue_description);
              $('.text-rest').html(data.queue_restriction);
              $('.text-req').html(data.requirements);
              $('.text-venue').html(data.venue);
              $('.footer').show();
            }
          },
          error:function(){
            alert("ajax errors");
          },
        });
      }
    };

    //ok
    $('.list-group-class').on('click', '.list-selected', function(){

      $(this).addClass('list-group-item-success').siblings().removeClass('list-group-item-success');

      selected_list=$(this).find('.list-qname').text();

      $(".panel-body-toggle").show();

      fetchpanel();
    });

    //ok
    $(".panel-body-toggle").hide();

    //ok
    function check_session(){
      $.ajax({
        type: 'GET',
        url: "<?php echo site_url('check_session'); ?>",
        dataType: 'json',
        success: function (data) {
          if(data.REDIRECT){
            window.location.replace('<?php echo site_url('logout'); ?>');
          }
        },
        error: function(xhr, textStatus, errorThrown) {
          alert('Error!  Status = ' + xhr.status);
        }
      });
    }

    var interval = 5000;
    function dbUpdate() {

      fetchlist();
      fetchtable();
      fetchpanel();
      check_session();
      setTimeout(dbUpdate, interval);
    }

    setTimeout(dbUpdate, interval);

  });
 </script>
