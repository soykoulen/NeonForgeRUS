<?php
$page_title = 'Услуги | NeonForge';
require_once '../config/database.php';
require_once '../includes/functions.php';
include '../includes/header.php';
?>

<div class="container">
    <div class="page-header">
        <h1><i class="fas fa-cogs"></i> Наши услуги</h1>
        <p>Широкий спектр дизайн-услуг для вашего бизнеса</p>
    </div>

    <div class="services-grid">
        <?php
        $stmt = $pdo->query("SELECT * FROM услуги ORDER BY Базовая_стоимость DESC");
        
        while ($service = $stmt->fetch(PDO::FETCH_ASSOC)) {
            ?>
            <div class="service-card">
                <div class="service-icon">
                    <i class="fas fa-star"></i>
                </div>
                <h3><?php echo htmlspecialchars($service['Название']); ?></h3>
                <p class="service-description"><?php echo htmlspecialchars($service['Описание']); ?></p>
                <div class="service-details">
                    <div class="detail">
                        <i class="fas fa-clock"></i>
                        <span>Длительность: <?php echo $service['Длительность']; ?> дней</span>
                    </div>
                    <div class="detail price-detail">
                        <i class="fas fa-ruble-sign"></i>
                        <span>От <?php echo formatPrice($service['Базовая_стоимость']); ?></span>
                    </div>
                </div>
                <button class="btn btn-primary btn-order">Заказать</button>
            </div>
            <?php
        }
        ?>
    </div>
</div>

<?php include '../includes/footer.php'; ?>