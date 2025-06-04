// resources/js/app.js

import './bootstrap'; // Contains Axios setup etc.

// Import Alpine.js directly by its package name
import Alpine from 'alpinejs';

// Import Livewire and its Alpine.js integration
import { Livewire, Alpine as LivewireAlpine } from 'livewire';

// Make Alpine.js globally available on the window object
window.Alpine = Alpine;

// Attach Alpine.js to Livewire (important for Livewire's magic properties like wire:model.live)
LivewireAlpine.plugin(Alpine);

// Start Alpine.js
Alpine.start();

// Start Livewire
Livewire.start();
