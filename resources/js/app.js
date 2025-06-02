import './bootstrap';
import Alpine from 'alpinejs';
import { Livewire, Alpine as LivewireAlpine } from 'livewire'; // Import Livewire and its Alpine integration

window.Alpine = Alpine; // Make Alpine available globally
Alpine.start(); // Start Alpine.js

Livewire.start(); // Start Livewire
