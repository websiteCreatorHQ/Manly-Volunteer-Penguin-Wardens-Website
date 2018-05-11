/**
 * toggleDropdown:
 * - When an element with this function attached as an action is clicked,
 *   if it provides an element that represents the drop down menu as a parameter,
 *   this function will toggle its display
 * - The parameter will be a jquery object
 */
function toggleDropdown (dropdownElement)
{
	/* Take note of whether element is visible or not
     */
	if (dropdownElement)
	{
		var elementIsVisible = dropdownElement.is(':visible');	
	}
	
	/* Hide all other dropdown menus that might be visible
     */
	$('.navDropdown').hide();
	
	/* Show the dropdown menu if it was hiding in the first place
	 */
	if (dropdownElement && !elementIsVisible)
	{
		dropdownElement.show();
	}
}

/**
 * runImageGallery:
 * - an element with img tags inside will be passed here,
 *   then all these img tags will be looped until it finds
 *   two, one to slide in and one to slide outerHTML
 * - this element will be a jquery object
 * - TODO: description about +1 or -1 in direction
 */
function runImageGallery(galleryElement, direction)
{
	var allImages = galleryElement.find('img');
	
	
	var toggledImages = false;
	for (var i = 0; i < allImages.length && !toggledImages; i++)
	{
		// If first image is visible and next image is not, toggle them both and stop loop
		if 
		(
			$(allImages[i]).css("left") == '0px' && 
			(
				$(allImages[mod((i+(1*direction)),allImages.length)]).css("left") == '800px' ||
				$(allImages[mod((i+(1*direction)),allImages.length)]).css("left") == '-800px'
			)
		)
		{
			$(allImages[i]).animate({left : (-800*(1*direction)) }, 1000);
			$(allImages[mod((i+(1*direction)),allImages.length)]).css({'left' : (800*(1*direction)) }).animate({left : '0px'}, 1000);
			
			toggledImages = true;
		}
	}
	
	if (!toggledImages)
	{
		$(allImages[0]).hide().css({left : '0'}).fadeIn();
	}
}

/**
 * mod:
 * - TODO: Description about modulo
 * - TODO: Description about negative numbers
 */
function mod(n, m)
{
	return ((n % m) + m) % m;
}