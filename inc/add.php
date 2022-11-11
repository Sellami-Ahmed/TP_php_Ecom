<?php
$_SESSION['name_use']=false;
$_SESSION["event"]="add";
$modalname="New Product";
$req="required";

$category=$name=$price=$quantity=$image="";
if (isset($_GET["code"]) && !empty($_GET["code"]) && isset($_GET["event_id"]) && !empty($_GET["event_id"])){
    if ($_GET["event_id"]==2){
        $_SESSION["code"]= trim($_GET["code"]);
        $req="";
        $modalname="Edit Product";
        $_SESSION["event"]="edit";

        require_once "DBconnect.php";
        $param_code = trim($_GET["code"]);
        $sql = "SELECT * FROM produits WHERE code = ".$param_code;
        $result = $pdo->query($sql);
        $row = $result->fetch(PDO::FETCH_ASSOC);
        
        /* var_dump ($row); */
        $price=$row["Prix"];
        $quantity=$row["Quantite"];
        $category=$row["code_categorie"];
        $_SESSION["name"]=$name=$row["designation"];
        
        $image="./inc/images/$row[designation].jpg";
        

    }

}

require_once "DBconnect.php";
$designation_err='';
if(isset($_POST["type"]) && !empty($_POST["type"])){
    
    if ($_POST["type"]=='add'){
        $sql = "SELECT designation FROM produits WHERE designation = :designation";
        
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":designation", $param_designation, PDO::PARAM_STR);
            
            // Set parameters
            $param_designation = trim($_POST["designation"]);
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                if($stmt->rowCount() == 1){
                    $designation_err = "This name is already taken.";
                    $_SESSION['name_use']=true;
                } else{
                    $designation = trim($_POST["designation"]);
                    $code_categorie=$_POST['code_categorie'];
    $Prix=$_POST['Prix'];
    $Quantite=$_POST['Quantite'];
    $sql = "INSERT INTO produits (designation, Prix,Quantite,code_categorie) VALUES (?,?,?,?)";
    $data = array($designation, $Prix, $Quantite,$code_categorie); 
    $stmtt = $pdo->prepare($sql);
    $stmtt->execute($data);
    $target_dir = "./inc/images/";
    

    
    
    $target_file = $target_dir . basename($designation).".jpg";
    
    
    
    move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
    
    
                }
            }}
    
    
}
if ($_POST["type"]=='edit'){
    
    
                $designation = trim($_POST["designation"]);
                $code_categorie=$_POST['code_categorie'];
$Prix=$_POST['Prix'];
$Quantite=$_POST['Quantite'];
$sql = "UPDATE produits
set designation='$designation' ,Prix=$Prix ,Quantite=$Quantite ,code_categorie=$code_categorie
WHERE code=$_SESSION[code]";

$pdo->query($sql);
rename("./inc/images/".$_SESSION["name"].".jpg","./inc/images/".$designation.".jpg");



if (!(!isset($_FILES['fileToUpload']) || $_FILES['fileToUpload']['error'] == UPLOAD_ERR_NO_FILE)){


$file_to_dele="./inc/images/".$_SESSION["name"].".jpg";
unlink($file_to_dele); 
$target_dir = "./inc/images/";




$target_file = $target_dir . basename($designation).".jpg";



move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);}


            }
        }

    ?>
<div class="modal fade" id="modalADDForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-bold"><?php echo $modalname; ?> </h4>
                <button  type="button" class="close" data-dismiss="modal" onclick='location.href = "crudProduit.php";' aria-label="Close" >
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="crudProduit.php" method="POST" enctype="multipart/form-data">
                <div class="modal-body mx-3">
                    <div class="form-group">
                        <label>Product Name:</label>
                        <input type="text" class="form-control <?php echo (!empty($designation_err)) ? 'is-invalid' : ''; ?>"  name="designation" value="<?php echo $name; ?>" required>
                        <span class="invalid-feedback"><?php echo $designation_err; ?></span>

                    </div>
                    <div class="form-group">
                        <label for="inlineFormCustomSelectPref">Category:</label>
                        <select required class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref"
                        name="code_categorie" >
                        <option value="">Choose...</option>
                        <?php
									require_once "DBconnect.php";
									// read all row from database table
									$sql = "SELECT * FROM categories";
									$result = $pdo->query($sql);
									if (!$result) {
										die("Invalid query: " . $pdo->error);
									}
									// read data of each row
									while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
										echo "
                            
                            <option value=$row[code]";
                            if($row['code']==$category){
                                echo " selected='selected'";
                            }
                            echo ">$row[name]</option>
                            " ;}?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Price:</label>
                        <input type=number step=0.01 class="form-control" name="Prix" value=<?php echo $price; ?> required>
                    </div>
                    <div class="form-group" >
                        <label>Quantity:</label>
                        <input type="number" class="form-control" name="Quantite" value=<?php echo $quantity; ?> required>
                    </div>
                    <div>
                        <div>
                            <label for="Image" class="form-label">Image:</label>
                            <input <?php echo $req; ?> class="form-control" type="file" name="fileToUpload" id="fileToUpload" value="<?php echo $image; ?>" onchange="preview()" >

                        </div>
                        <div class="container col-md-6">
                            <img style="margin-top: 20px;" id="frame" src="<?php echo $image; ?>" class="img-fluid" />
                        </div>
                    </div>

                    <script>
                        function preview() {
                            frame.src = URL.createObjectURL(event.target.files[0]);
                        }

                        function clearImage() {
                            document.getElementById('formFile').value = null;
                            frame.src = "";
                        }
                    </script>

                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary" name="type" value=<?php echo $_SESSION['event']; ?>>Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
