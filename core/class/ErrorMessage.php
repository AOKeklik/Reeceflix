<?php

class ErrorMessage {
    static function show (string $txt) {
        exit ("
                <div class='h-100vh flex align-center justify-center'>
                    <div class='container'>
                        <p class='bg-red-400 text-red-900 p-5 flex align-center justify-center gap-2'>
                            $txt
                            <i class='bi bi-bug-fill text-2'></i>
                        </p>
                    </div>
                </div>
        ");
    }
    static function notification ($txt) {
        $txt = json_encode($txt);

        echo <<<HTML
            <script type="module">
                document.addEventListener("DOMContentLoaded", e => {
                    const msg = $txt
                    import('http://localhost/Reeceflix/assets/js/Natification.js').then(module => {
                        new module.default(msg)
                    }).catch(error => console.error("Failed to load module:", error));
                })
            </script>
        HTML;
        exit ("");
    }
}