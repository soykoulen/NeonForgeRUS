<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title ?? 'NeonForge'; ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="/desing_studio/assets/css/style.css">
</head>
<body>
    <nav class="navbar">
        <div class="nav-container">
            <a href="/desing_studio/index.php" class="logo">
                <i class="fas fa-palette"></i>
                <span>Neon<span class="logo-accent">Forge</span></span>
            </a>
            <button class="mobile-menu-btn" id="mobileMenuBtn">
                <i class="fas fa-bars"></i>
            </button>
            <ul class="nav-menu" id="navMenu">
                <li><a href="/desing_studio/index.php" class="nav-link"><i class="fas fa-home"></i> Главная</a></li>
                <li><a href="/desing_studio/pages/dashboard.php" class="nav-link"><i class="fas fa-chart-line"></i> Дашборд</a></li>
                <li><a href="/desing_studio/pages/projects.php" class="nav-link"><i class="fas fa-project-diagram"></i> Проекты</a></li>
                <li><a href="/desing_studio/pages/designers.php" class="nav-link"><i class="fas fa-users"></i> Дизайнеры</a></li>
                <li><a href="/desing_studio/pages/clients.php" class="nav-link"><i class="fas fa-user-friends"></i> Клиенты</a></li>
                <li><a href="/desing_studio/pages/services.php" class="nav-link"><i class="fas fa-cogs"></i> Услуги</a></li>
                <li><a href="/desing_studio/search.php" class="nav-link"><i class="fas fa-search"></i> Поиск</a></li>
            </ul>
        </div>
    </nav>
    <main class="main-content">