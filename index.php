<?php
	if (!count($_GET))
	{
		header('Location: index.php?page=home.html');
	}
?>
<!doctype html>
<html>
	<head>
		<title>Manly Volunteer Penguin Wardens</title>
		
		<!--
			Meta tags for this website to be SEO friendly
		-->
		<meta charset="UTF-8">
		<meta name="description" content="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut malesuada sit amet purus eu sollicitudin. Duis pharetra convallis massa eget maximus. Curabitur in lorem in quam vehicula consectetur nec quis elit. Phasellus lacus ex, porta tempus odio sed, auctor pharetra diam. Mauris tincidunt mauris neque, id tempor quam blandit eu. Praesent felis tortor, laoreet eget massa a, dictum sagittis purus. Vivamus pellentesque tincidunt ligula. Vestibulum et mi id lacus aliquam rhoncus nec id sapien. In ut elit pellentesque, sodales arcu ut, facilisis nisl. Suspendisse vulputate rutrum nulla, quis sodales massa imperdiet a. Donec ut quam a felis sollicitudin mattis maximus et orci. Etiam cursus diam id convallis molestie. Suspendisse tincidunt aliquam risus ac pharetra. Proin id dolor purus. Cras egestas justo sit amet metus ultricies, ac posuere neque tincidunt." />
		<meta name="keywords"    content="Little Penguins,Manly Penguins,Little Penguins Habitat,Penguin Warden,Volunteer Penguin Warden" />
		<meta name="author"      content="Kevin S. Tran" />
		
		<!--
			How this website will look will be determined below
		-->
		<link href="https://fonts.googleapis.com/css?family=Itim" rel="stylesheet">
		<link rel="stylesheet" type='text/css' href="style.css" />
		
		<!--
			Javascript external libraries and files
		-->
		<script src="jquery-3.3.1.min.js"></script>
		<!--script src="jquery.ui.map.full.min.js"></script-->
		<script src="scripts/utilities.js"></script>
	</head>
	
	<body>
		
		<nav>
			<div class='navContainer'>
				<!--
					Logo on the left
				-->
				<div style='display:inline-block;'>
				
					<a href='index.php'><img src='images/penguin-warden-logo.png' height=auto width=100/></a>
					
				</div>
				
				<!--
					All other stuff on the right
			    -->
				<div style='display:inline-block;text-align:right;vertical-align:top;'>
				
					<!--
						The buttons on the navigation bar, 
						the buttons with buttons inside them are the
						buttons with dropdown menus
					-->
					<a href='index.php?page=home.html'><div class='navButton'>Home</div></a>
					
					<div class='navButton' onmouseover='showDropdown($("#menuAbout"), true);' onmouseout='showDropdown($("#menuAbout"), false);'>
						About
						<div class='navDropdown' id='menuAbout'>
							<a href='index.php?page=whatWeDo.html&sect=about'>
								<div class='navButton'>What we do</div>
							</a>
							<a href='index.php?page=history.html&sect=about'>
								<div class='navButton'>History of Penguin Wardens</div>
							</a>
							<a href='index.php?page=contact.html&sect=about'>
								<div class='navButton'>Contact</div>
							</a>
						</div>
					</div>
					
					<div class='navButton' onmouseover='showDropdown($("#menuPenguins"), true);' onmouseout='showDropdown($("#menuPenguins"), false);'>
						Little Penguins
						<div class='navDropdown' id='menuPenguins'>
							<a href='index.php?page=life.html&sect=littlePenguins'>
								<div class='navButton'>Life as a Little Penguin</div>
							</a>
							<a href='index.php?page=important.html&sect=littlePenguins'>
								<div class='navButton'>Why are Little Penguins So Important?</div>
							</a>
							<a href='index.php?page=threats.html&sect=littlePenguins'>
								<div class='navButton'>Threats to survival</div>
							</a>
							<a href='index.php?page=habitat.html&sect=littlePenguins'>
								<div class='navButton'>Habitat</div>
							</a>
							<a href='index.php?page=protect.html&sect=littlePenguins'>
								<div class='navButton'>How you can protect Little Penguins</div>
							</a>
						</div>
					</div>
					
					<div class='navButton' onmouseover='showDropdown($("#menuInvolved"), true);' onmouseout='showDropdown($("#menuInvolved"), false);'>
						Get Involved
						<div class='navDropdown' id='menuInvolved'>
							<a href='index.php?page=volunteer.html&sect=getInvolved'>
								<div class='navButton'>Become a volunteer</div>
							</a>
							<a href='index.php?page=photographer.html&sect=getInvolved'>
								<div class='navButton'>Become our official photographer</div>
							</a>
							<a href='index.php?page=donate.html&sect=getInvolved'>
								<div class='navButton'>Donate</div>
							</a>
							<a href='index.php?page=learn.html&sect=getInvolved'>
								<div class='navButton'>Learn</div>
							</a>
						</div>
					</div>
					
					<!-- 
						Search bar
					-->
					<div>
						<form method='post' action='index.php?page=search.php'>
							<input type='text' name='searchQuery' />
							<input type='submit' value='Search'>
						</form>
					</div>
					
				</div>
			</div>
		</nav>
		
		
		<!--
			Click anywhere else to disable dropdown menus
		-->
		<div onclick='showDropdown($(".navDropdown"), false);'>
			<!--
				All other content will be displayed here,
				so that all pages will contain common elements
				like the navigation bar and the footer
			-->
			<?php
				$finalURL = "";
				/* If there is something in the url,
				 *  acquire information to load specific page
				 */
				if (count($_GET))
				{
					$finalURL .= "pages/";
					/* Acquire name of folder
					 */
					if (isset($_GET["sect"]))
					{
						$finalURL .= $_GET["sect"]."/";
					} 
					/* Acquire name of page
					 */
					if (isset($_GET["page"]))
					{
						$finalURL .= $_GET["page"];
					} 
				}
				/* Load the content if there is any
				 */
				if ($finalURL != "" && $finalURL !== "pages/")
				{
					include $finalURL;	
				}
			?>
		</div>
			
			
		
		<!--
			Our footer
		-->
		<footer>
			<div class="footerContainer">
				
				<div class="footerPanel">
					<h4>Contact Information</h4>
					
					<!-- SAME AS CONTACT PAGE, NEED CONSIDERATION -->
					<p>
						<strong>Manly Council</strong> (02) 9976 1500 <br />
						<strong>Manly Environment Centre office</strong> and <a href='mailto:mec@manly.nsw.gov.au '>mec@manly.nsw.gov.au</a> <br />
						<strong>The National Parks and Wildlife Duty Officer</strong> (02) 9457 9577 to report any dogs, cats or foxes in critical habitat areas or anyone disturbing little penguins and their nests. <br />
					</p>
				</div>
				
				<div class="footerPanel">
					<h4>Social Media</h4>
					
					<a href="#" style="text-decoration:none">
						<img 
							width=48 height=48
							src='https://www.shareicon.net/data/512x512/2016/08/01/640091_media_512x512.png' 
							alt="There's supposed to be a facebook logo here"
						/>
					</a>
					<a href="#" style="text-decoration:none">
						<img 
							width=48 height=48
							src='https://www.shareicon.net/data/512x512/2016/08/01/640100_text_512x512.png' 
							alt="There's supposed to be a twitter logo here"
						/>
					</a>
					<a href="#" style="text-decoration:none">
						<img 
							width=48 height=48
							src='https://www.shareicon.net/data/512x512/2016/08/01/640092_media_512x512.png' 
							alt="There's supposed to be a google plus logo here"
						/>
					</a>
					
				</div>
				
				<div class="footerPanel">
					<h4>Subscribe to newsletter</h4>
					<br />
					<div style="width:200px;display:inline-block;">
						<form action="index.php?pages=home.html" id="subscribeForm" style='text-align:left;'>
							<div id="subscribeMessage"></div>
							<input type='email' name='subscribeEmail' placeholder='E-mail' style='width:100%;margin-bottom:5px;'/> <br/>
							<input type='submit' value='Subscribe' style='width:40%;border:none;border-radius:5px;' />
						</form>
					</div>
				</div>
				<!--
					Mock subscribe post handler
				-->
				<script>
					$('#subscribeForm').submit
					(
						function(event)
						{
							// don't load new page or anything
							event.preventDefault();
							
							// acquire data
							var currentForm = $(this);
							var newEmail = currentForm.find( "input[name='subscribeEmail']" ).val();
							var url = currentForm.attr("action");
							
							// post data
							var posting = $.post( url, { "newEmail" : newEmail } );
							
							/*
							 * METHOD TO HANDLE SUBSCRIBING HERE
							 *
							 */
							
							// update div to user end
							posting.done
							(
								function(data)
								{
									if (newEmail !== '')
									{
										$("#subscribeMessage").empty().append("<p style='text-align:center'><i>Thank you for subscribing</i></p>");
										$("#subscribeForm").find(" input[type=email] ").val("");
									}
									else
									{
										$("#subscribeMessage").empty().append("<p style='text-align:center'><i>Please enter your E-mail</i></p>");
									}
								}
							);
						}
					);
				</script>
				
			</div>
		</footer>
	
	</body>
</html>