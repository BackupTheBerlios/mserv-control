// open_win function
// INPUT:	stringURL : the URL to open
//		winW      : Width of window
//		winH      : Height of window
// OUTPUT:	Will open a new browser window
//		with the strinURL location.
// AUTHOR:	dZ <dz@caribe.net>

function open_win(stringURL, winW, winH, winX, winY) {

	// Arbitrary "MAGIC" values have been restored.
	// It just works better this way, in every browser
	//     -dZ.
	//
	BorderSize   = 4;  // 4px wide
	TitleBarIE   = 14; // 14px per IE toolbar
	TitleBarNN   = 20; // 20px per NN toolbar
	ToolBar      = 'yes'; // Karen wants this
	StatBar      = 'yes'; 
	MenuBar      = 'yes'; // and this...
	Sizable      = 'yes';

	if (!(winX && winY)) {	
		winX = ((screen.width  / 2) - (winW / 2));
		winY = ((screen.height / 2) - (winH / 2));
	}	
	if (winW && winH) {
		ToolBar      = 'no';
		StatBar      = 'no';
		MenuBar      = 'no';
		Sizable      = 'no';
	} else {
		if ( is_IE() ) {
			winX = window.screenLeft - BorderSize;
			winX = (winX <= 0) ? 1 : (winX);

			// Don't ask me... THEY WORK! fuckit!
			winY = window.screenTop - (TitleBarIE * 7) - 1;
			winW = document.body.offsetWidth - BorderSize;
			winH = document.body.offsetHeight - TitleBarIE - BorderSize;

		} else {
			winX = window.screenX;
			winY = window.screenY + TitleBarNN + BorderSize - 1;
			winW = window.outerWidth - (BorderSize * 3);

			// Same here... oh well!
			winH = window.outerHeight - (TitleBarNN * 7) + BorderSize + 1;
		}
	}

	var win_args=	"scrollbars"+
			",toolbar="+ToolBar+
			",status="+StatBar+
			",menubar="+MenuBar+
			",resizable="+Sizable+
			",location=no"+
			",width="+winW+
			",height="+winH+
			",left="+winX+
			",top="+winY+
			",screenX="+winX+
			",screenY="+winY;

	win_kid = window.open(stringURL, "winSpawnie", win_args);
	win_kid.opener = self;

	if (navigator.appName == 'Netscape') {
		win_kid.focus();
	}
}

