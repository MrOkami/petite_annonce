<?php

foreach ($showUser as $users) {
    echo "<pre>" . json_encode($users, JSON_PRETTY_PRINT) . "</pre>";

}