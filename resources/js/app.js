import "./bootstrap";
import "../css/app.css";
// Import logo for Vite to process
import.meta.glob("../images/**/*.{png,jpg,jpeg,gif,svg,webp}", { eager: true });

// Register Alpine collapse plugin with Livewire's Alpine instance
import collapse from "@alpinejs/collapse";

document.addEventListener("alpine:init", () => {
    Alpine.plugin(collapse);
});
