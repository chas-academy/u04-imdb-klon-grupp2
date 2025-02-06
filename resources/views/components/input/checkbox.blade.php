@props([
    'name',
    'label',
    'checked' => false,
])

<div class="float-left flex flex-col gap-1">
    <!-- Label Text (Clickable) -->

    <label
        for="{{ $name }}"
        class="cursor-pointer text-sm font-medium text-slate-50"
    >
        {{ $label }}
    </label>

    <!-- Hidden Checkbox Input (Starts Unchecked) -->
    <input
        type="checkbox"
        id="{{ $name }}"
        name="{{ $name }}"
        @if($checked) checked @endif
        class="peer hidden"
    />

    <!-- Custom Visual Checkbox -->
    <span
        tabindex="0"
        role="checkbox"
        aria-checked="{{ $checked ? 'true' : 'false' }}"
        class="h-6 w-6 cursor-pointer justify-center rounded border-2 border-slate-50 bg-indigo-400 peer-checked:border-indigo-400 peer-checked:bg-slate-50"
        onclick="toggleCheckbox('{{ $name }}')"
        onkeydown="handleKeyPress(event, '{{ $name }}')"
    >
        <x-lucide-check class="h-5 w-5 text-slate-50" />
    </span>
</div>

<script>
    function toggleCheckbox(checkboxId) {
        const checkbox = document.getElementById(checkboxId)
        const visualCheckbox = checkbox.nextElementSibling // Get the <span>

        checkbox.checked = !checkbox.checked // Toggle checkbox state
        visualCheckbox.setAttribute(
            'aria-checked',
            checkbox.checked ? 'true' : 'false',
        ) // Update aria-checked
        checkbox.dispatchEvent(new Event('change')) // Fire change event for Livewire/Vue if needed
    }

    function handleKeyPress(event, checkboxId) {
        if (event.key === 'Enter' || event.key === ' ') {
            event.preventDefault() // Prevent scrolling on Space key
            toggleCheckbox(checkboxId)
        }
    }
</script>
