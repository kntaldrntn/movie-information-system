<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie Management</title>

    <link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>🎬</text></svg>">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    colors: {
                        cyan: tailwind.theme.colors.cyan,
                    }
                }
            }
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <style>
        [x-cloak] { display: none !important; }

        html {
            font-family: 'Inter', sans-serif;
            scroll-behavior: smooth;
        }

        body {
            /* Fallback color */
            background-color: #030712;

            /* Noise pattern background */
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='100' height='100' viewBox='0 0 100 100'%3E%3Cfilter id='n' x='0' y='0'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.8' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100' height='100' filter='url(%23n)' opacity='0.05'/%3E%3C/svg%3E");
            background-repeat: repeat;

            color: #d1d5db; /* gray-300 */

            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        /* Firefox */
        html {
            scrollbar-width: thin;
            scrollbar-color: #4B5563 #1F2937; /* gray-600 gray-800 */
        }

        /* WebKit (Chrome, Safari, Edge) */
        ::-webkit-scrollbar { width: 8px; height: 8px; }
        ::-webkit-scrollbar-track { background: #1F2937; border-radius: 4px; }
        ::-webkit-scrollbar-thumb { background: #4B5563; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #6B7280; /* gray-500 */ }
    </style>
</head>
