<?php
	
	header("charset: utf-8");
	/*
	 * Kapcsolat az OS adatbázissal.
	 */
	require_once('mysql_class.php');
	$MySQL = new MySQL();
	session_start();
	
?>
<div class="row">
	<div class="container">
		<div class="btn-group btn-group-lg">
			<button type="button" class="btn btn-primary addbutton" data-action="newproject" data-toggle="modal" data-target="#addmodal">Új projekt</button>
			<button type="button" class="btn btn-primary addbutton" data-action="newsubject" data-toggle="modal" data-target="#addmodal">Új tantárgy</button>
			<button type="button" class="btn btn-primary addbutton" data-action="newsection" data-toggle="modal" data-target="#addmodal">Új fejezet</button>
			<button type="button" class="btn btn-primary addbutton" data-action="newresource" data-toggle="modal" data-target="#addmodal">Új elem</button>
		</div>
		<h2>Tantárgy</h2>
		<select class="form-control input-lg" name="tantargy">
			<option value="0">Válassz...</option>
			<?php
			$tantargyak = $MySQL->Query("SELECT id, fullname FROM subjects","multiassoc");
			foreach ($tantargyak as $t) {
				$default = ($t['id'] == $_SESSION['tantargy']) ? "selected" : "";
				print "<option value='".$t["id"]."' ".$default.">".$t["fullname"]."</option>";
			}
			?>
		</select>
		<h2>Szűkítés</h2>
		<p>
			<label for="amount">Megjelenő fejezetek:</label>
			<input type="text" id="amount" readonly style="border:0; color:#f6931f; font-weight:bold;">
		</p>
		<div id="slider-range"></div>
		<hr>
		
		<div id="sitecontent">
			<?php
			if (isset($_SESSION['tantargy'])){
				include "tantargy.php";
			}
			?>
		</div>
		
	</div>
</div>

<div id="addmodal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title" id="addmodalcim"></h4>
			</div>
			<div class="modal-body" id="addmodalcontent">
				
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-success" id="addsubmit">Küld</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<script>
	$( function() {
		$( "#slider-range" ).slider({
			range: true,
			min: 1,
			max: 20,
			values: [ 2, 10 ],
			slide: function( event, ui ) {
				$( "#amount" ).val( ui.values[ 0 ] + " - " + ui.values[ 1 ] );
			}
		});
		$( "#amount" ).val( $( "#slider-range" ).slider( "values", 0 ) + " - " + $( "#slider-range" ).slider( "values", 1 ) );
    
		$('.addbutton').on('click',function(){
			var action=$(this).attr('data-action');
			var cim=$(this).text();
			$("#addmodalcim").text(cim);
			$.ajax({
				method: "POST",
				url: "engine/addforms.php",
				data: { action: action }
			})
			.done(function( msg ) {
				$("#addmodalcontent").html(msg);
			});
		});
		
		$("#addsubmit").on("click",function(){
		$("#addform").submit(function(e){
			var PostData = $(this).serializeArray();
			var FormURL = $(this).attr("action");
			var MethodType = $(this).attr("method");
			$.ajax({
				url : FormURL,
				type: MethodType,
				data : PostData,
				success:function(data, textStatus, jqXHR) {
					$('#addmodalcontent').html(data);
				},
				error: function(jqXHR, textStatus, errorThrown) {
					$('#addmodalcontent').html("Sikertelen AJAX hívás!");
					console.log(data);
				}
			});
			e.preventDefault();
		});
		$("#addform").submit();
		});
		
		$("select[name=tantargy]").on('change', function() {
			$.post( "engine/tantargy.php?id="+this.value, function( data ) {
				$( "#sitecontent" ).html( data );
			});
		});
		
	});
</script>
