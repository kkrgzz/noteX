const constantsJSON = '[{"webSiteTitle" : "noteX"}]';

var constants = JSON.parse(constantsJSON);

// Change the window title with javascript.
document.title = constants[0].webSiteTitle;
