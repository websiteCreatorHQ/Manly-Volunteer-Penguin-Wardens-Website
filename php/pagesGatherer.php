<?php
	/**
	 * page:
	 * - TODO: Add description
	 */
	class page
	{
		private $textString = '';
		private $metaTags = array();
		public $pageURL = '';
		/**
		 * TODO:
		 * - Description about fraction less than one
		 * - Description about higher relevancy the close to zero
		 */
		private $searchRelevanceRating = 1;
		
		function __construct($newString, $newTags, $newURL)
		{
			$this->textString = $newString;
			$this->metaTags = $newTags;
			$this->pageURL = $newURL;
			$this->searchRelevanceRating = 1;
		}
		
		/**
		 * acquireTitle:
		 * - TODO: Add description
		 */
		public function acquireTitle()
		{
			preg_match('/<title>(.*)<\/title>/', $this->textString, $match);
			if (count($match) > 1)
			{
				return $match[1];
			}
			return null;
		}
		/**
		 * acquireImage:
		 * - TODO: Add description
		 */
		public function acquireFirstImage()
		{
			preg_match('/<img([^>]*)/', $this->textString, $match);
			if (count($match) > 1)
			{
				return $match[1];
			}
			return null;
		}
		
		public function acquireDescription()
		{
			return $this->metaTags['description'];
		}
		/**
		 * acquireKeywords:
		 * - gets the keywords from the meta tags
		 *   splits the keywords string into an array,
		 *   and returns that result
		 */
		public function acquireKeywords()
		{
			return explode(',',$this->metaTags['keywords']);
		}
		public function acquireRating()
		{
			return $this->searchRelevanceRating;
		}
		/**
		 * assignRating:
		 * - acquires the search query and checks to see if page's
		 *   keywords match part or all of the query, and offers rating
		 *   accordingly
		 * - rating will be calculated by index of matching keyword if there is any,
		 *   divided by the length of total keywords, the earlier the keyword, the 
		 *   lower the rating
		 */
		public function assignRating($searchQuery)
		{
			$this->searchRelevanceRating = 2;
			
			$keyWords = $this->acquireKeywords();
			
			$foundMatch = false;
			$foundContains = false;
			for ($i = 0; $i < count($keyWords) && !$foundMatch; $i++)
			{
				/**
				 * Rate immediately if perfect match is found
                 */				 
				if (strtolower($keyWords[$i]) == strtolower($searchQuery))
				{
					$this->searchRelevanceRating = $i/count($keyWords);
					$foundMatch = true;
				}
				/**
				 * If part of keyword contains search query, rate it, then search for perfect match
				 */
				else if (strpos(strtolower($keyWords[$i]), strtolower($searchQuery)) !== false && !$foundContains)
				{
					$this->searchRelevanceRating = $i/count($keyWords);
					$foundContains = true;
				}
			}
		}
	}
	/**
	 * acquirePage:
	 * - converts file located in provided url
	 *   into a string, and returns a page object
	 *   containing that string
	 */
	function acquirePage($url, $pageName, $sect)
	{
		$newFile = fopen($url, 'r');
		$result = null;
		while(!feof($newFile))
		{
			$result .= fgets($newFile);
		}
		fclose($newFile);
		
		$finalLocation = 'page='.$pageName;
		if ($sect != '')
		{
			$finalLocation .= '&sect='.$sect;
		}
		
		return new page($result, get_meta_tags($url), 'index.php?'.$finalLocation);
	}
	/**
	 * acquireAllPages:
	 * - Acquires all pages in the server in string form
	 *   and returns an array of those strings
	 */
	function acquireAllPages()
	{
		$result = array();
		
		/* More variables needed to be added
		 * if more folders are added
		 */
		$pages = scandir('./pages');
		$pagesAbout = scandir('./pages/about');
		$pagesLittlePenguins = scandir('./pages/littlePenguins');
		$pagesGetInvolved = scandir('./pages/getInvolved');
	
		for ($i = 0; $i < count($pages); $i++)
		{
			preg_match('/(.html)$/', $pages[$i], $match);
			if (count($match) > 0)
			{
				array_push($result, acquirePage('./pages/'.$pages[$i], $pages[$i], ''));
			}
		}
		for ($i = 0; $i < count($pagesAbout); $i++)
		{
			preg_match('/(.html)$/', $pagesAbout[$i], $match);
			if (count($match) > 0)
			{
				array_push($result, acquirePage('./pages/about/'.$pagesAbout[$i], $pagesAbout[$i], 'about'));	
			}
		}
		for ($i = 0; $i < count($pagesLittlePenguins); $i++)
		{
			preg_match('/(.html)$/', $pagesLittlePenguins[$i], $match);
			if (count($match) > 0)
			{
				array_push($result, acquirePage('./pages/littlePenguins/'.$pagesLittlePenguins[$i], $pagesLittlePenguins[$i], 'littlePenguins'));	
			}
		}
		for ($i = 0; $i < count($pagesGetInvolved); $i++)
		{
			preg_match('/(.html)$/', $pagesGetInvolved[$i], $match);
			if (count($match) > 0)
			{
				array_push($result, acquirePage('./pages/getInvolved/'.$pagesGetInvolved[$i], $pagesGetInvolved[$i], 'getInvolved'));	
			}
		}
		
		return $result;
	}
	
	function displayPageResult($displayingPage)
	{
		echo '<div class="searchResult">';
		
		echo '<a href="'.$displayingPage->pageURL.'"><h2 style="margin-bottom:0px;">'.$displayingPage->acquireTitle().'</h2></a>';
		
		
		$pageImage = $displayingPage->acquireFirstImage();
		if ($pageImage != null)
		{
			echo 
			'
			<div style="padding:10px;float:left;overflow:hidden;width:200px;height:160px;">
				<a href="'.$displayingPage->pageURL.'">
					<img'.$pageImage.' style="height:100%;width:auto">
				</a>
			</div>
			';
		}
		
		echo '<div style="padding-left:10px;overflow:hidden;max-height:160px;"> <p>
				'.$displayingPage->acquireDescription().'
			  </p> </div>';
		
		echo '</div>';
	}
	/**
	 * dispalyPageColumn3:
	 * - TODO: Add description about displaying columns of page abstracts
	 * - TODO: Add description about home page using this
	 */
	function displayPageColumn3($displayingPage, $stringLength)
	{
		echo '<article class="column3">';
		
		echo '<h2 style="text-align:center;">'.$displayingPage->acquireTitle().'</h2>';
		
		echo '<div style="height:240px;overflow:hidden;"><p>';
		
		$pageImage = $displayingPage->acquireFirstImage();
		if ($pageImage != null)
		{
			echo 
			'
			<div style="overflow:hidden;width:200px;height:160px;">
				<a href="'.$displayingPage->pageURL.'">
					<img'.$pageImage.' style="height:100%;width:auto">
				</a>
			</div>
			';
		}
		$displayingContent = $displayingPage->acquireDescription();
		if (strlen($displayingContent) >= $stringLength)
			$displayingContent = substr($displayingContent, 0, $stringLength)." ... ";
		
		echo $displayingContent.'</p></div><br />';
			  
		echo 
		"
			<a href='".$displayingPage->pageURL."' style='margin-left:10px;'><i>Click image below for more</i><br /><br /></a>
			<div class='labeledImage'>
				<img
					src='".(($pageImage != null)? $pageImage : 'https://upload.wikimedia.org/wikipedia/commons/8/81/Eudyptula_minor_family_exiting_burrow.jpg')."' 
					alt='SAMPLE IMAGE'
				/>
				<a href='".$displayingPage->pageURL."'><div class='accompanyingLabel'><h4>".$displayingPage->acquireTitle()."</h4></div></a>
			</div>
		";
		
		echo '</article>';
	}
?>