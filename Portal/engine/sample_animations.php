<?php

	print "<div class='row'>
		<div class='container'>
			
			<div class='col-sm-12 col-md-6' id='1'>
				<div class='thumbnail'>
					<div class='embed-responsive embed-responsive-4by3'>
						<embed class='embed-responsive-item' src='data/anim/1.swf'></embed>
					</div>
					<div class='caption'>
						<h3>Típusa</h3>
						<p>Száma: X</p>
					</div>
				</div>
			</div>
			<div class='col-sm-12 col-md-6' id='2'>
				<div class='thumbnail'>
					<div class='embed-responsive embed-responsive-4by3'>
						<embed class='embed-responsive-item' src='data/anim/2.swf'></embed>
					</div>
					<div class='caption'>
						<h3>Típusa</h3>
						<p>Száma: X</p>
					</div>
				</div>
			</div>
			<div class='col-sm-12 col-md-6'>
				<div class='thumbnail'>
					<div class='embed-responsive embed-responsive-4by3'>
						<embed class='embed-responsive-item' src='data/anim/3.swf'></embed>
					</div>
					<div class='caption'>
						<h3>Típusa</h3>
						<p>Száma: X</p>
					</div>
				</div>
			</div>
			<div class='col-sm-12 col-md-6'>
				<div class='thumbnail'>
					<div class='embed-responsive embed-responsive-4by3'>
						<embed class='embed-responsive-item' src='data/anim/4.swf'></embed>
					</div>
					<div class='caption'>
						<h3>Típusa</h3>
						<p>Száma: X</p>
					</div>
				</div>
			</div>
			<div class='col-sm-12 col-md-6'>
				<div class='thumbnail'>
					<div class='embed-responsive embed-responsive-4by3'>
						<embed class='embed-responsive-item' src='data/anim/5.swf'></embed>
					</div>
					<div class='caption'>
						<h3>Típusa</h3>
						<p>Száma: X</p>
					</div>
				</div>
			</div>
			<div class='col-sm-12 col-md-6'>
				<div class='thumbnail'>
					<div class='embed-responsive embed-responsive-4by3'>
						<embed class='embed-responsive-item' src='data/anim/6.swf'></embed>
					</div>
					<div class='caption'>
						<h3>Típusa</h3>
						<p>Száma: X</p>
					</div>
				</div>
			</div>
			<div class='col-sm-12 col-md-6'>
				<div class='thumbnail'>
					<div class='embed-responsive embed-responsive-4by3'>
						<embed class='embed-responsive-item' src='data/anim/7.swf'></embed>
					</div>
					<div class='caption'>
						<h3>Típusa</h3>
						<p>Száma: X</p>
					</div>
				</div>
			</div>
			<div class='col-sm-12 col-md-6'>
				<div class='thumbnail'>
					<div class='embed-responsive embed-responsive-4by3'>
						<embed class='embed-responsive-item' src='data/anim/8.swf'></embed>
					</div>
					<div class='caption'>
						<h3>Típusa</h3>
						<p>Száma: X</p>
					</div>
				</div>
			</div>
			
			
		</div>
	</div>
	
	<script>
	$(document).ready(function(){
		$('.animbutton').on('click',function(){
			var p = $(this).parents().get(3);
			p.toggleClass('col-md-6');
		});
	});
	</script>
	";

?>
