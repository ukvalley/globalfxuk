<div id="op_status">
    @if(Session::has('success'))
        <div id="card-alert" class="alert alert-success">
          <div class="card-content green-text">
            <p>{{ Session::get('success') }}</p>
          </div>
          <button type="button" class="close green-text" data-dismiss="alert" aria-label="Close">
           <!-- <span aria-hidden="true">×</span>-->
          </button>
        </div>
    @endif 

    @if(Session::has('error'))
        <div id="card-alert" class="alert alert-danger">
          <div class="card-content red-text">
            <p>{{ Session::get('error') }}</p>
          </div>
          <button type="button" class="close red-text" data-dismiss="alert" aria-label="Close">
            <!--<span aria-hidden="true">×</span>-->
          </button>
        </div>
    @endif
</div>