/**
 * showDropdown:
 * - When an element with this function attached as an action is clicked/hovered,
 *   if it provides an element that represents the drop down menu as a parameter,
 *   this function will show or hide the drop down menu based on the canShow boolean
 * - The parameter will be a jquery object
 */
function showDropdown (dropdownElement, canShow)
{
	if (canShow)
	{
		dropdownElement.show();
	}
	else
	{
		dropdownElement.hide();
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
				$(allImages[mod((i+(1*direction)),allImages.length)]).css("left") == '975px' ||
				$(allImages[mod((i+(1*direction)),allImages.length)]).css("left") == '-975px'
			)
		)
		{
			$(allImages[i]).animate({left : (-975*(1*direction)) }, 1000);
			$(allImages[mod((i+(1*direction)),allImages.length)]).css({'left' : (975*(1*direction)) }).animate({left : '0px'}, 1000);
			
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