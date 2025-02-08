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
        :checked="$checked"
        class="peer hidden"
    />

    <span
        tabindex="0"
        role="checkbox"
        :aria-checked="$checked"
        class="size-5 cursor-pointer justify-center rounded border-2 border-indigo-400 bg-slate-50 peer-checked:border-indigo-400 peer-checked:bg-indigo-400"
        onclick="toggleCheckbox('{{ $name }}')"
        onkeydown="handleKeyPress(event, '{{ $name }}')"
    >
        <x-lucide-check class="size-4 text-slate-50" />
    </span>
</div>

<script>
    function toggleCheckbox(checkboxId) {
        const checkbox = document.getElementById(checkboxId)
        const visualCheckbox = checkbox.nextElementSibling

        checkbox.checked = !checkbox.checked
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

</div>
