<?php
$page_title = 'Поиск | Дизайн Студия';
require_once 'config/database.php';
require_once 'includes/functions.php';
include 'includes/header.php';

$search_term = $_GET['q'] ?? '';
$search_results = [];

if (!empty($search_term)) {
    // Поиск по проектам
    $stmt = $pdo->prepare("
        SELECT п.*, 'проект' as type, к.ФИО as client_name
        FROM проекты п
        JOIN клиенты к ON п.ID_Клиента = к.ID_Клиента
        WHERE п.Название LIKE ? OR к.ФИО LIKE ?
        LIMIT 10
    ");
    $like_term = "%$search_term%";
    $stmt->execute([$like_term, $like_term]);
    $project_results = $stmt->fetchAll();
    
    // Поиск по дизайнерам
    $stmt = $pdo->prepare("
        SELECT *, 'дизайнер' as type
        FROM дизайнеры
        WHERE ФИО LIKE ? OR Специализация LIKE ?
        LIMIT 10
    ");
    $stmt->execute([$like_term, $like_term]);
    $designer_results = $stmt->fetchAll();
    
    // Поиск по клиентам
    $stmt = $pdo->prepare("
        SELECT *, 'клиент' as type
        FROM клиенты
        WHERE ФИО LIKE ? OR Компания LIKE ? OR Email LIKE ?
        LIMIT 10
    ");
    $stmt->execute([$like_term, $like_term, $like_term]);
    $client_results = $stmt->fetchAll();
    
    $search_results = array_merge($project_results, $designer_results, $client_results);
}
?>

<div class="container">
    <div class="search-hero">
        <h1>Поиск по студии</h1>
        <form action="search.php" method="GET" class="search-form">
            <div class="search-wrapper">
                <i class="fas fa-search search-icon"></i>
                <input type="text" name="q" class="search-input-large" placeholder="Поиск проектов, дизайнеров, клиентов..." value="<?php echo htmlspecialchars($search_term); ?>">
                <button type="submit" class="btn btn-primary">Найти</button>
            </div>
        </form>
    </div>

    <?php if (!empty($search_term)): ?>
        <div class="search-results">
            <h2>Результаты поиска: "<?php echo htmlspecialchars($search_term); ?>"</h2>
            
            <?php if (empty($search_results)): ?>
                <div class="no-results">
                    <i class="fas fa-search"></i>
                    <p>Ничего не найдено. Попробуйте изменить поисковый запрос.</p>
                </div>
            <?php else: ?>
                <div class="results-grid">
                    <?php foreach ($search_results as $result): ?>
                        <div class="result-card">
                            <div class="result-type <?php echo $result['type']; ?>">
                                <?php echo $result['type'] == 'проект' ? '<i class="fas fa-project-diagram"></i> Проект' : ($result['type'] == 'дизайнер' ? '<i class="fas fa-user"></i> Дизайнер' : '<i class="fas fa-user-friends"></i> Клиент'); ?>
                            </div>
                            <h3>
                                <?php if ($result['type'] == 'проект'): ?>
                                    <?php echo htmlspecialchars($result['Название']); ?>
                                <?php else: ?>
                                    <?php echo htmlspecialchars($result['ФИО']); ?>
                                <?php endif; ?>
                            </h3>
                            <?php if ($result['type'] == 'проект'): ?>
                                <p>Клиент: <?php echo htmlspecialchars($result['client_name']); ?></p>
                                <p>Стоимость: <?php echo formatPrice($result['Стоимость']); ?></p>
                                <?php echo getStatusBadge($result['Статус']); ?>
                            <?php elseif ($result['type'] == 'дизайнер'): ?>
                                <p>Специализация: <?php echo htmlspecialchars($result['Специализация']); ?></p>
                                <p>Стаж: <?php echo $result['Стаж']; ?> лет</p>
                            <?php else: ?>
                                <p>Email: <?php echo htmlspecialchars($result['Email']); ?></p>
                                <p>Телефон: <?php echo htmlspecialchars($result['Телефон']); ?></p>
                                <?php if ($result['Компания']): ?>
                                    <p>Компания: <?php echo htmlspecialchars($result['Компания']); ?></p>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</div>

<?php include 'includes/footer.php'; ?>