<?php

if (!isset($_SESSION['user'])) {
    header('Location: ./?page=signin');
    exit();
}
