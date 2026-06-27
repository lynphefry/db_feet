<?php

$conn = mysqli_connect(
    "localhost",
    "root",
    "",
    "feet_to_fit"
);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}