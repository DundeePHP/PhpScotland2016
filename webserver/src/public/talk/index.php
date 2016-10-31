
<div class="deck-container showGoTo white-background">
    
<?php
    include "helpers.php";
    
    // Load slides in numeric order.
    if($dh = opendir("slides")) {
        $files = array();
        while(($file = readdir($dh)) !== false) {
            if($file == '.' || $file == '..') continue;
            $info = pathinfo("slides" . DIRECTORY_SEPARATOR . $file);
            if($info['extension'] == 'php') {
                $file = "slides" . DIRECTORY_SEPARATOR . $file;
                $files[intval($info['basename'])] = $file;
            }
        }        
        closedir($dh);
        sort($files);
        foreach($files as $file) {
            include($file);
        }
    }
?>
    <!-- deck.navigation snippet -->
    <div aria-role="navigation">
      <a href="#" class="deck-prev-link" title="Previous">&#8592;</a>
      <a href="#" class="deck-next-link" title="Next">&#8594;</a>
    </div>

    <!-- deck.status snippet -->
    <p id="deck-status-id" class="deck-status" aria-role="status">
      <span class="deck-status-current"></span>
      /
      <span class="deck-status-total"></span>
    </p>

    <!-- deck.goto snippet -->
    <form action="." method="get" class="goto-form">
      <label for="goto-slide">Go to slide:</label>
      <input type="text" name="slidenum" id="goto-slide" list="goto-datalist">
      <datalist id="goto-datalist"></datalist>
      <input type="submit" value="Go">
    </form>

  </div>
