<?$this->layout('admin/base')?>

<div class="row">
	<div class="col s12">
		<h1>Catalogue Panel</h1>

		<div class="card hoverable">
			<div class="card-content">
			  <span class="card-title">New Catalogue</span>
			  <p>A catalogue is like a namespace that holds a list of messages. The catalogue will provide some
			  context as to how the messages are related. Create new catalogues to store contextually related 
			  messages. For example, you may want to create a catalogue for each feature of your application.</p>
			  <br/>
			
				<div class="row">
					<div class="input-field col s12">
						<input 
							js-create-catalogue-input 
							value="" 
							placeholder="homepage/newsfeed-componant" 
							id="catalogueNameInput" 
							type="text" 
							class="validate" />
						<label for="catalogueNameInput">Catalogue name</label>
					</div>
				</div>

			</div>
			<div class="card-action">
			  <a js-create-catalogue-btn href="#">Create</a>
			</div>
		</div>

		<div class="card hoverable">
			<div class="card-content">
			  <span class="card-title">All Catalogues</span>
			  <p>All available catalogues are listed below. They will be ordered alphabetically.</p>
			  <ul class="collection">
		        <li class="collection-item"><div>homepage/leaderboard-componant<a href="#!" class="secondary-content"><i class="material-icons">launch</i></a></div></li>
		      </ul>
			</div>
			<div class="card-action">
			  <a js-create-catalogue-btn href="#">Refresh list</a>
			</div>
		</div>

	</div>

</div>
<script type="text/javascript">
$(document).ready(function() {

});
</script>