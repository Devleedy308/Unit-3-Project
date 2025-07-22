<?php
require_once(__DIR__ . '/../model/menu_db.php');

$items = get_all_menu_items();
include('../view/menu_view.php');
