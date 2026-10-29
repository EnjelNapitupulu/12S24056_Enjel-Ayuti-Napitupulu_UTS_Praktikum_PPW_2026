<?php
require_once 'models/Equipment.php';

class EquipmentController {
    public function index() {
        $search = $_GET['search'] ?? '';
        $category_id = $_GET['category_id'] ?? '';
        $status = $_GET['status'] ?? 'semua';

        $equipments = Equipment::getAll($search, $category_id, $status);
        $categories = Equipment::getCategories();

        require_once 'views/equipments/index.php';
    }

    public function create() {
        $categories = Equipment::getCategories();
        require_once 'views/equipments/create.php';
    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $asset_code = $_POST['asset_code'];
            $name = $_POST['name'];
            $category_id = $_POST['category_id'];
            $specification = $_POST['specification'];
            $condition = $_POST['condition'];
            $daily_rental_fee = $_POST['daily_rental_fee'];
            
            // Upload Foto
            $image_path = null;
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
                $filename = time() . '_' . uniqid() . '.' . $ext;
                move_uploaded_file($_FILES['image']['tmp_name'], 'uploads/' . $filename);
                $image_path = 'uploads/' . $filename;
            }

            Equipment::create([
                'category_id' => $category_id,
                'asset_code' => $asset_code,
                'name' => $name,
                'specification' => $specification,
                'condition' => $condition,
                'status' => 'tersedia',
                'daily_rental_fee' => $daily_rental_fee,
                'image_path' => $image_path
            ]);

            header('Location: index.php?page=equipments&success=1');
            exit;
        }
    }

    public function show($id) {
        $equipment = Equipment::find($id);
        require_once 'views/equipments/show.php';
    }
}