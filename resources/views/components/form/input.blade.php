@props(['label', 'name', 'type' => 'text', 'value' => null, 'placeholder' => null])

<div class="mb-3">
    <label for="{{ $name }}" class="form-label">{{ $label }}</label>
    <input type="{{ $type }}" class="form-control" id="{{ $name }}" name="{{ $name }}" value="{{ old($name, $value) }}" placeholder="{{ $placeholder }}">
    @error($name)
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>