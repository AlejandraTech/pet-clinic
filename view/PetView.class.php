<?php
class PetView
{
	/**
	 * Display HTML files with include() (optional parameters by assigning them to NULL)
	 * This method can be called as:
	 * display();
	 * display("view/form/formName.php");
	 * display("view/form/formName.php", contentArray);
	 */
	public function display ($template = NULL, $content = NULL)
	{
		// MENU ZONE (TOP: NAVBAR)
		// include("view/menu/PetMenu.html"); ----> Las opciones relacionadas con Pet ya están incluidas en MainMenu.html

		// MIDDLE ZONE (CONTENT)
		if ($template != NULL) include($template);

		// MESSAGES ZONE (BOTTOM: INFO AND ERRORS)
		include("view/form/MessageForm.php");
	}
}
