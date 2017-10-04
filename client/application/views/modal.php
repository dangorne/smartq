<div class="modal fade" id="statusModal" tabindex="-1" role="dialog" aria-labelledby="statusModalLabel" data-backdrop="static">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

      <div class="panel panel-default">

        <div class="panel-heading">
          <h1 class="text-center queue-num"><strong></strong></h1>
          <h6 class="text-center">serving</h6>
        </div>

        <div class="panel-body">

          <div class="page-header top-buffer">
            <h3 class="text-center id-num"></h3>
            <h6 class="text-center">id num</h6>
          </div>

          <div class="page-header top-buffer">
            <h3 class="text-center q-status"></h3>
            <h6 class="text-center">status</h6>
          </div>

          <h3 class="text-center q-total-sub"></h3>
          <h6 class="text-center">queuers</h6>

        </div>

        <div class="panel-footer">

          <div class="btn-group btn-group-lg btn-group-justified" role="group">

            <div class="btn-group" role="group">
              <button type="button" class="btn btn-success btn-next">
                <span class="glyphicon glyphicon-chevron-right btn-success-glyph"></span>
              </button>
            </div>

          </div>

        </div>

      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>

<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" data-backdrop="static">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="createModalLabel"><strong>Create</strong></h4>
      </div>

      <div class="modal-body">

          <label for="qname">Name</label>
          <input type="text" id="create-name" name="qname" class="form-control">

          <label for="qcode">Code</label>
          <input type="text" id="create-code" name="qcode" class="form-control">

          <label for="qseat">Seats Offered</label>
          <input type="text" id="create-seat" name="qseat" class="form-control">

          <label for="qdesc">Description</label>
          <input type="text" id="create-desc" name="qdesc" class="form-control">

          <label for="qreq">Requirements</label>
          <input type="text" id="create-req" name="qreq" class="form-control">

          <label for="qvenue">Venue</label>
          <input type="text" id="create-venue" name="qvenue" class="form-control">

          <label for="qrest">Restriction</label>
          <select id="create-rest" name="qrest" class="form-control">
            <option value="CAS">CAS</option>
            <option value="CED">CED</option>
            <option value="CASNR">CASNR</option>
            <option value="CEIT">CEIT</option>
          </select>

      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-create" data-dismiss="modal">Create</button>
      </div>

    </div>
  </div>
</div>

<div class="modal fade" id="seatModal" tabindex="-1" role="dialog" aria-labelledby="seatModalLabel" data-backdrop="static">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="seatModalLabel"><strong>Edit Seats Offered</strong></h4>
      </div>

      <div class="modal-body">

        <input type="text" id="new-seats" name="new-seats" class="form-control">

      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-edit" id="save-seats" data-dismiss="modal">Save</button>
        <button type="button" class="btn btn-default " data-dismiss="modal">Cancel</button>
      </div>

    </div>
  </div>
</div>

<div class="modal fade" id="descModal" tabindex="-1" role="dialog" aria-labelledby="descModalLabel" data-backdrop="static">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="descModalLabel"><strong>Edit Description</strong></h4>
      </div>

      <div class="modal-body">

        <textarea id="new-desc" class="form-control" rows="3"></textarea>

      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-edit" id="save-desc" data-dismiss="modal">Save</button>
        <button type="button" class="btn btn-default " data-dismiss="modal">Cancel</button>
      </div>

    </div>
  </div>
</div>

<div class="modal fade" id="reqModal" tabindex="-1" role="dialog" aria-labelledby="reqModalLabel" data-backdrop="static">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="reqModalLabel"><strong>Edit Requirements</strong></h4>
      </div>

      <div class="modal-body">

        <textarea id="new-req" class="form-control" rows="3"></textarea>

      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-edit" id="save-req" data-dismiss="modal">Save</button>
        <button type="button" class="btn btn-default " data-dismiss="modal">Cancel</button>
      </div>

    </div>
  </div>
</div>

<div class="modal fade" id="venueModal" tabindex="-1" role="dialog" aria-labelledby="venueModalLabel" data-backdrop="static">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="venueModalLabel"><strong>Edit Venue</strong></h4>
      </div>

      <div class="modal-body">

        <input type="text" id="new-venue" class="form-control">

      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-edit" id="save-venue" data-dismiss="modal">Save</button>
        <button type="button" class="btn btn-default " data-dismiss="modal">Cancel</button>
      </div>

    </div>
  </div>
</div>

<div class="modal fade" id="restModal" tabindex="-1" role="dialog" aria-labelledby="restModalLabel" data-backdrop="static">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="restModalLabel"><strong>Edit Restriction</strong></h4>
      </div>

      <div class="modal-body">

        <input type="text" id="new-rest" class="form-control">

      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-edit" id="save-rest" data-dismiss="modal">Save</button>
        <button type="button" class="btn btn-default " data-dismiss="modal">Cancel</button>
      </div>

    </div>
  </div>
</div>

<div class="modal fade" id="displayModal" tabindex="-1" role="dialog" aria-labelledby="displayModalLabel" data-backdrop="static">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="displayModalLabel"><strong>Edit display Name</strong></h4>
      </div>

      <div class="modal-body">

        <input type="text" id="new-display" name="new-display" class="form-control">

      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-edit" id="save-display" data-dismiss="modal">Save</button>
        <button type="button" class="btn btn-default " data-dismiss="modal">Cancel</button>
      </div>

    </div>
  </div>
</div>
