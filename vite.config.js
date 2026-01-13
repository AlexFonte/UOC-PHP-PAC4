import laravel from "laravel-vite-plugin";
import { defineConfig } from "vite";

export default defineConfig({
    plugins: [
        laravel({
            input: ["resources/css/app.css", "resources/js/app.js"],
            refresh: true,
        }),
    ],
    server: {
        host: true, // escucha en 0.0.0.0 dentro del contenedor
        port: 5173,
        strictPort: true,
        hmr: {
            host: "pec4.ddev.site", // tu dominio DDEV
            protocol: "wss", // porque navegas en https
            clientPort: 5173, // hmr por https de ddev
        },
    },
});
