$targetDir = "../assets/uploads/";
$imageName = uniqid() . basename($_FILES["image"]["name"]);
$targetFile = $targetDir . $imageName;

if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
  $sql = "INSERT INTO products (name, description, price, image_path) 
          VALUES (?, ?, ?, ?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ssds", $_POST['name'], $_POST['description'], $_POST['price'], $imageName);
  $stmt->execute();
}