<?php

$conn = mysqli_connect("localhost","root","", "web");

function register($data) 
{
  global $conn;

  $username = stripcslashes($data["username"]);
  $email = stripslashes($data["email"]);
  $password = mysqli_real_escape_string($conn,$data["password"]);
  $password2 = mysqli_real_escape_string($conn,$data["password2"]);


  //ngecek username sudah ada atau belum
  $result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");

  if(mysqli_fetch_assoc($result)) {
    echo "<script>
          alert('username sudah dipakai');
          </script>";
          return false;
  }
  if($password !== $password2) {
    echo "<script>
          alert('konfirmasi password tidak sesuai!');
          </script>";
          return false;
        } 
        
        //enkripsi password
        $password = password_hash($password, PASSWORD_DEFAULT);

  mysqli_query($conn, "INSERT INTO user VALUES('','$username', '$email', '$password')");
}
 return mysqli_affected_rows($conn);
?>