<?php
// Developed by Hasan Shahriar Nayan
session_start();
require_once __DIR__ . '/../src/Models/User.php';

$error = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userModel = new User();
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'] ?? 'student';

    if ($userModel->register($username, $email, $password, $role)) {
        header("Location: login.php?success=1");
        exit();
    } else {
        $error = "Registration failed. Email or Username might already exist.";
    }
}
?>
<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Library LMS - Register</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Newsreader:ital,wght@0,400..700;1,400..700&family=Public+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet"/>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "surface-container-highest": "#e3e2e0",
                        "on-secondary-container": "#55656f",
                        "secondary-container": "#d2e2ee",
                        "on-error": "#ffffff",
                        "surface-container": "#efeeeb",
                        "on-surface-variant": "#44474e",
                        "secondary": "#51606b",
                        "surface-container-low": "#f4f3f1",
                        "on-tertiary": "#ffffff",
                        "tertiary-fixed-dim": "#f1bd81",
                        "secondary-fixed-dim": "#b9c9d5",
                        "on-primary-fixed-variant": "#2e476f",
                        "on-error-container": "#93000a",
                        "secondary-fixed": "#d5e5f1",
                        "inverse-primary": "#aec7f7",
                        "on-secondary-fixed": "#0e1d26",
                        "tertiary-container": "#4f2f00",
                        "surface-container-high": "#e9e8e5",
                        "on-tertiary-container": "#c6965e",
                        "tertiary-fixed": "#ffddb9",
                        "primary-fixed": "#d6e3ff",
                        "surface": "#faf9f6",
                        "surface-variant": "#e3e2e0",
                        "outline": "#74777f",
                        "on-background": "#1a1c1a",
                        "on-primary": "#ffffff",
                        "error": "#ba1a1a",
                        "inverse-on-surface": "#f2f1ee",
                        "inverse-surface": "#2f312f",
                        "surface-dim": "#dbdad7",
                        "on-tertiary-fixed": "#2b1700",
                        "error-container": "#ffdad6",
                        "background": "#faf9f6",
                        "outline-variant": "#c4c6cf",
                        "on-primary-fixed": "#001b3d",
                        "primary-container": "#1b365d",
                        "primary": "#002046",
                        "on-tertiary-fixed-variant": "#623f0f",
                        "on-surface": "#1a1c1a",
                        "tertiary": "#321c00",
                        "surface-container-lowest": "#ffffff",
                        "primary-fixed-dim": "#aec7f7",
                        "surface-bright": "#faf9f6",
                        "on-secondary": "#ffffff",
                        "surface-tint": "#465f88",
                        "on-secondary-fixed-variant": "#3a4953",
                        "on-primary-container": "#87a0cd"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.125rem",
                        "lg": "0.25rem",
                        "xl": "0.5rem",
                        "full": "0.75rem"
                    },
                    "fontFamily": {
                        "headline": ["Newsreader", "serif"],
                        "body": ["Public Sans", "sans-serif"],
                        "label": ["Public Sans", "sans-serif"]
                    }
                }
            }
        }
    </script>
    <style>
        body {
            font-family: 'Public Sans', sans-serif;
        }
        h1, h2, h3, h4, h5, h6, .font-headline {
            font-family: 'Newsreader', serif;
        }
        .bg-glass {
            background-color: rgba(250, 249, 246, 0.8);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }
    </style>
</head>
<body class="bg-surface text-on-surface min-h-screen flex flex-col justify-center items-center py-12 px-4 sm:px-6 lg:px-8 selection:bg-surface-container-high">
    <div aria-hidden="true" class="fixed inset-0 z-[-1] pointer-events-none opacity-[0.03]">
        <svg height="100%" width="100%" xmlns="http://www.w3.org/2000/svg"><defs><pattern height="40" id="archival-grid" patternunits="userSpaceOnUse" width="40"><path d="M 40 0 L 0 0 0 40" fill="none" stroke="#1a1c1a" stroke-width="0.5"></path><circle cx="0" cy="0" fill="#1a1c1a" r="1"></circle></pattern></defs><rect fill="url(#archival-grid)" height="100%" width="100%"></rect></svg>
    </div>

    <main class="w-full max-w-md mx-auto">
        <div class="bg-surface-container-lowest p-10 md:p-14 lg:p-16 rounded-lg shadow-[0_24px_48px_-12px_rgba(0,32,70,0.06)] relative overflow-hidden">
            <div class="absolute top-0 right-0 -mr-16 -mt-16 w-32 h-32 bg-secondary-container rounded-full opacity-20 blur-2xl pointer-events-none"></div>
            
            <div class="text-center mb-10">
                <h1 class="font-headline text-4xl font-semibold text-primary tracking-tight mb-2">Create Account</h1>
                <p class="font-body text-secondary text-sm">Join The Digital Archivist</p>
            </div>

            <?php if($error): ?> 
                <p class="text-error font-body text-sm font-medium mb-6 text-center"><?php echo htmlspecialchars($error); ?></p> 
            <?php endif; ?>

            <form method="POST" class="space-y-6">
                <!-- Username Field -->
                <div>
                    <label class="block font-label text-sm font-medium text-on-surface-variant mb-1" for="username">Username</label>
                    <div class="relative">
                        <input autocomplete="username" class="appearance-none block w-full px-4 py-3 bg-surface-container-highest border-0 border-b-2 border-transparent text-on-surface focus:outline-none focus:ring-0 focus:border-primary font-body text-base rounded-t-sm transition-colors" id="username" name="username" placeholder="Username" required type="text"/>
                    </div>
                </div>

                <!-- Email Field -->
                <div>
                    <label class="block font-label text-sm font-medium text-on-surface-variant mb-1" for="email">Email Address</label>
                    <div class="relative">
                        <input autocomplete="email" class="appearance-none block w-full px-4 py-3 bg-surface-container-highest border-0 border-b-2 border-transparent text-on-surface focus:outline-none focus:ring-0 focus:border-primary font-body text-base rounded-t-sm transition-colors" id="email" name="email" placeholder="Email Address" required type="email"/>
                    </div>
                </div>

                <!-- Password Field -->
                <div>
                    <label class="block font-label text-sm font-medium text-on-surface-variant mb-1" for="password">Password</label>
                    <div class="relative">
                        <input autocomplete="new-password" class="appearance-none block w-full px-4 py-3 bg-surface-container-highest border-0 border-b-2 border-transparent text-on-surface focus:outline-none focus:ring-0 focus:border-primary font-body text-base rounded-t-sm transition-colors" id="password" name="password" placeholder="••••••••" required type="password"/>
                    </div>
                </div>

                <!-- Role Dropdown -->
                <div>
                    <label class="block font-label text-sm font-medium text-on-surface-variant mb-1" for="role">Account Role</label>
                    <div class="relative">
                        <select class="appearance-none block w-full px-4 py-3 bg-surface-container-highest border-0 border-b-2 border-transparent text-on-surface focus:outline-none focus:ring-0 focus:border-primary font-body text-base rounded-t-sm transition-colors cursor-pointer" id="role" name="role" required>
                            <option value="student">Student</option>
                            <option value="admin">Administrator</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-on-surface-variant">
                            <span class="material-symbols-outlined text-[20px]">expand_more</span>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="pt-4">
                    <button class="w-full flex justify-center py-4 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-on-primary bg-gradient-to-r from-primary to-primary-container hover:from-primary-container hover:to-primary focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-all duration-300 transform hover:-translate-y-0.5" type="submit">
                        Register
                    </button>
                </div>
            </form>

            <div class="mt-8 text-center">
                <p class="font-body text-sm text-secondary">
                    Already have an account? 
                    <a class="font-medium text-primary hover:text-primary-container hover:underline decoration-from-font underline-offset-4 transition-colors" href="login.php">Login here</a>
                </p>
            </div>
        </div>

        <!-- Bottom logo anchor -->
        <div class="mt-12 text-center flex items-center justify-center gap-2 opacity-60">
            <span class="material-symbols-outlined text-primary text-xl">auto_stories</span>
            <span class="font-headline italic text-lg text-primary">The Digital Archivist</span>
        </div>
    </main>
</body>
</html>
