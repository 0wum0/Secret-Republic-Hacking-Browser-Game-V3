
<div class="panel-white panel-white-card text-center">
  <div class="panel-body">
    <div class="row">
      <div class="col-sm-3 col-xs-6" title="{$data.totalSeconds|floatval|number_format} seconds ">
          <small><span class="glyphicon glyphicon-time"></span></small> {$data.totalSeconds|sec2hms}
      </div>
      <div class="col-sm-3 col-xs-6">
        {$data.dataPoints|floatval|number_format} DATA POINTS
      </div>
      <div class="col-sm-3 col-xs-6">
        {$data.energy|floatval|number_format} <small><span class="glyphicon glyphicon-flash"></span></small>
      </div>
      <div class="col-sm-3 col-xs-6">
       {$data.money|floatval|number_format} $
      </div>

    </div>
  </div>
</div>