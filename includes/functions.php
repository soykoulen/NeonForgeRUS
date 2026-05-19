<?php
function formatPrice($price) {
    return number_format($price, 0, '', ' ') . ' ₽';
}

function getStatusBadge($status) {
    $badges = [
        'активен' => 'badge-success',
        'закрыт' => 'badge-secondary',
        'в работе' => 'badge-primary',
        'завершен' => 'badge-success',
        'планируется' => 'badge-warning'
    ];
    $class = isset($badges[$status]) ? $badges[$status] : 'badge-info';
    return "<span class='badge $class'>$status</span>";
}

function getProjectStatus($status) {
    $statuses = [
        'в работе' => 'В работе',
        'завершен' => 'Завершен',
        'планируется' => 'Планируется'
    ];
    return isset($statuses[$status]) ? $statuses[$status] : $status;
}
?>