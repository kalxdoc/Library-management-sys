<?php
// Programmed by Md. Ikramul Hassan
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html class="h-full" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Admin Dashboard - LMS</title>
    <!-- Stitch Design dependencies -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;900&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "surface-dim": "#d9dadb",
                        "primary": "#002942",
                        "outline-variant": "#c4c6cd",
                        "on-tertiary-container": "#c1a17d",
                        "surface-bright": "#f8f9fa",
                        "on-tertiary-fixed-variant": "#5a4225",
                        "outline": "#74777d",
                        "on-error-container": "#93000a",
                        "secondary": "#4e6073",
                        "inverse-on-surface": "#f0f1f2",
                        "on-tertiary": "#ffffff",
                        "on-primary-fixed": "#001e31",
                        "inverse-primary": "#92ccff",
                        "surface-container-lowest": "#ffffff",
                        "surface-container-high": "#e7e8e9",
                        "primary-container": "#004063",
                        "surface-variant": "#e1e3e4",
                        "on-primary-fixed-variant": "#004b73",
                        "on-secondary-container": "#526478",
                        "tertiary": "#362308",
                        "on-surface": "#191c1d",
                        "background": "#f8f9fa",
                        "on-primary": "#ffffff",
                        "inverse-surface": "#2e3132",
                        "on-tertiary-fixed": "#291802",
                        "secondary-container": "#cfe2f9",
                        "error-container": "#ffdad6",
                        "tertiary-fixed-dim": "#e3c19b",
                        "on-secondary": "#ffffff",
                        "tertiary-fixed": "#ffddb7",
                        "secondary-fixed": "#d1e4fb",
                        "tertiary-container": "#4e381c",
                        "surface-container": "#edeeef",
                        "on-secondary-fixed": "#091d2e",
                        "error": "#ba1a1a",
                        "primary-fixed-dim": "#92ccff",
                        "on-error": "#ffffff",
                        "surface-tint": "#006497",
                        "on-surface-variant": "#43474c",
                        "on-primary-container": "#60aee9",
                        "surface-container-highest": "#e1e3e4",
                        "primary-fixed": "#cce5ff",
                        "secondary-fixed-dim": "#b5c8df",
                        "surface-container-low": "#f3f4f5",
                        "on-secondary-fixed-variant": "#36485b",
                        "on-background": "#191c1d",
                        "surface": "#f8f9fa"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.125rem",
                        "lg": "0.25rem",
                        "xl": "0.5rem",
                        "full": "0.75rem"
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
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .material-symbols-outlined[data-weight="fill"] {
            font-variation-settings: 'FILL' 1;
        }
    </style>
    <!-- Keep existing assets just in case -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="text-on-surface font-body h-full flex antialiased relative">
    <!-- Background Image with Overlay -->
    <div class="fixed inset-0 z-[-1] bg-[url('https://images.unsplash.com/photo-1507842217343-583bb7270b66?q=80&w=2000&auto=format&fit=crop')] bg-cover bg-center">
        <div class="absolute inset-0 bg-black/60"></div>
    </div>

    <!-- TopAppBar -->
    <header class="bg-[#F8F9FA]/80 backdrop-blur-md dark:bg-slate-900/80 text-[#002942] dark:text-white font-['Inter'] text-sm font-medium uppercase tracking-widest fixed top-0 right-0 left-0 h-16 no-border bg-surface-container-low-logic flat flex items-center justify-between px-8 w-full z-40">
        <div class="flex items-center gap-4 w-1/3">
            <div class="relative w-full max-w-md focus-within:ring-1 focus-within:ring-[#002942] rounded-DEFAULT">
                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant">search</span>
                <input class="w-full bg-surface-container-high border-none rounded-DEFAULT py-2 pl-10 pr-4 text-sm focus:ring-0 focus:border-b-2 focus:border-b-primary focus:bg-surface-container-lowest transition-colors placeholder-on-surface-variant/50" placeholder="SEARCH ARCHIVE..." type="text"/>
            </div>
        </div>
        <div class="flex items-center gap-6 text-sm">
            Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?> &nbsp;
            <a href="logout.php" class="text-slate-200 hover:text-white transition-all flex items-center justify-center">
                Logout
            </a>
            <div class="w-8 h-8 rounded-full bg-surface-container-highest overflow-hidden ml-2 flex items-center justify-center ring-2 ring-primary-fixed">
                <img alt="Administrator Profile" class="w-full h-full object-cover" data-alt="Portrait of a mature male librarian" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAjrOU-z3Q1d0M2sH5du4CwzDJOu2hWJdN7_1wDjZpd4MP5zY-hUumEt2by1vINu3dnqdasEx8Rpn3l2RA9sISQ8TjZFQxZKI4sXq3eaonIttXMwEDuHBGLuxZ6J00vteQKDrXKl9HiC_VjDBaJRQ-9mU-hhRfJPxEnbMrb5BX-3pb10sRhb8OMBLIZXYE5yuWVzqVpCKlWLKFuROr1APaGDDHdYTHD31cehzhHSUk8hzHZy9PSNthZDNt5VINhQPmjHrF3b7Nspsg"/>
            </div>
        </div>
    </header>

    <!-- Main Content Canvas -->
    <main class="flex-1 pt-24 px-8 pb-12 w-full mx-auto flex flex-col items-center gap-8">
        <!-- Large Centered Title -->
        <h1 class="text-4xl md:text-5xl font-black text-white tracking-tight text-center mt-4 mb-2 drop-shadow-md">Admin Dashboard</h1>
        
        <!-- Header Section -->
        <div class="flex flex-col gap-2 text-center w-full max-w-5xl">
            <h2 class="text-3xl font-headline font-semibold text-white drop-shadow-sm tracking-[-0.02em]">Book Management</h2>
            <p class="text-sm text-white/80 font-body drop-shadow-sm">Add, edit, and manage the archival inventory.</p>
        </div>

        <!-- Inline Form Module (Surface Container Low -> Lowest) -->
        <section class="bg-surface-container-low/95 backdrop-blur-sm rounded-lg p-6 flex flex-col gap-4 w-full max-w-5xl shadow-xl book-management">
            <h3 class="text-xs font-label uppercase tracking-widest text-on-surface-variant mb-2">Acquisition Entry</h3>
            
            <form id="bookForm" method="POST" action="" class="bg-surface-container-lowest p-6 rounded-DEFAULT shadow-[0_4px_24px_rgba(25,28,29,0.04)] grid grid-cols-1 md:grid-cols-12 gap-4 items-end horizontal-form">
                <input type="hidden" id="bookId" name="id">
                
                <div class="md:col-span-3 flex flex-col gap-1">
                    <label class="text-[0.6875rem] font-label uppercase tracking-[0.05em] text-on-surface-variant">Book Title</label>
                    <input type="text" id="title" name="title" class="w-full bg-surface-container-high border-none rounded-DEFAULT py-2 px-3 text-sm focus:ring-0 focus:border-b-2 focus:border-b-primary focus:bg-surface-container-lowest transition-colors" placeholder="Book Title" required/>
                </div>
                
                <div class="md:col-span-2 flex flex-col gap-1">
                    <label class="text-[0.6875rem] font-label uppercase tracking-[0.05em] text-on-surface-variant">Author</label>
                    <input type="text" id="author" name="author" class="w-full bg-surface-container-high border-none rounded-DEFAULT py-2 px-3 text-sm focus:ring-0 focus:border-b-2 focus:border-b-primary focus:bg-surface-container-lowest transition-colors" placeholder="Author" required/>
                </div>
                
                <div class="md:col-span-2 flex flex-col gap-1">
                    <label class="text-[0.6875rem] font-label uppercase tracking-[0.05em] text-on-surface-variant">ISBN</label>
                    <input type="text" id="isbn" name="isbn" class="w-full bg-surface-container-high border-none rounded-DEFAULT py-2 px-3 text-sm focus:ring-0 focus:border-b-2 focus:border-b-primary focus:bg-surface-container-lowest transition-colors" placeholder="ISBN" required/>
                </div>
                
                <div class="md:col-span-2 flex flex-col gap-1">
                    <label class="text-[0.6875rem] font-label uppercase tracking-[0.05em] text-on-surface-variant">Category</label>
                    <input type="text" id="category" name="category" class="w-full bg-surface-container-high border-none rounded-DEFAULT py-2 px-3 text-sm focus:ring-0 focus:border-b-2 focus:border-b-primary focus:bg-surface-container-lowest transition-colors" placeholder="Category"/>
                </div>
                
                <div class="md:col-span-1 flex flex-col gap-1">
                    <label class="text-[0.6875rem] font-label uppercase tracking-[0.05em] text-on-surface-variant">Qty</label>
                    <input type="number" id="quantity" name="quantity" class="w-full bg-surface-container-high border-none rounded-DEFAULT py-2 px-3 text-sm focus:ring-0 focus:border-b-2 focus:border-b-primary focus:bg-surface-container-lowest transition-colors" placeholder="Qty" min="1" required/>
                </div>
                
                <div class="md:col-span-2 flex flex-col gap-2">
                    <button type="submit" id="submitBtn" class="w-full h-9 bg-gradient-to-tr from-primary to-primary-container text-on-primary rounded-DEFAULT text-sm font-semibold hover:opacity-90 transition-opacity flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined text-[1.125rem]">add</span> Add Book
                    </button>
                    <button type="button" id="cancelBtn" class="hidden w-full h-9 bg-surface-container-high text-on-surface rounded-DEFAULT text-sm font-semibold hover:opacity-90 transition-opacity flex items-center justify-center gap-2" style="display:none;">
                        Cancel
                    </button>
                </div>
            </form>
        </section>

        <!-- Data Table Module -->
        <section class="bg-surface-container-low/95 backdrop-blur-sm rounded-lg p-6 flex flex-col gap-4 w-full max-w-5xl shadow-xl">
            <div class="flex justify-between items-center mb-2">
                <h3 class="text-xs font-label uppercase tracking-widest text-on-surface-variant">Inventory Index</h3>
            </div>
            
            <div class="bg-surface-container-lowest rounded-DEFAULT overflow-hidden shadow-[0_4px_24px_rgba(25,28,29,0.04)]">
                <table id="booksTable" class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-surface-container-low/50">
                            <th class="px-3 py-3 text-[0.6875rem] font-label uppercase tracking-[0.05em] text-on-surface-variant font-semibold">Title</th>
                            <th class="px-3 py-3 text-[0.6875rem] font-label uppercase tracking-[0.05em] text-on-surface-variant font-semibold">Author</th>
                            <th class="px-3 py-3 text-[0.6875rem] font-label uppercase tracking-[0.05em] text-on-surface-variant font-semibold">ISBN</th>
                            <th class="px-3 py-3 text-[0.6875rem] font-label uppercase tracking-[0.05em] text-on-surface-variant font-semibold">Category</th>
                            <th class="px-3 py-3 text-[0.6875rem] font-label uppercase tracking-[0.05em] text-on-surface-variant font-semibold">Qty</th>
                            <th class="px-4 py-3 text-[0.6875rem] font-label uppercase tracking-[0.05em] text-on-surface-variant font-semibold text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="booksBody" class="text-sm font-body">
                        <!-- Data loaded via JS -->
                    </tbody>
                </table>
            </div>
        </section>
    </main>

    <script src="assets/js/admin.js"></script>
</body>
</html>
