<?php

function Slide_00100_script($slide, $idx, $img) { ?>
<script>
    $("<?=$slide;?>-<?=$idx;?>").bind('deck.becameCurrent', function(ev, dir) {
        $("<?=$slide;?>-img").attr('src', "<?=$img;?>");
        $("<?=$slide;?>-img").attr('width', "350");
        $("<?=$slide;?>-div").delay(500).fadeIn(500);                    
    });
    $("<?=$slide;?>-<?=$idx;?>").bind('deck.lostCurrent', function(ev, dir) {
        $("<?=$slide;?>-div").hide();
    });
</script>
<?php 
}

function LastSlide($id) { ?>
<script>
    $("<?=$id;?>").bind('deck.becameCurrent', function(ev, dir) {
        $("#deck-status-id").addClass("endofseq");            
    });
    $("<?=$id;?>").bind('deck.lostCurrent', function(ev, dir) {
        $("#deck-status-id").removeClass("endofseq");            
    });
</script>
<?php
}


