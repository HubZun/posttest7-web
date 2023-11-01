<?php
session_start();
require "php/config.php";
$id = $_SESSION['id'];



$result = mysqli_query($con, "delete from users where Id = '$id'");


if ($result) {
    echo "
    <script>
    alert('Data Berhasil Dihapus!');
    document.location.href = 'index.php';
    </script>
    ";
} else {
    echo "
    <script>
    alert('Data Gagal Dihapus!');
    document.location.href = 'index.php';
</script>
";
}
