<?php
ob_start();
require_once '../@/config.php';
require_once '../@/init.php';
if(!$user->isloggedin() || !$user->isadmin($odb)) die("Unauthorized");

$query = "SELECT * FROM `products`";
$productsQuery = $odb->query($query);
$products = $productsQuery->fetchAll(PDO::FETCH_ASSOC);


include 'header.php';
?>

<div class="col-md-10 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">New Product</h4>
                  <form class="forms-sample" action="ajax/productscreate.php" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Image</label>
                        <input class="form-control" type="file" name="the_file" id="fileToUpload">
                    </div>
                    <div class="form-group">
                      <label>Name</label>
                      <input type="text" class="form-control" name="name" placeholder="Name">
                    </div>
                    <div class="form-group">
                      <label>Price</label>
                      <input type="text" class="form-control" name="price" placeholder="Price">
                    </div>
                    <div class="form-group">
                      <label>Category</label>
                      <input type="text" class="form-control" name="category" placeholder="Category">
                    </div>
                    
                    <button type="submit" name="submit" class="btn btn-primary me-2">Submit</button>
                  </form>
                </div>
              </div>
            </div>
</div>

<?php
include 'footer.php';
?>