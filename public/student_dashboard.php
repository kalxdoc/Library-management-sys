<?php
// Developed by Md. Ikramul Hassan
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'student') {
    header("Location: login.php");
    exit();
}
require_once __DIR__ . '/../src/Models/Book.php';
require_once __DIR__ . '/../src/Models/Transaction.php';

$bookModel = new Book();
$txModel = new Transaction();
$availableBooks = $bookModel->getAll();
$myBooks = $txModel->getStudentTransactions($_SESSION['user_id']);
?>
<!DOCTYPE html>
<html class="light" lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Student Dashboard - LMS</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com" rel="preconnect" />
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "on-secondary-container": "#425b7f",
                        "on-background": "#191c1d",
                        "on-tertiary-fixed": "#311300",
                        "on-tertiary-fixed-variant": "#733600",
                        "inverse-on-surface": "#f0f1f2",
                        "surface-container-lowest": "#ffffff",
                        "tertiary-fixed": "#ffdbc7",
                        "secondary": "#475f84",
                        "on-primary-container": "#fffdff",
                        "primary-container": "#1976d2",
                        "on-primary-fixed": "#001c3a",
                        "surface-container": "#edeeef",
                        "surface-variant": "#e1e3e4",
                        "background": "#f8f9fa",
                        "on-tertiary": "#ffffff",
                        "primary": "#005dac",
                        "outline": "#717783",
                        "on-error-container": "#93000a",
                        "on-surface-variant": "#414752",
                        "secondary-container": "#bad3fd",
                        "surface-container-highest": "#e1e3e4",
                        "primary-fixed-dim": "#a5c8ff",
                        "on-secondary": "#ffffff",
                        "error-container": "#ffdad6",
                        "surface-bright": "#f8f9fa",
                        "on-secondary-fixed-variant": "#2f486a",
                        "surface-dim": "#d9dadb",
                        "on-error": "#ffffff",
                        "on-tertiary-container": "#fffeff",
                        "error": "#ba1a1a",
                        "tertiary-fixed-dim": "#ffb688",
                        "outline-variant": "#c1c6d4",
                        "inverse-surface": "#2e3132",
                        "secondary-fixed": "#d4e3ff",
                        "on-secondary-fixed": "#001c3a",
                        "inverse-primary": "#a5c8ff",
                        "surface-container-high": "#e7e8e9",
                        "secondary-fixed-dim": "#afc8f1",
                        "surface": "#f8f9fa",
                        "on-primary-fixed-variant": "#004786",
                        "surface-tint": "#005faf",
                        "surface-container-low": "#f3f4f5",
                        "tertiary": "#944700",
                        "tertiary-container": "#ba5b00",
                        "primary-fixed": "#d4e3ff",
                        "on-primary": "#ffffff",
                        "on-surface": "#191c1d"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                    "fontFamily": {
                        "headline": ["Inter"],
                        "body": ["Inter"],
                        "label": ["Inter"]
                    }
                },
            },
        }
    </script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f9fa;
            color: #191c1d;
            -webkit-font-smoothing: antialiased;
        }

        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }

        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f8f9fa;
        }

        ::-webkit-scrollbar-thumb {
            background: #e1e3e4;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #c1c6d4;
        }
    </style>
</head>

<body class="bg-background text-on-surface antialiased min-h-screen flex flex-col pt-20 pb-24 md:pb-0">
    <header class="hidden md:flex fixed top-0 left-0 w-full z-50 justify-between items-center px-8 py-4 h-20 bg-white/80 dark:bg-slate-900/80 backdrop-blur-xl shadow-[0_20px_40px_rgba(25,28,29,0.06)] bg-slate-50 dark:bg-slate-800/50">
        <div class="flex items-center gap-8">
            <div class="flex flex-col">
                <h1 class="text-2xl font-bold tracking-tighter text-blue-800 dark:text-blue-300 leading-tight">DIU Library</h1>
                <span class="text-sm font-medium text-slate-500 dark:text-slate-400">Student Portal</span>
            </div>
            <nav class="flex gap-6">
                <a class="text-blue-700 dark:text-blue-400 font-semibold border-b-2 border-blue-700 pb-1" href="#">Dashboard</a>
            </nav>
        </div>
        <div class="flex items-center gap-6">
            <button onclick="window.location.href='premium_upgrade.php'" class="text-amber-600 font-medium hover:text-amber-800 transition-colors">Upgrade to Premium</button>
            <a href="logout.php" class="text-slate-500 hover:text-slate-800 transition-colors font-medium">Logout</a>
            <div class="w-10 h-10 rounded-full overflow-hidden bg-surface-container-high border-2 border-transparent hover:border-primary transition-all cursor-pointer">
                <img alt="Student profile" class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBitgcgZxYMNSfqcPydk7IY7eu68WgxkXidF3mNrx8OK3WKqtcBTUT3X_hLb3GFEyXgkFJl-vYSLwW1pk_xYs9IJ_k7SLXYsYO6JWzN6aM9DUvEyqpZ45OUPEsJ5L2JRLI54-isDS3Xr5HN2y9IuO4-80mwCob92SY-Quf0uAtypy98sOYqPngvOZs9xDVfAH-_a63GtA4g5T0YXrWpG6Qnt0ydfYb6Y4zRSG35Qeeq-lN29LAe9lem661smUEgYAcyXxByG9Ys50aF" />
            </div>
        </div>
    </header>
    <main class="flex-grow max-w-6xl mx-auto w-full px-4 sm:px-6 lg:px-8 py-10 md:py-16">
        <div class="mb-16 flex flex-col md:flex-row md:items-end justify-between gap-6">
            <div>
                <h2 class="text-4xl md:text-5xl font-extrabold text-on-surface tracking-tight mb-2" style="letter-spacing: -0.02em;">Welcome back, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
                <p class="text-on-surface-variant text-lg">Your sanctuary awaits. Here is the status of your current research materials.</p>
            </div>
            <div class="bg-surface-container-lowest rounded-2xl p-4 shadow-[0_20px_40px_rgba(25,28,29,0.04)] border border-outline-variant/20 flex items-center gap-4 hidden md:flex">
                <div class="w-12 h-12 rounded-xl bg-primary-container/20 flex items-center justify-center text-primary">
                    <span class="material-symbols-outlined text-2xl">book_4</span>
                </div>
                <div>
                    <p class="text-sm font-medium text-on-surface-variant uppercase tracking-wider">Total Borrowed</p>
                    <p class="text-2xl font-bold text-on-surface"><?php echo count($myBooks); ?> <span class="text-sm font-normal text-on-surface-variant">/ 5 limit</span></p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            <div class="lg:col-span-7 flex flex-col h-full">
                <div class="flex items-center justify-between mb-6 px-2">
                    <h3 class="text-2xl font-bold text-on-surface tracking-tight flex items-center gap-3">
                        <span class="material-symbols-outlined text-primary" style="font-variation-settings: 'FILL' 1;">library_books</span>
                        My Borrowed Books
                    </h3>
                </div>
                <div class="bg-surface-container-lowest rounded-[1.5rem] p-6 sm:p-8 shadow-[0_20px_40px_rgba(25,28,29,0.06)] border border-outline-variant/20 flex-grow relative overflow-hidden group">
                    <div class="absolute top-0 right-0 w-64 h-64 bg-gradient-to-br from-primary/5 to-transparent rounded-bl-full opacity-50 pointer-events-none"></div>
                    <div class="overflow-x-auto relative z-10">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr>
                                    <th class="pb-4 pt-2 px-2 text-xs font-semibold text-on-surface-variant uppercase tracking-[0.05em]">Title</th>
                                    <th class="pb-4 pt-2 px-2 text-xs font-semibold text-on-surface-variant uppercase tracking-[0.05em]">Due Date</th>
                                    <th class="pb-4 pt-2 px-2 text-xs font-semibold text-on-surface-variant uppercase tracking-[0.05em] text-right">Fines ($)</th>
                                </tr>
                            </thead>
                            <tbody class="text-sm">
                                <?php if (empty($myBooks)): ?>
                                    <tr>
                                        <td colspan="3" class="py-4 text-center">You have no active borrows.</td>
                                    </tr>
                                <?php endif; ?>
                                <?php foreach ($myBooks as $tx): ?>
                                    <tr class="group/row hover:bg-surface-container-low transition-colors rounded-xl">
                                        <td class="py-4 px-2 font-medium text-on-surface rounded-l-xl">
                                            <div class="flex items-center gap-3">
                                                <div class="w-8 h-10 bg-surface-variant rounded flex items-center justify-center shrink-0">
                                                    <span class="material-symbols-outlined text-[16px] text-on-surface-variant">menu_book</span>
                                                </div>
                                                <div>
                                                    <?php echo htmlspecialchars($tx['title']); ?><br />
                                                    <span class="text-xs text-on-surface-variant font-normal">Author: <?php echo htmlspecialchars($tx['author']); ?></span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="py-4 px-2 text-on-surface-variant">
                                            <div class="inline-flex items-center px-2 py-1 rounded bg-secondary-container/50 text-on-secondary-container text-xs font-medium">
                                                <span class="material-symbols-outlined text-[14px] mr-1">calendar_today</span>
                                                <span class="deadline"><?php echo $tx['return_deadline']; ?></span>
                                            </div>
                                        </td>
                                        <td class="py-4 px-2 text-right font-medium text-on-surface rounded-r-xl">
                                            $<?php echo number_format($txModel->calculateFine($tx['return_deadline']), 2); ?><br />
                                            <button onclick="returnBook(<?php echo $tx['id']; ?>)" class="text-xs text-primary underline mt-1">Return Book</button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-5 flex flex-col h-full">
                <div class="flex items-center justify-between mb-6 px-2">
                    <h3 class="text-2xl font-bold text-on-surface tracking-tight flex items-center gap-3">
                        <span class="material-symbols-outlined text-secondary" style="font-variation-settings: 'FILL' 1;">auto_stories</span>
                        Available Books
                    </h3>
                </div>
                <div class="bg-surface-container-lowest rounded-[1.5rem] p-6 sm:p-8 shadow-[0_20px_40px_rgba(25,28,29,0.06)] border border-outline-variant/20 flex-grow flex flex-col relative overflow-hidden">
                    <div class="absolute inset-0 opacity-5 pointer-events-none" style="background-image: radial-gradient(circle at 2px 2px, #1976d2 1px, transparent 0); background-size: 24px 24px;"></div>
                    <div class="flex flex-col gap-4 relative z-10 flex-grow" id="catalogTable">
                        <?php foreach ($availableBooks as $book): ?>
                            <div class="p-4 rounded-xl hover:bg-surface-container-low transition-colors border border-transparent hover:border-outline-variant/30 flex items-start gap-4 <?= ($book['available_quantity'] <= 0) ? 'opacity-70' : '' ?>">
                                <div class="w-12 h-16 <?= ($book['available_quantity'] <= 0) ? 'bg-surface-container-high' : 'bg-gradient-to-br from-primary-container to-primary-fixed' ?> rounded shadow-sm shrink-0 flex items-center justify-center <?= ($book['available_quantity'] <= 0) ? 'text-outline' : 'text-on-primary-container' ?>">
                                    <span class="material-symbols-outlined opacity-50">book_2</span>
                                </div>
                                <div class="flex-grow min-w-0">
                                    <h4 class="font-bold text-on-surface truncate text-base"><?php echo htmlspecialchars($book['title']); ?></h4>
                                    <p class="text-sm text-on-surface-variant truncate mb-2"><?php echo htmlspecialchars($book['author']); ?></p>
                                    <div class="flex items-center justify-between">
                                        <?php if ($book['available_quantity'] > 0): ?>
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-full bg-secondary-fixed/50 text-on-secondary-fixed text-xs font-medium">
                                                <span class="w-1.5 h-1.5 rounded-full bg-primary mr-1.5"></span> <?php echo $book['available_quantity']; ?> / <?php echo $book['total_quantity']; ?> Available
                                            </span>
                                            <button onclick="borrowBook(<?php echo $book['id']; ?>)" class="bg-primary-container hover:bg-primary text-on-primary-container hover:text-on-primary px-4 py-1.5 rounded-lg text-sm font-medium transition-all shadow-[0_4px_12px_rgba(25,28,29,0.08)] active:scale-95">
                                                Borrow
                                            </button>
                                        <?php else: ?>
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-full bg-surface-container-high text-on-surface-variant text-xs font-medium">
                                                <span class="w-1.5 h-1.5 rounded-full bg-outline mr-1.5"></span> Out of Stock
                                            </span>
                                            <span class="out-of-stock text-sm font-medium text-outline">Unavailable</span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="mt-4 pt-4 border-t border-transparent text-center">
                        <button class="text-primary hover:text-primary-fixed-dim text-sm font-medium transition-colors">Explore full catalog</button>
                    </div>
                </div>
            </div>

        </div>
    </main>
    <nav class="md:hidden fixed bottom-0 left-0 w-full z-50 flex justify-around items-center px-4 pb-6 pt-3 bg-slate-100 dark:bg-slate-800 backdrop-blur-2xl rounded-t-[1.5rem] shadow-[0_-10px_30px_rgba(0,0,0,0.03)]">
        <a class="flex flex-col items-center justify-center bg-blue-50 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300 rounded-[1.25rem] px-5 py-2 transition-all" href="#">
            <span class="material-symbols-outlined mb-1" style="font-variation-settings: 'FILL' 1;">home</span>
            <span class="text-[11px] font-medium uppercase tracking-widest font-['Inter']">Home</span>
        </a>
        <a class="flex flex-col items-center justify-center text-slate-400 dark:text-slate-500 px-5 py-2 hover:text-blue-600 dark:hover:text-blue-300 transition-all" href="premium_upgrade.php">
            <span class="material-symbols-outlined mb-1">star</span>
            <span class="text-[11px] font-medium uppercase tracking-widest font-['Inter']">Premium</span>
        </a>
        <a class="flex flex-col items-center justify-center text-slate-400 dark:text-slate-500 px-5 py-2 hover:text-blue-600 dark:hover:text-blue-300 transition-all" href="logout.php">
            <span class="material-symbols-outlined mb-1">logout</span>
            <span class="text-[11px] font-medium uppercase tracking-widest font-['Inter']">Logout</span>
        </a>
    </nav>
    <script src="assets/js/student.js"></script>
</body>

</html>