<?php
require_once 'config/database.php';

class Equipment {
    public static function getAll($search = '', $category_id = '', $status = 'semua') {
        $pdo = getDB();
        $sql = "SELECT equipments.*, categories.name as category_name FROM equipments 
                JOIN categories ON equipments.category_id = categories.id WHERE 1=1";
        $params = [];

        if (!empty($search)) {
            $sql .= " AND (equipments.name LIKE ? OR equipments.asset_code LIKE ?)";
            $params[] = "%$search%";
            $params[] = "%$search%";
        }

        if (!empty($category_id)) {
            $sql .= " AND equipments.category_id = ?";
            $params[] = $category_id;
        }

        if (!empty($status) && $status != 'semua') {
            $sql .= " AND equipments.status = ?";
            $params[] = $status;
        }

        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getCategories() {
        $pdo = getDB();
        return $pdo->query("SELECT * FROM categories")->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function create($data) {
        $pdo = getDB();
        $stmt = $pdo->prepare("INSERT INTO equipments (category_id, asset_code, name, specification, condition, status, daily_rental_fee, image_path, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW())");
        $stmt->execute([
            $data['category_id'], $data['asset_code'], $data['name'], 
            $data['specification'], $data['condition'], $data['status'], 
            $data['daily_rental_fee'], $data['image_path']
        ]);
    }

    public static function find($id) {
        $pdo = getDB();
        $stmt = $pdo->prepare("SELECT equipments.*, categories.name as category_name FROM equipments JOIN categories ON equipments.category_id = categories.id WHERE equipments.id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}