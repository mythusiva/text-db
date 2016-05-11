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
            
            <div>

              <p>
                Create a new message string that will be used by your application. 
                The message identifier is a string or message key that will be used to reference the text.
                The message id along with the locale will form the arguments of the request to textDB to 
                retrieve a localized string.
              </p>
              
              <div class="form-group">
                <label class="control-label">Assign to catalogue:</label>
                <select class="form-control">
                  <option>1</option>
                  <option>2</option>
                  <option>3</option>
                  <option>4</option>
                  <option>5</option>
                </select>
              </div>

              <div class="form-group">
                <label for="inputMsgIdentifier" class="control-label">Message identifier:</label>
                <input type="text" class="form-control" id="inputMsgIdentifier" placeholder="project_homepage_heading">
              </div>

              <div class="form-group">
                <label class="control-label">Message text:</label>
                <textarea class="form-control" rows="3"></textarea>
              </div>

              <div class="form-group">
                <button type="button" class="btn btn-success">Create</button>
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