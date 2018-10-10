Axelerant custom module
=======================
> Axelerant custom module for interview does following things

* A new form text field named "Site API Key" needs to be added to the "Site Information" form with the default value of “No API Key yet”.
* When this form is submitted, the value that the user entered for this field should be saved as the system variable named "siteapikey".
* A Drupal message should inform the user that the Site API Key has been saved with that value.
* When this form is visited after the "Site API Key" is saved, the field should be populated with the correct value.
* The text of the "Save configuration" button should change to "Update Configuration".
* This module also provides a URL that responds with a JSON representation of a given node with the content type "page" only if the previously submitted API Key and a node id (nid) of an appropriate node are present, otherwise it will respond with "access denied".

Resource used
====================
https://drupal.stackexchange.com/questions/258884/error-running-browsertest-drupal-core-config-schema-schemaincompleteexception
https://api.drupal.org/api/drupal

Total time to complete
======================
4.30 Hrs (2.30 Hrs for module code + 2 hrs for test code)
















