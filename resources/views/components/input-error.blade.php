<div>
    @if($errors->has($name))
        <p class="input_error">
            {{$errors->first($name)}}
        </p>
    @endif
</div>