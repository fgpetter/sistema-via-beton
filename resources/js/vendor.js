/*
Template Name: Tailwik - TailwindCSS Admin & Dashboard Template
Author: Themesdesign
Version: 2.0.0
Website: https://themesdesign.in/
Contact: themesdesign.in@gmail.com
File: vendor.js
*/


import '../css/style.css'

import 'preline';

window.initializeModalSelects = () => {
    const options = {
        toggleTag: '<button type="button" aria-haspopup="listbox" aria-expanded="false"><span data-title></span><svg aria-hidden="true" class="size-4 shrink-0 text-default-500" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg></button>',
        toggleClasses: 'form-input modal-select-toggle w-full gap-2 text-left',
        wrapperClasses: 'w-full',
        dropdownClasses: 'absolute z-50 mt-1 max-h-60 w-full overflow-y-auto rounded-md border border-default-200 bg-white p-1 shadow-lg',
        optionClasses: 'cursor-pointer rounded px-3 py-2 text-sm text-default-700 hover:bg-default-100',
        dropdownVerticalFixedPlacement: 'bottom',
        optionAllowEmptyOption: true,
    };

    document.querySelectorAll('select[data-modal-select]').forEach((select) => {
        const placeholder = select.querySelector('option[value=""]')?.textContent?.trim();

        select.setAttribute('data-hs-select', JSON.stringify({
            ...options,
            placeholder: placeholder || 'Selecione...',
        }));
    });

    window.HSSelect?.autoInit();
};

document.addEventListener('livewire:init', () => {
    Livewire.hook('morph', () => {
        document.querySelectorAll('select[data-modal-select]').forEach((select) => {
            const instance = window.HSSelect?.getInstance(select, true);

            instance?.element.destroy();
        });
    });

    Livewire.hook('morphed', () => window.initializeModalSelects?.());
});

import 'simplebar';

import { createIcons, icons } from 'lucide';
createIcons({ icons });
