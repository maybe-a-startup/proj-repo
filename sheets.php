<html>
  <head></head>
  <body>
    <!--
    BEFORE RUNNING:
    ---------------
    1. If not already done, enable the Google Sheets API
       and check the quota for your project at
       https://console.developers.google.com/apis/api/sheets
    2. Get access keys for your application. See
       https://developers.google.com/api-client-library/javascript/start/start-js#get-access-keys-for-your-application
    3. For additional information on authentication, see
       https://developers.google.com/sheets/api/quickstart/js#step_2_set_up_the_sample
    -->
    <script>
    function makeApiCall() {
      var params = {
        // The spreadsheet to request.
        spreadsheetId: '1mbkeUFDWS6Uz6tByvvmqv1a6KiVF76z9iK_PGgGz7mY',  // TODO: Update placeholder value.

        // The ranges to retrieve from the spreadsheet.
        ranges: 'Sheet1',  // TODO: Update placeholder value.


        // valueRenderOption: 'FORMATTED_VALUE',
        // True if grid data should be returned.
        // This parameter is ignored if a field mask was set in the request.
        // includeGridData: false,  // TODO: Update placeholder value.
      };

      var request = gapi.client.sheets.spreadsheets.get(params);
      request.then(function(response) {
        // TODO: Change code below to process the `response` object:
        console.log(response.result);
        populatesheets(response.result);
      }, function(reason) {
        console.error('error: ' + reason.result.error.message);
      });
    }

    function initClient() {
      var API_KEY = 'AIzaSyBAnJzM4YmLbqQXg5C66nSFR_lYp9fkVOM';  // TODO: Update placeholder with desired API key.

      var CLIENT_ID = '197100295917-g78aciudr36rh0abac9painip85fbb68.apps.googleusercontent.com';  // TODO: Update placeholder with desired client ID.

      // TODO: Authorize using one of the following scopes:
      //   'https://www.googleapis.com/auth/drive'
      //   'https://www.googleapis.com/auth/drive.file'
      //   'https://www.googleapis.com/auth/drive.readonly'
      //   'https://www.googleapis.com/auth/spreadsheets'
      //   'https://www.googleapis.com/auth/spreadsheets.readonly'
      var SCOPE = 'https://www.googleapis.com/auth/spreadsheets.readonly';

      gapi.client.init({
        'apiKey': API_KEY,
        'clientId': CLIENT_ID,
        'scope': SCOPE,
        'discoveryDocs': ['https://sheets.googleapis.com/$discovery/rest?version=v4'],
      }).then(function() {
        gapi.auth2.getAuthInstance().isSignedIn.listen(updateSignInStatus);
        updateSignInStatus(gapi.auth2.getAuthInstance().isSignedIn.get());
      });
    }

    function populatesheets(results) {
      for(var row=0;row<20;row++){
        for(var col=0;col<3;col++) {
          document.getElementById(row+":"+col).value = results.values[row][col];
        }
      }
    }

    function handleClientLoad() {
      gapi.load('client:auth2', initClient);
    }

    function updateSignInStatus(isSignedIn) {
      if (isSignedIn) {
        makeApiCall();
      }
    }

    function handleSignInClick(event) {
      gapi.auth2.getAuthInstance().signIn();
    }

    function handleSignOutClick(event) {
      gapi.auth2.getAuthInstance().signOut();
    }
    </script>
    <script async defer src="https://apis.google.com/js/api.js"
      onload="this.onload=function(){};handleClientLoad()"
      onreadystatechange="if (this.readyState === 'complete') this.onload()">
    </script>
    <button id="signin-button" onclick="handleSignInClick()">Sign in</button>
    <button id="signout-button" onclick="handleSignOutClick()">Sign out</button>
    <div style="margin-left: auto; margin-right: auto; width: 960px;"></div>

    <?php

    for($row = 0;$row < 20 ;$row++){
      echo "<div style='clear:both'>";
      for($col = 0;$col < 3;$col++){
        echo "<input type='text' style='float:left;' name='$row:$col' id='$row:$col'>";
      }
      echo "</div>";
    }


    ?>

  </body>
</html>