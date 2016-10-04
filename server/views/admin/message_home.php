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

            <?=$this->insert('admin/snippets/alertBoxes', ['id' => 'createMessage'])?>

            <div>

              <p>
                Create a new message string that will be used by your application.
                The message key is a string or message key that will be used to reference the text.
                The message id along with the locale will form the arguments of the request to textDB to
                retrieve a localized string.
              </p>

              <div class="form-group">
                <label class="control-label">Assign to catalogue:</label>
                <select name="catalogueName" class="form-control">
                  <?foreach ($catalogueList as $catalogueEntity): ?>
                  <option value="<?=$catalogueEntity->catalogueNamespace?>">
                    <?=$catalogueEntity->catalogueNamespace?>
                  </option>
                  <?endforeach;?>
                </select>
              </div>

              <div class="form-group">
                <label class="control-label">Message Options:</label>
                <div class="checkbox">
                  <label>
                    <input name="isPlural" js-checkbox-plural-forms type="checkbox" value="1">
                    This message has plural forms.
                  </label>
                </div>
              </div>

              <div js-form-block-no-plural>
                <div class="form-group">
                  <label for="inputMsgKey" class="control-label">Message key:</label>
                  <input name="messageKey" type="text" class="form-control" id="inputMsgKey" placeholder="project_homepage_heading">
                </div>

                <div class="form-group">
                  <label class="control-label">Message text:</label>
                  <textarea name="messageText" class="form-control" rows="3"></textarea>
                </div>
              </div>

              <div js-form-block-plural hidden>
                <div class="form-group">
                  <label for="inputMsgKey" class="control-label">Message key - Plural Form:</label>
                  <input name="messageKeyPlural" type="text" class="form-control" id="inputMsgKeyPluralOne" placeholder="catalog_item_count">
                </div>
                <div class="form-group">
                  <label class="control-label">Message text - Singular:</label>
                  <textarea name="messageText[one]" class="form-control" rows="3"></textarea>
                </div>

                <div class="form-group">
                  <label class="control-label">Message text - Plural:</label>
                  <textarea name="messageText[other]" class="form-control" rows="3"></textarea>
                </div>
              </div>

              <div class="form-group">
                <button js-btn-create-message type="button" class="btn btn-success">Create</button>
              </div>

            </div>

          </div>
        </div>

        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">Recent messages</h3>
          </div>
          <div class="panel-body">
            <p></p>
            <table class="table table-condensed table-striped table-bordered">
              <thead>
                <tr>
                  <th>Identifier</th>
                  <th>Text</th>
                  <th>Catalogue name</th>
                  <th>Locale</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?foreach ($messageListItems as $messageEntity): ?>
                <tr>
                  <td><?=$messageEntity->identifier?></td>
                  <td><?=$messageEntity->text?></td>
                  <td><?=$messageEntity->catalogueName?></td>
                  <td><?=$messageEntity->locale?></td>
                  <td>
                    <a class="btn btn-xs btn-default">edit</a>
                  </td>
                </tr>
                <?endforeach;?>
              </tbody>
            </table>
          </div>
        </div>

    </div>

</div>
<script type="text/javascript">
$(document).ready(function() {

  $('[js-checkbox-plural-forms]').click(function() {
    togglePluralFormBlock();
  });

  $('[js-btn-create-message]').click(function() {
    var catalogue_name = $('[name="catalogueName"]').val();
    var message_key_normal = $('[name="messageKey"]').val();
    var message_text_normal = $('[name="messageText"]').val();
    var message_key_one = $('[name="messageKeyPlural"]').val() + '_one';
    var message_key_other = $('[name="messageKeyPlural"]').val() + '_other';
    var message_text_one = $('[name="messageText[one]"]').val();
    var message_text_other = $('[name="messageText[other]"]').val();

    var is_plural_form = isPluralFormEnabled();

    var message_key_array = {};

    if(is_plural_form) {

      message_key_array[message_key_one] = message_text_one;
      message_key_array[message_key_other] = message_text_other;

    } else {
      message_key_array[message_key_normal] = message_text_normal;
    }

    $.ajax({
      type: "POST",
      url: '/admin.php/createMessage',
      data: {
        catalogue_name:catalogue_name,
        is_plural_form:is_plural_form,
        messages: message_key_array
      },
      complete: function(rawResponse) {
        response = rawResponse.responseJSON;
        if(response.success) {
          showAlert('createMessage','success','Successfully created!');
        } else {
          showAlert('createMessage','danger',response.message);
        }
      },
      dataType: 'json'
    });
  });

});

function isPluralFormEnabled() {
  return $('[js-checkbox-plural-forms]').prop('checked');
}

function togglePluralFormBlock() {
  $('[js-form-block-plural]').toggle('fade');
  $('[js-form-block-no-plural]').toggle('fade');
}

</script>