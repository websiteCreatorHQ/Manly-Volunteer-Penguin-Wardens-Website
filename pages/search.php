<?php
	require_once('./php/pagesGatherer.php');
	
	$displayBlock = '';
	
	/**
	 * Acquire query entered in search bar
	 */
	$searchQuery = '';
	if 
	(
		isset($_POST['searchQuery']) && 
		(
			!empty($_POST['searchQuery']) 
			|| 
			is_numeric($_POST['searchQuery']) //for '0' case
		)
	)
	{
		$searchQuery = htmlspecialchars($_POST['searchQuery']);
	}
	
	/**
     * Acquire all the files
	 */
	$allPages = acquireAllPages();
	
	/**
	 * Add rating to results based on search query,
	 * and add to displayingPages
	 */
	$displayingPages = array();
	if ($searchQuery != '')
	{
		for ($i = 0; $i < count($allPages); $i++)
		{
			$allPages[$i]->assignRating($searchQuery);
			if ($allPages[$i]->acquireRating() <= 1)
			{
				array_push($displayingPages, $allPages[$i]);
			}
		}
	}
	/**
	 * Sort displaying pages by rating, in ascending order
	 */
	usort
	(
		$displayingPages, 
		function($a, $b)
		{ 
			if ($a->acquireRating() == $b->acquireRating()) 
				return 0; 
			return $a->acquireRating() < $b->acquireRating() ? -1 : 1; 
		}
	);
	
	if (count($displayingPages) <= 0)
	{
		echo 
		'
			<p style="margin:0 auto;width:560px;padding:10px;text-align:center;">
			'
				.
				(
					($searchQuery != '') ? 
					'<i>There\'s nothing for <strong>'.$searchQuery.'</strong></i>':
					'<i>Write something in the search bar</i>'
				)
				.
			'
			</p>
		';
	}
	else
	{
		echo '<h1 style="margin:0 auto;width:560px;">Displaying results for : <i>'.$searchQuery.'</i></h1>';
		for ($i = 0; $i < count($displayingPages); $i++)
		{
			displayPageResult($displayingPages[$i]);
		}
	}
?>
<!doctype html>
<html>
	<body>
		<?php //echo $displayBlock; ?>
	</body>
</html>