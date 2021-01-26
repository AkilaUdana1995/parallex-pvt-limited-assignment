<!DOCTYPE html>
    
   <html>
      <head>
           <title> php crud</title>
           <script type="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
           <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
           <script type="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
      </head>
      <body>
        <?php require_once 'process.php' ; ?>

            <?php
            if (isset($_SESSION['message'])) : ?> 

            <div class="alert alert-<?=$_SESSION['msg_type']?>">
            
                <?php
                echo $_SESSION['message'];
                unset($_SESSION['message']);
                ?>
            </div>
    <?php endif  ?>
        <div class="container"> 

       <?php
         $mysqli = new mysqli('localhost','root','','abc_test') or die(mysqli_error($mysqli)); 
          $result =$mysqli->query("SELECT * FROM data") or die($mysqli->error);
          
          //pre_r($result);
          //pre_r($result->fetch_assoc());
         // pre_r($result->fetch_assoc());
        ?>
        <div class="row justify-content-right">
            <table>
                <thead>
                    <tr>
                        <th>Category</th>
                        <th>Product</th>
                        <th colspan="2">Action</th>
                    </tr>
                </thead>
         <?php
         while ($row = $result->fetch_assoc()): ?>
            <tr>
              <td><?php echo $row['category']; ?></td>
              <td><?php echo $row['product']; ?></td>
              <td>
                  <a href="index.php?edit=<?php echo $row['id']; ?>"
                    class = "btn btn-info">Edit</a>
                    <a href="process.php?Delete=<?php echo $row['id']; ?>"
                        class = "btn btn-info">Delete</a>
              </td>
              
            </tr>
          
          <?php endwhile; ?>

            </table>
        </div>

        <?php
          function pre_r($array)
          {
            echo '<pre>';
            print_r($array);
            echo '</pre>' ;
          }
       ?>

        <div class="row justify-content-center">
          <form action="process.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $id; ?>"
          <div class="form-group">
              <label> Category</label>
              <input type="text" name="category" class="form-control" value="<?php echo $category; ?>" placeholder="Enter product catogery">
          </div>

          <div class="form-group">
            <label>Product</label>
            <input type="text" name="product" class="form-control"  value="<?php echo $product; ?>" placeholder="Enter product">
        </div>

        <div class="form-group">
            <?php
               if ($update == true): ?>
               <button style="background-color: green" type="submit" class="btn btn-info" name="save">Save</button>
               <?php else:?>

              
            <button style="background-color: green" type="submit" class="btn btn-primary" name="save">Save</button>
        <?php endif; ?>

        </div>
          </form>
          </div>
      </div>

      </body>