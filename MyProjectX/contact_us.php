<?php
  include "header.php";
  if(!isset($_SESSION)){
    session_start();
  }
  if(isset($_SESSION['loggedIn'])){
    $chesh = $_SESSION['admin'];
    if($chesh === true){
      include "admin_navig_bar.php";
    }else{
    include "client_navig_bar.php";
    }
  }else{
    include "navig_bar.php";
  }

 ?>
 <!DOCTYPE html>
 <html>
 <head>
   <meta name = "viewport" content = "width = device-width, initial-scale = 1.0">
   <link rel = "stylesheet" href = "./css/contact_us_layout.css">
 </head>

 <body>
  <div class = "receptacle-background">
    <div class = "receptacle-init" >

      <div class = "rec-init">
        <h1 id = "contact-details">Individual Project</h1>
        <p id = "contact-details">Individual Project<br>Project X Bank<br>Birmingham,
          Street Rome<br>b2030AB<br> England, United Kingdom</p>
        </p>
      </div>

      <div class = "rec-init">
        <h1 id = "contact-details">Contact Details</h1>
        <p id = "contact-details">Email: projectX@projectX.com<br>Fax: 851-846-874-3654<br>
          Telephone: 0213443435<br>Phone: 0753838455</p>
        </p>
      </div>

      <div  id = "move" class = "rec-init">
        <h1 id = "contact-details">Working Days</h1>
          <table id = "rec-table" style="width:100%">
            <tr>
              <th id = "rec-table-header">Days</th>
              <th id = "rec-table-header">Opening times</th>
            </tr>
            <tr>
              <td>Monday</td>
              <td>09:00-17:00</td>
            </tr>
            <tr>
              <td>Tuesday</td>
              <td>09:00-17:00</td>
            </tr>
            <tr>
              <td>Wednesday</td>
              <td>09:00-17:00</td>
            </tr>
            <tr>
              <td>Thursday</td>
              <td>09:00-17:00</td>
            </tr>
            <tr>
              <td>Friday</td>
              <td>09:00-17:00</td>
            </tr>
            <tr>
              <td>Saturday</td>
              <td>11:00-15:00</td>
            </tr>
            <tr>
              <td>Sunday</td>
              <td>closed</td>
            </tr>
          </table>
          </p>
        </div>

      <div id = "move" class = "rec-init">
        <h1 id = "contact-details">Customer Service</h1>
        <p id = "contact-details">Email: ProjX.customerservice@projectX.com<br>Fax: 853-846-874-3654<br>
          Telephone: 0213643435<br>Phone: 0773835455</p>
        </p>
      </div>

    </div>

  </div>
  <footer>
    <div class ="Copyright">
	   	<p>Copyright&copy;2018 by Ofori Mintah Emmanuel. All rights reserved.</p>
	    <p>&reg;&#153;The page was last update on 16 of May of 2018.</p>
	  </div>
  </footer>
 </body>
