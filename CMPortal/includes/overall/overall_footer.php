    <?php include 'includes/footer.php'; ?>
	
	<!--  Scripts -->	
	
    <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script src="js/materialize.js"></script>
    <script src="js/init.js"></script>
	<script src="js/index.js"></script>
	<script type="text/javascript">
	    <!--
	    $('.datepicker').pickadate({
        selectMonths: true, // Creates a dropdown to control month
        selectYears: 250 // Creates a dropdown of 15 years to control year
        });
		$(document).ready(function(){
        $('.slider').slider({interval: 3000});
        });
		-->
    </script> 
	<script type="text/javascript">
		<!--
		// ===== Scroll to Top ==== 
		$(window).scroll(function() {
			if ($(this).scrollTop() >= 50) {        // If page is scrolled more than 50px
				$('#return-to-top').fadeIn(200);    // Fade in the arrow
			} else {
				$('#return-to-top').fadeOut(200);   // Else fade out the arrow
			}
		});
		$('#return-to-top').click(function() {      // When arrow is clicked
			$('body,html').animate({
				scrollTop : 0                       // Scroll to top of body
			}, 300);
		});
		$('.dropdown').dropdown({
            inDuration: 300,
            outDuration: 225,
            constrainWidth: false, // Does not change width of dropdown to that of the activator
            hover: true, // Activate on hover
            gutter: -17, // Spacing from edge
            belowOrigin: false, // Displays dropdown below the button
            alignment: 'right', // Displays dropdown with edge aligned to the left of button
            stopPropagation: false // Stops event propagation
        });
		-->
	</script>	
</body>
</html>