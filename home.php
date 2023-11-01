<?php 
    include("php/config.php");
    session_start();

    include("php/config.php");
    if(!isset($_SESSION['valid'])){
    header("Location: index.php");
    }
    $id = $_SESSION['id'];

   $query = mysqli_query($con,"SELECT * FROM users where Id = '$id' ");

//    $data = [];
//    while($result = mysqli_fetch_assoc($query)){
//    $data[]= $result;
// }

if (isset($_POST["ganti"])) {

    // UPLOAD GAMBAR
    $gambar = $_FILES['gambar']['name'];
    $explode = explode('.',$gambar);
    $ekstensi = strtolower(end($explode));
    $gambar_baru = "gambar1.$ekstensi";
    $tmp = $_FILES['gambar']['tmp_name'];

    if(move_uploaded_file($tmp, 'img/'.$gambar_baru)){
        $result = mysqli_query($con, "UPDATE users SET `gambar`='$gambar_baru' WHERE Id = '$id'");

    if ($result) {
        echo "
                <script>
                alert('gambar berhasi diganti!');
                document.location.href = 'home.php';
                </script>
            ";
    } else {
        echo "
            <script>
            alert('gambar gagal diganti!');
            document.location.href = 'home.php';
            </script>
        ";
        }
    }
}


?>
   

<!DOCTYPE html>
<html lang="en">
<head> 
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <link rel="icon" href="image/Resident-Evil-Logo.webp">
    <title>Home</title>
</head>
<body>
    <div class="nav">
        <div class="logo">
            <p><a href="home.php">Logo</a> </p>
        </div>
        
        <div class="right-links">
            <a href="index.html">RESIDENT EVIL</a>
            <a href="edit.php">Change Profile</a>
            <a href="delete.php">DELETE ACCOUNT</a>
            <a href="php/logout.php"> <button class="btn">Log Out</button> </a>
        </div>
        
    </div>
    <main>
            <?php while($row = mysqli_fetch_assoc($query)) : ?>
       <div class="main-box top">
          <div class="top">
            <div class="box">
                <p>Hello <b><?php echo $row["Username"] ?></b>, Welcome</p>
            </div>

            <div class="box">
                <p>Hari/Tanggal :
                    <?php
                        echo "<b>".date ("l")." ".date("d-M-Y")."</b>";
                    ?>
                </p>
            </div>

            <div class="box">
            <p>
            <?php
            date_default_timezone_set("Asia/jakarta");
            ?>
            <p>Jam Digital: <b><span id="jam" style="font-size:24"></span></b></p>
            
            <script type="text/javascript">
                window.onload = function() { jam(); }
            
                function jam() {
                    var e = document.getElementById('jam'),
                    d = new Date(), h, m, s;
                    h = d.getHours();
                    m = set(d.getMinutes());
                    s = set(d.getSeconds());
            
                    e.innerHTML = h +':'+ m +':'+ s;
            
                    setTimeout('jam()', 1000);
                }
            
                function set(e) {
                    e = e < 10 ? '0'+ e : e;
                    return e;
                }
            </script>
            
            </p>
            </div>


            <div class="box">
                <p>Your email is <b><?php echo $row["Email"] ?></b>.</p>
            </div>
          </div>
          <div class="bottom">
            <div class="box">
                <p>And you are <b><?php echo $row["Age"] ?> years old</b>.</p> 
            </div>
          </div>
          <div class="bottom">
              <div class="box">
                <img src="img/<?php echo $row["gambar"]?>" alt="" style="width : 500px; ">
                <form action="" method="post" enctype="multipart/form-data">
                <input type="file" name="gambar" id=""><br>
                <button type="submit" name="ganti">Ganti Gambar</button><br>
                <?php  
                if (isset($_POST['hapus'])){
                    $result = mysqli_query($con, "UPDATE users SET `gambar`='default.jpg' WHERE Id = '$id'");
                    if ($result) {
                        echo "
                                <script>
                                alert('gambar berhasi dihapus');
                                document.location.href = 'home.php';
                                </script>
                            ";
                    } else {
                        echo "
                            <script>
                            alert('gambar gagal dihapus!');
                            document.location.href = 'home.php';
                            </script>
                        ";
                        } 
                }
                ?>
                <button type="submit" name="hapus">Hapus Gambar</button>
            </form> 
        </div>
    </div>
       </div>
       <?php endwhile ?>

    </main>
</body>
</html>