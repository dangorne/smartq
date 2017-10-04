<script type="text/javascript" language="javascript" >

  $(document).ajaxStart(function() {
    $(document.body).css({'cursor' : 'pointer'});
  }).ajaxStop(function() {
    $(document.body).css({'cursor' : 'pointer'});
  });

  $(document).ready(function(){

    var selected_list
    var selected_table
    var panel_toggle

    function fetchtable(){

      var txt = $('#q-search-txt').val();

      if(txt == ''){

        $.ajax({

          url: "<?php echo site_url('fetchtable'); ?>",
          method: "GET",
          dataType: "text",
          success:function(data){

            $('#q-tbl-body').html(data);

            var tableRow = $("#q-tbl-body td").filter(function(){

              return $(this).text() == selected_table;
            }).closest("tr");

            if(tableRow.find('td:first').text() != ''){

              tableRow.addClass('success');
            }else{

              selected_table = null;
            }
          },
          error:function(){
            alert("table empty search ajax error");
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

            var tableRow = $("#q-tbl-body td").filter(function(){

              return $(this).text() == selected_table;
            }).closest("tr");

            if(tableRow.find('td:first').text() != ''){

              tableRow.addClass('success');
            }else{
              selected_table = null;
            }
          },
          error:function(){
            alert("table non empty search ajax error");
          },
        });
      }
    }

    fetchtable();

    function fetchqueuers(){
      $.ajax({
        url: "<?php echo site_url('fetchqueuers'); ?>",
        method: "POST",
        data: {selected:selected_table},
        dataType: "text",
        success:function(data){

          $('#q-tbl-queuer-body').html(data);
        },
        error:function(){

          alert("fetch queuer ajax error");
        },
      });
    };

    $('#q-search-txt').keyup(function(){

      fetchtable();
    });

    $('.btn-join').click(function(){

      if(selected_table != null){

        $.ajax({
          type: "POST",
          url: "<?php echo site_url('join'); ?>",
          data: {selected: selected_table},
          dataType: "json",
          success:function(data){

            if(data['res']== 'ONGOING'){

              fetchtable();
              fetchqueuers();
            }else if(data['res'] == 'PAUSED'){

              alert("You can't join. The queue is paused.")
            }else if(data['res'] == 'CLOSED'){

              alert("You can't join. The queue is closed.")
            }else if(data['res'] == 'UNIDENTIFIED'){

              alert("You can't join. The queue does not exist.")
            }
          },
          error:function(){
            alert("join ajax error");
          },
        });

        $('.btn-join').attr("disabled", "disabled").html('<span class="glyphicon glyphicon-ban-circle"></span>');

        setTimeout(function() {

          $('.btn-join').removeAttr("disabled").html('JOIN!');
        }, 5000);
      }
    });

    $('#q-tbl-body').on('click', 'tr', function(){

      $(this).not(".head").addClass('success').siblings().removeClass('success');

      selected_table=$(this).find('td:first').text();
      fetchqueuers();
    });

    var interval = 5000;

    function update(){

      fetchtable();
      fetchqueuers();
      setTimeout(update, interval);
    }

    setTimeout(update, interval);
  });

 </script>
