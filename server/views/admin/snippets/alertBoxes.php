<div hidden <?=$id?>-js-alert-msg-success class="alert alert-dismissible alert-success" role="alert">
  <span></span>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<div hidden <?=$id?>-js-alert-msg-info class="alert alert-dismissible alert-info" role="alert">
  <span></span>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<div hidden <?=$id?>-js-alert-msg-warning class="alert alert-dismissible alert-warning" role="alert">
  <span></span>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<div hidden <?=$id?>-js-alert-msg-danger class="alert alert-dismissible alert-danger" role="alert">
  <span></span>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>

<script type="text/javascript">

if (typeof showAlert != 'function') { 
  function showAlert(id,level,message,delayTime) {
    if(!delayTime) {
      delayTime = 5000;
    }

    var alertTag = id + '-js-alert-msg-' + level;
    $('[' + alertTag + '] span:first').html(message);
    $('[' + alertTag + ']').slideDown().delay(delayTime).slideUp();
  }
}

</script>