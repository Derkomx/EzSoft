<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">

    <!------------------>
    <link rel="stylesheet" href="CSS/style-menu.css">
    <!----------------->

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;500;700&display=swap" rel="stylesheet">
    <title>-Ez Soft-</title>
    
</head>
<!-------de aca-------->

<nav role="navigation">
    <div id="menuToggle">
      <!--
      A fake / hidden checkbox is used as click reciever,
      so you can use the :checked selector on it.
      -->
      <input type="checkbox" />
  
      <!--
      Some spans to act as a hamburger.
      
      They are acting like a real hamburger,
      not that McDonalds stuff.
      -->
      <span></span>
      <span></span>
      <span></span>
  
      <!--
      Too bad the menu has to be inside of the button
      but hey, it's pure CSS magic.
      -->
      <ul id="menu">
        <a href="#">
          <li>Home</li>
        </a>
        <a href="#">
          <li>Administracion</li>
        </a>
        <a href="#">
          <li>Ventas</li>
        </a>
        <a href="#">
          <li>Cargar Productos</li>
        </a> 
      </ul>
    </div>
  </nav>

<!-------hasta aca-------->


<body>
  <div>
      <?php
      include "paginas/login.html";
      ?>
  </div>
</body>
</html>