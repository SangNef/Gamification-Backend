<?php

use App\Http\Controllers\Admin\ChestController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EnemyController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\GameController;
use App\Http\Controllers\Admin\ItemController;
use App\Http\Controllers\Admin\ItemInEventController;
use App\Http\Controllers\Admin\NpcController;
use App\Http\Controllers\Admin\PackageController;
use App\Http\Controllers\Admin\QuestController;
use App\Http\Controllers\Admin\ShopController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/login', [UserController::class, 'showAdminLoginForm']);
Route::post('/login', [UserController::class, 'login']);
Route::get('/logout', [UserController::class, 'logout']);

Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/admin/dashboard', [DashboardController::class, 'showDashboard']);

    // Chest Management
    Route::prefix('/admin/chest-manage')->group(function () {
        Route::get('/', [ChestController::class, 'showAllChest']);
        Route::get('/create', [ChestController::class, 'createChestForm']);
        Route::post('/create', [ChestController::class, 'createChest'])->name('chest.create');
        Route::delete('/delete-{id}', [ChestController::class, 'deleteChest'])->name('chest.delete');
        Route::get('/update-{id}', [ChestController::class, 'updateChestForm']);
        Route::put('/update-{id}', [ChestController::class, 'updateChest'])->name('chest.update');
        Route::get('/chest-{id}-detail', [ChestController::class, 'chestDetail']);
    });

    // Item Management
    Route::prefix('/admin/item-manage')->group(function () {
        Route::get('/', [ItemController::class, 'itemManage']);
        Route::get('/create', [ItemController::class, 'createItemForm']);
        Route::post('/create', [ItemController::class, 'createItem'])->name('item.create');
        Route::get('/item-{id}-detail', [ItemController::class, 'itemDetail']);
        Route::get('/item-{id}-update', [ItemController::class, 'updateItemForm']);
        Route::put('/item-{id}-update', [ItemController::class, 'updateItem'])->name('item.update');
        Route::delete('/delete-{id}', [ItemController::class, 'deleteItem'])->name('item.delete');
        Route::put('/update-{id}-status', [ItemController::class, 'updateRewardStatus'])->name('reward.update');
    });

    // Package Management
    Route::prefix('/admin/package-manage')->group(function () {
        Route::get('/', [PackageController::class, 'packageManage']);
        Route::get('/create', [PackageController::class, 'createPackageForm']);
        Route::post('/create', [PackageController::class, 'createPackage'])->name('package.create');
        Route::get('/package-{id}-detail', [PackageController::class, 'packageDetail']);
        Route::get('/update-{id}', [PackageController::class, 'updatePackageForm']);
        Route::put('/update-{id}', [PackageController::class, 'updatePackage'])->name('package.update');
        Route::delete('/delete-{id}', [PackageController::class, 'deletePackage'])->name('package.delete');
    });

Route::prefix('/admin/quest-manage')->group(function () {
    Route::get('/', [QuestController::class, 'questManage']);
    Route::get('/create', [QuestController::class, 'createQuestForm']);
    Route::post('/create', [QuestController::class, 'createQuest'])->name('quest.create');
    Route::get('/update-{id}', [QuestController::class, 'updateQuestForm']);
    Route::put('/update-{id}', [QuestController::class, 'updateQuest'])->name('quest.update');
Route::delete('/delete-{id}', [QuestController::class, 'deleteQuest'])->name('quest.delete');
    Route::get('/detail-{id}', [QuestController::class, 'questDetail'])->name('quest.detail');
});

    // User Management
    Route::prefix('/admin/user-manage')->group(function () {
        Route::get('/', [UserController::class, 'userManage']);
        Route::put('/ban-{id}', [UserController::class, 'banUser'])->name('user.ban');
        Route::put('/unban-{id}', [UserController::class, 'unbanUser'])->name('user.unban');
    });


    // Shop Management
    Route::prefix('/admin/shop-manage')->group(function () {
        Route::get('/', [ShopController::class, 'index']);
    });

    // Event Manager
    Route::prefix('/admin/event-manage')->group(function () {
        Route::get('/', [EventController::class, 'index']);
        Route::get('/create', [EventController::class, 'createEventForm']);
        Route::post('/create', [EventController::class, 'createEvent'])->name('event.create');;
    });

    // Enemy Management
    Route::prefix('/admin/enemy-manage')->group(function () {
        Route::get('/', [EnemyController::class, 'index']);
        Route::get('/create', [EnemyController::class, 'createEnemyForm']);
        Route::post('/create', [EnemyController::class, 'createEnemy'])->name('enemy.create');
        Route::get('/enemy-{id}-detail', [EnemyController::class, 'enemyDetail']);
        Route::delete('/delete-{id}', [EnemyController::class, 'deleteEnemy'])->name('enemy.delete');
        Route::get('/update-{id}', [EnemyController::class, 'updateEnemyForm']);
        Route::put('/update-{id}', [EnemyController::class, 'updateEnemy'])->name('enemy.update');
    });

    // Game Management
    Route::prefix('/admin/game-manage')->group(function () {
        Route::get('/', [GameController::class, 'index']);
        Route::get('/create', [GameController::class, 'createGameForm']);
        Route::post('/create', [GameController::class, 'createGame'])->name('game.create');
        Route::get('/game-{id}-detail', [GameController::class, 'gameDetail']);
        Route::delete('/delete-{id}', [GameController::class, 'deleteGame'])->name('game.delete');
        Route::get('/update-{id}', [GameController::class, 'updateGameForm']);
        Route::put('/update-{id}', [GameController::class, 'updateGame'])->name('game.update');
    });

    //Chest Managemet
    // Chest Management
Route::prefix('/admin/chest-manage')->group(function () {
    Route::get('/', [ChestController::class, 'showAllChest']);
    Route::get('/create', [ChestController::class, 'createChestForm']);
    Route::post('/create', [ChestController::class, 'createChest'])->name('chest.create');
    Route::delete('/delete-{id}', [ChestController::class, 'deleteChest'])->name('chest.delete');
    Route::get('/update-{id}', [ChestController::class, 'updateChestForm']);
    Route::put('/update-{id}', [ChestController::class, 'updateChest'])->name('chest.update');
    Route::get('/chest-{id}-detail', [ChestController::class, 'chestDetail'])->name('chest.detail');
});

    // NPC Management
Route::prefix('/admin/npc-manage')->group(function () {
    Route::get('/', [NpcController::class, 'showAllNpcs']);
    Route::get('/create', [NpcController::class, 'createNpcForm']);
    Route::post('/create', [NpcController::class, 'createNpc'])->name('npc.create');
    Route::delete('/delete-{id}', [NpcController::class, 'deleteNpc'])->name('npc.delete');
    Route::get('/update-{id}', [NpcController::class, 'updateNpcForm']);
    Route::put('/update-{id}', [NpcController::class, 'updateNpc'])->name('npc.update');
    Route::get('/npc-{id}-detail', [NpcController::class, 'npcDetail']);
});


});

