<?php
require('../functions.php');
require('../partials/head.php');

if (empty($_SESSION['user'])) {
    header('location: /menu.php');
    exit();
}

$stmt = $connection->prepare("
    select s.id as id, s.code, s.description, s.days, s.time, s.price_unit, s.units, t.code as teacher_code, t.id as teacher_id, t.name as teacher_name, r.id as room_id, r.name as room_name from subjects s left join teachers t on t.id = s.teacher_id left join rooms r on s.room_id = r.id 
");

$stmt->execute();

$subjects = $stmt->fetchAll();
?>

<body class="bg-gray-50" x-data="{ sidebarOpen: false, deleteModal: false, deleteId: null }">
    <?php require('../partials/admin_sidebar.php'); ?>

    <!-- Delete Modal -->
    <?php require('delete.php') ?>

    <!-- Main Content -->
    <div class="flex-1 lg:ml-64">
        <!-- Header -->
        <div class="bg-white border-b border-gray-200 px-6 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <button @click="sidebarOpen = !sidebarOpen" class="lg:hidden text-gray-600 hover:text-gray-900">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                    <h1 class="text-2xl font-extrabold text-gray-900">Teacher Subjects</h1>
                </div>
                <a href="create.php"
                    class="inline-flex items-center px-4 py-2 bg-neutral-800 hover:bg-neutral-900 text-white font-medium border border-neutral-800 focus:ring-2 focus:ring-neutral-800 focus:ring-offset-2">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Add Subject
                </a>
            </div>
        </div>

        <!-- Content Area -->
        <div class="p-6">
            <!-- Teacher Subjects Table -->
            <div class="bg-white border border-gray-300">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50 border-b border-gray-200">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Code</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Description</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Days</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Time</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Price per unit</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Units</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Teacher</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Room</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <?php if (empty($subjects)) : ?>
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                                        <svg class="w-12 h-12 mx-auto mb-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                        </svg>
                                        <p class="text-sm">No subjects found.</p>
                                    </td>
                                </tr>
                            <?php else : ?>
                                <?php foreach ($subjects as $subject) : ?>
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 text-sm text-gray-900"><?= htmlspecialchars($subject['code']) ?></td>
                                        <td class="px-6 py-4 text-sm text-gray-900"><?= htmlspecialchars($subject['description']) ?></td>
                                        <td class="px-6 py-4 text-sm text-gray-900"><?= htmlspecialchars($subject['days']) ?></td>
                                        <td class="px-6 py-4 text-sm text-gray-900"><?= htmlspecialchars($subject['time']) ?></td>
                                        <td class="px-6 py-4 text-sm text-gray-900"><?= '₱' . htmlspecialchars(number_format($subject['price_unit'], 2)) ?></td>
                                        <td class="px-6 py-4 text-sm text-gray-900"><?= htmlspecialchars($subject['units']) ?></td>
                                        <td class="px-6 py-4 text-sm text-gray-900"><?= htmlspecialchars($subject['teacher_name']) ?></td>
                                        <td class="px-6 py-4 text-sm text-gray-900"><?= htmlspecialchars($subject['room_name']) ?></td>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center space-x-2">
                                                <a href="edit.php?id=<?= $subject['id'] ?>"
                                                    class="px-3 py-1 border border-gray-300 bg-white hover:bg-gray-50 text-gray-700 text-sm font-medium focus:ring-2 focus:ring-neutral-800 focus:ring-offset-2">
                                                    Edit
                                                </a>
                                                <button @click="deleteModal = true; deleteId = <?= $subject['id'] ?>"
                                                    class="px-3 py-1 bg-red-600 hover:bg-red-700 text-white text-sm font-medium border border-red-600 focus:ring-2 focus:ring-red-600 focus:ring-offset-2">
                                                    Delete
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

<?php
require('../partials/footer.php')
?>