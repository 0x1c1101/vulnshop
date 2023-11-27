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
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
        <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Products</h4>
                  
                  <div class="table-responsive">
                  <a href="productsnew.php"><button type="button" class="btn btn-success" style="float: right;">New</button></a>
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>
                            ID
                          </th>
                          <th>
                            Name
                          </th>
                          <th>
                            Price
                          </th>
                          <th>
                            Image
                          </th>
                          <th>
                            Category
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        
                      <?php 

                        foreach ($products as $product){
                            echo ' <tr>
                            <td class="py-1">
                            ' . $product['id']. '
                            </td>
                            <td>
                            ' . $product['name']. '
                            </td>
                            <td>
                            $' . $product['price']. '
                            </td>
                            <td>
                            ' . $product['image']. '
                            <img src="/' . $product['image']. '" alt="image">
                            </td>
                            <td>
                            ' . $product['category']. '
                            </td>
                          </tr>';
                        }
                    ?>
                     


                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
</div>
<?php
include 'footer.php';
?>