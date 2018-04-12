<?php
     require "header.php";

     session_start();
     if(!isset($_SESSION['email']) || empty($_SESSION['email'])){
       header("location: welcome.php");
       exit;
     }
     if(!isset($_SESSION['id']) || empty($_SESSION['id'])){
       header("location: welcome.php");
       exit;
     }
     require_once 'config.php';
     require_once 'Address.php';
     $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

     // Check connection
     if($link === false){
         die("ERROR: Could not connect. " . mysqli_connect_error());
     }
     $type = $type_err ="";


      $sql = "SELECT PROFILE.PROFILE_ID,
                     PROFILE.FIRST_NAME,
                     PROFILE.LAST_NAME ,
                     PROFILE.STREET ,
                     PROFILE.CITY,
                     PROFILE.STATE ,
                     PROFILE.COUNTRY,
                     PROFILE.ZIPCODE
             FROM PROFILE


                  GROUP BY
                    PROFILE.LAST_NAME,
                    PROFILE.FIRST_NAME
                  ORDER BY
                    PROFILE.LAST_NAME,
                    PROFILE.FIRST_NAME";

      $stmt = $link->prepare($sql);
      $stmt->execute();
      $stmt->store_result();
      $stmt->bind_result($Name_ID,
                         $Name_First,
                         $Name_Last,
                         $Street,
                         $City,
                         $State,
                         $Country,
                         $ZipCode);





?>

  <body>
    <h1>Hi, ADMIN<b><?php
    echo $_SESSION['email'];
     ?></b>. Welcome
    <a href="logout.php" >Sign Out</a> ||

    <div class="flex-containers">
      <div style="flex-grow: 1">


          <form action="promote_update.php" method="post">

                <td><select name="name_ID" required>
                  <option value="" selected disabled hidden>Choose player's name here</option>
                  <?php
                    // for each row of data returned,
                    //   construct an Address object proviuseding first and last name
                    //   emit an option for the pull down list such that
                    //     the displayed name is retrieved from the Address object
                    //     the value submitted is the unique ID for that player
                    // for example:
                    //     <option value="101">Duck, Daisy</option>
                    $stmt->data_seek(0);
                    while( $stmt->fetch() )
                    {
                      $player = new Address([$Name_First, $Name_Last]);
                      echo "<option value=\"$Name_ID\">".$player->name()."</option>\n";
                    }
                  ?>
                </select></td>
              </tr>
              <tr>
                <div class="form-group <?php echo (!empty($type_err)) ? 'has-error' : ''; ?>">
                      <label>Promote this person to be:<sup>*</sup></label>
                      <select name="type" class="form-control" value="<?php echo $type; ?>">
                        <option value="M">MANAGER</option>
                        <option value="A">ADMIN</option>
                      </select>
                      <span class="help-block"><?php echo $type_err; ?></span>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Submit">
                    <input type="reset" class="btn btn-default" value="Reset">
                </div>
              </tr>
            </form>

      </div>
      <div style="flex-grow: 1">






      </div>
    </div>
  </body>
  </body>

  <?php
  require "footer.php";
  ?>
