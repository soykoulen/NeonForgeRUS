<?php
$page_title = 'Проекты | NeonForge';
require_once '../config/database.php';
require_once '../includes/functions.php';
include '../includes/header.php';
?>

<div class="container">
    <div class="page-header">
        <h1><i class="fas fa-project-diagram"></i> Все проекты</h1>
        <div class="filter-bar">
            <select id="statusFilter" class="filter-select">
                <option value="all">Все статусы</option>
                <option value="в работе">В работе</option>
                <option value="завершен">Завершен</option>
                <option value="планируется">Планируется</option>
            </select>
            <input type="text" id="searchProject" placeholder="Поиск по проектам..." class="search-input">
        </div>
    </div>

    <div class="projects-grid" id="projectsContainer">
        <?php
        $stmt = $pdo->query("
            SELECT п.*, к.ФИО as клиент, д.ФИО as дизайнер, у.Название as услуга 
            FROM проекты п
            JOIN клиенты к ON п.ID_Клиента = к.ID_Клиента
            JOIN дизайнеры д ON п.ID_Дизайнера = д.ID_Дизайнера
            JOIN услуги у ON п.ID_Услуги = у.ID_Услуги
            ORDER BY п.ID_Проекта DESC
        ");
        
        while ($project = $stmt->fetch(PDO::FETCH_ASSOC)) {
            ?>
            <div class="project-card" data-status="<?php echo $project['Статус']; ?>" data-title="<?php echo htmlspecialchars($project['Название']); ?>">
                <div class="project-card-header">
                    <h3><?php echo htmlspecialchars($project['Название']); ?></h3>
                    <?php echo getStatusBadge($project['Статус']); ?>
                </div>
                <div class="project-card-body">
                    <p><i class="fas fa-user"></i> <strong>Клиент:</strong> <?php echo htmlspecialchars($project['клиент']); ?></p>
                    <p><i class="fas fa-paint-brush"></i> <strong>Дизайнер:</strong> <?php echo htmlspecialchars($project['дизайнер']); ?></p>
                    <p><i class="fas fa-tag"></i> <strong>Услуга:</strong> <?php echo htmlspecialchars($project['услуга']); ?></p>
                    <p><i class="fas fa-calendar"></i> <strong>Период:</strong> <?php echo date('d.m.Y', strtotime($project['Дата_начала'])); ?> 
                    <?php echo $project['Дата_окончания'] ? ' - ' . date('d.m.Y', strtotime($project['Дата_окончания'])) : ' - настоящее время'; ?></p>
                </div>
                <div class="project-card-footer">
                    <span class="price"><?php echo formatPrice($project['Стоимость']); ?></span>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
</div>

<?php include '../includes/footer.php'; ?>