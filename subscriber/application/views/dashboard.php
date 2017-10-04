<div class="container-fluid">

  <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" data-backdrop="static">
    <div class="modal-dialog" role="document">
      <div class="modal-content">

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="editModalLabel"><strong>Edit</strong></h4>
        </div>

        <div class="modal-body">

          <label for="phonename">Phone Number</label>
          <input type="text" id="edit-phonenum" name="phonename" class="form-control">

        </br>

          <label for="college">College</label>
          <input type="text" id="edit-college" name="college" class="form-control">

        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default btn-edit" id="saveEdit" data-dismiss="modal">Save</button>
          <button type="button" class="btn btn-default " data-dismiss="modal">Cancel</button>
        </div>

      </div>
    </div>
  </div>
  
  <div class="row">

    <div class="col-sm-12 col-md-4">

      <div class="list-group list-group-class">

      </div>

    </div>

    <div class="col-sm-12 col-md-8">

          <div class="panel panel-default">
            <div class="panel-heading">
              <span class=" text-title"></span>
              <span class="text-status">ONGOING</span>
            </div>

            <div class="panel-body panel-body-toggle">

              <div class="row">

                <div class="col-sm-2 col-md-2">

                  <div class="well well-sm">
                    <h1 class="text-center text-current"></h1>
                    <h6 class="text-center">current</h6>
                  </div>

                </div>
                <div class="col-sm-2 col-md-2">

                  <div class="well well-sm">
                    <h1 class="text-center text-last"></h1>
                    <h6 class="text-center">last</h6>
                  </div>

                </div>

                <div class="col-sm-2 col-md-2">

                  <div class="well well-sm">
                    <h1 class="text-center text-self"></h1>
                    <h6 class="text-center">self</h6>
                  </div>

                </div>

                <div class="col-sm-6 col-md-6">

                  <div class="row">

                    <div class="col-sm-6 col-md-6">
                      <div class="media">

                        <div class="media-body">
                          <h4 class="media-heading">Description</h4>
                          <p class="text-desc"></p>
                        </div>

                      </div>

                      <div class="media">

                        <div class="media-body">
                          <h4 class="media-heading">Restriction</h4>
                          <p class="text-rest"></p>
                        </div>

                      </div>
                    </div>

                    <div class="col-sm-6 col-md-6">
                      <div class="media">

                        <div class="media-body">
                          <h4 class="media-heading">Requirements</h4>
                          <p class="text-req"></p>
                        </div>

                      </div>

                      <div class="media">

                        <div class="media-body">
                          <h4 class="media-heading">Venue</h4>
                          <p class="text-venue"></p>
                        </div>

                      </div>

                    </div>

                  </div>

                </div>

              </div>

            </div>

            <div class="panel-footer footer" style="display:none">
              <div class="btn-group btn-group-justified" role="group">
                <div class="btn-group" role="group">
                  <button type="button" class="btn btn-danger btn-leave">LEAVE!</button>
                </div>
              </div>
            </div>

          </div>

          <div class="panel panel-default">

            <div class="panel-heading">
              <input type="text" id="q-search-txt" name="qsearchtxt" class="form-control" placeholder="Queue" aria-describedby="sizing-addon1">
            </br>
              <div class="btn-group btn-group-justified" role="group">
                <div class="btn-group" role="group">
                  <button type="button" class="btn btn-success btn-join">JOIN!</button>
                </div>
              </div>

            </div>

            <div class="table-responsive">
              <table class="table table-hover">
                <thead>
                  <tr class="head">
                    <th>Queue Name</th>
                    <th>Serving at</th>
                    <th>Total Queuers</th>
                    <th>Offered Seats</th>
                    <th>Description</th>
                    <th>Restriction</th>
                    <th>Requirements</th>
                    <th>Venue</th>
                  </tr>
                </thead>
                <tbody id="q-tbl-body">
                </tbody>
              </table>
            </div>

          </div>

      </div>
    </div>


</div>
