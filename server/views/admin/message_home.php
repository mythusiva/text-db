<?$this->layout('admin/base')?>

<div class="row">
    <div class="col-xs-12">
    
        <div class="page-header">
          <h1>Message Panel <small>Create, view or edit messages.</small></h1>
        </div>


        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">Create message</h3>
          </div>
          <div class="panel-body">
            
            <div class="form-horizontal">
              
              <div class="form-group">
                <label class="col-xs-2 control-label">Catalogue</label>
                <div class="col-xs-10">
                  <select class="form-control">
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                  </select>
                </div>
              </div>

              <div class="form-group">
                <label for="inputMsgIdentifier" class="col-xs-2 control-label">Identifier</label>
                <div class="col-xs-10">
                  <input type="text" class="form-control" id="inputMsgIdentifier" placeholder="project_homepage_heading">
                </div>
              </div>

              <div class="form-group">
                <label class="col-xs-2 control-label">Text</label>
                <div class="col-xs-10">
                  <textarea class="form-control" rows="3"></textarea>
                </div>
              </div>

              <div class="form-group">
                <div class="col-xs-offset-2 col-xs-10">
                  <button type="button" class="btn btn-success">Create</button>
                </div>
              </div>

            </div>


          </div>
        </div>

    </div>

</div>
<script type="text/javascript">
$(document).ready(function() {
    $('select').material_select();
});
</script>