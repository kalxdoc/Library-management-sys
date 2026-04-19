<?php
// public/login.php
session_start();
require_once __DIR__ . '/../src/Models/User.php';

$error = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userModel = new User();
    $user = $userModel->login($_POST['email'], $_POST['password']);

    if ($user) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];

        if ($user['role'] === 'admin') {
            header("Location: admin_dashboard.php");
        } else {
            header("Location: student_dashboard.php");
        }
        exit();
    } else {
        $error = "Invalid email or password.";
    }
}
?>
<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Login | Digital Curator</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Newsreader:ital,opsz,wght@0,6..72,200..800;1,6..72,200..800&family=Public+Sans:wght@100..900&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "surface-container-lowest": "#ffffff",
                        "on-primary-container": "#8690ee",
                        "surface": "#f9f9f9",
                        "inverse-on-surface": "#f1f1f1",
                        "background": "#f9f9f9",
                        "primary-fixed-dim": "#bdc2ff",
                        "primary-fixed": "#e0e0ff",
                        "on-secondary": "#ffffff",
                        "on-error": "#ffffff",
                        "primary": "#000666",
                        "surface-container-high": "#e8e8e8",
                        "on-background": "#1a1c1c",
                        "primary-container": "#1a237e",
                        "on-error-container": "#93000a",
                        "on-primary-fixed-variant": "#343d96",
                        "surface-container": "#eeeeee",
                        "secondary-container": "#d2d4ff",
                        "on-surface": "#1a1c1c",
                        "error": "#ba1a1a",
                        "surface-tint": "#4c56af",
                        "surface-dim": "#dadada",
                        "on-secondary-fixed": "#151839",
                        "outline": "#767683",
                        "outline-variant": "#c6c5d4",
                        "on-primary-fixed": "#000767",
                        "surface-bright": "#f9f9f9",
                        "error-container": "#ffdad6",
                        "on-primary": "#ffffff",
                        "tertiary": "#380b00",
                        "on-tertiary-fixed-variant": "#7b2e12",
                        "tertiary-container": "#5c1800",
                        "secondary-fixed": "#e0e0ff",
                        "secondary": "#585c80",
                        "surface-container-highest": "#e2e2e2",
                        "on-tertiary-container": "#e17c5a",
                        "on-secondary-fixed-variant": "#414467",
                        "tertiary-fixed-dim": "#ffb59d",
                        "on-tertiary-fixed": "#390c00",
                        "on-secondary-container": "#575b7f",
                        "surface-variant": "#e2e2e2",
                        "surface-container-low": "#f3f3f3",
                        "inverse-primary": "#bdc2ff",
                        "tertiary-fixed": "#ffdbd0",
                        "on-tertiary": "#ffffff",
                        "inverse-surface": "#2f3131",
                        "secondary-fixed-dim": "#c1c3ed",
                        "on-surface-variant": "#454652"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.125rem",
                        "lg": "0.25rem",
                        "xl": "0.5rem",
                        "full": "0.75rem"
                    },
                    "fontFamily": {
                        "headline": ["Newsreader"],
                        "body": ["Public Sans"],
                        "label": ["Public Sans"]
                    }
                },
            },
        }
    </script>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        body {
            font-family: 'Public Sans', sans-serif;
            background-color: #f9f9f9;
        }
        .font-serif {
            font-family: 'Newsreader', serif;
        }
        .tonal-shift-header {
            background: rgba(249, 249, 249, 0.8);
            backdrop-filter: blur(20px);
        }
        /* Custom subtle shadow for the lift effect */
        .academic-shadow {
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.15);
        }
        .bg-overlay {
            background: linear-gradient(to bottom, rgba(249, 249, 249, 0.2), rgba(249, 249, 249, 0.4));
        }
    </style>
</head>
<body class="flex flex-col min-h-screen bg-surface selection:bg-primary-container selection:text-white relative">
<!-- Global Background Image -->
<div class="fixed inset-0 -z-20 w-full h-full">
    <img alt="Atmospheric view of a classic library" class="object-cover w-full h-full blur-[4px] scale-105" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBKlXWnKiWtyi29UUMcVO-RT3VmRmcTDb-8b9mMpmGII6otgjByxGO7_xkkvx-CCUpF6Rrn05Wo2TGYDUHhqSsUGIGoNsibgtKY3sy-he6Sbg4alGNT-EwJzvfHgWsndrosSma-gIES3w3KtIfV0e21vDSXk6atHPho1yuPn9WrmCO2gppbk4v2V_PGsi96F3vRp0uHl_Q6kA-kqPGCwzY64CsAWuKlWWyKqPcqtOQDTkQ1_ELCi_KO8KxYE6zd1M4SshUmYbzEWNVx"/>
    <div class="absolute inset-0 bg-white/30 mix-blend-overlay"></div>
</div>
<!-- Brand Header -->
<main class="flex-grow flex items-center justify-center px-6 pt-20 pb-12">
    <div class="w-full max-w-md z-10">
        <!-- Login Card -->
        <div class="academic-shadow rounded p-10 md:p-12 border border-white/50 bg-white/70 backdrop-blur-md">
            <div class="mb-10">
                <h1 class="font-serif text-4xl font-bold text-primary-container tracking-tight mb-2">
                    Welcome Back
                </h1>
                <p class="text-on-surface-variant text-sm tracking-wide">
                    Access your university's curated digital collection.
                </p>
            </div>
            <form method="POST" class="space-y-6">
                <!-- PHP Error/Success messages -->
                <?php if(isset($_GET['success'])): ?> 
                    <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50" role="alert">
                        <span class="font-medium">Success!</span> Registration successful! Please login.
                    </div>
                <?php endif; ?>
                <?php if($error): ?> 
                    <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50" role="alert">
                        <span class="font-medium">Error!</span> <?php echo htmlspecialchars($error); ?>
                    </div>
                <?php endif; ?>

                <!-- Email / Student ID -->
                <div class="space-y-2">
                    <label class="block font-label text-sm font-medium text-on-surface-variant tracking-wide" for="email">
                        Email / Student ID
                    </label>
                    <input class="block w-full bg-surface-container-highest border-none focus:ring-0 focus:bg-surface-container-lowest focus:border-b-2 focus:border-primary transition-all duration-200 px-4 py-3 rounded-t" id="email" name="email" placeholder="e.g. s1234567@university.edu" type="email" required/>
                </div>
                <!-- Password -->
                <div class="space-y-2">
                    <div class="flex justify-between items-center">
                        <label class="block font-label text-sm font-medium text-on-surface-variant tracking-wide" for="password">
                            Password
                        </label>
                        <a class="text-xs font-medium text-primary hover:underline transition-all" href="#">
                            Forgot Password?
                        </a>
                    </div>
                    <input class="block w-full bg-surface-container-highest border-none focus:ring-0 focus:bg-surface-container-lowest focus:border-b-2 focus:border-primary transition-all duration-200 px-4 py-3 rounded-t" id="password" name="password" type="password" required/>
                </div>
                <!-- Actions -->
                <div class="pt-4">
                    <button class="w-full bg-gradient-to-b from-primary to-primary-container text-white font-label font-bold uppercase tracking-widest text-sm py-4 rounded hover:opacity-90 active:scale-[0.98] transition-all duration-150 shadow-lg" type="submit">
                        Sign In
                    </button>
                </div>
            </form>
            <!-- Alternative Action -->
            <div class="mt-10 pt-8 text-center border-t border-surface-variant">
                <p class="text-on-surface-variant text-sm">
                    Don't have an account? 
                    <a class="text-primary font-bold hover:underline ml-1" href="register.php">
                        Create an account
                    </a>
                </p>
            </div>
        </div>
        <!-- Contextual Information -->
    </div>
</main>
<!-- Footer (Minimal) -->
<footer class="w-full bg-white/80 backdrop-blur-md px-12 py-10 z-10">
    <div class="max-w-7xl mx-auto text-center font-serif italic text-lg text-primary-container">
        DIU Library Management
    </div>
</footer>
</body>
</html>
