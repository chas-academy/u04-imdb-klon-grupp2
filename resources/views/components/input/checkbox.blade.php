@props([
    'name',
    'label',
    'checked' => false,
])

<div class="flex flex-col gap-1">
    <x-input.label for="{{ $name }}">
        {{ $label }}
    </x-input.label>

    <input
        type="checkbox"
        id="{{ $name }}"
        name="{{ $name }}"
        class="peer hidden"
    />

    <span
        tabindex="0"
        role="checkbox"
        aria-checked="{{ $checked ? 'true' : 'false' }}"
        class="flex size-5 cursor-pointer items-center justify-center rounded border-1 border-indigo-400 bg-slate-50 peer-checked:border-indigo-400 peer-checked:bg-indigo-400"
        onclick="toggleCheckbox('{{ $name }}')"
        onkeydown="handleKeyPress(event, '{{ $name }}')"
    >
        <x-lucide-check class="size-5 text-slate-50" />
    </span>
</div>
<script>
    function toggleCheckbox(checkboxId) {
        const checkbox = document.getElementById(checkboxId)

        checkbox.checked = !checkbox.checked
        checkbox.setAttribute('checked', checkbox.checked ? 'checked' : null)

        const visualCheckbox = document.querySelector(
            `[aria-checked][role="checkbox"][tabindex="0"]`,
        )
        visualCheckbox.setAttribute(
            'aria-checked',
            checkbox.checked ? 'true' : 'false',
        )
    }

    function handleKeyPress(event, checkboxId) {
        if (event.key === 'Enter' || event.key === ' ') {
            event.preventDefault()
            toggleCheckbox(checkboxId)
        }
    }
</script>
