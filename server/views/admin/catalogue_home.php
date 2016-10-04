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
        <?=$this->insert('admin/snippets/alertBoxes', ['id' => 'createCatalogue'])?>
     		<p>A catalogue is like a namespace that holds a list of messages. The catalogue will provide some
           context as to how the messages are related. Create new catalogues to store contextually related
           messages. For example, you may want to create a catalogue for each feature of your application.</p>
        <div class="form-group">
          <label>Catalogue name:</label>
          <input js-input-catalogue-name type="text" class="form-control" placeholder="myFeatureName/hompage/landingPage">
        </div>
        <div class="form-group">
          <button js-btn-create-catalogue type="button" class="btn btn-success">Create</button>
        </div>
      </div>
    </div>

    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">All catalogues</h3>
      </div>
      <div class="panel-body">
        <p></p>
        <table class="table table-condensed table-striped table-bordered">
          <thead>
            <tr>
              <th>Name</th>
              <th>Date created</th>
              <th>Messages</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <?foreach ($catalogueListItems as $catalogueListItemEntity): ?>
            <tr>
              <td><?=$catalogueListItemEntity->catalogueNamespace?></td>
              <td><?=$catalogueListItemEntity->dateCreated?></td>
              <td><?=$catalogueListItemEntity->totalMessagesCount?></td>
              <td>
                <a class="btn btn-xs btn-default">edit</a>
                <a class="btn btn-xs btn-default">share</a>
              </td>
            </tr>
            <?endforeach;?>
          </tbody>
        </table>
        <div class="form-group">
          <!-- <button type="button" class="btn btn-success">Create</button> -->
        </div>
      </div>
    </div>

	</div>

</div>
<script type="text/javascript">
$(document).ready(function() {

  $('[js-btn-create-catalogue]').click(function() {

    var catalogue_name = $('[js-input-catalogue-name]').val();

    $.ajax({
      type: "POST",
      url: '/admin.php/createCatalogue',
      data: {name:catalogue_name},
      complete: function(rawResponse) {
        response = rawResponse.responseJSON;
        if(response.success) {
          showAlert('createCatalogue','success','Successfully created!');
        } else {
          showAlert('createCatalogue','danger',response.message);
        }
      },
      dataType: 'json'
    });

  });

});
</script>