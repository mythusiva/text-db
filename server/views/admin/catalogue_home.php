<?$this->layout('admin/base')?>

<div class="row">
	<div class="col-xs-12">

		<div class="page-header">
      <h1>Catalogue Panel <small>Create and view catalogues.</small></h1>
    </div>


    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">Create catalogue</h3>
      </div>
      <div class="panel-body">
        
        <div>

       		<p>A catalogue is like a namespace that holds a list of messages. The catalogue will provide some
             context as to how the messages are related. Create new catalogues to store contextually related 
             messages. For example, you may want to create a catalogue for each feature of your application.</p>
          
          <div class="form-group">
            <label for="inputMsgIdentifier">Name</label>
            <input type="text" class="form-control" id="inputMsgIdentifier" placeholder="myFeatureName/hompage/landingPage">
          </div>

          <div class="form-group">
            <button type="button" class="btn btn-success">Create</button>
          </div>

        </div>


      </div>

	</div>

</div>
<script type="text/javascript">
$(document).ready(function() {

});
</script>