<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
    <!--===============================================================================================-->
    	<link rel="stylesheet" type="text/css" href="../Modules/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    	<link rel="stylesheet" type="text/css" href="../Modules/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    	<link rel="stylesheet" type="text/css" href="../Modules/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
    <!--===============================================================================================-->
    	<link rel="stylesheet" type="text/css" href="../Modules/animate/animate.css">
    <!--===============================================================================================-->
    	<link rel="stylesheet" type="text/css" href="../Modules/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    	<link rel="stylesheet" type="text/css" href="../Modules/animsition/css/animsition.min.css">
    <!--===============================================================================================-->
    	<link rel="stylesheet" type="text/css" href="../Modules/select2/select2.min.css">
    <!--===============================================================================================-->
    	<link rel="stylesheet" type="text/css" href="../Modules/daterangepicker/daterangepicker.css">
    <!--===============================================================================================-->
    	<link rel="stylesheet" type="text/css" href="../Modules/util.css">
    	<link rel="stylesheet" type="text/css" href="css/main.css">
    <!--===============================================================================================-->

    <title>noteX</title>
  </head>
  <body>

    <div class="limiter">
      <div class="container-login100" style="background-image: url('images/bg-pattern.png');">
        
        <div class="notes100-signout-button-area justify-content-end">
          <form method="post">
            <button name="logout" value="true" class="notes100-button-shape px-2" id="logoutToastMessage">
              Logout
            </button>
          </form>
        </div>

        <div class="wrap-login100 p-t-30 p-b-50">
          <div class="notes100-form-title p-b-41">
            My Notes
          </div>

          <div class="wrap-notes100">
            <div class="container-fluid py-4">

            </div>
          </div>

        </div>

        <div class="add-note-section">

          <div class="card add-note-card">
            <div class="card-body">
              <div class="d-flex flex-row justify-content-between">
                <h5 class="card-title user-select-none">Add Note</h5>
                <div class="hide-add-note-card-button-area">
                  -
                </div>
              </div>

              <hr>
                <input id="noteOwnerID" type="hidden" name="noteOwner" value="<?php echo $_SESSION['userId']; ?>">
                <input id = "noteDate" type="hidden" name = "noteDate" value = "<?php echo date('d.m.Y - H:i:s'); ?>">

                <label for="noteTitleInput">Note Title: <span class="existingTitleLength">50</span></label>
                <input id="noteTitleInput" class="noteTitleInput form-control mb-2 " type="text" name="noteTitle" placeholder="Note Title" maxlength="50">
                
                <label for="noteContentInput">Note Content: <span class="existingContentLength">500</span></label>
                <textarea id="noteContentInput" class="noteContentInput form-control mb-2" name="noteContent" rows="5" cols="1" placeholder="Note Content" maxlength="500"></textarea>

                <button class="btn btn-outline-dark w-100 mb-2" id="submit-add-note-button" disabled>Add Note</button>

                <!--
                <div class="d-flex flex-row justify-content-between">
                  <button type="button" class="btn btn-outline-success w-100" id="liveToastBtn">Add</button>
                  <button type="button" class="btn btn-outline-danger w-100" id="liveToastBtn2">Delete</button>
                </div>
-->
            </div>
          </div>

        </div>

        <div class="show-add-note-section-area">
          <div class="show-add-note-section-button">
            +
          </div>
        </div>

      </div>
    </div>

    <!--This div is determining the position of toast.-->
    <div class="position-fixed w-100 top-0 p-3 justify-content-center" style="z-index: 11">
      <div id="logoutToast" class="toast hide align-items-center text-white bg-success border-0 my-2 w-100" style="max-width: 400px;" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
          <div class="toast-body">
            Account is being logged out.
         </div>
          <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
      </div>

    <div class="position-fixed w-100 top-0 p-3 justify-content-center" style="z-index: 11">
      <div id="toast1" class="toast hide align-items-center text-white bg-success border-0 my-2 w-100" style="max-width: 400px;" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
          <div class="toast-body">
          Note added successfully.
         </div>
          <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
      </div>

      <div id="toast2" class="toast hide align-items-center text-white bg-danger border-0 my-2 w-100" style="max-width: 400px;" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
          <div class="toast-body">
          The another Toast message. Note deleted succesfully.
         </div>
          <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
      </div>

    </div>

    <!--===============================================================================================-->
    	<script src="../Modules/jquery/jquery-3.6.0.min.js"></script>
    <!--===============================================================================================-->
    	<script src="../Modules/animsition/js/animsition.min.js"></script>
    <!--===============================================================================================-->
    	<script src="../Modules/popperjs/popper.js"></script>
    	<script src="../Modules/bootstrap/js/bootstrap.min.js"></script>
    <!--===============================================================================================-->
    	<script src="../Modules/select2/select2.min.js"></script>
    <!--===============================================================================================-->
    	<script src="../Modules/daterangepicker/moment.min.js"></script>
    	<script src="../Modules/daterangepicker/daterangepicker.js"></script>
    <!--===============================================================================================-->
    	<script src="../Modules/countdowntime/countdowntime.js"></script>
    <!--===============================================================================================-->
    	<script src="js/main.js"></script>
  </body>
</html>
