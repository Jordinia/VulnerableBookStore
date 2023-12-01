<?php
$koneksi = mysqli_connect("localhost", "root", "", "jorbarvbookstore");
if (mysqli_connect_errno()) {
    echo "Database connection failed : " . mysqli_connect_error();
}
?>
