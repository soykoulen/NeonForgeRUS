<?php
$page_title = 'Клиенты | Дизайн Студия';
require_once '../config/database.php';
require_once '../includes/functions.php';
include '../includes/header.php';
?>

<div class="container">
    <div class="page-header">
        <h1><i class="fas fa-user-friends"></i> Наши клиенты</h1>
        <p>Довольные клиенты - наша главная награда</p>
    </div>

    <div class="clients-grid">
        <?php
        $stmt = $pdo->query("
            SELECT к.*, COUNT(п.ID_Проекта) as projects_count 
            FROM клиенты к
            LEFT JOIN проекты п ON к.ID_Клиента = п.ID_Клиента
            GROUP BY к.ID_Клиента
            ORDER BY projects_count DESC
        ");
        
        while ($client = $stmt->fetch(PDO::FETCH_ASSOC)) {
            ?>
            <div class="client-card">
                <div class="client-icon">
                    <i class="fas fa-building"></i>
                </div>
                <h3><?php echo htmlspecialchars($client['ФИО']); ?></h3>
                <?php if ($client['Компания']): ?>
                    <div class="client-company"><?php echo htmlspecialchars($client['Компания']); ?></div>
                <?php endif; ?>
                <div class="client-info">
                    <p><i class="fas fa-phone"></i> <?php echo htmlspecialchars($client['Телефон']); ?></p>
                    <p><i class="fas fa-envelope"></i> <?php echo htmlspecialchars($client['Email']); ?></p>
                    <p><i class="fas fa-map-marker-alt"></i> <?php echo htmlspecialchars($client['Адрес']); ?></p>
                    <div class="client-projects">
                        <i class="fas fa-project-diagram"></i> Проектов: <?php echo $client['projects_count']; ?>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
</div>

<?php include '../includes/footer.php'; ?>