<?php
  $pageTitle = "Dynamic Website";
  $currentTime = date("Y-m-d H:i:s");
?>

<html>
  <head>
    <title><?= $pageTitle ?></title>
  </head>
  <body>
    <h1>Welcome to <?= $pageTitle ?></h1>
    <p id = "time">Current time: <?= $currentTime ?></p>
    <script>
      function updateTime(){
        fetch(window.location.href) 
          .then(response => response.text())
          .then(html =>{
            const parser = new DOMParser();
            const doc = parser.parseFromString(html, 'text/html');
            const newTime = doc.querySelector('#time').textContent;
            document.querySelector('#time').textContent = newTime;
          });
      }
      setInterval(updateTime, 1000);
    </script>
    <table>
      <thead>
        <tr>
          <td><strong>Key</strong></td>
          <td><strong>Value</strong></td>
        </tr>
      </thead>
      <tbody>
        <?php foreach($_SERVER as $key => $value) { ?>
          <tr>
            <td><?= $key ?></td>
            <td><?= $value ?></td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </body>
</html>