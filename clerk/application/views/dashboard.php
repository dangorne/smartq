<div class="container-fluid">

  <div class="row">

    <div class="col-md-6">

      <div class="panel panel-default">

          <input type="text" id="q-search-txt"class="form-control" placeholder="Queue" aria-describedby="sizing-addon1">

      </div>

      <div class="panel panel-default">

        <div class="table-responsive">
          <table class="table table-hover">
            <thead>
              <tr class="head">
                <th>Queue Name</th>
                <th>Current</th>
                <th>Total</th>
                <th>Seats Offered</th>
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

    <div class="col-md-6">

      <div class="panel panel-default">

        <div class="btn-group btn-group-justified" role="group" aria-label="...">

          <div class="btn-group" role="group">
            <button type="button" class="btn btn-success btn-join"><span class="btn-join-glyph"></span>JOIN!</button>
          </div>

        </div>

      </div>

      <div class="panel panel-default">

        <div class="table-responsive table-queuer">
          <table class="table">
            <thead>
              <tr class="head">
                <th>Time Added</th>
                <th>Queue Number</th>
              </tr>
            </thead>
            <tbody id="q-tbl-queuer-body">

            </tbody>
          </table>

        </div>

      </div>

    </div>

  </div>
</div>
