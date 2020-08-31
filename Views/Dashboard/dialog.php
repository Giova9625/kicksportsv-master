<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Tallas</title>
	<link rel="stylesheet" href="../../Resources/Css/normalize.css">
	<link rel="stylesheet" href="../../Resources/Css/sweetalert2.css">
	<link rel="stylesheet" href="../../Resources/Css/material.min.css">
	<link rel="stylesheet" href="../../Resources/Css/material-design-iconic-font.min.css">
	<link rel="stylesheet" href="../../Resources/Css/jquery.mCustomScrollbar.css">
	<link rel="stylesheet" href="../../Resources/Css/main.css">
</head>
<body>
    <button onclick="openDialog1()" type="button" class="mdl-button">Show Dialog 1</button>
    <button onclick="openDialog2()" type="button" class="mdl-button">Show Dialog 2</button>

    <dialog class="mdl-dialog" id="modal1">
      <h4 class="mdl-dialog__title">Allow data collection 1</h4>
      <div class="mdl-dialog__content">
        <p>
          Allowing us to collect data will let us get you the information you want faster.
        </p>
      </div>
      <div class="mdl-dialog__actions">
        <button type="button" class="mdl-button">Agree</button>
        <button onclick="dialog.close();" type="button" class="mdl-button">Disagree</button>
      </div>
    </dialog>

    <dialog class="mdl-dialog" id="modal2">
      <h4 class="mdl-dialog__title">Allow data collection 2</h4>
      <div class="mdl-dialog__content">
        <p>
          Allowing us to collect data will let us get you the information you want faster.
        </p>
      </div>
      <div class="mdl-dialog__actions">
        <button type="button" class="mdl-button">Agree</button>
        <button onclick="dialog.close();" type="button" class="mdl-button">Disagree</button>
      </div>
    </dialog>

    <script src="../../Resources/Js/jquery-3.4.1.min.js"></script>
	<script src="../../Resources/Js/material.min.js" ></script>
	<script src="../../Resources/Js/sweetalert2.min.js" ></script>
	<script src="../../Resources/Js/jquery.mCustomScrollbar.concat.min.js" ></script>
	<script src="../../Resources/Js/mainn.js" ></script>
    <script>
        

        function openDialog1()
        {
           let dialog = document.querySelector('#modal1');
            dialog.showModal();
        }

        function openDialog2()
        {
            let dialog = document.querySelector('#modal2');
            dialog.showModal();
        }
       
    </script>
  </body>
  </html>