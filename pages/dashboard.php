<?php
$page_title = 'Дашборд | NeonForge';
require_once '../config/database.php';
require_once '../includes/functions.php';
include '../includes/header.php';

// Статистика
$stats = [];
$stats['total_projects'] = $pdo->query("SELECT COUNT(*) FROM проекты")->fetchColumn();
$stats['active_projects'] = $pdo->query("SELECT COUNT(*) FROM проекты WHERE Статус = 'в работе'")->fetchColumn();
$stats['total_designers'] = $pdo->query("SELECT COUNT(*) FROM дизайнеры")->fetchColumn();
$stats['total_clients'] = $pdo->query("SELECT COUNT(*) FROM клиенты")->fetchColumn();
$stats['total_revenue'] = $pdo->query("SELECT SUM(Сумма) FROM договоры WHERE Статус = 'активен'")->fetchColumn();
$stats['total_revenue'] = $stats['total_revenue'] ?: 0;

// Популярные услуги
$popular_services = $pdo->query("
    SELECT у.Название, COUNT(п.ID_Проекта) as count
    FROM услуги у
    JOIN проекты п ON у.ID_Услуги = п.ID_Услуги
    GROUP BY у.ID_Услуги
    ORDER BY count DESC
    LIMIT 5
")->fetchAll();
?>

<div class="container">
    <div class="page-header">
        <h1><i class="fas fa-chart-line"></i> Дашборд студии</h1>
        <p>Аналитика и ключевые показатели</p>
    </div>

    <div class="stats-grid">
        <div class="stat-card-large">
            <div class="stat-icon"><i class="fas fa-project-diagram"></i></div>
            <div class="stat-info">
                <div class="stat-value"><?php echo $stats['total_projects']; ?></div>
                <div class="stat-label">Всего проектов</div>
            </div>
        </div>
        <div class="stat-card-large">
            <div class="stat-icon"><i class="fas fa-play-circle"></i></div>
            <div class="stat-info">
                <div class="stat-value"><?php echo $stats['active_projects']; ?></div>
                <div class="stat-label">Активных проектов</div>
            </div>
        </div>
        <div class="stat-card-large">
            <div class="stat-icon"><i class="fas fa-users"></i></div>
            <div class="stat-info">
                <div class="stat-value"><?php echo $stats['total_designers']; ?></div>
                <div class="stat-label">Дизайнеров</div>
            </div>
        </div>
        <div class="stat-card-large">
            <div class="stat-icon"><i class="fas fa-user-friends"></i></div>
            <div class="stat-info">
                <div class="stat-value"><?php echo $stats['total_clients']; ?></div>
                <div class="stat-label">Клиентов</div>
            </div>
        </div>
        <div class="stat-card-large revenue">
            <div class="stat-icon"><i class="fas fa-ruble-sign"></i></div>
            <div class="stat-info">
                <div class="stat-value"><?php echo formatPrice($stats['total_revenue']); ?></div>
                <div class="stat-label">Доход по активным договорам</div>
            </div>
        </div>
    </div>

    <div class="dashboard-sections">
        <div class="dashboard-card">
            <h2><i class="fas fa-chart-bar"></i> Популярные услуги</h2>
            <div class="services-list">
                <?php foreach ($popular_services as $service): ?>
                <div class="service-item">
                    <span class="service-name"><?php echo htmlspecialchars($service['Название']); ?></span>
                    <div class="progress-bar">
                        <div class="progress-fill" style="width: <?php echo ($service['count'] / $stats['total_projects']) * 100; ?>%"></div>
                    </div>
                    <span class="service-count"><?php echo $service['count']; ?> проектов</span>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="dashboard-card">
            <h2><i class="fas fa-trophy"></i> Топ дизайнеров по проектам</h2>
            <?php
            $top_designers = $pdo->query("
                SELECT д.ФИО, COUNT(п.ID_Проекта) as project_count
                FROM дизайнеры д
                JOIN проекты п ON д.ID_Дизайнера = п.ID_Дизайнера
                GROUP BY д.ID_Дизайнера
                ORDER BY project_count DESC
                LIMIT 5
            ")->fetchAll();
            ?>
            <div class="top-list">
                <?php foreach ($top_designers as $index => $designer): ?>
                <div class="top-item">
                    <div class="top-rank">#<?php echo $index + 1; ?></div>
                    <div class="top-name"><?php echo htmlspecialchars($designer['ФИО']); ?></div>
                    <div class="top-count"><?php echo $designer['project_count']; ?> проектов</div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>