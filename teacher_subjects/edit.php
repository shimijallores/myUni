<?php
require('../functions.php');
require('../partials/head.php');


if (empty($_SESSION['user'])) {
    header('location: /menu.php');
    exit();
}

// Fetch Subject
$stmt = $connection->prepare("select * from subjects where id = ?;");
$stmt->execute([$_GET['id']]);
$subject = $stmt->fetch();

if (!$subject) {
    header('location: index.php');
    exit();
}

// Fetch Rooms
$stmt = $connection->prepare("select * from rooms");
$stmt->execute();
$rooms = $stmt->fetchAll();

// Fetch Teachers
$stmt = $connection->prepare("select * from teachers");
$stmt->execute();
$teachers = $stmt->fetchAll();
?>

<body class="bg-gray-50" x-data="{ sidebarOpen: false }">
    <?php require('../partials/admin_sidebar.php'); ?>

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
                    <h1 class="text-2xl font-extrabold text-gray-900">Edit Subject</h1>
                </div>
            </div>
        </div>

        <!-- Content Area -->
        <div class="p-6">
            <div class="max-w-2xl mx-auto">
                <!-- Subject Info Card -->
                <div class="bg-white border border-gray-300 p-6 mb-6">
                    <h2 class="text-lg font-medium text-gray-900 mb-2">Editing: Subject <?= htmlspecialchars($subject['code']) ?></h2>
                </div>

                <!-- Edit Form -->
                <div class="bg-white border border-gray-300 p-6">
                    <form action="update.php" method="POST" class="space-y-6">
                        <!-- Current subject id -->
                        <input type="hidden" name="id" value="<?= $subject['id'] ?>">

                        <!-- Subject Code -->
                        <div class="relative z-0 w-full group">
                            <input type="text"
                                name="code"
                                id="code"
                                value="<?= htmlspecialchars($subject['code']) ?>"
                                class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-neutral-800 peer"
                                placeholder=" "
                                required />
                            <label for="code"
                                class="peer-focus:font-medium absolute text-sm text-gray-600 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-neutral-800 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                Subject Code
                            </label>
                        </div>

                        <!-- Subject Description -->
                        <div class="relative z-0 w-full group">
                            <input type="text"
                                name="description"
                                id="description"
                                value="<?= htmlspecialchars($subject['description']) ?>"
                                class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-neutral-800 peer"
                                placeholder=" "
                                required />
                            <label for="description"
                                class="peer-focus:font-medium absolute text-sm text-gray-600 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-neutral-800 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                Description
                            </label>
                        </div>

                        <!-- Subject Days -->
                        <div class="relative z-0 w-full group">
                            <input type="text"
                                name="days"
                                id="days"
                                value="<?= htmlspecialchars($subject['days']) ?>"
                                class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-neutral-800 peer"
                                placeholder=" "
                                required />
                            <label for="days"
                                class="peer-focus:font-medium absolute text-sm text-gray-600 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-neutral-800 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                Days
                            </label>
                        </div>

                        <!-- Subject Time -->
                        <div class="relative z-0 w-full group">
                            <input type="text"
                                name="time"
                                id="time"
                                value="<?= htmlspecialchars($subject['time']) ?>"
                                class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-neutral-800 peer"
                                placeholder=" "
                                required />
                            <label for="time"
                                class="peer-focus:font-medium absolute text-sm text-gray-600 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-neutral-800 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                Time
                            </label>
                        </div>

                        <!-- Price per unit -->
                        <div class="relative z-0 w-full group">
                            <input type="text"
                                name="price_unit"
                                id="price_unit"
                                value="<?= htmlspecialchars($subject['price_unit']) ?>"
                                class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-neutral-800 peer"
                                placeholder=" "
                                required />
                            <label for="price_unit"
                                class="peer-focus:font-medium absolute text-sm text-gray-600 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-neutral-800 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                Price per unit
                            </label>
                        </div>

                        <!-- Units -->
                        <div class="relative z-0 w-full group">
                            <input type="text"
                                name="units"
                                id="units"
                                value="<?= htmlspecialchars($subject['units']) ?>"
                                class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-neutral-800 peer"
                                placeholder=" "
                                required />
                            <label for="units"
                                class="peer-focus:font-medium absolute text-sm text-gray-600 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-neutral-800 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                Units
                            </label>
                        </div>

                        <!-- Room -->
                        <div>
                            <label for="room" class="block text-sm font-medium text-gray-700 mb-2">Room</label>
                            <select name="room" id="room"
                                class="w-full px-3 py-2 border border-gray-300 bg-white focus:ring-neutral-800 focus:border-neutral-800">
                                <option value="">Select Room</option>
                                <?php foreach ($rooms as $room): ?>
                                    <option value="<?= $room['id'] ?>" <?= $room['id'] === $subject['room_id'] ? 'selected' : ''  ?>><?= htmlspecialchars($room['name']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <!-- Teachers -->
                        <div>
                            <label for="teacher" class="block text-sm font-medium text-gray-700 mb-2">Teacher</label>
                            <select name="teacher" id="teacher"
                                class="w-full px-3 py-2 border border-gray-300 bg-white focus:ring-neutral-800 focus:border-neutral-800">
                                <option value="">Select Teacher</option>
                                <?php foreach ($teachers as $teacher): ?>
                                    <option value="<?= $teacher['id'] ?>" <?= $teacher['id'] === $subject['teacher_id'] ? 'selected' : ''  ?>><?= htmlspecialchars($teacher['name']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>


                        <!-- Action Buttons -->
                        <div class="flex items-center space-x-4">
                            <button type="submit"
                                class="flex-1 px-4 py-2 bg-neutral-800 hover:bg-neutral-900 text-white font-medium border border-neutral-800 focus:ring-2 focus:ring-neutral-800 focus:ring-offset-2">
                                Update Subject Info
                            </button>
                            <a href="index.php"
                                class="px-4 py-2 border border-gray-300 bg-white hover:bg-gray-50 text-gray-700 font-medium focus:ring-2 focus:ring-neutral-800 focus:ring-offset-2">
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>

<?php
require('../partials/footer.php')
?>