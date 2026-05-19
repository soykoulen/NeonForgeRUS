<?php
$page_title = 'Дизайнеры | NeonForge';
require_once '../config/database.php';
require_once '../includes/functions.php';
include '../includes/header.php';
?>

<div class="container">
    <div class="page-header">
        <h1><i class="fas fa-users"></i> Наши дизайнеры</h1>
        <p>Талантливые профессионалы, готовые воплотить ваши идеи в жизнь</p>
    </div>

    <div class="designers-grid">
        <?php
        $stmt = $pdo->query("SELECT * FROM дизайнеры ORDER BY Стаж DESC");
        
        while ($designer = $stmt->fetch(PDO::FETCH_ASSOC)) {
            ?>
            <div class="designer-card">
                <div class="designer-avatar">
                    <i class="fas fa-user-circle"></i>
                </div>
                <h3><?php echo htmlspecialchars($designer['ФИО']); ?></h3>
                <div class="designer-specialty"><?php echo htmlspecialchars($designer['Специализация']); ?></div>
                <div class="designer-stats">
                    <div class="stat">
                        <i class="fas fa-briefcase"></i>
                        <span>Стаж: <?php echo $designer['Стаж']; ?> лет</span>
                    </div>
                    <div class="stat">
                        <i class="fas fa-ruble-sign"></i>
                        <span><?php echo formatPrice($designer['Зарплата']); ?></span>
                    </div>
                </div>
                <div class="designer-contacts">
                    <p><i class="fas fa-phone"></i> <?php echo htmlspecialchars($designer['Телефон']); ?></p>
                    <p><i class="fas fa-envelope"></i> <?php echo htmlspecialchars($designer['Email']); ?></p>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
</div>

<?php include '../includes/footer.php'; ?>