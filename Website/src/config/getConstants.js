const constantsJSON = '[{"webSiteTitle"    : "noteX","loginPageTitle"  : "noteX - Login","signupPageTitle" : "noteX - Signup"}]';

var constants = JSON.parse(constantsJSON);

// Change the window title with javascript.
document.title = constants[0].loginPageTitle;
