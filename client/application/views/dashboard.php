<div class="container-fluid">

  <div class="row">

    <div class="col-md-4 col-md-offset-4">

      <div class="panel panel-default panel-qlist" style="display:none;">
        <div class="panel-heading">
          <div class="btn-group btn-group-justified" role="group">
            <div class="btn-group" role="group">
              <button type="button" class="btn btn-success glyphicon glyphicon-plus" data-toggle="modal" data-target="#createModal"><strong> Create!</strong></button>
            </div>
          </div>
        </br>

          <div class="btn-group btn-group-justified" role="group">
            <div class="btn-group" role="group">
              <button type="button" class="btn btn-info btn-join" ><span class="glyphicon glyphicon-circle-arrow-down"></span> Join!</button>
            </div>
          </div>

        </div>

        <div class="list-group list-group-class">

        </div>
      </div>

      <div class="panel panel-default content-detail" style="display:none;">

        <div class="panel-heading">

          <div class="row">

            <div class="col-md-12">
              <h2 class="buffer text-center" id="detail-qname"></h2>
              <p class="buffer text-center" ><em>name</em></p>
            </div>

          </div>

          <div class="row">

            <div class="col-md-12">

              <h2 class="buffer text-center" id="detail-code"></h2>
              <p class="buffer text-center"><em>code</em></p>
            </div>

          </div>

        </div>

        <div class="list-group">

          <div class="list-group-item">

            <div class="row">
              <div class="col-md-10">
                <h4 class="buffer" id="detail-seats"></h4>
                <p class="buffer"><em>seats</em></p>
              </div>

              <div class="col-md-2">
                <button type="button" class="btn btn-info pull-right" id="editSeats" data-toggle="modal" data-target="#seatModal"><span class="glyphicon glyphicon-edit"></span> Edit</button>
              </div>

            </div>

          </div>
          <div class="list-group-item">

            <div class="row">
              <div class="col-md-10">
                <h4 class="buffer" id="detail-desc"></h4>
                <p class="buffer"><em>description</em></p>
              </div>

              <div class="col-md-2">
                <button type="button" class="btn btn-info pull-right" id="editDesc" data-toggle="modal" data-target="#descModal"><span class="glyphicon glyphicon-edit"></span> Edit</button>
              </div>

            </div>

          </div>
          <div class="list-group-item">

            <div class="row">
              <div class="col-md-10">
                <h4 class="buffer" id="detail-req"></h4>
                <p class="buffer"><em>requirements</em></p>
              </div>

              <div class="col-md-2">
                <button type="button" class="btn btn-info pull-right" id="editReq" data-toggle="modal" data-target="#reqModal"><span class="glyphicon glyphicon-edit"></span> Edit</button>
              </div>

            </div>

          </div>
          <div class="list-group-item">

            <div class="row">
              <div class="col-md-10">
                <h4 class="buffer" id="detail-venue"></h4>
                <p class="buffer"><em>venue</em></p>
              </div>

              <div class="col-md-2">
                <button type="button" class="btn btn-info pull-right" id="editVenue" data-toggle="modal" data-target="#venueModal"><span class="glyphicon glyphicon-edit"></span> Edit</button>
              </div>

            </div>

          </div>
          <div class="list-group-item">

            <div class="row">
              <div class="col-md-10">
                <h4 class="buffer" id="detail-rest"></h4>
                <p class="buffer"><em>restriction</em></p>
              </div>

              <div class="col-md-2">
                <button type="button" class="btn btn-info pull-right" id="editRest" data-toggle="modal" data-target="#restModal"><span class="glyphicon glyphicon-edit"></span> Edit</button>
              </div>

            </div>

          </div>

        </div>

        <div class="panel-footer content-detail" style="display:none;">
          <div class="btn-group btn-group-lg btn-group-justified" role="group">

            <div class="btn-group" role="group">
              <button type="button" class="btn btn-default btn-status" data-toggle="modal" data-target="#statusModal">
                <span class="glyphicon glyphicon glyphicon-stats"></span>
                Status
              </button>
            </div>
          </div>

        </br>

        <div class="btn-group btn-group-lg btn-group-justified" role="group">
          <div class="btn-group" role="group">
          <button type="button" class="btn btn-danger btn-leave" >
              <span class="glyphicon glyphicon-share-alt"></span>
              Leave
            </button>
          </div>
        </div>

        </div>

      </div>

    </div>

    <div class="col-md-4">
      <div class="panel panel-default window-panel" style="display:none;">

        <div class="panel-body">

          <div class="row">

            <div class="col-md-6">
              <h4 class="buffer" id="display-name">none</h4>
              <p class="buffer"><em>display name</em></p>
            </div>

            <div class="col-md-6">
              <button type="button" class="btn btn-info pull-right" id="editDisplay" data-toggle="modal" data-target="#displayModal"><span class="glyphicon glyphicon-edit"></span> Edit</button>
            </div>

          </div>

          </br>

          <div class="btn-group btn-group-justified" role="group">
            <div class="btn-group" role="group">
              <a href="<?php echo site_url('window'); ?>"  target="_blank" role="button" class="btn btn-info glyphicon glyphicon-new-window"> Display</a>
            </div>
          </div>

        </div>
      </div>

      <div class="panel panel-default window-panel" style="display:none;">

        <div class="panel-body">

          </br>

          <div class="btn-group btn-group-justified" role="group">
            <div class="btn-group" role="group">
              <button type="button" class="btn btn-success btn-resume" >
                <span class="glyphicon glyphicon-play"></span>
                Continue
              </button>
            </div>
          </div>

          </br>

          <div class="btn-group btn-group-lg btn-group-justified" role="group">
            <div class="btn-group" role="group">
              <button type="button" class="btn btn-warning btn-pause" >
                <span class="glyphicon glyphicon-pause btn-pause-glyph"></span>
                Pause
              </button>
            </div>
          </div>

        </br>

          <div class="btn-group btn-group-lg btn-group-justified" role="group">
            <div class="btn-group" role="group">
            <button type="button" class="btn btn-danger btn-close" >
                <span class="glyphicon glyphicon-alert"></span>
                Close
              </button>
            </div>
          </div>

        </br>

        <div class="btn-group btn-group-lg btn-group-justified" role="group">
          <div class="btn-group" role="group">
          <button type="button" class="btn btn-info btn-reset" >
              <span class="glyphicon glyphicon-refresh"></span>
              Reset
            </button>
          </div>
        </div>
        </div>
      </div>

    </div>
  </div>
</div>
