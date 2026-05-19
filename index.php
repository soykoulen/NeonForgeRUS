<?php
$page_title = 'Главная | NeonForge';
require_once 'config/database.php';
require_once 'includes/functions.php';
include 'includes/header.php';
?>

<div class="hero">
    <div class="hero-content">
        <h1 class="hero-title animate-title">Создаем <span class="gradient-text">вдохновение</span></h1>
        <p class="hero-subtitle animate-fade">Превращаем идеи в уникальные дизайн-решения для вашего бизнеса</p>
        <div class="hero-buttons animate-up">
            <a href="pages/projects.php" class="btn btn-primary">Наши проекты</a>
            <a href="pages/services.php" class="btn btn-outline">Услуги</a>
        </div>
    </div>
    <div class="hero-stats">
        <div class="stat-card animate-up-delay">
            <div class="stat-number">17</div>
            <div class="stat-label">Проектов</div>
        </div>
        <div class="stat-card animate-up-delay-2">
            <div class="stat-number">12</div>
            <div class="stat-label">Дизайнеров</div>
        </div>
        <div class="stat-card animate-up-delay-3">
            <div class="stat-number">12</div>
            <div class="stat-label">Клиентов</div>
        </div>
    </div>
</div>

<div class="container">
    <div class="section-header">
        <h2 class="section-title">Последние проекты</h2>
        <p class="section-subtitle">Наши последние работы, созданные с любовью к деталям</p>
    </div>

    <div class="projects-grid">
        <?php
        $stmt = $pdo->query("
            SELECT п.*, к.ФИО as клиент, д.ФИО as дизайнер, у.Название as услуга 
            FROM проекты п
            JOIN клиенты к ON п.ID_Клиента = к.ID_Клиента
            JOIN дизайнеры д ON п.ID_Дизайнера = д.ID_Дизайнера
            JOIN услуги у ON п.ID_Услуги = у.ID_Услуги
            ORDER BY п.ID_Проекта DESC LIMIT 6
        ");
        
        while ($project = $stmt->fetch(PDO::FETCH_ASSOC)) {
            ?>
            <div class="project-card">
                <div class="project-card-header">
                    <h3><?php echo htmlspecialchars($project['Название']); ?></h3>
                    <?php echo getStatusBadge($project['Статус']); ?>
                </div>
                <div class="project-card-body">
                    <p><i class="fas fa-user"></i> <strong>Клиент:</strong> <?php echo htmlspecialchars($project['клиент']); ?></p>
                    <p><i class="fas fa-paint-brush"></i> <strong>Дизайнер:</strong> <?php echo htmlspecialchars($project['дизайнер']); ?></p>
                    <p><i class="fas fa-tag"></i> <strong>Услуга:</strong> <?php echo htmlspecialchars($project['услуга']); ?></p>
                    <p><i class="fas fa-calendar"></i> <strong>Начало:</strong> <?php echo date('d.m.Y', strtotime($project['Дата_начала'])); ?></p>
                </div>
                <div class="project-card-footer">
                    <span class="price"><?php echo formatPrice($project['Стоимость']); ?></span>
                </div>
            </div>
            <?php
        }
        ?>
    </div>

    <div class="features">
        <div class="feature">
            <div class="feature-icon">
                <i class="fas fa-rocket"></i>
            </div>
            <h3>Быстрая реализация</h3>
            <p>Соблюдаем дедлайны и работаем на результат</p>
        </div>
        <div class="feature">
            <div class="feature-icon">
                <i class="fas fa-heart"></i>
            </div>
            <h3>Индивидуальный подход</h3>
            <p>Учитываем все пожелания клиентов</p>
        </div>
        <div class="feature">
            <div class="feature-icon">
                <i class="fas fa-trophy"></i>
            </div>
            <h3>Высокое качество</h3>
            <p>Используем современные технологии и материалы</p>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>